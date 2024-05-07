<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayPalLog extends Model
{
    protected $guarded = [];

    protected $casts = [
        'data' => 'array',
    ];
}
