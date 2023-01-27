<?php

namespace App\Http\Controllers\Api\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Subscription as RecordModel;
use App\Http\Controllers\CrudController;
class SubscriptionController extends Controller
{
    public function getUserSubscription(Request $request){
        $active = false;
        $endDate = null;
        $subscription = RecordModel::where('user_id',\Auth::id())->whereRaw("now() BETWEEN start_date AND end_date")->first();
        if($subscription){
            $active = true;
            $endDate = $subscription->end_date?$subscription->end_date->format('Y-m-d H:i:s'):null;
        }
        return response()->json([
            'active' => $active,
            'end_date' => $endDate
        ], 200);
    }
    public function getUserSubscriptions(Request $request){
        $crud = new CrudController(new RecordModel(), $request, ['id','amount','start_date','user_id', 'end_date','updated_at','created_at']);
        $crud->setRelationshipFunctions([
            "user" => ['id','username'],
        ]);
        $builder = $crud->getListBuilder();
        $responseData = $crud->pagination(true, $builder);
        $records = $responseData['records']->map(function($q){
            $q['start_date'] = $q['start_date']?$q['start_date']->format('Y-m-d H:i:s'):'';
            $q['end_date'] = $q['end_date']?$q['end_date']->format('Y-m-d H:i:s'):'';
            $q['created_at'] = $q['created_at']?$q['created_at']->format('Y-m-d H:i:s'):'';
            $q['updated_at'] = $q['updated_at']?$q['updated_at']->format('Y-m-d H:i:s'):'';
            return $q;
        });
        $responseData['records'] = $records;
        $responseData['message'] = __("crud.read.success");
        return response()->json($responseData, 200);
    }
}
