<?php

namespace App\Http\Controllers\Api\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Feedback;

class FeedbackController extends Controller
{
    public function send(Request $request){
        $result = Mail::to($request->email)->send(
            new Feedback($request)
        );
        return response()->json([
            'record' => $result ,
            'message' => 'Feedback has sent.'
        ],200);
    }
}
