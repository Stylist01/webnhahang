<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Setbill;
use App\Model\Dish;

class Setdetail extends Model
{
    protected $guarded=[];

    public function setbill()
    {
        return $this->belongsTo(Setbill::class, 'setbill_id');
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }
}
