<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProjects extends Model
{
    use HasFactory;
    protected $fillable = ["user_id","project_id"];

    public function projects(){
        return $this->hasOne(ProjectsModel::class, 'id','project_id');
    }
}
