<?php
namespace App\Http\Controllers\Api\Mobile\Archive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive\Archive AS RecordModel;
use Illuminate\Http\File;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\DB;

class ArchiveController extends Controller
{
    /** Get a list of Archives */
    public function index(Request $request){
        /** Format from query string */
        $search = isset( $request->search ) && $request->serach !== "" ? $request->search : false ;
        $number = isset( $request->number ) && $request->number !== "" ? $request->number : false ;
        $type = isset( $request->type ) && $request->type !== "" ? $request->type : false ;
        $unit = isset( $request->unit ) && $request->unit !== "" ? $request->unit : false ;
        $date = isset( $request->date ) && $request->date !== "" ? $request->date : false ;
        $perPage = isset( $request->perPage ) && $request->perPage !== "" ? $request->perPage : 10 ;
        $page = isset( $request->page ) && $request->page !== "" ? $request->page : 1 ;


        $queryString = [
            "where" => [
                'default' => [
                    [
                        'field' => 'type_id' ,
                        'value' => $type === false ? "" : $type
                    ]
                ],
                'in' => [] ,
                'not' => [] ,
                'like' => [
                    [
                        'field' => 'number' ,
                        'value' => $number === false ? "" : $number
                    ],
                    [
                        'field' => 'year' ,
                        'value' => $date === false ? "" : $date
                    ]
                ] ,
            ] ,
            "pivots" => [
                $unit ?
                [
                    "relationship" => 'units',
                    "where" => [
                        "in" => [
                            "field" => "id",
                            "value" => [$request->unit]
                        ],
                    // "not"=> [
                    //     [
                    //         "field" => 'fieldName' ,
                    //         "value"=> 'value'
                    //     ]
                    // ],
                    // "like"=>  [
                    //     [
                    //        "field"=> 'fieldName' ,
                    //        "value"=> 'value'
                    //     ]
                    // ]
                    ]
                ]
                : []
            ],
            "pagination" => [
                'perPage' => $perPage,
                'page' => $page
            ],
            "search" => $search === false ? [] : [
                'value' => $search ,
                'fields' => [
                    'title', 'objective'
                ]
            ],
            "order" => [
                'field' => 'year' ,
                'by' => 'desc'
            ],
        ];

        $request->merge( $queryString );

        $crud = new CrudController(new RecordModel(), $request, ['id', 'number', 'title', 'objective', 'year','pdfs','type_id','pdf_exists']);
        $crud->setRelationshipFunctions([
            /** relationship name => [ array of fields name to be selected ] */
            "type" => ['id','name','format'] ,
            "units" => ['id','name']
        ]);
        $builder = $crud->getListBuilder()->where('active',1)->where('pdf_exists',1);

        $responseData = $crud->pagination(true, $builder);
        foreach($responseData['records'] AS $index => $record ){
            $record['objective'] = strip_tags($record['objective']);
            $responseData['records'][$index] = $record ;
        }
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
    /** Get a list of Archives */
    public function search(Request $request){
        /** Format from query string */
        $search = isset( $request->search ) && $request->serach !== "" ? $request->search : false ;
        $number = isset( $request->number ) && $request->number !== "" ? $request->number : false ;
        $type = isset( $request->type ) && $request->type !== "" ? $request->type : false ;
        $unit = isset( $request->unit ) && $request->unit !== "" ? $request->unit : false ;
        $date = isset( $request->date ) && $request->date !== "" ? $request->date : false ;
        $perPage = isset( $request->perPage ) && $request->perPage !== "" ? $request->perPage : 10 ;
        $page = isset( $request->page ) && $request->page !== "" ? $request->page : 1 ;


        $queryString = [
            "where" => [
                'default' => [
                    [
                        'field' => 'type_id' ,
                        'value' => $type === false ? "" : $type
                    ]
                ],
                'in' => [] ,
                'not' => [] ,
                'like' => [
                    [
                        'field' => 'number' ,
                        'value' => $number === false ? "" : $number
                    ],
                    [
                        'field' => 'year' ,
                        'value' => $date === false ? "" : $date
                    ]
                ] ,
            ] ,
            "pivots" => [
                $unit ?
                [
                    "relationship" => 'units',
                    "where" => [
                        "in" => [
                            "field" => "unit_id",
                            "value" => [$request->unit]
                        ]
                    ]
                ]
                : []
            ],
            "pagination" => [
                'perPage' => $perPage,
                'page' => $page
            ],
            "search" => $search === false ? [] : [
                'value' => $search ,
                'fields' => [
                    'title', 'objective'
                ]
            ],
            "order" => [
                'field' => 'id' ,
                'by' => 'DESC'
            ],
        ];

        $request->merge( $queryString );
        $crud = new CrudController(new RecordModel(), $request, ['type_id']);
        $builder = $crud->getListBuilder()->where('active',1)->select('type_id',DB::raw('count(id) as total'));
        $responseData['records'] = $builder->groupBy("type_id")->get()
            ->map(function($record){
            return [
                'id' => $record->type_id ,
                'name' => ( $type = \App\Models\Archive\ArchiveType::find($record->type_id) ) ? $type->name : 'Unknowned' ,
                'total' => $record->total
            ];
            })
            ;

        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
    /** Updating the archive */
    public function read(Request $request)
    {
        $crud = new CrudController(new RecordModel(), $request, ['id', 'number','type_id', 'active', 'title', 'objective', 'year']);
        $crud->setRelationshipFunctions([
            "units" => false ,
            "createdBy" => ['id','firstname','lastname'],
            "updatedBy" => ['id','firstname','lastname']
        ]);
        if (($record = $crud->read()) !== false) {
            $record = $crud->formatRecord($record);
            return response()->json([
                'record' => $record,
                'message' => __("crud.read.success")
            ], 200);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.read.failed")
        ], 201);
    }

    /** Check duplicate archive */
    public function exists(Request $request){
        if (($user = $request->user()) === null) {
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        $crud = new CrudController(new RecordModel(), $request, ['id', 'number','type_id', 'active', 'title', 'objective', 'year', 'pdfs','created_at','updated_at','created_by','updated_by']);
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

    /** Mini display */
    public function forFilter(Request $request)
    {
        $crud = new CrudController(new RecordModel(), $request, ['id', 'number', 'objective' , 'year']);
        $responseData['records'] = $crud->getListBuilder()->where('active', 1)->limit(10)->get();;
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
    /** Updating the archive */
    public function readOffline(Request $request)
    {
        if (($user = $request->user()) === null) {
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        $crud = new CrudController(new RecordModel(), $request, ['id', 'number','type_id', 'active', 'title', 'objective', 'year', 'pdfs']);
        $crud->setRelationshipFunctions([
            "units" => false ,
            "createdBy" => ['id','firstname','lastname'],
            "updatedBy" => ['id','firstname','lastname']
        ]);
        if (($record = $crud->read()) !== false) {
            $record = $crud->formatRecord($record);
            return response()->json([
                'record' => $record,
                'message' => __("crud.read.success")
            ], 200);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.read.failed")
        ], 201);
    }
}