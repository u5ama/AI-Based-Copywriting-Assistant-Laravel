<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSidebarChoice extends Model
{
    use HasFactory;

    protected $fillable = ["user_id","expand"];

    protected $casts = [
        'expand' => 'boolean',
    ];
}
