<?php

namespace App\Http\Controllers\Api\Mobile\Archive;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Archive\Matra AS RecordModel;
use Illuminate\Http\File;
use App\Http\Controllers\CrudController;

class MatraController extends Controller
{
    /** Get a list of Archives */
    public function index(Request $request){
        $crud = new CrudController(new RecordModel(), $request, ['id', 'number','title', 'meaning', 'archive_id' ,'kunty_id', 'matika_id', 'chapter_id' , 'part_id', 'section_id' , 'created_by' , 'updated_by' ]);
        // $crud->setRelationshipFunctions([
        //     /** relationship name => [ array of fields name to be selected ] */
        //     "archive" => ['id','number','title','objective','year'] ,
        //     "kunty" => ['id', 'number', 'title'],
        //     "matika" => ['id', 'number', 'title'],
        //     "chapter" => ['id', 'number', 'title'],
        //     "part" => ['id', 'number', 'title'],
        //     "section" => ['id', 'number', 'title'],
        //     'author' => ['id', 'firstname', 'lastname' ,'username'] ,
        //     'editor' => ['id', 'firstname', 'lastname', 'username']
        // ]);
        $builder = $crud->getListBuilder();
        
        /** Filter by archive id */
        if( $request->archive_id > 0 ){
            $builder = $builder->where('archive_id',$request->archive_id);
        }

        /** Filter the record by the user role */
        if( ( $user = $request->user() ) !== null ){
            /** In case user is the administrator, all archives will show up */
            if( array_intersect( $user->roles()->pluck('id')->toArray() , [2,3,4] ) ){
                /** In case user is the super, auditor, member then the archives will show up if only that archives are own by them */
                $builder->where('created_by',$user->id);
            }else{
                /** In case user is the customer */
                /** Filter archives by its type before showing to customer */
            }
        }

        $responseData = $crud->pagination(true, $builder);
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
    /** Create a new Archive */
    public function store(Request $request){
        if( ($user = $request->user() ) !== null ){
            /** Merge variable created_by and updated_by into request */
            $input = $request->input();
            $input['created_at'] = $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $input['created_by'] = $input['updated_by'] = $user->id;
            $request->merge($input);
            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'archive_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
            if (($record = $crud->create()) !== false) {
                $record = $crud->formatRecord($record);
                return response()->json([
                    'record' => $record,
                    'message' => __("crud.save.success")
                ], 200);
            }
            return response()->json([
                'record' => null,
                'message' => __("crud.save.failed")
            ], 201);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
        
    }
    /** Updating the archive */
    public function update(Request $request)
    {
        if (($user = $request->user()) !== null) {
            /** Merge variable created_by and updated_by into request */
            $input = $request->input();
            $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            $request->merge($input);

            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'archive_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
            if ($crud->update() !== false) {
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
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Updating the archive */
    public function read(Request $request)
    {
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'archive_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
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
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Reading an archive */
    public function delete(Request $request)
    {
        if (($user = $request->user()) !== null) {
            /** Merge variable created_by and updated_by into request */
            $input = $this->request->input();
            $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            $request->merge($input);

            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'archive_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
            if (($record = $crud->delete()) !== false) {
                return response()->json([
                    'record' => $record,
                    'message' => __("crud.delete.success")
                ], 200);
            }
            return response()->json([
                'record' => null,
                'message' => __("crud.delete.failed")
            ], 201);
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Check duplicate archive */
    public function exists(Request $request){
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'archive_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
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
            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'archive_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
            if ($crud->booleanField('active', 1)) {
                $record = $crud->formatRecord($record = $crud->read());
                return response(
                    [
                        'record' => $record,
                        'message' => 'Activated !'
                    ],
                    200
                );
            } else {
                return response(
                    [
                        'record' => null,
                        'message' => 'There is not record matched !'
                    ],
                    350
                );
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
            $crud = new CrudController(new RecordModel(), $request, ['id', 'aid', 'title', 'meaning', 'archive_id', 'archive', 'kunty_id', 'kunty', 'matika_id', 'matika', 'chapter_id', 'chapter', 'part_id', 'part', 'section_id', 'section', 'created_by', 'author', 'updated_by', 'editor']);
            if ( $crud->booleanField('active', 0) ) {
                $record = $crud->formatRecord($record = $crud->read());
                // User does exists
                return response(
                    [
                        'record' => $record,
                        'message' => 'Deactivated !'
                    ],
                    200
                );
            } else {
                return response(
                    [
                        'record' => null,
                        'message' => 'There is not record matched !'
                    ],
                    350
                );
            }
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.auth.failed")
        ], 401);
    }
    /** Mini display */
    public function forFilter(Request $request)
    {
        $crud = new CrudController(new RecordModel(), $request, ['id', 'number','title']);
        $responseData['records'] = $crud->forFilter();
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
}
