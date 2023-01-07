<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use App\Models\ContentTool;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Gmail;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Ads;
use App\Models\Trail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $data;
    public $user;
    /**
     * @var array
     */
    public $ads_info;
    public $trail_quantity;
    public $trail_bonus;
    private $header;

    public function __construct()
    {
        $this->data = [];
        $this->data['isLoggedIn'] = false;
        $this->data['user'] = [];
        $this->data['user']['subscriber'] = false;
        $this->data['contentTools'] = ContentTool::all();
        $this->data['response'] = false;
        $this->data['subscriber'] = false;
        $this->ads_info = [];
        $this->trail_quantity = 0;
        $this->trail_bonus = 0;
        $this->header = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '. env('OPENAI_API_KEY'),
        ];
        $this->middleware(function ($request, $next) {

            $user = Auth::user();

            if ($user) {
                $this->data['user'] =  $user;
                $this->data['user']['profile'] = auth()->check() ? auth()->user()->profile : '';
                $this->data['teammate_ids'] = User::where('parent_member', $this->data['user']['parent_member'])->where('parent_member', '!=', 0)->pluck('id')->toArray();
                $this->data['isLoggedIn'] = $this->data['user']['isLoggedIn'];

                if (auth()->user()->subscriptions) {
                    $this->data['user']['subscriber'] = true;
                    $this->data['user']['subscription'] = auth()->user()->subscriptions;
                }
                if ($this->data['user']['role'] != 'isAdmin')
                {
                    $this->ads_info = Ads::where('user_id', $this->data['user']['id'])->get();
                    $admin_user_id  = auth()->user()->linked_user_role == 'admin' ? $this->data['user']['id'] : auth()->user()->parent_member;
                    $trail_quantity = Trail::where('user_id', $admin_user_id)->select('trail_quantity', 'trail_bonus')->get()->toArray();
                    $this->trail_quantity = isset($trail_quantity[0]['trail_quantity']) ? $trail_quantity[0]['trail_quantity'] : 0;
                    $this->trail_bonus = isset($trail_quantity[0]['trail_bonus']) ? $trail_quantity[0]['trail_bonus'] : 0;
                    $this->data['adscounter'] = $this->trail_quantity + $this->trail_bonus;
                }
            }
            return $next($request);
        });
        $this->data['page'] = '';
    }

    public function getSocialAdNew($description = '', $count = 1, $setting = [])
    {
        if ($setting) {
            $postValues = array(
                "prompt" => $description,
                "max_tokens" => $setting['max_tokens'],
                "echo" => true,
                "frequency_penalty" => $setting['frequency_penalty'],
                "presence_penalty" => $setting['presence_penalty'],
                "top_p" => $setting['top_p'],
                "temperature" => $setting['temperature'],
                "stop" => $setting['stop']
            );
        } else {
            $postValues = array(
                "prompt" => $description,
                "max_tokens" => 170,
                "echo" => true,
                "frequency_penalty" => 0,
                "presence_penalty" => 0.1,
                "top_p" => 1,
                "temperature" => 0.7,
                "stop" => ["-----------"]
            );
        }
        $client = new Client(['headers' => $this->header]);
        $body = json_encode($postValues);

        $promises = [];
        for ($i = 0; $i < $count; $i++) {
            $promises[] = $client->postAsync('https://api.openai.com/v1/engines/davinci/completions', ['body' => $body]);
        }
        $results = Promise\settle($promises)->wait();

        $response_data = [];
        foreach ($results as $result){
            $response_data[] = json_decode($result['value']->getBody()->getContents(), true);
        }
        return $this->checkSensitive($response_data);
    }

    /**
     * @param array $contentArray
     * @return array
     */
    public function checkSensitive($contentArray = [])
    {
        //  $contentArray
        $client = new Client(['headers' => $this->header]);
        $promises = [];
        for ($i = 0; $i < count($contentArray); $i++) {
            $postValues = array(
                'prompt' => "<|endoftext|>" . $contentArray[$i]['choices'][0]['text'] . "\n--\nLabel:",
                'temperature' => 0,
                'max_tokens' => 1,
                'top_p' => 1,
                'frequency_penalty' => 0,
                'presence_penalty' => 0,
                'logprobs' => 10
            );
            $body = json_encode($postValues);
            $promises[] = $client->postAsync('https://api.openai.com/v1/engines/content-filter-alpha-c4/completions', ['body' => $body]);
        }
        $results = Promise\settle($promises)->wait();
        foreach ($results as $index => $result) {
            $text = json_decode($result['value']->getBody()->getContents(), true);
            if ($text['choices'][0]['text'] == 2) {
                $contentArray[$index]['choices'][0]['text'] = 'Sensitive text generated. Please review inputs and regenerate';
            }
        }
        return $contentArray;
    }

    public function getSocialAd($description = '')
    {
        $authorization = "Authorization: Bearer ".env('OPENAI_API_KEY');
        $curl = curl_init();
        $postValues = array(
            "prompt" => $description,
            "max_tokens" => 100,
            "echo" => true,
            "frequency_penalty" => 0,
            "presence_penalty" => 0,
            "top_p" => 1,
            "temperature" => 0.7,
            "stop" => ["-----------"]
        );
        curl_setopt($curl, CURLOPT_URL, 'https://api.openai.com/v1/engines/davinci/completions');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postValues));
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        $response = curl_exec($curl);
        return json_decode($response, true);
    }

    public function percentage($percentage, $totalValue)
    {
        if (!empty($percentage) || $percentage != 0) {
            $percantageValue = $percentage / 100 * $totalValue;
            return round($totalValue - $percantageValue, 2);
        } else {
            return $totalValue;
        }
    }

    public function plans()
    {
        $plans = array(
            '1' => array(
                'name' => 'Monthly Subscription',
                'price' => 49,
                'interval' => 'month'
            ),
            '2' => array(
                'name' => 'yearly Subscription',
                'price' => 85,
                'interval' => 'year'
            ),
            '3' => array(
                'name' => 'Yearly Subscription',
                'price' => 950,
                'interval' => 'year'
            )
        );
        return $plans;
    }

    public function checkStrip_subscription($subscription_id)
    {
        $user = auth()->user();
        if (!$user->subscribed($subscription_id)) {
            return false;
        } else {
            return true;
        }
    }

    public function send_email($name = '', $email = '', $title = '', $message = '')
    {
        $details = array(
            'title' => $title,
            'body' => $message
        );
        Mail::to($email)->send(new Gmail($details));
        return true;
    }

    public function send_email2($name = '', $email = '', $title = '', $message = '', $link = '')
    {
        $details = array(
            'title' => $title,
            'body' => $message,
            'link' => $link
        );
        Mail::to($email)->send(new PasswordReset($details));
        return true;
    }

    function createBase64($string)
    {
        $urlCode = base64_encode($string);
        return str_replace(array('+', '/', '='), array('-', '_', ''), $urlCode);
    }

    function decodeBase64($base64ID)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $base64ID);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    function getProjectList()
    {
        return User::leftJoin('user_projects', 'users.id', '=', 'user_projects.user_id')->leftJoin('projects', 'user_projects.project_id', '=', 'projects.id')->whereIn('users.id', $this->data['teammate_ids'])->whereNull('projects.deleted_at')->select('projects.name', 'projects.id')->groupBy('projects.id')->get();
    }
}
