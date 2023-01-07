<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdResponse extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ad_responses';
    protected $appends = ['date'];

    /**
     * Get the user for the project.
     */
    public function ads()
    {
        return $this->belongsTo(Ads::class);
    }
    /**
     * Get the user for the project.
     */
    public function UserFavourite()
    {
        return $this->hasOne(UserFavourite::class);
    }

    /**
     * Get the user for the project.
     */
    public function getDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
}
