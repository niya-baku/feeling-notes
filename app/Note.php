<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $casts = [
        'am_image' => 'integer',
        'pm_image' => 'integer',
        'night_image' => 'integer'
    ];
}
