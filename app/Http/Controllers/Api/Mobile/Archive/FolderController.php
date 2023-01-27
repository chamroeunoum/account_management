<?php

namespace App\Http\Controllers\Api\Mobile\Archive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive\Folder AS RecordModel;
use Illuminate\Http\File;
use App\Http\Controllers\CrudController;

class FolderController extends Controller
{
    /** Get a list of Archives */
    public function index(Request $request){
        $crud = new CrudController(new RecordModel(), $request, ['id', 'name', 'user_id', 'created_at', 'updated_at']);
        $crud->setRelationshipFunctions([
            'owner' => [ 'id' , 'lastname' , 'firstname' ]
        ]);
        $builder = $crud->getListBuilder()->withCount([
            'archives as document_counts'
        ])->where('user_id',\Auth::id());
        $responseData = $crud->pagination(true, $builder);
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
    /** Create a new Archive */
    public function create(Request $request){
        $user = null ;
        if (($user = $request->user()) === null){
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        /** Merge variable created_by and updated_by into request */
        $input = $request->input();
        $input['created_at'] = $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $input['user_id'] = $user->id ;
        $request->merge($input);
        $crud = new CrudController(new RecordModel(), $request, ['id', 'name', 'created_at', 'updated_at']);
        $crud->setRelationshipFunctions([
            'owner' => [ 'id' , 'lastname' , 'firstname' ]
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
    /** Updating the archive */
    public function update(Request $request)
    {
        $user = null ;
        if (($user = $request->user()) === null){
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        /** Merge variable created_by and updated_by into request */
        $input = $request->input();
        $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $request->merge($input);
        $crud = new CrudController(new RecordModel(), $request, ['id', 'name' ,'updated_at']);
        $crud->setRelationshipFunctions([
            'owner' => [ 'id' , 'lastname' , 'firstname' ]
        ]);
        if (($record = $crud->update()) !== false) {
            $record = $crud->formatRecord($crud->read());
            return response()->json([
                'record' => $record,
                'message' => __("crud.update.success")
            ], 200);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.update.failed")
        ], 201);
    }
    /** Updating the archive */
    public function read(Request $request)
    {
        $user = null ;
        if (($user = $request->user()) === null){
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        $crud = new CrudController(new RecordModel(), $request, ['id', 'name', 'created_at', 'updated_at']);
        $crud->setRelationshipFunctions([
            'owner' => [ 'id' , 'lastname' , 'firstname' ]
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
    /** Reading an archive */
    public function delete(Request $request,$id)
    {
        $user = null ;
        if (($user = $request->user()) === null){
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        /** Merge variable created_by and updated_by into request */
        $input['id'] = $id;
        $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
        $request->merge($input);
        $crud = new CrudController(new RecordModel(), $request, ['id', 'format', 'name', 'order', 'created_at', 'updated_at']);
        if (($record = $crud->delete()) !== false) {
            /** Delete the matra(s) within this folder too */
            /** Code here */
            return response()->json([
                'record' => $record,
                'message' => __("crud.delete.success")
            ], 200);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.delete.failed")
        ], 404);
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
        $crud = new CrudController(new RecordModel(), $request, ['id', 'name', 'user_id', 'created_at', 'updated_at']);
        if ( ($record = $crud->exists(['name','user_id'],true)) !== false) {
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
    public function forfilter(Request $request){
        $user = null ;
        if (($user = $request->user()) === null){
            return response()->json([
                'record' => null,
                'message' => __("crud.auth.failed")
            ], 401);
        }
        /** Merge variable created_by and updated_by into request */
        $crud = new CrudController(new RecordModel(), $request, ['id', 'name', 'user_id', 'created_at', 'updated_at']);
        $crud->setRelationshipFunctions([
            'owner' => [ 'id' , 'lastname' , 'firstname' ]
        ]);
        if (($record = $crud->getListBuilder()->where('active',1)->orderby('order','asc')->get()) !== false) {
            return response()->json([
                'records' => $record,
                'message' => __("crud.read.success")
            ], 200);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.read.failed")
        ], 201);
    }
    public function getFolderWithDocument(Request $request,$id){
        $crud = new CrudController(new RecordModel(), $request, ['id','name']);
        $crud->setRelationshipFunctions();
        $builder = $crud->getListBuilder()->where('user_id',\Auth::id())->withCount([
            'archives as document_counts',
            'archives as already_in_folder' => function($q) use($id){
                $q->where('archive_id',$id);
            }
        ]);
        $responseData = $crud->pagination(true, $builder);
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
}
