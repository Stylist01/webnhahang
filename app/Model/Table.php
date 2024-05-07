<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Table extends Model
{
    protected $guarded=[];

    /**
     * Get the user that owns the Table.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     /**
     * Get the bill for the blog Table.
     * 
     *  @return Relationships
     */
    public function bill()
    {
        return $this->hasMany(Bill::class, 'id');
    }
}
