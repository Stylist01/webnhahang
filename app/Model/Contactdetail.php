<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Contactbill;
use App\Model\Dish;

class Contactdetail extends Model
{
    protected $guarded=[];

    public function contactbill()
    {
        return $this->belongsTo(Contactbill::class, 'bill_id');
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }
}
