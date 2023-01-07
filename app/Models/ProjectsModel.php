<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectsModel extends Model
{
    use SoftDeletes;

    protected $table = 'projects';

    protected $fillable = ["user_id","name"];

}
