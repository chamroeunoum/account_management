<?php

namespace App\Http\Controllers\Api\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News as RecordModel;
use App\Http\Controllers\CrudController;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** Get a list of Archives */
    public function index(Request $request){
        $crud = new CrudController(new RecordModel(), $request, ['id', 'content','start_date', 'end_date','updated_at','created_at']);
        $crud->setRelationshipFunctions([]);
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

        $responseData = $crud->pagination(true, $builder);
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);
        $new = RecordModel::create(['content'=>$request->content]);
        $responseData['message'] = __("crud.read.fail");
        $status = 404;
        if($new){
            $responseData['message'] = __("crud.read.success");
            $status = 200;
            $client = new \GuzzleHttp\Client();
            $res = $client->request('POST', 'https://fcm.googleapis.com/fcm/send',
            [
                'headers' => [
                    'Accept'     => 'application/json',
                    'Authorization'=>"key=".env('FCM_SERVER_KEY')
                ],
                'json'    => [
                    'notification' => [
                        'body' =>$new->content,
                        "title" => "New document",
                        "sound" => "default"
                    ],
                    "to"=>"/topic/news"
                ]
            ]);
        }
        return response()->json($responseData, $status);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        if (($user = $request->user()) !== null) {
            $crud = new CrudController(new RecordModel(), $request, ['id', 'content']);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $new = RecordModel::find($id);
        if($new){
            $new->content = $request->content;
            $new->save();
            if($new){
                return response()->json([
                    'record' => $new,
                    'message' => __("crud.update.success")
                ], 200);
            }
        }
        return response()->json([
            'record' => null,
            'message' => __("crud.update.failed")
        ], 404);
    }
    /** Reading an archive */
    public function delete(Request $request)
    {
        if (($user = $request->user()) !== null) {
            /** Merge variable created_by and updated_by into request */
            $input = $request->input();
            $input['updated_at'] = \Carbon\Carbon::now()->format('Y-m-d H:i:s');
            $input['updated_by'] = $user->id;
            $request->merge($input);

            $crud = new CrudController(new RecordModel(), $request, ['id', 'number','type_id', 'active', 'title', 'objective', 'year', 'pdfs','created_at','updated_at','created_by','updated_by']);
            if (($record = $crud->delete()) !== false) {
                /** Delete its structure and matras too */
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
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = RecordModel::find($id);
        if($record) {
            $record->delete();
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
}
