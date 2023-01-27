<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    //protected $table = 'sections';
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
    public function archive()
    {
        return $this->belongsTo(\App\Models\Regulator\Regulator::class, 'regulator_id', 'id');
    }
    public function kunty()
    {
        return $this->belongsTo(\App\Models\Regulator\Kunty::class,'kunty_id','id');
    }
    public function matika()
    {
        return $this->belongsTo(\App\Models\Regulator\Matika::class, 'matika_id', 'id');
    }
    public function chapter()
    {
        return $this->belongsTo(\App\Models\Regulator\Chapter::class, 'chapter_id', 'id');
    }
    public function part()
    {
        return $this->belongsTo(\App\Models\Regulator\Part::class, 'part_id', 'id');
    }
    public function matras()
    {
        return $this->hasMany(\App\Models\Regulator\Matra::class, 'section_id', 'id');
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
