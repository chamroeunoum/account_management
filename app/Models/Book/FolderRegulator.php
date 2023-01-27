<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class FolderRegulator extends Model
{

    protected $guarded = ['id'] ;
    protected $fillable = ['folder_id','regulator_id'];

    public function folder(){
        return $this->belongsTo(\App\Models\Regulator\Folder::class,'folder_id','id');
    }
    public function archive(){
        return $this->belongsTo(\App\Models\Regulator\Regulator::class,'regulator_id','id');
    }
}