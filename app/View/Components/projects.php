<?php

namespace App\View\Components;

use App\Models\ProjectsModel;
use App\Models\User;
use App\Models\UserProjects;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class projects extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $projects;
    public $currentUser;
    public function __construct($projects, $currentUser)
    {
        $this->projects = $projects;
        $this->currentUser = $currentUser;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return Application|Factory|View
     */
    public function render()
    {
        if($this->projects->isEmpty()){

            // Create Project for user
            $project = new ProjectsModel();
            $project->name = "My Project";
            $project->user_id = $this->currentUser->id;
            $project->save();

            // Map Project to User
            $save_project = new UserProjects();
            $save_project->user_id = $this->currentUser->id;
            $save_project->project_id = $project->id;
            $save_project->save();

            $user = User::find($this->currentUser->id);
            $user->current_project = $project->id;
            $user->update();

            $this->projects = User::leftJoin('user_projects', 'users.id', '=', 'user_projects.user_id')
                ->leftJoin('projects', 'user_projects.project_id', '=', 'projects.id')
                ->whereIn('users.id', $this->currentUser->id)
                ->whereNull('projects.deleted_at')
                ->select('projects.name', 'projects.id')
                ->groupBy('projects.id')
                ->get();
        }
        $desired_object = $this->projects->first(function($item) {
            return $item->id == $this->currentUser->current_project;
        });
        if(!$desired_object){
            $user = User::find($this->currentUser->id);
            $user->current_project = $this->projects[0]->id;
            $user->update();
        }
        return view('components.projects');
    }
}
