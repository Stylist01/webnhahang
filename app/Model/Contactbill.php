<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Contact;
use App\User;
use App\Model\Personnel;

class Contactbill extends Model
{
    protected $guarded=[];

    /**
     * Get the Bill that owns the table.
     * 
     *  @return Relationships
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    /**
     * Get the user that owns the bill.
     * 
     *  @return Relationships
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the bill.
     * 
     *  @return Relationships
     */
    public function personnel()
    {
        return $this->belongsTo(Personnel::class, 'personnel_id');
    }
}
