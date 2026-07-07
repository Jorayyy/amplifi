<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['title', 'instructions', 'original_url', 'points_per_click'])]
class Content extends Model
{
    // Forces Laravel to always remember to load the connected links automatically
    protected $with = ['sharableLinks'];

    public function sharableLinks()
    {
        return $this->hasMany(SharableLink::class, 'content_id');
    }
}