<?php

namespace App\Actions\Fortify;

use App\Models\ProjectsModel;
use App\Models\Trail;
use App\Models\User;
use App\Models\UserProjects;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Rules\Password;
use Laravel\Jetstream\Jetstream;
use Stevebauman\Location\Facades\Location;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Get the validation rules used to validate passwords.
     *
     * @return array
     */
    protected function passwordRules()
    {
        return ['required', 'string', new Password];
    }

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return User
     * @throws ValidationException
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        $userId = 0;
        $parentUser = null;
        if ($input['ref']) {
            $parentUser = User::whereLinkout($input['ref'])->first();
            $find = User::where('parent_member', $parentUser->id)->count();
            if ($find >= 10) {
                $data['response'] = false;
                $data['msg'] = 'You can not register using this link!';
                return response()->json($data);
            }
        }
        $data = [];
        $location = request()->ip();
        $location = str_replace('.', ':', $location);
        $location_data = Location::get($location);
        $country_name = $location_data->countryName ?? '';
        $formData = array(
            'username' => $input['name'],
            'name'     => $input['name'],
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
        $u_obj = new User();
        $response = $u_obj->insertGetId($formData);
        $userId = $response;

        $user = User::find($response);
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
            $user->current_project = $parentUser->current_project;
            $user->save();
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
        return $user;
    }
}
