<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Model\Personnel;

class Position extends Model
{
    protected $guarded=[];
    
    /**
     * Get the user that owns the position.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the company for the blog User.
     * 
     * @return Relationships
     */
    public function personnel()
    {
        return $this->hasMany(Personnel::class, 'id');
    }
}
