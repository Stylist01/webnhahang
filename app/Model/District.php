<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $fillable = [
        'id',  
        'name',     
        'province_id', 
    ];

    /**
     * Get the province that owns the District.
     * 
     *  @return Relationships
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    /**
     * Get the commune for the blog District.
     * 
     *  @return Relationships
     */
    public function commune()
    {
        return $this->hasMany(Commune::class, 'id');
    }

    /**
     * Get the user for the blog District.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }
}
