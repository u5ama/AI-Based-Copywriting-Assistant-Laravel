<?php

namespace App\Http\Controllers;

use App\Models\AdResponse;
use App\Models\Ads;
use App\Models\ContentTool;
use App\Models\Trail;
use App\Models\TrailHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class ContentGeneratorController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->User = new User();
    }

    public function generateData(Request $request)
    {
        // Initialize the variables
        $toolId             = $request->get('tool_id');
        $tool               = ContentTool::find($toolId);
        $tool_items         = $tool->contentToolItems->toArray();

        // Fetch validation rules
        $validation_rules   = $this->getValidationRulesOfTheTool($request);

        // modify request with tool uri
        $request['tool_uri'] = $tool->uri;

        // Validate the request
        Validator::validate($request->all(), $validation_rules);

        /**
         * We want to use generic function to work with all tools via database values.
         */
        $this->ToolContentGenerator($request, $tool, $tool_items);
        return redirect()->route('app.show',['slug'=>$tool->uri]);
    }

    /**
     * Generate the validator rules accoridng to tools
     *
     * @param $request
     * @return array
     */
    public function getValidationRulesOfTheTool($request)
    {
        // Initialize the necessary variables
        $toolId         = $request->get('tool_id');
        $tool           = ContentTool::find($toolId);
        $tool_items     = $tool->contentToolItems->toArray();
        $rules          =  [];
        // Format the data for the rules
        foreach ($tool_items as $k=>$item) {
            if ($item['required'] == 1) {
                if($item['key']){
                    $sting = 'required'.'|'."max:{$item['input_limit']}";
                    $rules = array_merge($rules, [$item['key'] => $sting]);
                }
            }else {
                $sting = 'nullable'.'|'."max:{$item['input_limit']}";
                $rules =array_merge($rules, [$item['key'] =>$sting]);
            }
        }
        // Return the response
        return $rules;
    }

     // function for generic content generator
     public function ToolContentGenerator(Request $request, $tool, $tool_items )
     {
         try {
             $input_context = $tool->context;
             $this->data['msg'] = '';
             $setting = [
                 'temperature' => (float) $tool->temperature,
                 'max_tokens' => (int) $tool->max_tokens,
                 'top_p' => (int) $tool->top_p,
                 'frequency_penalty' => (float) $tool->frequency_penalty,
                 'presence_penalty' => (float) $tool->presence_penalty,
                 'stop' => ["---"]
             ];
             foreach ($tool_items as $item) {
                 if (isset($request[$item['key']])) {
                     $key = $request[$item['key']];
                     echo $var = '{{$' . $item['key'] . '}}';
                     if(is_array($key)){
                             $input_context = str_replace($var, implode(', ',$request[$item['key']]), $input_context);
                     }else{
                         $input_context = str_replace($var, $request[$item['key']], $input_context);
                     }
                 }
             }
             $input['CompanyDescription'] = $input_context;
             $userData = Auth::user();
             $formData = $this->createFormData($request, $userData);
             $response = Ads::insertGetId($formData);
             $input['number_of_outputs'] = $request->get('number_of_outputs');
             $this->triggerContentGenerator($response, $input, $userData, 'components/ads', $setting);
             return $this->data;
         }
         catch (\Throwable $th) {
            Log::error("Error in ToolContentGenerator on {{$tool->uri}} :" . $th->getMessage());
             return response()->json($this->data);
         }
     }

    function triggerContentGenerator($response, $input, $userData, $component_path, $setting = [])
    {
        $response_data = $this->getSocialAdNew($input['CompanyDescription'], $input['number_of_outputs'], $setting);
        foreach ($response_data as $facebook_ad) {
            foreach ($facebook_ad['choices'] as $advalue) {
                $Company = isset($input['Company']) && !empty($input['Company']) ? $input['Company'] : 'Example';
                $apiResponse = array(
                    'ads_id' => $response,
                    'title' => $Company,
                    'description' => str_replace($input['CompanyDescription'], "", $advalue['text']),
                    'user_id' => $userData->id,
                    'project_id' => $userData->current_project,
                    'created_at' => Carbon::now(),
                );
                AdResponse::insertGetId($apiResponse);
            }
        }
        $facebook_ad['choices'] = AdResponse::where('ads_id', $response)->orderBy('id', 'desc')->get()->toArray();
        $facebook_ad['company_name'] = $Company;
        $this->data['response'] = true;
        $this->data['output'] = $facebook_ad;
        $this->data['ads'] = (string) View::make($component_path, ['ads' => $facebook_ad]);
        $decoded = html_entity_decode($this->data['ads']);
        $decoded = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $decoded);
        $decoded = preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/is', "$1$3", $decoded);
        $stripped = strip_tags($decoded);
        $this->data['totalNumberOfWords'] = str_word_count($stripped);
        $this->deductTrailsFromUser($response);
    }

    public function deductTrailsFromUser($ads_id)
    {
        //deduct Trails for user
        $updatedTrailBonus = $this->trail_bonus;
        if (auth()->user()->subscription('Typeskip.ai') !== null && auth()->user()->subscription('Typeskip.ai')->onTrial()) {
            // update TrailsHistory
            $this->updateTrailHistory($ads_id, $this->data['totalNumberOfWords'], 'trail_quantity');
        }
        else {
            // if trial quantity less than totalNumberOfWords
            if ($this->trail_quantity <= $this->data['totalNumberOfWords']) {
                $updatedTrailQuantity = 0;
                $totalNumberOfWords = $this->data['totalNumberOfWords'] - $this->trail_quantity;
                // update TrailsHistory
                $this->updateTrailHistory($ads_id, $this->trail_quantity, 'trail_quantity');
                // if trial bonus less than totalNumberOfWords
                if ($this->trail_bonus <= $totalNumberOfWords) {
                    $updatedTrailBonus = 0;
                    // update TrailsHistory
                    $this->updateTrailHistory($ads_id, $this->trail_bonus, 'trail_bonus');
                } else {
                    $updatedTrailBonus = $this->trail_bonus - $totalNumberOfWords;
                    // update TrailsHistory
                    $this->updateTrailHistory($ads_id, $totalNumberOfWords, 'trail_bonus');
                }
            } else {
                $updatedTrailQuantity = $this->trail_quantity - $this->data['totalNumberOfWords'];
                // update TrailsHistory
                $this->updateTrailHistory($ads_id, $this->data['totalNumberOfWords'], 'trail_quantity');
            }

            if (auth()->user()->linked_user_role == 'admin') {
                Trail::whereUserId($this->data['user']['id'])->update([
                    'trail_quantity' => $updatedTrailQuantity,
                    'trail_bonus' => $updatedTrailBonus
                ]);
            } else {
                Trail::whereUserId(auth()->user()->parent_member)->update([
                    'trail_quantity' => $updatedTrailQuantity,
                    'trail_bonus' => $updatedTrailBonus
                ]);
            }
        }
    }

    public function updateTrailHistory($ads_id, $quantity, $trail_type)
    {
        // TODO: Update with cashier
        $admin_user_id  = auth()->user()->linked_user_role == 'admin' ? $this->data['user']['id'] : auth()->user()->parent_member;
        $Trail = Trail::whereUserId($admin_user_id)->first();

        if (auth()->user()->subscription('Typeskip.ai') != null && auth()->user()->subscription('Typeskip.ai')->onTrial()) {}
        else {
            // upgrade preference
            $upgrade_user  = User::with('Trail')->whereHas('Trail', function ($q) {
                $q->whereRaw('(trail_quantity + trail_bonus) < 50');
            })->whereHas('subscriptions', function ($q) {
                $q->where('name', '=', 'TypeSkip');
                $q->whereNull('ends_at');
            })->whereId($admin_user_id)->first();
            if ($upgrade_user)
                \App\Jobs\UpgradePreferenceJob::dispatchNow($upgrade_user);
        }
        $TrailHistory = new TrailHistory();
        $TrailHistory->user_id = $admin_user_id;
        $TrailHistory->trail_id = $Trail->id;
        $TrailHistory->ads_id = $ads_id;
        $TrailHistory->quantity = $quantity;
        $TrailHistory->trail_type = $trail_type;
        $TrailHistory->teammate_id = $this->data['user']['id'];
        $TrailHistory->save();
    }

    /**
     * Method to create form data
     * @param Request $input
     * @param User $userData
     * @return array $data
     */
    public function createFormData(Request $input, $userData)
    {
        try {
            $data =  array(
                'project_id' => $userData->current_project,
                'company_name' => $input['brand_name'] ? $input['brand_name'] : 'Example',
                'description' => $input['product_description'] ?? '',
                'add_keywords' => $input['key_words'] ? json_encode($input['key_words'], true) :  '',
                'user_id' => $userData->id,
                'avoid_keywords' => $input['avoid_keyword'] ?? '',
                'number_of_outputs' => $input['number_of_outputs'] ?? '',
                'ads_category' => $input['tool_uri'],
                'created_at' => Carbon::now(),
            );
            return $data;
        } catch (\Throwable $th) {
            Log::error("Error in createFormData on ContentGeneratorController " . $th->getMessage());
        }
    }
}
