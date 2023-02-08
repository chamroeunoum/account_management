<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Matra extends Model
{

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    //protected $table = 'matras';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['number','title','meaning','book_id','kunty_id','matika_id','chapter_id','part_id','section_id','created_by','updated_by','active'];
    protected $casts = [
        'number' => 'string' ,
        'title' => 'string',
        'meaning' => 'string',
        'bid' => 'int' ,
        'kunty_id' => 'int',
        'matika_id' => 'int',
        'chapter_id' => 'int',
        'part_id' => 'int',
        'section_id' => 'int',
        'created_by' => 'int',
        'updated_by' => 'int',
        'active' => 'int'
    ];
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
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
    public function editor()
    {
        return $this->belongsTo(\App\Models\User::class, 'updated_by');
    }
    public function book()
    {
        return $this->belongsTo(\App\Models\Book\Book::class, 'bid', 'id');
    }
    public function kunty()
    {
        return $this->belongsTo(\App\Models\Book\Kunty::class, 'kunty_id', 'id');
    }
    public function matika()
    {
        return $this->belongsTo(\App\Models\Book\Matika::class, 'matika_id', 'id');
    }
    public function chapter()
    {
        return $this->belongsTo(\App\Models\Book\Chapter::class, 'chapter_id', 'id');
    }
    public function part()
    {
        return $this->belongsTo(\App\Models\Book\Part::class, 'part_id', 'id');
    }
    public function section()
    {
        return $this->belongsTo(\App\Models\Book\Section::class, 'section_id', 'id');
    }


    public function folders(){
        return $this->hasManyThrough(\App\Models\Book\Folder::class,'folder_matras','matra_id','folder_id');
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
