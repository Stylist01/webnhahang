<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $guarded = [];

    protected $casts = [
        'detail' => 'array',
    ];
}
