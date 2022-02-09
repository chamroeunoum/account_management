<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    /**
     * Properties
     */
    protected $guarded = [ 'id' ];
    /**
     * Relationships
     */
    /**
     * Accounts own by the people
     */
    public function accounts(){
        return $this->hasMany(\App\User::class,'people_id','id');
    }
    /**
     * Mutation
     */

}
