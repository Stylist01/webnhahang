<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Dish;
use App\Model\Ingredient;

class Recipe extends Model
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
     * Get the user that owns the category.
     * 
     *  @return Relationships
     */
    public function dish()
    {
        return $this->belongsTo(Dish::class, 'dish_id');
    }

    /**
     * Get the user that owns the category.
     * 
     *  @return Relationships
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }
}
