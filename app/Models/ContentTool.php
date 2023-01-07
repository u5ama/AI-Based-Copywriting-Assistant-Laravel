<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentTool extends Model
{
    use HasFactory;

    // methode for get all content tools
    public function contentToolItems()
    {
        return $this->hasMany(ContentToolItem::class);
    }
}
