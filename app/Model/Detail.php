<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Bill;
use App\Model\Dish;

class Detail extends Model
{
    protected $guarded=[];

    public function bill()
    {
        return $this->belongsTo(bill::class, 'bill_id');
    }

    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }
}
