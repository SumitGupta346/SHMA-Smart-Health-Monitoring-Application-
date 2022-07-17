<?php

namespace App\Http\Controllers\Api\V1;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\FoodIntake;
use App\WaterIntake;
use App\SleepHours;
use App\BMI;
use App\Department;
use App\Disease;
use App\Doctor;

class HealthMonitorController extends Controller
{
    public function get_foods(Request $request)
    {
        $foods = DB::table('foods')->where('id','<=',10)->get();
        $data = array(
            "foods" => $foods,

        );
        return response()->json([
            'message'  => 'Food Details',
            'data' => $data
        ], 200);
    }

    public function predict_disease(Request $request)
    {
        $predictions = array();
        $symptoms = $request['symptoms'];
        foreach($symptoms as $symptom){
            //echo $symptom."\n";
            $disases = DB::table('symptoms')->where('symptoms_name','like',$symptom)->get();
            foreach($disases as $disase){
                $d = DB::table('diseases')->where('id',$disase->id)->get();
                if(isset($d[0])) {
                   // print_r($predictions);

                  if(key_exists($disase->disease_id,$predictions)){


                    $predictions[$disase->disease_id]['count'] = $predictions[$disase->disease_id]['count'] + 1;
                    if($predictions[$disase->disease_id]['count'] >= 3)
                    $predictions[$disase->disease_id]['prob'] = 'High Probability';

                  }
                  else{

                    $predictions[$disase->disease_id]=array();
                    $predictions[$disase->disease_id]['count'] = 1;
                    $predictions[$disase->disease_id]['disease_name'] = $d[0]->disease_name;
                    $predictions[$disase->disease_id]['prob'] = 'Low Probability';
            }
            }


            }
        }
        return response()->json([
            'message'  => 'Disease Details',
            'data' => $predictions
        ], 200);
    }

    public function save_feedback(Request $request){
        $validator = Validator::make($request->all(), [
            'feedback_message' => 'required',
        ]);
        $feedback = array(
            "feedback_message" => $request->feedback_message,
            "feedback_date" => date('Y-m-d'),
            "user_id" => $request->user()->id
        );
        DB::table('feedback')->insert($feedback);
        return response()->json([
            'message'  => 'Feedback Sent successfully!',
            //'user' => $request->user()->id,
        ], 200);
    }

    public function save_food_intake(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'food' => 'required',
            'calorie' => 'required',
            'fat' => 'required'
        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        try {
            $food_intake = [
                'user_id' => $request->user()->id,
                'food'    => $request['food'],
                'calorie' => $request['calorie'],
                'fat'     => $request['fat'],
                'created_at'   => date('Y-m-d')
            ];
            DB::table('food_intakes')->insert($food_intake);
            return response()->json([
                'message'  => 'Food intake added successfully!',
                //'user' => $request->user()->id,
            ], 200);

            /*Mail::to($email)->send(new \App\Mail\OrderPlaced($o_id));*/
        } catch (\Exception $e) {
            return response()->json([$e->getMessage(), 'Error'], 403);
        }
    }

    public function save_water_intake(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'water_intake' => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        try {
            $water_intake = [
                'user_id'                => $request->user()->id,
                'water_intake'          => $request['water_intake'],
                'created_at'   => date('Y-m-d')

            ];
            DB::table('water_intakes')->insert($water_intake);
            return response()->json([
                'message'  => 'Water intake added successfully!',
            ], 200);

            /*Mail::to($email)->send(new \App\Mail\OrderPlaced($o_id));*/
        } catch (\Exception $e) {
            return response()->json([$e], 403);
        }
    }

    public function save_sleep_hours(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'sleep_hours' => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        try {
            $sleep_hours = [
                'user_id'      => $request->user()->id,
                'sleep_hours'  => $request['sleep_hours'],
                'created_at'   => date('Y-m-d')

            ];
            DB::table('sleep_hours')->insert($sleep_hours);
            return response()->json([
                'message'  => 'Sleeping Hours updated successfully!',
            ], 200);

            /*Mail::to($email)->send(new \App\Mail\OrderPlaced($o_id));*/
        } catch (\Exception $e) {
            return response()->json([$e], 403);
        }
    }

    public function get_departments(Request $request){
        $departments =  Department::all();
        $data = array(
            "departments" => $departments,

        );
        return response()->json([
            'message'  => 'Department Details',
            'data' => $data
        ], 200);

    }

