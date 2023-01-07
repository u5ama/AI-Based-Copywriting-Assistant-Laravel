<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Billable;
    use HasApiTokens;
    use HasProfilePhoto;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','username', 'provider_id', 'email', 'password', 'role', 'phone', 'linkout', 'parent_member', 'member_of', 'linked_user_role', 'upgrade_preference','profile'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function login($user)
    {
        $password = $user['password'];
        $email = $user['email'];
        $credentials = array();
        $credentials['email'] = $email;
        $credentials['password'] = $password;
        $user = $this->where(['email' => $user['email']])->first();

        if ($user) {
            if (auth()->attempt($credentials)) {
                return ['userID' => $user['id'], 'role' => $user['role'], 'email' => $user['email'], 'username' => $user['username'], 'isLoggedIn' => true, 'status' => $user['status'], 'current_project' => $user['current_project'], 'linkout' => $user['linkout'], 'parent_member' => $user['parent_member']];

            } else {
                return false;
            }
        }
        return false;
    }

    public function trailof()
    {
        return $this->hasone('App\Models\Trail', 'id', 'user_id');
    }

    public function Trail()
    {
        return $this->hasone('App\Models\Trail', 'user_id', 'id');
    }

    /**
     * Get the projects that owns the user.
     */
    public function projects()
    {
        return $this->hasMany('App\Models\ProjectsModel', 'id', 'user_id');
    }

    public function getStripeSubscriptionSchedule()
    {
        return $this->hasOne(StripeSubscriptionSchedule::class, 'user_id', 'id');
    }
}
