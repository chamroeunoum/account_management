<?php

namespace App\Http\Controllers\Api\Book;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book\Book AS RecordModel;
use App\Models\Book\Kunty;
use App\Models\Book\Chapter;
use App\Models\Book\Matika;
use App\Models\Book\Part;
use App\Models\Book\Section;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\CrudController;

class BookController extends Controller
{
    private $selectedFields ;
    public function __construct(){
        $this->selectedFields = ['id', 'title','description', 'color' , 'cover' , 'complete' , 'created_by', 'updated_by' , 'pdf' , 'created_at', 'updated_at' ] ;
    }
    /** Get a list of Archives */
    public function index(Request $request){

        /** Format from query string */
        $search = isset( $request->search ) && $request->serach !== "" ? $request->search : false ;
        $perPage = isset( $request->perPage ) && $request->perPage !== "" ? $request->perPage : 50 ;
        $page = isset( $request->page ) && $request->page !== "" ? $request->page : 1 ;
        // $number = isset( $request->number ) && $request->number !== "" ? $request->number : false ;
        // $type = isset( $request->type ) && $request->type !== "" ? $request->type : false ;
        // $unit = isset( $request->unit ) && $request->unit !== "" ? $request->unit : false ;
        // $date = isset( $request->date ) && $request->date !== "" ? $request->date : false ;


        $queryString = [
            // "where" => [
            //     'default' => [
            //         [
            //             'field' => 'type_id' ,
            //             'value' => $type === false ? "" : $type
            //         ]
            //     ],
            //     'in' => [] ,
            //     'not' => [] ,
            //     'like' => [
            //         [
            //             'field' => 'number' ,
            //             'value' => $number === false ? "" : $number
            //         ],
            //         [
            //             'field' => 'year' ,
            //             'value' => $date === false ? "" : $date
            //         ]
            //     ] ,
            // ] ,
            // "pivots" => [
            //     $unit ?
            //     [
            //         "relationship" => 'units',
            //         "where" => [
            //             "in" => [
            //                 "field" => "id",
            //                 "value" => [$request->unit]
            //             ],
            //         // "not"=> [
            //         //     [
            //         //         "field" => 'fieldName' ,
            //         //         "value"=> 'value'
            //         //     ]
            //         // ],
            //         // "like"=>  [
            //         //     [
            //         //        "field"=> 'fieldName' ,
            //         //        "value"=> 'value'
            //         //     ]
            //         // ]
            //         ]
            //     ]
            //     : []
            // ],
            "pagination" => [
                'perPage' => $perPage,
                'page' => $page
            ],
            "search" => $search === false ? [] : [
                'value' => $search ,
                'fields' => [
                    'title', 'description' 
                ]
            ],
            "order" => [
                'field' => 'id' ,
                'by' => 'desc'
            ],
        ];

        $request->merge( $queryString );

        $crud = new CrudController(new RecordModel(), $request, $this->selectedFields);
        $crud->setRelationshipFunctions([
            /** relationship name => [ array of fields name to be selected ] */
            'createdBy' => ['id', 'firstname', 'lastname' ,'username'] ,
            'updatedBy' => ['id', 'firstname', 'lastname', 'username']
        ]);
        $builder = $crud->getListBuilder();

        /** Filter the record by the user role */
        // if( ( $user = $request->user() ) !== null ){
        //     /** In case user is the administrator, all archives will show up */
        //     if( array_intersect( $user->roles()->pluck('id')->toArray() , [2,3,4] ) ){
        //         /** In case user is the super, auditor, member then the archives will show up if only that archives are own by them */
        //         $builder->where('created_by',$user->id);
        //     }else{
        //         /** In case user is the customer */
        //         /** Filter archives by its type before showing to customer */
        //     }
        // }

        $responseData = $crud->pagination(true, $builder,[
            'description' => function($description){
                return html_entity_decode( strip_tags( $description ) );
            } ,
            'title' => function($title){
                return html_entity_decode( strip_tags( $title ) );
            }
        ]);
        $responseData['message'] = __("crud.read.success");
        $responseData['ok'] = true ;
        return response()->json($responseData);
    }
    /** Create a new Regulator */
    public function store(Request $request){
        if( ($user = $request->user() ) !== null ){
            $archiveUnits = $request->get('unit_ids',false);
            if($archiveUnits){
                $archiveUnits = explode(',',$archiveUnits);
            }
            unset($request['unit_ids']);
            /** Merge variable created_by and updated_by into request */

            $request['created_at'] = $request['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $request['created_by'] = $request['updated_by'] = $user->id;
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields);
            // $crud->setRelationshipFunctions([
            //     'units' => false
            // ]);
            if (($record = $crud->create()) !== false) {
                /** Link the Regulator to the units */
                $updatedArchiveUnits = [];
                if($archiveUnits && is_array($archiveUnits)){
                    foreach( $archiveUnits AS $archiveUnit ){
                        $updatedArchiveUnits[ $archiveUnit ] =
                            [
                                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s') ,
                                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s') ,
                                'created_by' => $user->id ,
                                'updated_by' => $user->id
                            ];
                    }
                    $record->units()->sync( $updatedArchiveUnits );
                }

                $record = $crud->formatRecord($record);
                return response()->json([
                    'ok' => true ,
                    'record' => $record,
                    'message' => __("crud.save.success")
                ]);
            }
            return response()->json([
                'ok' => false ,
                'message' => __("crud.save.failed")
            ]);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);

    }
    /** Updating the Regulator */
    public function update(Request $request)
    {
        if (($user = $request->user()) !== null) {

            $archiveUnits = $request->get('unit_ids',false);
            unset( $request['unit_ids'] );

            /** Merge variable created_by and updated_by into request */
            $input = $request->input();
            $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            $request->merge($input);
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields);
            // $crud->setRelationshipFunctions([
            //     'units' => false
            // ]);
            /**
             * Check some fields before update the record, because it is related to the reference file
             * number , year, type
             */
            $record = $crud->read();
            if( $record->number != $request->number || \Carbon\Carbon::parse( $record->year )->format('Y-m-d') != $request->year || $record->type_id != $request->type_id ){
                /**
                 * Update location or move file
                 */
                list($year,$month,$day) = explode('-', \Carbon\Carbon::parse( $request->year )->format('Y-m-d') );
                $path = 'documents/'.$request->type_id."/".$year;
                $files = [] ;
                $pdfs = is_array( $record->pdfs ) ? ( !empty( $record->pdfs ) ? $record->pdfs : [] ) : ( $record->pdfs !== "" ? [ $record->pdfs ] : [] ) ;
                /**
                 * Start moving files
                 */ 
                foreach($pdfs AS $index => $pdf ){
                    $newLocation = $path. '/' . $record->id . '-' . $request->type_id.'-'.$year.$month.$day."-".$request->number.'.pdf' ;
                    if( Storage::disk(env('STORAGE_DRIVER','public'))->exists($pdf) ){
                        if( Storage::disk(env('STORAGE_DRIVER','public'))->move($pdf, $newLocation) ) {
                            $files[] = $newLocation;
                        }
                    }
                }
                $record->pdfs = $files;
                $record->save();
            }
            
            if ( $crud->update(['id','pdfs']) !== false) {
                $record = $crud->read();
                /** Link the Regulator to the units */
                $updatedArchiveUnits = [];
                if($archiveUnits && is_array($archiveUnits)){
                    foreach( $archiveUnits AS $archiveUnit ){
                        $updatedArchiveUnits[ $archiveUnit ] =
                            [
                                'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s') ,
                                'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s') ,
                                'created_by' => $user->id ,
                                'updated_by' => $user->id
                            ];
                    }
                    $record->units()->sync( $updatedArchiveUnits );
                }
                $record = $crud->formatRecord($record);
                return response()->json([
                    'record' => $record,
                    'ok' => true ,
                    'message' => __("crud.update.success")
                ], 200);
            }
            return response()->json([
                'ok' => false ,
                'message' => __("crud.update.failed")
            ], 201);
        }
        return response()->json([
            'ok' => false,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Updating the Regulator */
    public function read(Request $request)
    {
        if (($user = $request->user()) !== null) {
            $this->selectedFields[] = 'pdfs' ;
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields );
            $crud->setRelationshipFunctions([
                'units' => false
            ]);
            if (($record = $crud->read()) !== false) {
                $record = $crud->formatRecord($record);
                return response()->json([
                    'record' => $record,
                    'ok' => true ,
                    'message' => __("crud.read.success")
                ]);
            }
            return response()->json([
                'ok' => false,
                'message' => __("crud.read.failed")
            ]);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Get kunties of the Regulator */
    public function kunties(Request $request)
    {
        if (($user = $request->user()) !== null) {
            $this->selectedFields[] = 'pdfs' ;
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields );
            // $crud->setRelationshipFunctions([
            //     'units' => false ,
            //     'kunties' => ['id','title','number']
            // ]);
            if (($record = $crud->read()) !== false) {
                // $record = $crud->formatRecord($record);
                return response()->json([
                    'records' => $record->kunties,
                    'ok' => true ,
                    'message' => __("crud.read.success")
                ]);
            }
            return response()->json([
                'ok' => false,
                'message' => __("crud.read.failed")
            ]);
        }
        return response()->json([
            'records' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Get matikas of the Regulator */
    public function matikas(Request $request)
    {
        if (($user = $request->user()) !== null) {
            $this->selectedFields[] = 'pdfs' ;
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields );
            $crud->setRelationshipFunctions([
                'units' => false ,
                'matikas' => [ 'id' , 'number' , 'title' ]
            ]);
            if (($record = $crud->read()) !== false) {
                $record = $crud->formatRecord($record);
                return response()->json([
                    'records' => $record,
                    'ok' => true ,
                    'message' => __("crud.read.success")
                ]);
            }
            return response()->json([
                'ok' => false,
                'message' => __("crud.read.failed")
            ]);
        }
        return response()->json([
            'records' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    
    /** Delete an Regulator */
    public function delete(Request $request)
    {
        if (($user = $request->user()) !== null) {
            /** Merge variable created_by and updated_by into request */
            $input = $request->input();
            $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            $request->merge($input);

            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields );
            $record = $crud->read();
            if ( $crud->delete() !== false) {
                /** Delete its structure and matras too */
                Storage::disk(env('STORAGE_DRIVER','public'))->delete($record->pdfs);
                return response()->json([
                    'ok' => true ,
                    'message' => __("crud.delete.success")
                ]);
            }
            return response()->json([
                'ok' => false,
                'message' => __("crud.delete.failed")
            ]);
        }
        return response()->json([
            'ok' => false,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Upload file */
    public function upload(Request $request){
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields  );
            $record = $crud->read();
            list($year,$month,$day) = explode('-', \Carbon\Carbon::parse( $record->year )->format('Y-m-d') );
            $path = 'documents/'.$record->type_id."/".$year;
            if (($record = $crud->upload('pdfs',$path, new File($_FILES['files']['tmp_name']), $record->id . '-' . $record->type_id.'-'.$year.$month.$day."-".$record->number.'.pdf' , false )) !== false) {
                // $record = $crud->formatRecord($record);
                return response()->json([
                    'record' => $record,
                    'ok' => true ,
                    'message' => __("crud.delete.success")
                ]);
            }
            return response()->json([
                'ok' => false ,
                'message' => __("crud.delete.failed")
            ]);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Check duplicate Regulator */
    public function exists(Request $request){
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields  );
            if ( ($record = $crud->exists(['fid','year'],true)) !== false) {
                $record = $crud->formatRecord($record);
                return response()->json([
                    'record' => $record,
                    'message' => __("crud.duplicate.no")
                ], 200);
            }
            return response()->json([
                'record' => null,
                'message' => __("crud.duplicate.yes")
            ], 201);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Active the record */
    public function active(Request $request)
    {
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields  );
            if ($crud->booleanField('active', 1)) {
                $record = $crud->formatRecord($record = $crud->read());
                return response(
                    [
                        'record' => $record,
                        'ok' => true ,
                        'message' => 'Activated !'
                    ]);
            } else {
                return response(
                    [
                        'ok' => false ,
                        'message' => 'There is not record matched !'
                    ]);
            }
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Unactive the record */
    public function unactive(Request $request)
    {
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, $this->selectedFields );
            if ( $crud->booleanField('active', 0) ) {
                $record = $crud->formatRecord($record = $crud->read());
                // User does exists
                return response(
                    [
                        'record' => $record,
                        'ok' => true ,
                        'message' => 'Deactivated !'
                    ]);
            } else {
                return response(
                    [
                        'ok' => false ,
                        'message' => 'There is not record matched !'
                    ]);
            }
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /**
     * Remove file
     */
    public function removefile(Request $request)
    {
        $crud = new CrudController(new RecordModel(), $request, $this->selectedFields  );
        if (($record = $crud->removeFile('pdfs')) != null) {
            $record = $crud->formatRecord( $record );
            return response()->json([
                'record' => $record ,
                'message' => __('crud.remove.file.success')
            ], 200);
        }
        return response()->json([
            'message' => __('crud.remove.file.success')
        ], 350);
    }
    /** Mini display */
    public function compactList(Request $request)
    {
        /** Format from query string */
        $search = isset( $request->search ) && $request->serach !== "" ? $request->search : false ;
        $perPage = isset( $request->perPage ) && $request->perPage !== "" ? $request->perPage : 50 ;
        $page = isset( $request->page ) && $request->page !== "" ? $request->page : 1 ;
        $queryString = [
            "pagination" => [
                'perPage' => $perPage,
                'page' => $page
            ],
            "search" => $search === false ? [] : [
                'value' => $search ,
                'fields' => [
                    'title','description'
                ]
            ],
            "order" => [
                'field' => 'title' ,
                'by' => 'asc'
            ],
        ];
        $request->merge( $queryString );
        $crud = new CrudController(new RecordModel(), $request, ['id', 'title', 'description']);
        $builder = $crud->getListBuilder();
        $responseData = $crud->pagination(true, $builder, [
            'field' => 'title' ,
            'callback' => function($val){ return strip_tags( $val ); }
        ]);
        $responseData['message'] = __("crud.read.success");
        $responseData['ok'] = true ;
        return response()->json($responseData);
    }
    public function structure(Request $request){
        if (($user = $request->user()) !== null) {
            $Regulator = RecordModel::select(['id','title','description'])->where('id',$request->id)->first();
            if ( $Regulator !== null ) {
                return response()->json([
                    'regulator' => $Regulator ,
                    'structure' => $Regulator->getStructure() ,
                    'ok' => true ,
                    'message' => __("crud.read.success")
                ]);
            }
            return response()->json([
                'ok' => false,
                'message' => __("crud.read.failed")
            ]);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /***
     * Check type of level
     * kunty
     * matika
        chapter
        part
        section
     */

    private function _checkType($type){
        $model = new Kunty();
        switch ($type) {
            case 'kunty':
                $model = new Kunty();
                break;
            case 'matika':
                $model = new Matika();
                break;
            case 'capture':
                $model = new Capture();
                break;
            case 'part':
                $model = new Part();
                break;
            case 'section':
                $model = new Section();
                break;
            default:
                # code...
                break;
        }
        return $model;
    }
    /** Save Structure */
    public function saveStructure(Request $request,$id){
        dd($request->all(),$id);
        $type = $request->get('type',null);
        $title = $request->get('title',null);
        $number = $request->get('number',null);
        $status = 404;
        $responseData['message'] = __("crud.read.failed");
        if(!$type)  return response()->json(['message'=>__("crud.read.failed")], 404);

        $model = $this->_checkType($type);
        $model->archive_id = $id;
        $model->title = $title;
        $model->save();
        if($model){
            $responseData['message'] = __("crud.read.success");
            $status = 200;
        }
        return response()->json($responseData, $status);
    }
}