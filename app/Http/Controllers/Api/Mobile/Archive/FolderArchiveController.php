<?php

namespace App\Http\Controllers\Api\Mobile\Archive;

use App\Http\Controllers\Controller;
use App\Http\Controllers\CrudController;
use App\Models\Archive\FolderArchive AS RecordModel;
use Illuminate\Http\Request;

class FolderArchiveController extends Controller
{
    public function archive(Request $request){
        $folder = \App\Models\Archive\Folder::with('regulators')->find($request->id);

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
                    // 'title', 'objective'
                ]
            ],
            "order" => [
                'field' => 'year' ,
                'by' => 'desc'
            ],
        ];

        $request->merge( $queryString );

        $crud = new CrudController(new \App\Models\Archive\Archive(), $request, ['id', 'number', 'title', 'objective', 'year','pdfs','type_id']);
        $crud->setRelationshipFunctions([
            /** relationship name => [ array of fields name to be selected ] */
            "type" => ['id','name','format'] ,
            "units" => ['id','name']
        ]);
        $builder = $crud->getListBuilder()->whereIn('id',$folder?$folder->archives->pluck('id')->toArray():[]);

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

        $responseData = $crud->pagination(true, $builder);
        $record =$responseData['records']->map(function($q){
            $q['objective'] = strip_tags($q['objective']);
            return $q;
        });
        $responseData['records'] = $record;
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);

    }
    /** Create a new Archive */
    public function addArchive(Request $request){
        $user = null ;
        if (($user = $request->user()) === null){
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }

        /** Check duplicate */
        if ( ($record = RecordModel::where('folder_id',$request->folder_id)->where('archive_id',$request->archive_id)->first() ) !== null ) {
            return response()->json([
                'record' => $record,
                'message' => __("crud.duplicate.no")
            ], 200);
        }

        /** Merge variable created_by and updated_by into request */
        $input = $request->input();
        $input['created_at'] = $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $request->merge($input);
        $crud = new CrudController(new RecordModel(), $request, ['folder_id','archive_id', 'created_at', 'updated_at']);
        $crud->setRelationshipFunctions([
            'archive' => [ 'id' , 'number' , 'title' , 'objective' ,'year' ] ,
            'folder' =>  [ 'id' , 'name' ]
        ]);
        if (($record = $crud->create()) !== false) {
            $record = $crud->formatRecord($record);
            return response()->json([
                'record' => $record,
                'message' => __("crud.save.success")
            ], 200);
        }
        return response()->json([
            'record' => $record,
            'message' => __("crud.save.failed")
        ], 200);
    }
    public function removeArchive(Request $request)
    {
        $user = null ;
        if (($user = $request->user()) === null){
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        /** Merge variable created_by and updated_by into request */

        if (($record = RecordModel::where('folder_id',$request->folder_id)->where('archive_id',$request->archive_id)->first() ) !== null ) {
            /** Delete the matra(s) within this folder too */
            $record = RecordModel::where('folder_id',$request->folder_id)->where('archive_id',$request->archive_id)->delete();
            /** Code here */
            return response()->json([
                'record' => $record ,
                'message' => __("crud.delete.success")
            ], 200);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.delete.failed")
        ], 201);
    }
    /** Check duplicate archive */
    public function exists(Request $request){
        $user = null ;
        if (($user = $request->user()) === null){
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        if ( ($record = RecordModel::where('folder_id',$request->folder_id)->where('archive_id',$request->archive_id)->first() ) !== null ) {
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
}
