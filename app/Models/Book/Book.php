<?php

namespace App\Models\Book;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'pdf' => 'array'
    ];

    //protected $table = 'books';
    //protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id','clear_pdf'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public static function getBook($id,$columns=false){
        return  $columns!==false&&is_array($columns)&&!empty($columns)
                ?static::selectRaw( implode( ' , ' , $columns ) )->where( 'id' , $id )
                :static::where( 'id' , $id );
    }
    public static function getKunthies($id,$columns=false){
        return  $columns!==false&&is_array($columns)&&!empty($columns)
                ?Kunty::selectRaw( implode( ' , ' , $columns ) )->where( 'book_id' , $id )
                :Kunty::where( 'book_id' , $id );
    }
    public static function getMatikas($id,$columns=false){
        return  $columns!==false&&is_array($columns)&&!empty($columns)
                ?Matika::selectRaw( implode( ' , ' , $columns ) )->where( 'book_id' , $id )
                :Matika::where( 'book_id' , $id );
    }
    public static function getChapters($id,$columns=false){
        return  $columns!==false&&is_array($columns)&&!empty($columns)
                ?Chapter::selectRaw( implode( ' , ' , $columns ) )->where( 'book_id' , $id )
                :Chapter::where( 'book_id' , $id );
    }
    public static function getParts($id,$columns=false){
        return  $columns!==false&&is_array($columns)&&!empty($columns)
                ?Part::selectRaw( implode( ' , ' , $columns ) )->where( 'book_id' , $id )
                :Part::where( 'book_id' , $id );
    }
    public static function getSections($id,$columns=false){
        return  $columns!==false&&is_array($columns)&&!empty($columns)
                ?Section::selectRaw( implode( ' , ' , $columns ) )->where( 'book_id' , $id )
                :Section::where( 'book_id' , $id );
    }
    public static function getMatras($id,$columns=false,$search=false){
        /**
         * ជ្រើសរើសជួរឈរដែលចង់បាន
        */
        $builder = $columns !== false && is_array($columns) && !empty($columns)
                ? Matra::selectRaw( implode( ' , ' , $columns ) )
                    ->where( 'book_id' , $id )
                : Matra::where( 'book_id' , $id );
        /**
         * បន្ថែមលក្ខណ នៃការស្វែងរក ដែលត្រូវការ
         */
        $builder->Where(function ($query) use ($columns,$search) {
            /**
             * កំណត់ជួឈរ ដែលជាជួឈរ ត្រូវធ្វើការស្វែងរក
             */
            $columns = ['aid','title','meaning'] ;
            /**
             * អនុវត្ថន៍ការស្វែងរក
             */
            foreach( $columns AS $column ) $query->orwhere( $column , 'LIKE' , '%' . $search . '%' );
            return $query ;
        });
        return  $builder ;
    }
    public static function getContent($id){
        $book = Book::getBook($id,['id','title','cover','color','pdf'])->first();
        foreach( $book->kunties AS $kunty ) return $kunty->chapters ;
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function createdBy(){
        return $this->belongsTo(\App\Models\User::class,'created_by');
    }
    public function updatedBy(){
        return $this->belongsTo(\App\Models\User::class,'updated_by');
    }
    public function kunties(){
        return $this->hasMany(Kunty::class,'book_id');
    }
    public function matikas(){
        return $this->hasMany(Matika::class,'book_id');
    }
    public function chapters(){
        return $this->hasMany(Chapter::class,'book_id');
    }
    public function parts(){
        return $this->hasMany(Part::class,'book_id');
    }
    public function sections(){
        return $this->hasMany(Section::class,'book_id');
    }
    public function matras(){
        return $this->hasMany(Matra::class,'book_id');
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
    public function setCoverAttribute($value)
    {
        $attribute_name = "cover";
        $disk = "public";
        $destination_path = "uploads/book_covers";

        // if the image was erased
        if ($value==null) {
            // delete the image from disk
            \Storage::disk($disk)->delete($this->{$attribute_name});

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (starts_with($value, 'data:image'))
        {
            // 0. Make the image
            $image = \Image::make($value);
            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';
            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());
            // 3. Save the path to the database
            $this->attributes[$attribute_name] = $destination_path.'/'.$filename;
        }
    }
    public static function boot()
    {
        parent::boot();
        // Delete cover of the book
        static::deleting(function($obj) {
            \Storage::disk(env('FILESYSTEM_DRIVER','public'))->delete($obj->cover);
        });
        // Delete Pdf file of the book
        static::deleting(function($obj) {
            if (count((array)$obj->pdf)) {
            // if (count((array)$obj->pdf) && $obj->forceDeleting === true) {
                foreach ($obj->pdf as $file_path) {
                    \Storage::disk(env('FILESYSTEM_DRIVER','public'))->delete($file_path);
                }
            }
        });
    }

    public function setPdfAttribute($value)
    {
        $attribute_name = "pdf";
        $disk = "uploads";
        $destination_path = "uploads/book/pdf";

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
