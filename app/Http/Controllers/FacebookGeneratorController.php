<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FacebookGeneratorController extends Controller
{
    function getProjectList()
    {
        return User::leftJoin('user_projects', 'users.id', '=', 'user_projects.user_id')->leftJoin('projects', 'user_projects.project_id', '=', 'projects.id')->whereIn('users.id', $this->data['teammate_ids'])->whereNull('projects.deleted_at')->select('projects.name', 'projects.id')->groupBy('projects.id')->get();
    }

    public function index(Request $request)
    {
        return Inertia::render('Generators/Facebook');
    }
}
