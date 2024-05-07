<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Table;
use App\Model\Set;

class Tabledetail extends Model
{
    protected $guarded=[];

    /**
     * Get the user that owns the table.
     * 
     *  @return Relationships
     */
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    /**
     * Get the user that owns the set.
     * 
     *  @return Relationships
     */
    public function set()
    {
        return $this->belongsTo(Set::class, 'set_id');
    }
}
