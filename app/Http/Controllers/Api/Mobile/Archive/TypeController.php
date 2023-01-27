<?php

namespace App\Http\Controllers\Api\Mobile\Archive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive\ArchiveType AS RecordModel;
use Illuminate\Http\File;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\CrudController;

class TypeController extends Controller
{
    /** Get a list of archive types */
    public function index(Request $request){
        $crud = new CrudController(new RecordModel(), $request, ['id', 'format', 'name']);
        $builder = $crud->getListBuilder()->where('active',1)->has('regulators','>',0);
        // $responseData = $crud->pagination(true, $builder);
        $responseData['records'] = $builder->get()->map(function($record) use( $crud, $request ) {
            return [
                'id' => $record->id ,
                'name' => $record->name ,
                'format' => $record->format
            ];
        });
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
    public function searchArchivesWithTypes(Request $request){
        $crud = new CrudController(new RecordModel(), $request, ['id', 'format', 'name']);
        $builder = $crud->getListBuilder()->whereHas('regulators',function($query) use ($request) {
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
                        'name'
                    ]
                ],
                "order" => [
                    'field' => 'id' ,
                    'by' => 'DESC'
                ],
            ];

            $request->merge( $queryString );
            $crud = new CrudController();
            $builder = $crud->getListBuilder($query,$request,["id","number"])->where('active',1);
            return $builder->get()->count() > 0 ? true : false ;
        });
        $responseData['records'] = $builder->get()->map(function($record) use( $crud, $request ) {
            return [
                'id' => $record->id ,
                'name' => $record->name ,
                'format' => $record->format
            ];
        });
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
}
