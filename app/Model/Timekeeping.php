<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Timekeeping extends Model
{
    protected $guarded=[];

    /**
     * Get the user that owns the category.
     * 
     *  @return Relationships
     */
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}
