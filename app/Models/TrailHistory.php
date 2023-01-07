<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrailHistory extends Model
{

    public function users()
    {
        return $this->belongsTo(User::class);
    }
    public function Trail()
    {
        return $this->belongsTo(Trail::class);
    }
}
