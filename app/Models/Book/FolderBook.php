<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class FolderBook extends Model
{

    protected $guarded = ['id'] ;
    protected $fillable = ['folder_id','bid'];

    public function folder(){
        return $this->belongsTo(\App\Models\Regulator\Folder::class,'bid','id');
    }
    public function archive(){
        return $this->belongsTo(\App\Models\Regulator\Regulator::class,'bid','id');
    }
}
