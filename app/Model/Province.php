<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
        'id', 
        'name', 
    ];

    /**
     * Get the district for the blog Province.
     * 
     *  @return Relationships
     */
    public function district()
    {
        return $this->hasMany(District::class, 'id');
    }

    /**
     * Get the user for the blog Province.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }
}
