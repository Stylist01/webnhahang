<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable
{
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'customers';

    protected $guarded = [];

    public $timestamps = true;
}
