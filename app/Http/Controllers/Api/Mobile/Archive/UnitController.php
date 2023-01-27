<?php

namespace App\Http\Controllers\Api\Mobile\Archive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive\Unit AS RecordModel;
use App\Http\Controllers\CrudController;

class UnitController extends Controller
{
    /** Get a list of archive units */
    public function index(Request $request){
        /** Format from query string */
        $search = isset( $request->search ) && $request->serach !== "" ? $request->search : false ;
        $number = isset( $request->number ) && $request->number !== "" ? $request->number : false ;
        $type = isset( $request->type ) && $request->type !== "" ? $request->type : false ;
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
            "pivot" => [],
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
        
        $crud = new CrudController(new RecordModel(), $request, ['id', 'name']);
        $builder = $crud->getListBuilder();
        $responseData = $crud->pagination(true, $builder);
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
}
