<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    protected $fillable = [
        'id',   
        'district_id', 
        'name',    
    ];

    /**
     * Get the district that owns the Commune.
     * 
     *  @return Relationships
     */
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Get the user for the blog Commune.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }
}
