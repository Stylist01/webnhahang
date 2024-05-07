<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Company extends Model
{
    protected $guarded=[];

    /**
     * Get the user that owns the company.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
