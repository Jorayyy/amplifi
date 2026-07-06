<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['sharable_link_id', 'ip_address', 'target_domain'])] // Unlocks click logging columns!
class Click extends Model
{
    public function sharableLink()
    {
        return $this->belongsTo(SharableLink::class);
    }
}
