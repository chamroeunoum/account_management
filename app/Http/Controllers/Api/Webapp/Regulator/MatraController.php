<?php

namespace App\Http\Controllers\Api\Webapp\Regulator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regulator\Matra AS RecordModel;
use Illuminate\Http\File;
use App\Http\Controllers\CrudController;

class MatraController extends Controller
{
    /** Get a list of Archives */
    public function index(Request $request){
        /**
         * Filter all the matras base on its regulator which is active
         */
        $activeBookIds = \App\Models\Regulator\Book::where('active',1)->where('complete',1)->pluck('id')->toArray();
        /** Format from query string */
        $search = isset( $request->search ) && $request->serach !== "" ? $request->search : false ;
        $perPage = isset( $request->perPage ) && $request->perPage !== "" ? $request->perPage : 10 ;
        $page = isset( $request->page ) && $request->page !== "" ? $request->page : 1 ;

        $queryString = [
            "where" => [
                // 'default' => [
                //     // [
                //     //     'field' => 'type_id' ,
                //     //     'value' => $type === false ? "" : $type
                //     // ]
                // ],
                'in' => [
                    [
                        'field' => 'book_id' ,
                        'value' => $activeBookIds
                    ]
                ] ,
                // 'not' => [] ,
                // 'like' => [
                //     [
                //         'field' => 'number' ,
                //         'value' => $search === false ? "" : $search
                //     ],
                //     [
                //         'field' => 'title' ,
                //         'value' => $search === false ? "" : $search
                //     ],
                //     [
                //         'field' => 'meaning' ,
                //         'value' => $search === false ? "" : $search
                //     ]
                // ] ,
            ] ,
            // "pivots" => [
            //     // $unit ?
            //     // [
            //     //     "relationship" => 'units',
            //     //     "where" => [
            //     //         "in" => [
            //     //             "field" => "id",
            //     //             "value" => [$request->unit]
            //     //         ],
            //     //     // "not"=> [
            //     //     //     [
            //     //     //         "field" => 'fieldName' ,
            //     //     //         "value"=> 'value'
            //     //     //     ]
            //     //     // ],
            //     //     // "like"=>  [
            //     //     //     [
            //     //     //        "field"=> 'fieldName' ,
            //     //     //        "value"=> 'value'
            //     //     //     ]
            //     //     // ]
            //     //     ]
            //     // ]
            //     // : []
            // ],
            "pagination" => [
                'perPage' => $perPage,
                'page' => $page
            ],
            "search" => $search === false ? [] : [
                'value' => $search ,
                'fields' => [
                    'number','title', 'meaning'
                ]
            ],
            "order" => [
                'field' => 'id' ,
                'by' => 'asc'
            ],
        ];

        $request->merge( $queryString );

        $crud = new CrudController(new RecordModel(), $request, ['id', 'number','title', 'meaning'
        , 'book_id' ,'kunty_id', 'matika_id', 'chapter_id' , 'part_id', 'section_id' , 'created_by' , 'updated_by'
         ]);
        $crud->setRelationshipFunctions([
            /** relationship name => [ array of fields name to be selected ] */
            "book" => ['id','title','description'] ,
            "kunty" => ['id', 'number', 'title'],
            "matika" => ['id', 'number', 'title'],
            "chapter" => ['id', 'number', 'title'],
            "part" => ['id', 'number', 'title'],
            "section" => ['id', 'number', 'title'],
            'author' => ['id', 'firstname', 'lastname' ,'username'] ,
            'editor' => ['id', 'firstname', 'lastname', 'username']
        ]);
        $builder = $crud->getListBuilder();
        
        /** Filter by archive id */
        // if( $request->regulator_id > 0 ){
        //     $builder = $builder->where('regulator_id',$request->regulator_id);
        // }

        /** Filter the record by the user role */
        // if( ( $user = $request->user() ) !== null ){
            /** In case user is the administrator, all archives will show up */
            // if( array_intersect( $user->roles()->pluck('id')->toArray() , [2,3,4] ) ){
                /** In case user is the super, auditor, member then the archives will show up if only that archives are own by them */
                // $builder->where('created_by',$user->id);
            // }else{
                /** In case user is the customer */
                /** Filter archives by its type before showing to customer */
        //     }
        // }

        $responseData = $crud->pagination(true, $builder,[
            'meaning' => function($meaning){
                return html_entity_decode( strip_tags( $meaning ) );
            } ,
            'title' => function($title){
                return html_entity_decode( strip_tags( $title ) );
            }
        ]);
        $responseData['message'] = __("crud.read.success");
        $responseData['ok'] = true;
        return response()->json($responseData);
    }
    /** Updating the archive */
    public function read(Request $request)
    {
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'regulator_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
            if (($record = $crud->read()) !== false) {
                $record = $crud->formatRecord($record);
                return response()->json([
                    'record' => $record,
                    'ok' => true ,
                    'message' => __("crud.read.success")
                ]);
            }
            return response()->json([
                'ok' => false ,
                'message' => __("crud.read.failed")
            ]);
        }
        return response()->json([
            'ok' => false ,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Check duplicate archive */
    public function exists(Request $request){
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'regulator_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
            if ( ($record = $crud->exists(['fid','year'],true)) !== false) {
                $record = $crud->formatRecord($record);
                return response()->json([
                    'record' => $record,
                    'ok' => true ,
                    'message' => __("crud.duplicate.no")
                ]);
            }
            return response()->json([
                'ok' => false ,
                'message' => __("crud.duplicate.yes")
            ]);
        }
        return response()->json([
            'ok' => false ,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Mini display */
    public function compactList(Request $request)
    {
        /** Format from query string */
        $search = isset( $request->search ) && $request->serach !== "" ? $request->search : false ;
        $queryString = [
            "search" => $search === false ? [] : [
                'value' => $search ,
                'fields' => [
                    'number','title'
                ]
            ],
            "order" => [
                'field' => 'title' ,
                'by' => 'asc'
            ],
        ];
        $request->merge( $queryString );
        $crud = new CrudController(new RecordModel(), $request, ['id', 'number','title']);
        $responseData['records'] = $crud->getListBuilder()->get();
        $responseData['message'] = __("crud.read.success");
        $responseData['ok'] = true;
        return response()->json($responseData);
    }
}
