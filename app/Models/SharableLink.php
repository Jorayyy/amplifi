<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'content_id', 'unique_code'])] // This unlocks the columns for mass assignment!
class SharableLink extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function content()
    {
        return $this->belongsTo(Content::class);
    }

    public function clicks()
    {
        return $this->hasMany(Click::class);
    }
}
