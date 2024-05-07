<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Set;
use App\User;

class Setbill extends Model
{
    protected $guarded=[];

    /**
     * Get the Bill that owns the table.
     * 
     *  @return Relationships
     */
    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }

    /**
     * Get the user that owns the bill.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
