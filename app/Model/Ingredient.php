<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Recipe;

class Ingredient extends Model
{
    protected $guarded=[];

    /**
     * Get the user that owns the Ingredient.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the recipe for the blog Category.
     * 
     *  @return Relationships
     */
    public function recipe()
    {
        return $this->hasMany(Recipe::class, 'id');
    }
}
