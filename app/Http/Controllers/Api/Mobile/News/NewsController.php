<?php

namespace App\Http\Controllers\Api\Mobile\News;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Http\Controllers\CrudController;
use Carbon\Carbon;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /** Get a list of Archives */
    public function index(Request $request){
        /** Format from query string */
        $perPage = isset( $request->perPage ) && $request->perPage !== "" ? $request->perPage : 10 ;
        $page = isset( $request->page ) && $request->page !== "" ? $request->page : 1 ;
        $queryString = [
            "pagination" => [
                'perPage' => $perPage,
                'page' => $page
            ],
            "order" => [
                'field' => 'id' ,
                'by' => 'desc'
            ],
        ];
        $request->merge( $queryString );
        $crud = new CrudController(new News(), $request, ['id', 'content','created_at']);
        $crud->setRelationshipFunctions([]);
        $builder = $crud->getListBuilder();
        $responseData = $crud->pagination(true, $builder);
        // $records = $responseData['records']->map(function($v){
        //     $i = $v;
        //     $i['created_at'] = $v['created_at']->format("Y-m-d H:i:s");
        //     return $i;
        // });
        // $responseData['records']= $records;
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
        $request->validate([
            'content' => 'required|string'
        ]);
        $new = News::create(['content'=>$request->content]);
        $responseData['message'] = __("crud.read.fail");
        $status = 404;
        if($new){
            $responseData['message'] = __("crud.read.success");
            $status = 200;
        }
        return response()->json($responseData, $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news =  News::select('id','content','created_at')->find($id);
        $status = 404;
        $smg = __("crud.read.failed");

        if($news){
            $status = 200;
            $news['created_at'] = $news->created_at->format('Y-m-d H:i:s');
            $responseData['records']= $news;
            $smg = __("crud.read.success");
        }
        $responseData['message'] = $smg;
        return response()->json($responseData, $status);
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
            $crud = new CrudController(new News(), $request, ['id', 'content']);
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
        $new = News::find($id);
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

            $crud = new CrudController(new News(), $request, ['id', 'number','type_id', 'active', 'title', 'objective', 'year', 'pdfs','created_at','updated_at','created_by','updated_by']);
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
        $record = News::find($id);
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
