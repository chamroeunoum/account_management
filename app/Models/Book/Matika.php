<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Matika extends Model
{

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    //protected $table = 'matikas';
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
    public function getChapters(){
        return $this->chapters()->get()->map(function($record){
            return [
                'id' => $record->id ,
                'title' => $record->number . " ៖ " . $record->title,
                'children' => $record->getParts(),
                'type'=>'chapter'
            ];
        });
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function author()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }
    public function editor()
    {
        return $this->belongsTo(\App\User::class, 'updated_by');
    }
    public function regulator()
    {
        return $this->belongsTo(\App\Models\Regulator\Regulator::class, 'regulator_id', 'id');
    }
    public function kunty()
    {
        return $this->belongsTo(\App\Models\Regulator\Kunty::class, 'kunty_id', 'id');
    }
    public function chapters()
    {
        return $this->hasMany(\App\Models\Regulator\Chapter::class, 'matika_id', 'id');
    }
    public function parts()
    {
        return $this->hasMany(\App\Models\Regulator\Part::class,'matika_id','id');
    }
    public function sections()
    {
        return $this->hasMany(\App\Models\Regulator\Section::class, 'matika_id', 'id');
    }
    public function matras()
    {
        return $this->hasMany(\App\Models\Regulator\Matra::class,'matika_id','id');
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
