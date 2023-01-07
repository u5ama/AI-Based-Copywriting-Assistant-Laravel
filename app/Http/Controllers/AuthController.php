<?php

namespace App\Http\Controllers;

use App\Models\ProjectsModel;
use App\Models\Trail;
use App\Models\User;
use App\Models\UserProjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Stevebauman\Location\Facades\Location;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return Inertia::render('Auth/Login');
    }

    public function register(Request $request)
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
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
                'username' => 'required|max:50',
                'email' => 'required|max:50|unique:users|email',
                'password' => 'required|min:8',
//      'g-recaptcha-response' => 'required|recaptcha',
                //'checkbox' => 'required',

            ]
//        [
//      'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
//      'g-recaptcha-response.required' => 'Captcha is required.',
//        ]
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
                'username' => $input['username'],
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
            $users = User::find($userId);
            auth()->login($users, true);
            $authUser =  ['userID' => $users['id'], 'role' => 'user', 'email' => $users['email'], 'username' => $users['username'], 'isLoggedIn' => true, 'status' => $users['status'], 'current_project' => $users['current_project'], 'linkout' => $users['linkout'], 'parent_member' => $users['parent_member']];
            session(['user' => $authUser]);
        }
        return response()->json($data);
    }
}
