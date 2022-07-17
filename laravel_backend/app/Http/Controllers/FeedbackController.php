<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\User;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    //
    public function patient_feedbacks(Request $request){
        $user_ids = User::where('role_id',3)->pluck('id')->toArray();
        $feedbacks = Feedback::whereIn('user_id',$user_ids)->get();
        return view('admin.patient_feedbacks',compact('feedbacks'));
    }

    public function doctor_feedbacks(Request $request){
        $user_ids = User::where('role_id',1)->pluck('id')->toArray();
        $feedbacks = Feedback::whereIn('user_id',$user_ids)->get();
        return view('admin.doctor_feedbacks',compact('feedbacks'));
    }
}
