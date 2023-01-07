<?php

namespace App\Http\Controllers;

use App\Models\AdsItem;
use App\Models\ContentTool;
use App\Models\TrailHistory;
use App\Models\UserFavourite;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Stevebauman\Location\Facades\Location;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use App\Models\UserProjects;
use App\Models\AdResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\ProjectsModel;
use Illuminate\Http\Request;
use App\Models\Trail;
use App\Models\User;
use App\Models\Ads;
use Carbon\Carbon;
use App\Models\UserSidebarChoice;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Gmail;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->User = new User();
    }

    public function contentTool(Request $request)
    {
        $title = $request->title;
        $id = $request->id;
        $response_id = $request->response_id ? $request->response_id : 0;
        $this->data['uri'] = $request->uri;
        $this->data['tool'] = ContentTool::with('ContentToolItem')->whereUri($request->uri)->firstOrFail();

        if (!$request->isMethod('post')) { // if method is not post
            if (isset($this->data['user']['userID'])) {
                $this->data['projects'] = $this->getProjectList();
                $this->data['currentUser'] = User::where('id', $this->data['user']['userID'])->first();
            }
            if (!empty($title)) {
                if (!isset($this->data['user']['userID'])) {
                    $this->data['ad_info'] = Ads::where('company_name', $title)->where('id', decrypt($id))->first();
                    $this->data['adscounter'] = 0;
                } else {
                    $this->data['ad_info'] = Ads::where('company_name', $title)
                        ->whereIn('user_id', $this->data['teammate_ids'])
                        ->where('id', decrypt($id))
                        ->first();
                }
                $this->data['ads'] = AdResponse::where('ads_id', $this->data['ad_info']['id'])
                    ->orderBy('id', 'desc')
                    ->get()
                    ->toArray();
                if ($response_id != '0') {
                    $this->data['ads_response'] = AdResponse::where('id', decrypt($response_id))
                        ->first()
                        ->toArray();
                }
                if (!empty($this->data['ad_info'])) {
                    return view('admin.ads.content_tool.update', $this->data);
                } else {
                    return back();
                }
            }

            if (isset($this->data['user']['userID']))
            {
                $userData = User::find($this->data['user']['userID']);
                $this->data['category'] = $request->uri;
                $ads = Ads::where(['ads_category' => $request->uri, 'user_id' => $userData->id])->pluck('id');
                $this->data['contents'] = AdResponse::whereIn('ads_id', $ads)
                    ->with(['ads', 'ads.Items'])
                    ->orderBy('id', 'DESC')
                    ->get();
                $this->data['contents']->map(function ($da) {
                    $da->ads->Items = $da->ads->Items->filter(function ($item) use ($da) {
                        return $da->ads[$item->slug] = $item->value;
                    });
                    return $da;
                });
                $this->data['projects'] = $this->getProjectList();
                foreach ($this->data['contents'] as $key => $value) {
                    $createdDate = Carbon::parse($value->created_at);
                    $this->data['contents'][$key]['date_for_humman'] = $createdDate->diffForHumans();
                    $favorite = UserFavourite::where(['user_id' => $userData->id, 'ad_response_id' => $value->id])->first();
                    $this->data['contents'][$key]['is_favorite'] = (bool)$favorite;
                }
                return view('admin.ads.content_tool.index', $this->data);
            } else {
                return redirect(route('landing'));
            }
        }

        // Validate Input
        $validatorArray = [];
        $validatorErrorArray = [];
        $request->request->add(['outputs' => $request->number_of_outputs]);
        foreach ($this->data['tool']->ContentToolItem as $item) {
            if ($item->required) {
                if ($item->input_type == 'textarea'){
                    $validatorArray[$item->slug] = 'required|max:400';
                } else{
                    $validatorArray[$item->slug] = 'required|max:80';
                }
                $validatorErrorArray[$item->slug . '.required'] = $item->input_title . ' field is required.';
            }
        }
        $validator = Validator::make($request->all(), $validatorArray, $validatorErrorArray);
        if ($validator->fails()) { // If validator fails
            $errors = $validator->errors();
            $this->data['errors'] = $errors;
            $this->data['Company_error'] = $errors->first('Company');
            $this->data['CompanyDescription_error'] = $errors->first('CompanyDescription');
            $this->data['addkeywords_error'] = $errors->first('add_keywords');
            $this->data['numberofoutputs_error'] = $errors->first('number_of_outputs');
        } else {
            if (!$this->checkIfUserHasTrails()) {
                $this->data['msg'] = 'Please purchase offer to generate Ads';
                return response()->json($this->data);
            }
            $this->data['msg'] = '';
            $input = $request->all();
            $userData = User::where('id', $this->data['user']['userID'])->first();
            //Get Form data
            $formData = $this->createFormData($input, $userData);
            $response = Ads::insertGetId($formData);
            //insert inputs in ads items
            $input['context'] = $this->data['tool']->context;
            foreach ($this->data['tool']->ContentToolItem as $item) {
                if (isset($input[$item->slug])) {
                    $var = '{{' . $item->slug . '}}';
                    $input['context'] = str_replace($var, $input[$item->slug], $input['context']);
                    AdsItem::insertGetId(['slug' => $item->slug, 'value' => $input[$item->slug], 'ads_id' => $response]);
                }
            }
            $this->triggerContentGeneratorGeneric($response, $input, $userData, $this->data['tool']);
            return response()->json(['ads' => $this->data['ads'], 'response' => true]);
        }
        return response()->json($this->data);
    }

    function triggerContentGeneratorGeneric($response, $input, $userData, $tool)
    {
        $setting = [
            'temperature' => (float) $tool->temperature,
            'max_tokens' => (int) $tool->max_tokens,
            'top_p' => (int) $tool->top_p,
            'frequency_penalty' => (float) $tool->frequency_penalty,
            'presence_penalty' => (float) $tool->presence_penalty,
            'stop' => [$tool->stop]
        ];
        $response_data = $this->getSocialAdNew($input['context'], $input['number_of_outputs'], $setting);
        $Company = isset($input['Company']) && !empty($input['Company']) ? $input['Company'] : 'Example';
        foreach ($response_data as $facebook_ad) {
            foreach ($facebook_ad['choices'] as $advalue) {
                $apiResponse = array(
                    'ads_id' => $response,
                    'title' => $Company,
                    'description' => str_replace($input['context'], "", $advalue['text']),
                    'user_id' => $this->data['user']['userID'],
                    'project_id' => $userData->current_project,
                    'created_at' => Carbon::now(),
                );
                AdResponse::insertGetId($apiResponse);
            }
        }
        $data['choices'] = AdResponse::where('ads_id', $response)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
        $data['company_name'] = $Company;
        $this->data['response'] = true;
        $this->data['ads'] = (string) View::make('components/ads', ['ads' => $data]);
        $decoded  = html_entity_decode($this->data['ads']);
        $decoded = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $decoded);
        $decoded = preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/is', "$1$3", $decoded);
        $stripped = strip_tags($decoded);
        $this->data['totalNumberOfWords'] = str_word_count($stripped);
        $this->deductTrailsFromUser($response);
    }

    public function product_description(Request $request, $title = '', $id = 0, $response_id = 0)
    {
        try {
            if (!$request->isMethod('post')) {
                if (isset($this->data['user']['userID'])) {
                    $this->data['projects'] = $this->getProjectList();
                    $this->data['currentUser'] = User::where('id', $this->data['user']['userID'])->first();
                }
                if (!empty($title)) {
                    $this->data['category'] = 'product-description';
                    if (!isset($this->data['user']['userID'])) {
                        $this->data['ad_info'] = Ads::where('company_name', $title)->where('id', decrypt($id))->first();
                        $this->data['adscounter'] = 0;
                    } else {
                        $this->data['ad_info'] = Ads::where('company_name', $title)
                            ->whereIn('user_id', $this->data['teammate_ids'])
                            ->where('id', decrypt($id))
                            ->first();
                    }

                    $this->data['ads'] = AdResponse::where('ads_id', decrypt($id))
                        ->orderBy('id', 'desc')
                        ->get()
                        ->toArray();
                    if ($response_id != '0') {
                        $this->data['ads_response'] = AdResponse::where('id', decrypt($response_id))->first()->toArray();
                    }

                    if (!empty($this->data['ad_info'])) {
                        return view('admin.ads.product.update', $this->data);
                    } else {
                        return back();
                    }
                }
                if (isset($this->data['user']['userID'])) {
                    $userData = User::find($this->data['user']['userID']);
                    $this->data['category'] = 'product-description';
                    $ads = Ads::where(['ads_category' => 'product-description', 'user_id' => $userData->id])->pluck('id');
                    $this->data['contents'] = AdResponse::whereIn('ads_id', $ads)->with('ads')->orderBy('id', 'DESC')->get();
                    $this->data['projects'] = $this->getProjectList();
                    foreach ($this->data['contents'] as $key => $value) {
                        $createdDate = Carbon::parse($value->created_at);
                        $this->data['contents'][$key]['date_for_humman'] = $createdDate->diffForHumans();
                        $favorite = UserFavourite::where(['user_id' => $userData->id, 'ad_response_id' => $value->id])->first();
                        $this->data['contents'][$key]['is_favorite'] = (bool)$favorite;
                    }
                    return view('admin.ads.product.product-description', $this->data);
                } else {
                    return redirect(route('landing'));
                }
            } else {
                $validator = Validator::make($request->all(), [
                    'Company' => 'required|max:80',
                    'CompanyDescription' => 'required|max:400',
                    'add_keywords' => 'required|max:80',
                    'number_of_outputs' => 'required',
                ], [
                    'Company.required' => 'Brand Name field is required.',
                ]);

                if ($validator->fails()) {
                    $errors = $validator->errors();
                    $this->data['Company_error'] = $errors->first('Company');
                    $this->data['CompanyDescription_error'] = $errors->first('CompanyDescription');
                    $this->data['addkeywords_error'] = $errors->first('add_keywords');
                    $this->data['numberofoutputs_error'] = $errors->first('number_of_outputs');
                } else {
                    //check if user have counts
                    if (!$this->checkIfUserHasTrails()) {
                        $this->data['msg'] = 'Please purchase offer to generate Ads';
                        return response()->json($this->data);
                    }
                    $userData = User::where('id', $this->data['user']['userID'])->first();
                    $this->data['msg'] = '';
                    $input = $request->all();
                    //Get Form data
                    $formData = $this->createFormData($input, $userData);

                    $response = Ads::insertGetId($formData);
                    $input['CompanyDescription'] = "Write a creative product description using the given name, description and keywords.\n---\nName:\n---\nTone: Professional\n---\nDescription: Lantern, Made of welded metal, contains 4 bulbs, hangs from a chain, for entryway \n---\nKeywords: candelabra lights, pendant, luminary\n---\nOutput:\nGreet guests with a warm and welcoming glow while you grab their glances with this pendant hanging overhead. Crafted from metal, its geometric frame features an openwork design topped off by hardware. In the center, you'll find four candelabra lights for traditional illumination in the foyer or entryway. Depending on where you're hanging this luminary, simply adjust the chain length. Bulbs are not included. \n---\nName: Kennedy Barrel Chair\n---\nTone: Friendly\n---\nDescription: Oversized, High-Quality Fabric\n---\nKeywords: elegance, handpicked fabric, sheen\n---\nOutput:\nThe Kennedy Barrel Chair is one of our favorite pieces. This oversized chair is perfect for those looking to spend hours sprawled out reading their favorite book or for those who just want to cuddle with the one they love. The Kennedy Barrel Chair's handpicked fabric has a special sheen that creates a look of total elegance. \n---\nName: Bryant U-Sofa\n---\nTone: Professional\n---\nDescription: Sectional Sofa for the home, Contours to your body. Comfortable and customizable, Cradling Seat, Hardwood construction, high quality foam.\n---\nKeywords: high-resiliency foam, plush\n---\nOutput:\nHome is your sanctuary, so shouldn't it feel relaxing and reflect your style? Let the Bryant U-Sofa do both with its contouring comfort and customizable construction. The Bryant U-Sofa is designed to cradle you in comfort. To ensure this, our craftsmen begin with a minimal hardwood frame layered in dense layers of high-resiliency foam. As if that weren't enough, plush cushions and pillows are added to exceed comfort expectations. Between its cradling seat and room for everyone, it will quickly become the best seat in the house. \n---\nName: Dropbottle\n---\nTone: Professional\n---\nDescription: Best selling water bottle available in different colors. Features a large opening for ice cubes. Fits most water purifiers and filters. Wider mouth for easier handwashing. Graduations keep track of water intake. \n---\nKeywords: Dishwasher Safe, Loop-top\n---\nOutput:\nDropbottle is our most popular bottle, available in a variety of colors to help brighten up anybody's gear. The large opening on our wide-mouth bottles easily accommodates ice cubes. fits most water purifiers and filters, and makes hand washing a breeze. The attached loop-top never gets lost and screws on and off easily. Printed graduations let keep track of your hydration. Dropbottle is completely dishwasher safe.\n---\nName: Chill Pup\n---\nTone: Professional\n---\nDescription: Multivitamin for calming dogs. Made using living probiotics, organic chamomile and valerian root\n--- \nKeywords: separation anxiety\n---\nOutput:\nSupport your pup through life's stressful moments with Chill Pup. From storms to separation anxiety. Chill Pup Multivitamin harnesses natural herbs like organic chamomile and valerian root to help your pup relax. Our daily Multivitamin with living probiotics nourishes a healthy gut, strong joints. and a luscious coat. In a time when it’s difficult to give your dog all the different vitamins that they need in order to keep their health intact, we offer you a simple solution to help them live healthy lives. 1 pill-a-day will have your pup looking better than ever before! With just 2 weeks of regular use you'll notice calmer behavior and healthier eyes. It's like having another magic potion for happy hounds!\n---\nName:\n---\nTone: Casual\n---\nDescription: Ice Cream made from Buttery Streusel with sesame, poppy seed, onions and garlic. Mixed with slightly sweet cream cheese ice cream\n---\nKeywords:\n---\nOutput:\nThere are rare moments when we create a flavor so shockingly good. Our test kitchen looks like a soundless rave. We can't help but dance. Shimmy. Feel the flavor in our bones. This is one of those ice creams. A soul-shaking, dancing-with-no-music kind of delicious. Buttery streusel laden with sesame, poppy seeds—and yes, onions and garlic—schmeared throughout subtly sweet cream cheese ice cream. An ice cream acceptable to eat any time of day. \n---\nName: Breadwinner\n---\nTone: Professional\n---\nDescription: Breadwinner is the first and only breadpan to evenly bake breads of any shape. This revolutionary pans non-stick coating uniformly coats, seals and releases each loaf in turn without tearing the dough or using extra oil. It also has a versatile wavy corrugated bottom which uses dry rice for perfecting crusty loaves, making it an all-inclusive choice for home bakers everywhere. \nThe Breadwinner pan is made from Aluminized Steel with non toxic ceramic coating that prevents sticking and won't release toxins into your food when baking at high temperatures;\n---\nKeywords: non toxic, ceramic coating\n---\nOutput:\nBreadwinner is the first and only breadpan to evenly bake breads of any shape. This revolutionary pans non-stick coating uniformly coats, seals and releases each loaf in turn without tearing the dough or using extra oil. It also has a versatile wavy corrugated bottom which uses dry rice for perfecting crusty loaves, making it an all-inclusive choice for home bakers everywhere. \nThe Breadwinner pan is made from Aluminized Steel with non toxic ceramic coating that prevents sticking and won't release toxins into your food when baking at high temperatures.\n---\nName:\n---\nTone: Professional\n---\nDescription: Towels with a sand resistant design. Lightweight and portable. Dries 3x quicker than traditional towers and gets more absorbent when washed. Tie dyed navy acid wash pattern. Twisted tassel fringe. 38 x 64 in size and made of Turkish cotton in Turkey\n---\nKeywords: Sand Free, Single weave jacquard, Twisted tassel fringe\n---\nOutput:\nMeet the perfect bath towel for any little one. Designed with a special cotton that dries 3x faster than traditional towels and becomes more absorbent when washed, this towel is both multipurpose and lightweight. So picture your child taking their bath with a fun or one of our many colorful designs--the blue, navy acid wash tie dye have fun fringing hem and tassels on top to give it an extra bit of style. This 100% Turkish Cotton made in Turkey is light and easy to roll up for easier travel.\n---\nName: My Calm Blanket for Kids\n---\nTone: Professional\n---\nDescription: Weighted blanket to help kids sleep through the night. Made of quality fabric and glass beads that stay quiet. Great for kids with autism and ADHD. The perfect gift.\n---\nKeywords: restless leg syndrome, ADHD, autism, minky fabric\n---\nOutput:\nWhen your child doesn't sleep, you don't sleep. Maybe you're constantly getting up to check on them? Maybe they tiptoe into your room in the middle of the night and wake you up? Why not simply get your kids a weighted blanket and watch them sleep through the night so they will be energized in the morning? My Calm Blanket for Kids is perfect. The outer minky fabric is soft and warm, and the glass beads are completely silent - even if your child keeps fidgeting in their sleep, the blanket noise won't wake them up. It is also a perfect gift for parents who want to catch some Zs and want their child to do the same. My Calm Blanket for Kids can help children with restless leg syndrome, ADHD, or as well as those with an autism diagnosis to deal with their symptoms. \n---\nName: {$input['Company']}\n---\nTone: Professional\n---\nDescription: {$input['CompanyDescription']}\n---\nKeywords: {$input['add_keywords']}\n---\nOutput:\n";
                    $setting = [
                        'temperature' => 0.7,
                        'max_tokens' => 160,
                        'top_p' => 1,
                        'frequency_penalty' => 0,
                        'presence_penalty' => 0.1,
                        'stop' => ["---"]
                    ];
                    $this->triggerContentGenerator($response, $input, $userData, 'components/ads', $setting);
                }
                return response()->json($this->data);
            }
        } catch (\Throwable $th) {
            Log::error('Error in product_description on UserController :' . $th->getMessage());
            return response()->json($this->data);
        }
    }

    public function flushSession(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect('/');
    }

    public function changePassword(Request $request)
    {
        $data = $this->data;
        return Inertia::render('Password/Index', compact('data'));
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required_with:confirm_password|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('change_password')->withErrors($validator)->withInput();
        } else {
            $response = User::where('id', auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
            if ($response === true) {
                $request->session()->flush();
                return redirect('login')->with('message', 'password updated successfully please login with new password');
            }
        }
    }

    public function remove_ad(Request $request)
    {
        $data = [];
        $data['response'] = false;
        $id = decrypt($request->ad_id);
        Ads::where('id', $id)->delete();
        AdResponse::where('ads_id', $id)->delete();
        $data['response'] = true;
        return response()->json($data);
    }

    public function update_userStatus(Request $request, $user_id = '', $status = '')
    {
        $update = array(
            'status' => decrypt($status),
        );
        $response = $this->User::where('id', decrypt($user_id))->update($update);
        if ($response) {
            return back();
        }
    }

    public function login(Request $request)
    {
        if (!$request->isMethod('post')) {
            return back();
        } else {
            $data = [];
            $data['response'] = false;
            $validator = Validator::make($request->all(), [
                'email' => 'required|max:50|email',
                'password' => 'required|min:8',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $data['email'] = $errors->first('email');
                $data['password'] = $errors->first('password');
            } else {
                $formData = $request->all();
                unset($formData['_token']);
                $status = $this->User->login($formData);
                if (!$status) {
                    $data['error'] = 'Wrong Email Or Password!';
                } else {
                    if ($status['role'] == 'user') {
                        $request->session()->put('user', $status);
                        $data['redirect'] = 'template';
                        $data['response'] = true;
                    } else {
                        $data['error'] = 'Sorry you cannot perform this action !';
                    }
                }
            }
            return response()->json($data);
        }
    }

    public function register(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('register', $this->data);
        }
        $userId = 0;
        $parentUser = null;
        if ($request['ref']) {
            $parentUser = User::whereLinkout($request['ref'])->first();
            $find = User::where('parent_member', $parentUser->id)->count();
            if ($find >= 10) {
                $data['response'] = false;
                $data['msg'] = 'You can not register using this link!';
                return response()->json($data);
            }
        }
        $data = [];
        $data['response'] = false;
        $validator = Validator::make($request->all(), [
                'username'  => 'required|max:50',
                'email'     => 'required|max:50|unique:users|email',
                'password'  => 'required|min:8',
            ]
//          'g-recaptcha-response' => 'required|recaptcha'
//               'checkbox' => 'required',
//          [
//              'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
//              'g-recaptcha-response.required' => 'Captcha is required.',
//          ]
        );
        if ($validator->fails()) {
            $errors = $validator->errors();
            $data['username'] = $errors->first('username');
            $data['email'] = $errors->first('email');
            $data['password'] = $errors->first('password');
            //$data['g-recaptcha-response'] = $errors->first('g-recaptcha-response');
            //$data['confirm_password'] = $errors->first('confirm_password');
            //$data['checkbox'] = $errors->first('checkbox');
        } else {
            $input = $request->all();
            /*if ($parentUser) {
                  $ref = 0;
              } else {
                  $ref = $input['ref'];
              }*/

            /*if ($input['ref'] != '' && $input['pa'] == 0) {
                  $pa = $input['ref'];
              } else if ($input['ref'] == '' && $input['pa'] == '') {
                  $pa = 0;
                  $user_r = 'admin';
              } else {
                  $pa = $input['pa'];
                  $user_r = 'user';
              }*/
            $location = request()->ip();
            $location = str_replace('.', ':', $location);
            $location_data = Location::get($location);
            $country_name = $location_data->countryName ?? '';
            $formData = array(
                'username' => $input['name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'role' => 'user',
                'ip_address' => request()->ip(),
                'country_name' => $country_name,
                'linkout' => md5(rand(00000, 99999)),
                'member_of' => $parentUser ? $parentUser->id : 0,
                'parent_member' => $parentUser ? $parentUser->id : 0,
                'linked_user_role' => $parentUser ? 'user' : 'admin',
                'current_project' => 0,
            );

            $response = $this->User->insertGetId($formData);
            $userId = $response;
            if (!$parentUser) {
                // Create Project for user
                $project = new ProjectsModel();
                $project->name = "My Project";
                $project->user_id = $response;
                $project->save();

                // Map Project to User
                $save_project = new UserProjects();
                $save_project->user_id = $response;
                $save_project->project_id = $project->id;
                $save_project->save();

                $user = User::find($response);
                $user->current_project = $project->id;
                $user->parent_member = $response;
                $user->linked_user_role = 'admin';
                $user->update();

            } else {
                $user_projects = UserProjects::where('user_id', $parentUser->id)->get();
                foreach ($user_projects as $value) {
                    // Save Team Projects
                    $save_project = new UserProjects();
                    $save_project->user_id = $response;
                    $save_project->project_id = $value->project_id;
                    $save_project->save();
                }

                // Set User Current Project
                $newUser = User::find($response);
                $newUser->current_project = $parentUser->current_project;
                $newUser->save();
            }
            if (!empty($response)) {
                $trailArray = array(
                    'user_id' => $response,
                    'trail_bonus' => 0,
                );
                $response = Trail::insertGetId($trailArray);
                if (!empty($response)) {
                    // Mail::to($input['email'])->send(new Gmail($formData));
                    $data['response'] = true;
                    $data['msg'] = 'Your Account Created successfully';
                }
            }
        }
        if ($userId != 0) {
            $users =   User::find($userId);
            auth()->login($users, true);
            $authUser =  ['userID' => $users['id'], 'role' => 'user', 'email' => $users['email'], 'username' => $users['username'], 'isLoggedIn' => true, 'status' => $users['status'], 'current_project' => $users['current_project'], 'linkout' => $users['linkout'], 'parent_member' => $users['parent_member']];
            session(['user' => $authUser]);
        }
        return response()->json($data);
    }

    public function password_recover(Request $request)
    {
        if (!$request->isMethod('post')) {
            return Inertia::render('Password/Recover');
        } else {
            $data = array();
            $data['response'] = false;
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|max:50',
//              'g-recaptcha-response' => 'required|recaptcha',
            ],
               /*[
                    'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
                    'g-recaptcha-response.required' => 'Captcha is required.',
                ]*/
            );
            if (!$validator->fails()) {
                $post = ['email' => $request->input('email')]; //   no comments
                $row = $this->User->where($post)->first(); // no comments

                if (!empty($row)) {
                    $user_id = $row['id'];
                    $email = $this->createBase64($request->input('email')); // send encode email
                    $user_id = $this->createBase64($user_id); //send encode id
                    $url = url('update_password' . '/' . $user_id . '/' . $email);
                    $message = "You recently requested for reset password of your account in Trapsol<br>click the
                    button below to reset it :<br> ";
                    $message .= '<a href="' . $url . '" class="button btn btn-primary">Reset your password</a>';
                    $this->send_email2('', $request->input('email'), 'Email Confirmation', $message, $url);
                    $data['response'] = true;
                    $data['msg'] = ' Please follow that email to reset your password';
                } else {
                    $data['msg'] = ' Email does not exist ';
                }
            }
            else {
                return redirect('password-recover')->withErrors($validator)->withInput();
//                $data['g-recaptcha-response'] = $errors->first('g-recaptcha-response');
            }
            $data['csrf_token'] = csrf_token();
            echo json_encode($data);
        }
    }

    public function recoverpassword(Request $request, $id = '', $email = '')
    {
        if (!$request->isMethod('post')) {
            $id = $this->decodeBase64($id);
            $email = $this->decodeBase64($email);
            $where = array('id' => $id, 'email' => $email);
            $result = $this->User->where($where)->first(); // checking email, id in db
            if (empty($result)) {
                return redirect('/');
            }
            $this->data['id'] = $id;
            return view('password_reset', $this->data);
        }
        else {

            $this->data['response'] = false;
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:8',
            ]);
            if ($validator->fails()) {
                $errors = $validator->errors();
                $this->data['password_error'] = $errors->first('password');
            } else {
                $user = $request->input('id');
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $passwordArray = array(
                    'password' => $password,
                );
                $this->User = new User();
                $response = $this->User->where('id', $user)->update($passwordArray);
                if ($response) {
                    $request->session()->flash('message', 'Password Updated Successfully');
                    $this->data['response'] = true;
                }
            }
            $this->data['csrf_token'] = csrf_token();
            echo json_encode($this->data);
        }
    }

    public function update_profile(Request $request)
    {
        if (request()->is('update/company_info')) {
            $validator = Validator::make($request->all(), [
                'cmp_name' => 'required|max:50',
                'cmp_description' => 'required|max:500',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'fname' => 'required|max:50',
                'lname' => 'required|max:50',
            ]);
        }
        if ($validator->fails()) {
            return redirect('profile')->withErrors($validator)->withInput();
        } else {
            $input = $request->all();
            unset($input['_token']);
            $response = $this->User->where('id', $this->data['user']['userID'])->update($input);
            if ($response) {
                if (!empty($input['fname'])) {
                    return redirect('profile')->with('personalinfo', 'personal information updated successfully');
                } else {
                    return redirect('profile')->with('companyinfo', 'company information updated successfully');
                }
            }
        }
    }

    public function update_upgrade_preference(Request $request)
    {
        validator($request->all(), [
            'update_upgrade_preference' => 'max:50|nullable',
        ])->validate();
        $input = ['upgrade_preference' => $request->get('update_upgrade_preference')];
        $response = $this->User->whereId($this->data['user']['userID'])->update($input);
        if ($response) {
            return response()->json(['status' => 'success', 'message' => 'Upgrade Preference Saved Successfully!']);
        } else{
            return response()->json(['status' => 'error', 'message' => 'Something went wrong!']);
        }
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */

    public function redirectToGoogle(Request $request)
    {
        \Cookie::queue('ref', $request->ref, 1000);
        \Illuminate\Support\Facades\Session::put('url.intended', URL::previous());
        return Socialite::driver('google')->redirect();
    }
    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $url = \Illuminate\Support\Facades\Session::get('url.intended', url('/'));
            \Illuminate\Support\Facades\Session::forget('url.intended');
            $url = Str::afterLast($url, '/');
            $is_exist = false;
            $parentUser = null;
            if (User::where('email', $user->email)->exists()) {
                // exists
                $is_exist = true;
            }
            if ($url == "login_v1") {
                if (!$is_exist) {
                    session()->put('error-email', 'EmailId is not registered');
                    return view('login');
                }
            }

            // Check reference and parent user
            if ($request->cookie('ref')) {
                $parentUser = User::whereLinkout($request->cookie('ref'))->first();
                $find = User::where('parent_member', $parentUser->id)->count();
                if ($find >= 10) { // If referenced already used by 10 member
                    session()->put('error-email', 'You can not register using this link!');
                    return view('login');
                }
            }

            $authUser = $this->findOrCreateUser($user);
            $data = [];
            $data['response'] = false;
            if (!$is_exist) {

                if (!$parentUser) { // If no ref found
                    // Create Project for user
                    $project = new ProjectsModel();
                    $project->name = "My Project";
                    $project->user_id = $authUser["id"];
                    $project->save();
                    // Map Project to User
                    $save_project = new UserProjects();
                    $save_project->user_id = $authUser["id"];
                    $save_project->project_id = $project->id;
                    $save_project->save();

                    $user = User::find($authUser["id"]);
                    $user->current_project = $project->id;
                    $user->parent_member = $authUser["id"];
                    $user->linked_user_role = 'admin';
                    $user->update();

                }
                else { // If ref found
                    $user_projects = UserProjects::where('user_id', $parentUser->id)->get();
                    foreach ($user_projects as $value) {
                        // Save Team Projects
                        $save_project = new UserProjects();
                        $save_project->user_id = $authUser["id"];
                        $save_project->project_id = $value->project_id;
                        $save_project->save();
                    }
                    // Set User Current Project
                    $newUser = User::find($authUser["id"]);
                    $newUser->current_project = $parentUser->current_project;
                    $newUser->save();
                }

                if (!empty($authUser)) {
                    $trailArray = array(
                        'user_id' => $authUser["id"],
                        'trail_quantity' => 5000,
                    );
                    $response = Trail::insertGetId($trailArray);
                    if (!empty($response)) {
                        Mail::to($authUser['email'])->send(new Gmail($authUser));
                        $data['response'] = true;
                        $data['msg'] = 'Your Account Created successfully';
                    }
                }
            }
            //*session storage*/
            $users =   User::find($authUser["id"]);
            auth()->login($authUser, true);
            $authUser =  ['userID' => $users['id'], 'role' => 'user', 'email' => $users['email'], 'username' => $users['username'], 'isLoggedIn' => true, 'status' => $users['status'], 'current_project' => $users['current_project'], 'linkout' => $users['linkout'], 'parent_member' => $users['parent_member']];
            session(['user' => $authUser]);
            return redirect('template');

        }
        catch (Exception $e) {
            Log::error('Error in handleGoogleCallback on UserController :' . $e->getMessage());
        }
    }

    public function findOrCreateUser($socialUser)
    {
        $finduser = User::where(['email' => $socialUser->email])->first();
        if ($finduser) {
            return $finduser;
        } else {
            return User::create([
                'username' => $socialUser->name,
                'email' => $socialUser->email,
                'provider_id' => $socialUser->id,
            ]);
        }
    }
    /**
     * Method to create form data
     * @param array $input
     * @param collection $userData
     * @return array $data
     */
    public function createFormData($input, $userData)
    {
        try {
            return array(
                'project_id' => $userData->current_project,
                'company_name' => $input['Company'] ?? 'Example',
                'description' => $input['CompanyDescription'] ?? '',
                'add_keywords' => $input['add_keywords'] ?? '',
                'user_id' => $this->data['user']['userID'] ?? '',
                'avoid_keywords' => $input['avoid_keyword'] ?? '',
                'number_of_outputs' => $input['number_of_outputs'] ?? '',
                'ads_category' => decrypt($input['category']),
                'created_at' => Carbon::now(),
            );
        }
        catch (\Throwable $th) {
            Log::error("Error in createFormData on UserController " . $th->getMessage());
        }
    }

    public function checkIfUserHasTrails()
    {
        if (auth()->user()->subscription('Typeskip.ai') != null && auth()->user()->subscription('Typeskip.ai')->onTrial()) {
            return true;
        } else {
            if (auth()->user()->linked_user_role == 'admin')
                $Trail = Trail::whereUserId(auth()->user()->id)->first();
            else
                $Trail = Trail::whereUserId(auth()->user()->parent_member)->first();

            $trail = $Trail->trail_quantity + $Trail->trail_bonus;
            if ($trail <= 0)
                return false;
            else
                return true;
        }
    }

    public function deductTrailsFromUser($ads_id)
    {
        //deduct Tails for user
        $updatedTrailBonus = $this->trail_bonus;

        if (auth()->user()->subscription('Typeskip.ai') !== null && auth()->user()->subscription('Typeskip.ai')->onTrial()) {
            // update TrailsHistory
            $this->updateTrailHistory($ads_id, $this->data['totalNumberOfWords'], 'trail_quantity');
        } else {
            // if trial quantity less then totalNumberOfWords
            if ($this->trail_quantity <= $this->data['totalNumberOfWords']) {
                $updatedTrailQuantity = 0;
                $totalNumberOfWords = $this->data['totalNumberOfWords'] - $this->trail_quantity;
                // update TrailsHistory
                $this->updateTrailHistory($ads_id, $this->trail_quantity, 'trail_quantity');
                // if trial bonus less then totalNumberOfWords
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
                Trail::whereUserId($this->data['user']['userID'])->update([
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
        $admin_user_id  = auth()->user()->linked_user_role == 'admin' ? $this->data['user']['userID'] : auth()->user()->parent_member;
        $Trail = Trail::whereUserId($admin_user_id)->first();
        if (auth()->user()->subscription('Typeskip.ai') != null && auth()->user()->subscription('Typeskip.ai')->onTrial()) {
        } else {
            // upgrade preference
            $upgrade_user  = User::with('Trail')->whereHas('Trail', function ($q) {
                $q->whereRaw('(trail_quantity + trail_bonus) < 50');
            })->whereHas('subscriptions', function ($q) {
                $q->where('name', '=', 'Typeskip.ai');
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
        $TrailHistory->teammate_id = $this->data['user']['userID'];
        $TrailHistory->save();
    }

    public function pay_with_card()
    {
        if (auth()->user()->linked_user_role != 'admin')
            return redirect()->route('template');
        $TrailHistory = TrailHistory::whereUserId($this->data['user']['userID'])->selectRaw('sum(quantity) as quantity,Date(created_at) as created_date')
            ->whereDate('created_at', '>', Carbon::now()->subDays(7))
            ->groupBy(DB::raw('Date(created_at)'))->get()->toArray();
        $TrailHistorySum = TrailHistory::whereUserId($this->data['user']['userID'])->selectRaw('sum(quantity) as quantity,trail_type')
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('trail_type')->get()->toArray();
        $trail_quantity_index = array_search('trail_quantity', array_column($TrailHistorySum, 'trail_type'));
        $trail_quantity_usage = $trail_quantity_index === false ? 0 : $TrailHistorySum[$trail_quantity_index]['quantity'];
        $trail_bonus_index = array_search('trail_bonus', array_column($TrailHistorySum, 'trail_type'));
        $trail_bonus_usage = $trail_bonus_index === false ? 0 : $TrailHistorySum[$trail_bonus_index]['quantity'];

        $start = Carbon::now()->subDays(7);
        $dates = array_map(fn ($day) => $start->copy()->addDays($day)->toDateString(), range(0, 7));
        // prepare data for chart
        $newQuantities = [];
        foreach ($dates as $date) {
            $find = array_search($date, array_column($TrailHistory, 'created_date'));
            if ($find === false)
                $newQuantities[] = 0;
            else
                $newQuantities[] = $TrailHistory[$find]['quantity'];
        }
        //upgrade_preference
        $user = User::whereId($this->data['user']['userID'])->first();
        $this->data['user']['upgrade_preference'] = $user->upgrade_preference;
        $this->data['chart_dates'] = $dates;
        $this->data['chart_quantities'] = $newQuantities;
        $this->data['trail_usage'] = $newQuantities;
        $this->data['trail_quantity'] = $this->trail_quantity;
        $this->data['trail_bonus'] = $this->trail_bonus;
        $this->data['trail_quantity_usage'] = $trail_quantity_usage;
        $this->data['trail_bonus_usage'] = $trail_bonus_usage;
        $this->data['all_data'] = $this->data;
        return view('home.pay-with-card', $this->data);
    }

    /**
     * Method to request template over email
     */
    public function requestTemplate(Request $request)
    {
        $request->validate([
            "requestMessage" => "required",
        ]);

        $to_email = env('MAIL_TO_ADDRESS');
        $to_name = env('MAIL_TO_NAME');
        Mail::send('emails.request-template', ['data' => $request->requestMessage], function ($m) use ($to_email, $to_name) {
            $m->to($to_email, $to_name)->subject('Request for Template');
        });
        // check for failures
        if (Mail::failures()) {
            return "failed to send";
        }

        return redirect()->back();
    }

    /**
     * Method to report bad content
     */
    public function reportContent(Request $request)
    {
        $request->validate([
            "message" => "required",
        ]);

        $to_email = env('MAIL_TO_ADDRESS');
        $to_name = env('MAIL_TO_NAME');
        $response = Ads::join('ad_responses', 'ad_responses.ads_id', '=', 'ads.id')->select('ads.*', 'ad_responses.description as ad_response_description')->where('ad_responses.id', $request->response_id)->first();
        $data = array(
            'message' => $request->message,
            'ads' => $response
        );

        Mail::send('emails.report-content', ['data' => $data], function ($m) use ($to_email, $to_name) {
            $m->to($to_email, $to_name)->subject('Content Reported');
        });

        // check for failures
        if (Mail::failures()) {
            return "failed to send";
        }

        return redirect()->back();
    }

    function triggerContentGenerator($response, $input, $userData, $component_path, $setting = [])
    {
        $response_data = $this->getSocialAdNew($input['CompanyDescription'], $input['number_of_outputs'], $setting);
        foreach ($response_data as $facebook_ad) {
            foreach ($facebook_ad['choices'] as $advalue) {
                $choices[]['text'] = str_replace($input['CompanyDescription'], "", $advalue['text']);

                $Company = isset($input['Company']) && !empty($input['Company']) ? $input['Company'] : 'Example';
                $apiResponse = array(
                    'ads_id' => $response,
                    'title' => $Company,
                    'description' => str_replace($input['CompanyDescription'], "", $advalue['text']),
                    'user_id' => $this->data['user']['userID'],
                    'project_id' => $userData->current_project,
                    'created_at' => Carbon::now(),
                );
                AdResponse::insertGetId($apiResponse);
            }
        }

        $facebook_ad['choices'] = AdResponse::where('ads_id', $response)->orderBy('id', 'desc')->get()->toArray();
        $facebook_ad['company_name'] = $Company;
        $this->data['response'] = true;
        $this->data['ads'] = (string) View::make($component_path, ['ads' => $facebook_ad]);
        $decoded  = html_entity_decode($this->data['ads']);
        $decoded = preg_replace('/(<[^>]+) style=".*?"/i', '$1', $decoded);
        $decoded = preg_replace('/(<(script|style)\b[^>]*>).*?(<\/\2>)/is', "$1$3", $decoded);
        $stripped = strip_tags($decoded);
        $this->data['totalNumberOfWords'] = str_word_count($stripped);
        $this->deductTrailsFromUser($response);
    }

    public function saveUserSidebarChoice(Request $request)
    {
        $sideBarChoice = UserSidebarChoice::whereUserId(auth()->user()->id)->first();
        $newChoice = 0;
        if ($sideBarChoice != null) {
            $newChoice = !$sideBarChoice->expand;
        }
        UserSidebarChoice::updateOrCreate(
            [
                'user_id' => auth()->user()->id,
            ],
            [
                'user_id' => auth()->user()->id,
                'expand' => $newChoice == true ? 1 : 0,
            ]
        );
        return response()->json(['data' => $newChoice == 1 ? true : false], 200);
    }

    public function getUserSidebarChoice()
    {
        $sideBarChoice = UserSidebarChoice::whereUserId(auth()->user()->id)->first();
        if ($sideBarChoice != null) {
            return response()->json(['data' => $sideBarChoice->expand], 200);
        } else {
            return response()->json(['data' => true], 200);
        }
    }
}
