<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    /**
     * Get the response that owns the Ads.
     */
    public function adsResponse()
    {
        return $this->hasMany(AdResponse::class);
    }

    public function Items()
    {
        return $this->hasMany(AdsItem::class);
    }

    /**
     * Get the user for the project.
     */
    public function ContentTool()
    {
        return $this->belongsTo(ContentTool::class,'ads_category','uri');
    }
}
