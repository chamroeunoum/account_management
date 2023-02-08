<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class FolderBook extends Model
{

    protected $guarded = ['id'] ;
    protected $fillable = ['folder_id','book_id'];

    public function folder(){
        return $this->belongsTo(\App\Models\Book\Folder::class,'bid','id');
    }
    public function book(){
        return $this->belongsTo(\App\Models\Book\BOok::class,'bid','id');
    }
}