    public function get_doctors(Request $request){
        $doctors =  DB::table('users')->where('role_id',1)->get();
        $data = array(
            "doctors" => $doctors,

        );
        return response()->json([
            'message'  => 'Doctor Details',
            'data' => $data
        ], 200);

    }

    public function vital_details(Request $request)
    {
        
        $bmi =  DB::table('bmi')->where('user_id',$request->user()->id)->latest('id')->first();
        $bmi_index = $bmi->bmi;
        $height = $bmi->height;
        $weight = $bmi->weight;
        $shours = DB::table('sleep_hours')->where('user_id',$request->user()->id)->where('created_at','like',date('Y-m-d')."%")->sum('sleep_hours');
        $water_intake1 = DB::table('water_intakes')->where('user_id',$request->user()->id)->where('created_at','like',date('Y-m-d')."%")->sum('water_intake');
        $total_cal = (int) DB::table('food_intakes')->where('user_id',$request->user()->id)->where('created_at','like',date('Y-m-d')."%")->sum('calorie');
        $total_fat = (int)DB::table('food_intakes')->where('user_id',$request->user()->id)->where('created_at','like',date('Y-m-d')."%")->sum('fat');
        $output = "";

        $output = "";
        if ($bmi_index <= 18.5) {
            $output = "UNDERWEIGHT";
        } else if ($bmi_index > 18.5 && $bmi_index <= 24.9) {
            $output = "NORMAL WEIGHT";
        } else if ($bmi_index > 24.9 && $bmi_index <= 29.9) {
            $output = "OVERWEIGHT";
        } else if ($bmi_index > 30.0) {
            $output = "OBESE";
        }
        $data = array(
            "height" => $height,
            "weight" => $weight,
            "bmi" => $bmi_index,
            "bmi_result" => $output,
            "sleep_hours" =>(int) $shours,
            "water_intake" => (int)$water_intake1,
            "cal" => (int)$total_cal,
            "fat" => (int)$total_fat,
        );
        return response()->json([
            'message'  => 'Vital Details',
            'data' => $data
        ], 200);
    }

    public function vital_details1()
    {

        $bmi =  DB::table('bmi')->where('user_id',2)->get();
        $bmi_index = $bmi[0]->bmi;
        $height = $bmi[0]->height;
        $weight = $bmi[0]->weight;
        $shours = DB::table('sleep_hours')->where('user_id',2)->where('created_at','like',date('Y-m-d')."%")->sum('sleep_hours');
        $water_intake1 = DB::table('water_intakes')->where('user_id',2)->where('created_at','like',date('Y-m-d')."%")->sum('water_intake');
        $total_cal = (int) DB::table('food_intakes')->where('user_id',2)->where('created_at','like',date('Y-m-d')."%")->sum('calorie');
        $total_fat = (int)DB::table('food_intakes')->where('user_id',2)->where('created_at','like',date('Y-m-d')."%")->sum('fat');
        $output = "";
        $bmi = $weight / ($height * $height);
        $output = "";
        if ($bmi <= 18.5) {
            $output = "UNDERWEIGHT";
        } else if ($bmi > 18.5 && $bmi <= 24.9) {
            $output = "NORMAL WEIGHT";
        } else if ($bmi > 24.9 && $bmi <= 29.9) {
            $output = "OVERWEIGHT";
        } else if ($bmi > 30.0) {
            $output = "OBESE";
        }
        $data = array(
            "height" => $height,
            "weight" => $weight,
            "bmi" => $bmi_index,
            "bmi_result" => $output,
            "sleep_hours" => $shours,
            "water_intake" => $water_intake1,
            "cal" => $total_cal,
            "fat" => $total_fat,
        );
        return response()->json([
            'message'  => 'Vital Details',
            'data' => $data
        ], 200);
    }

    public function save_bmi(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'height' => 'required',
            'weight' => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        try {
            $mass = $request['weight'];
            $height = $request['height'];
            $bmi = ($mass / ($height * $height)) * 100 * 100;
            $output = "";

            $bmi = [
                'user_id'                => $request->user()->id,
                'height'          => $request['height'],
                'weight'          => $request['weight'],
                'bmi'          => $bmi,
                'created_at'   => date('Y-m-d')

            ];
            DB::table('bmi')->insert($bmi);
            return response()->json([
                'message'  => 'BMI updated successfully!',
            ], 200);

            /*Mail::to($email)->send(new \App\Mail\OrderPlaced($o_id));*/
        } catch (\Exception $e) {
            return response()->json([$e], 403);
        }
    }
}
