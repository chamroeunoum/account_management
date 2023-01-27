<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Kunty extends Model
{

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'kunties';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getMatikas(){
        return $this->matikas()->get()->map(function($record){
            return [
                'id' => $record->id ,
                'title' => $record->number . " ៖ " . $record->title,
                'children' => $record->getChapters(),
                'type' => 'matika'
            ];
        });
    }
    public function getChapters(){
        return $this->chapters()->get()->map(function($record){
            return [
                'id' => $record->id ,
                'title' => $record->number . " ៖ " . $record->title,
                'children' => $record->getParts() ,
                'type' => 'chapter'
            ];
        });
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function author(){
        return $this->belongsTo(\App\User::class,'created_by');
    }
    public function editor(){
        return $this->belongsTo(\App\User::class,'updated_by');
    }
    public function regulator(){
        return $this->belongsTo(\App\Models\Regulator\Regulator::class,'regulator_id','id');
    }
    public function matikas()
    {
        return $this->hasMany(\App\Models\Regulator\Matika::class, 'kunty_id', 'id');
    }
    public function chapters()
    {
        return $this->hasMany(\App\Models\Regulator\Chapter::class, 'kunty_id', 'id');
    }
    public function parts()
    {
        return $this->hasMany(\App\Models\Regulator\Part::class, 'kunty_id', 'id');
    }
    public function sections()
    {
        return $this->hasMany(\App\Models\Regulator\Section::class, 'kunty_id', 'id');
    }
    public function matras()
    {
        return $this->hasMany(\App\Models\Regulator\Matra::class,'kunty_id','id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}