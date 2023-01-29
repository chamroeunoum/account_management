<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $guarded = ['id'];
    protected $casts = [
        'id' => 'int' ,
        'name' => 'string' ,
        'unit_type_id' => 'int',
        'order' => 'int' ,
        'active' => 'int'
    ];

    public function type(){
        return $this->belongsTo('\App\UnitType','unit_type_id','id');
    }
    public function archives(){
        return $this->belongsToMany('App\Models\Book\Book','archives_units','unit_id','bid');
    }
    public function setActiveAttribute($val){
        $this->attributes['active'] = (int) $val ;
    }
    public function getActiveAttribute(){
        return (int) $this->attributes['active'] ;
    }
}
