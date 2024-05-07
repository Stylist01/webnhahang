<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Position;

class Personnel extends Model
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
     * Get the user that owns the category.
     * 
     *  @return Relationships
     */
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    /**
     * Get the commune that owns the User.
     * 
     *  @return Relationships
     */
    public function commune()
    {
        return $this->belongsTo(Commune::class, 'commune_id');
    }

    /**
     * Get the province that owns the User.
     * 
     *  @return Relationships
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }
}
