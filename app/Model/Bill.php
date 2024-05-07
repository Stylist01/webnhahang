<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Table;
use App\User;

class Bill extends Model
{
    protected $guarded=[];

    /**
     * Get the Bill that owns the table.
     * 
     *  @return Relationships
     */
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
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
}
