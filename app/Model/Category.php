<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Dish;

class Category extends Model
{
    protected $guarded=[];

    /**
     * Get the user that owns the category.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the dish for the blog Category.
     * 
     *  @return Relationships
     */
    public function dish()
    {
        return $this->hasMany(Dish::class, 'id');
    }
}
