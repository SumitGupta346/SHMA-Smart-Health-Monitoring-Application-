<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Time;
use App\User;
use App\Booking;
use App\Disease;
use App\Prescription;
use App\Symptom;

class FrontEndController extends Controller
{
    public function index(Request $request)
    {
        // Set timezone
        date_default_timezone_set('America/New_York');
        // If there is set date, find the doctors
          // Return all doctors avalable for today to the welcome page
        $doctors= [];
       // $doctors = Appointment::where('date', date('m-d-yy'))->get();
        return view('welcome', compact('doctors'));
    }


    public function treems(Request $request)
    {

        return view('treems');
    }

    public function get_symptoms1(Request $request)
    {
        $body_part = $request->body_part;
        $symptoms =[];
        if($body_part == "Eye"){
            $symptoms = Symptom::where('id','<=',10)->get();
        }
        else if($body_part == "Ear"){
            $symptoms = Symptom::whereIn('id',[311,108,302,121,309,35,61])->get();
        }else if($body_part == "Nose"){
            $symptoms = Symptom::whereIn('id',[141,149,157,164,168,183,174,179])->get();
        }else if($body_part == "Mouth"){
            $symptoms = Symptom::whereIn('id',[40,45,47,50,54,57,60])->get();
        }else if($body_part == "Neck"){
            $symptoms = Symptom::whereIn('id',[387,388,122,121,131,393,395])->get();
        }else if($body_part == "Chest"){
            $symptoms = Symptom::whereIn('id',[196,202,209,218,221,230,234])->get();
        }else if($body_part == "Abdomen"){
            $symptoms = Symptom::whereIn('id',[247,254,259,265,271,275])->get();
        }else if($body_part == "Pelvis"){
            $symptoms = Symptom::whereIn('id',[379,382,383,384,386])->get();
        }else if($body_part == "Pubis"){
            $symptoms = Symptom::whereIn('id',[120,369,370,247,372])->get();
        }else if($body_part == "Shoulder"){
            $symptoms = Symptom::whereIn('id',[294,300,301,299])->get();
        }else if($body_part == "Elbow"){
            $symptoms = Symptom::whereIn('id',[122,312,131,198,124,46])->get();
        }else if($body_part == "Forearm"){
            $symptoms = Symptom::whereIn('id',[120,315,131,122,319,321,313])->get();
        }else if($body_part == "Wrist"){
            $symptoms = Symptom::whereIn('id',[124,125,131,135,138])->get();
        }else if($body_part == "Hand"){
            $symptoms = Symptom::whereIn('id',[356,126,359,360,346])->get();
        }else if($body_part == "Head"){
            $symptoms = Symptom::whereIn('id',[64,75,66,67,68,87,92,97,99,95,42,113,115])->get();
        }else if($body_part == "Tigh"){
            $symptoms = Symptom::whereIn('id',[332,69,335,121,329,112,340,344])->get();
        }else if($body_part == "Knee"){
            $symptoms = Symptom::whereIn('id',[361,362,363,364,366,325])->get();
        }else if($body_part == "Arm"){
            $symptoms = Symptom::whereIn('id',[120,131,316,28,345,128])->get();
        }else if($body_part == "Ankle"){
            $symptoms = Symptom::whereIn('id',[130,321,349,351,72,131])->get();
        }else if($body_part == "Foot"){
            $symptoms = Symptom::whereIn('id',[322,120,69,325,327,207,330])->get();
        }

        return view('get_symptoms1',compact('body_part','symptoms'));
    }

    public function get_symptoms2(Request $request)
    {
        $body_part = $request->body_part;
        $symptoms =[];
        if($body_part == "Eye"){
            $ed[0]=0;
            $ed[1]=0;
            $ed[2]=0;
            $ed[3]=0;
            $ed[4]=0;
            $ed[5]=0;
            $ed[6]=0;
            $ed[7]=0;
            $ed[8]=0;
            $ed[9]=0;
               if(($_POST[1])=="Yes")
               {
                $ed[0]++;
               }
               if(($_POST[2])=="Yes")
               {
                $ed[1]++;
               }
               if(($_POST[3])=="Yes")
               {
                $ed[2]++;
               }
               if(($_POST[4])=="Yes")
               {
                $ed[3]++;
               }
               if(($_POST[5])=="Yes")
               {
                $ed[4]++;
               }
               if(($_POST[6])=="Yes")
               {
                $ed[5]++;
               }
               if(($_POST[7])=="Yes")
               {
                $ed[6]++;
               }
               if(($_POST[8])=="Yes")
               {
                $ed[7]++;
               }
               if(($_POST[9])=="Yes")
               {
                $ed[8]++;
               }
               if(($_POST[10])=="Yes")
               {
                $ed[9]++;
               }
            $symptoms = Symptom::whereIn('id',[11,18,20,22,28,30])->get();
            $neds = 10;
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }
        else if($body_part == "Ear"){
            $ed[0]=0;
            $ed[1]=0;
            $ed[2]=0;
            $ed[3]=0;
            $ed[4]=0;
            $ed[5]=0;
            $ed[6]=0;
            $ed[7]=0;

               if(($_POST[1])=="Yes")
               {
                $ed[5]++;
                $ed[6]++;
                $ed[7]++;
               }
               if(($_POST[2])=="Yes")
               {
                $ed[6]++;
                $ed[7]++;
               }
               if(($_POST[3])=="Yes")
               {
                $ed[0]++;
               }
               if(($_POST[4])=="Yes")
               {
                $ed[1]++;
               }
               if(($_POST[5])=="Yes")
               {
                $ed[2]++;
               }
               if(($_POST[6])=="Yes")
               {
                $ed[2]++;
                $ed[6]++;
               }
               if(($_POST[7])=="Yes")
               {
                $ed[3]++;
               }
               $neds = 8;
            $symptoms = Symptom::whereIn('id',[303,305,306,308,46,51])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Nose"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[7]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[3]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
    $ed[6]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[7]++;
   }
   if(($_POST[8])=="Yes")
   {
    $ed[7]++;
   }
   $neds = 8;
   $symptoms = Symptom::whereIn('id',[143,147,146,156,152,166,172,180])->get();
   return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Mouth"){
            $ed[11]=0;
$ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
   if(($_POST[1])=="Yes")
   {
    $ed[11]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;
    $ed[2]++;
    $ed[3]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[5]++;
   }
            $neds = 6;
            $symptoms = Symptom::whereIn('id',[41,46,48,53,62])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Neck"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;
$ed[8]=0;
$ed[9]=0;
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[2]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[4]++;
   }
            $neds = 10;
            $symptoms = Symptom::whereIn('id',[389,69,391,298,392,396])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Chest"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;
$ed[8]=0;
$ed[9]=0;
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[2]++;
    $ed[4]++;
    $ed[5]++;
    $ed[8]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[2]++;
    $ed[3]++;
    $ed[5]++;
    $ed[6]++;
    $ed[7]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
    $ed[2]++;
    $ed[7]++;
    $ed[8]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[5]++;
    $ed[6]++;
    $ed[7]++;
   }
   $neds = 10;
   $symptoms = Symptom::whereIn('id',[239,242,206,207])->get();
   return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Abdomen"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;
$ed[8]=0;
$ed[9]=0;
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
    $ed[3]++;
    $ed[7]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
    $ed[3]++;
    $ed[4]++;
    $ed[5]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
    $ed[4]++;
    $ed[7]++;

   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }
   $neds = 10;
            $symptoms = Symptom::whereIn('id',[296,269,286,291,293])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Pelvis"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;
    $ed[5]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[2]++;
   }
            $symptoms = Symptom::whereIn('id',[380,182,79,131])->get();
            $neds = 8;
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Pubis"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[3]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   $neds = 8;
            $symptoms = Symptom::whereIn('id',[46,371,373,376,378])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Shoulder"){
            $ed[0]=0;
            $ed[1]=0;
            $ed[2]=0;
            $ed[3]=0;
            $ed[4]=0;
            $ed[5]=0;
            $ed[6]=0;
            $ed[7]=0;

               if(($_POST[1])=="Yes")
               {
                $ed[0]++;
                $ed[1]++;
               }
               if(($_POST[2])=="Yes")
               {
                $ed[1]++;

               }
               if(($_POST[3])=="Yes")
               {
                $ed[1]++;
               }
               if(($_POST[4])=="Yes")
               {
                $ed[1]++;
               }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[298,297,296])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Elbow"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[0]++;
   }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[121,120])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Forearm"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[4]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[0]++;
    $ed[5]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[3]++;
   }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[316,281,318,320])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Wrist"){
$ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
            $neds = 5;
            $symptoms = Symptom::whereIn('id',[139,133,129,128,122,123])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Hand"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[3]++;
   }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[357,358,121])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Head"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;
$ed[8]=0;
$ed[9]=0;
$ed[10]=0;
$ed[11]=0;
$ed[12]=0;
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[6]++;
    $ed[7]++;
   }
   if(($_POST[8])=="Yes")
   {
    $ed[7]++;
   }
   if(($_POST[9])=="Yes")
   {
    $ed[8]++;
   }
   if(($_POST[10])=="Yes")
   {
    $ed[9]++;
   }
   if(($_POST[11])=="Yes")
   {
    $ed[10]++;
   }
   if(($_POST[12])=="Yes")
   {
    $ed[11]++;
   }
   if(($_POST[13])=="Yes")
   {
    $ed[12]++;
   }
            $neds = 13;
            $symptoms = Symptom::whereIn('id',[70,82,77,86,1,94,98])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Tigh"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;
$ed[8]=0;
$ed[9]=0;
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[6]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[3]++;
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[8])=="Yes")
   {
    $ed[9]++;
   }
            $neds = 10;
            $symptoms = Symptom::whereIn('id',[333,120,336,129,315,341,325])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Knee"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;
$ed[8]=0;
$ed[9]=0;
$ed[10]=0;
$ed[11]=0;
$ed[12]=0;
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[2]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[8]++;
   }
   $neds = 13;
   $symptoms = Symptom::whereIn('id',[313,298,365,367,121,273])->get();
   return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Arm"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[3]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
    $ed[3]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[2]++;
    $ed[1]++;
   }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[315,317,346,347,112])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Ankle"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[3]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[3]++;
   }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[185,350,353,355,332])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }else if($body_part == "Foot"){
            $ed[0]=0;
$ed[1]=0;
$ed[2]=0;
$ed[3]=0;
$ed[4]=0;
$ed[5]=0;
$ed[6]=0;
$ed[7]=0;

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
    $ed[2]++;
    $ed[5]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
    $ed[4]++;
    $ed[5]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[5]++;
   }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[122,324,131,28,328,298])->get();
            return view('get_symptoms2',compact('body_part','symptoms','ed'));
        }

        return view('get_symptoms2',compact('body_part','symptoms'));
    }

    public function get_symptoms3(Request $request)
    {
        $body_part = $request->body_part;
        $symptoms =[];
        if($body_part == "Eye"){
            $ed[0]=$_POST['var1'];
            $ed[1]=$_POST['var2'];
            $ed[2]=$_POST['var3'];
            $ed[3]=$_POST['var4'];
            $ed[4]=$_POST['var5'];
            $ed[5]=$_POST['var6'];
            $ed[6]=$_POST['var7'];
            $ed[7]=$_POST['var8'];
            $ed[8]=$_POST['var9'];
            $ed[9]=$_POST['var10'];
               if(($_POST[1])=="Yes")
               {
                $ed[0]++;
				$ed[1]++;
				$ed[2]++;
				$ed[3]++;
				$ed[4]++;
				$ed[5]++;
				$ed[6]++;
				$ed[7]++;
               }
               if(($_POST[2])=="Yes")
               {
                $ed[0]++;
				$ed[3]++;
               }
               if(($_POST[3])=="Yes")
               {
                $ed[0]++;
				$ed[3]++;
               }
               if(($_POST[4])=="Yes")
               {
                $ed[1]++;
				$ed[7]++;
				$ed[6]++;
				$ed[9]++;
               }
               if(($_POST[5])=="Yes")
               {
                $ed[2]++;
				$ed[9]++;
               }
               if(($_POST[6])=="Yes")
               {
                $ed[2]++;
               }

            $symptoms = Symptom::whereIn('id',[31,32,34,37,38])->get();
            $neds = 10;
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }
        else if($body_part == "Ear"){
            $ed[0]=$_POST['var1'];
            $ed[1]=$_POST['var2'];
            $ed[2]=$_POST['var3'];
            $ed[3]=$_POST['var4'];
            $ed[4]=$_POST['var5'];
            $ed[5]=$_POST['var6'];
            $ed[6]=$_POST['var7'];
            $ed[7]=$_POST['var8'];

               if(($_POST[1])=="Yes")
               {
                $ed[0]++;

               }
               if(($_POST[2])=="Yes")
               {
                $ed[0]++;
               }
               if(($_POST[3])=="Yes")
               {
                $ed[1]++;
               }
               if(($_POST[4])=="Yes")
               {
                $ed[2]++;
               }
               if(($_POST[5])=="Yes")
               {
                $ed[2]++;
               }
               if(($_POST[6])=="Yes")
               {
                $ed[3]++;
                $ed[6]++;
               }

               $neds = 8;
            $symptoms = Symptom::whereIn('id',[304,307,120,7,76,89])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Nose"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[2]++;
	$ed[7]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
	$ed[6]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
	$ed[3]++;
	$ed[6]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[4]++;
	$ed[6]++;
   }
   if(($_POST[8])=="Yes")
   {
    $ed[7]++;
   }
   $neds = 8;
   $symptoms = Symptom::whereIn('id',[144,453,162,163,171,187])->get();
   return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Mouth"){

$ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;

   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
	$ed[5]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[6]++;
   }

            $neds = 6;
            $symptoms = Symptom::whereIn('id',[31,32,34,37,38])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Neck"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[5]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[3]++;
    $ed[5]++;
   }
   if(($_POST[3])=="Yes")
   {

    $ed[1]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[2]++;
    $ed[4]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }

            $neds = 10;
            $symptoms = Symptom::whereIn('id',[338,70,321,394,397,87])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Chest"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
   if(($_POST[1])=="Yes")
   {
    $ed[8]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[8]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;

   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
   }

   $neds = 10;
   $symptoms = Symptom::whereIn('id',[243,244,232])->get();
   return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Abdomen"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
   if(($_POST[1])=="Yes")
   {
    $ed[5]++;
    $ed[6]++;
    $ed[7]++;
    $ed[8]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[3]++;
    $ed[6]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;
    $ed[7]++;

   }
   if(($_POST[4])=="Yes")
   {
    $ed[8]++;

   }
   if(($_POST[5])=="Yes")
   {
    $ed[8]++;
   }

   $neds = 10;
            $symptoms = Symptom::whereIn('id',[250,251,253,257,256,262])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Pelvis"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[3]++;
    $ed[4]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[4]++;

   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }

            $symptoms = Symptom::whereIn('id',[381,7,82,385])->get();
            $neds = 8;
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Pubis"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[3]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   $neds = 8;
            $symptoms = Symptom::whereIn('id',[198,374,375,377])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Shoulder"){
            $ed[0]=$_POST['var1'];
            $ed[1]=$_POST['var2'];
            $ed[2]=$_POST['var3'];
            $ed[3]=$_POST['var4'];
            $ed[4]=$_POST['var5'];
            $ed[5]=$_POST['var6'];
            $ed[6]=$_POST['var7'];
            $ed[7]=$_POST['var8'];

               if(($_POST[1])=="Yes")
               {
                $ed[0]++;
                $ed[1]++;
               }
               if(($_POST[2])=="Yes")
               {
                $ed[1]++;

               }
               if(($_POST[3])=="Yes")
               {
                $ed[1]++;
               }
               if(($_POST[4])=="Yes")
               {
                $ed[1]++;
               }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[298,297,296])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Elbow"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[0]++;
   }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[121,120])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Forearm"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[4]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[2]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;

   }
            $neds = 8;
            $symptoms = Symptom::whereIn('id',[314,317,121,90,126])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Wrist"){
$ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
   if(($_POST[1])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[0]++;
    $ed[4]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[0]++;
   }
            $neds = 5;
            $symptoms = Symptom::whereIn('id',[127,130,125,121])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Hand"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }

            $neds = 8;
            $symptoms = Symptom::whereIn('id',[132])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Head"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
$ed[10]=$_POST['var11'];
$ed[11]=$_POST['var12'];
$ed[12]=$_POST['var13'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[6]++;
    $ed[7]++;
   }
   if(($_POST[8])=="Yes")
   {
    $ed[7]++;
   }
   if(($_POST[9])=="Yes")
   {
    $ed[8]++;
   }
   if(($_POST[10])=="Yes")
   {
    $ed[9]++;
   }
   if(($_POST[11])=="Yes")
   {
    $ed[10]++;
   }
   if(($_POST[12])=="Yes")
   {
    $ed[11]++;
   }
   if(($_POST[13])=="Yes")
   {
    $ed[12]++;
   }
            $neds = 13;
            $symptoms = Symptom::whereIn('id',[70,82,77,86,1,94,98])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Tigh"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
    $ed[2]++;
    $ed[3]++;
    $ed[4]++;
    $ed[5]++;
    $ed[6]++;
    $ed[7]++;
    $ed[8]++;
    $ed[9]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[6]++;
    $ed[9]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
    $ed[5]++;
    $ed[8]++;
    $ed[9]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[6]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[9]++;
   }

            $neds = 10;
            $symptoms = Symptom::whereIn('id',[334,338,337,122,342,46,343])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Knee"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
$ed[10]=$_POST['var11'];
$ed[11]=$_POST['var12'];
$ed[12]=$_POST['var13'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[9]++;
    $ed[10]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[7]++;
    $ed[11]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[11]++;
   }
   $neds = 13;
   $symptoms = Symptom::whereIn('id',[134,122,120,368,352])->get();
   return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Arm"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[2]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;

   }
   if(($_POST[4])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[3]++;
   }


            $neds = 8;
            $symptoms = Symptom::whereIn('id',[321,348,335,314])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Ankle"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[3]++;
    $ed[1]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[3]++;
   }

            $neds = 8;
            $symptoms = Symptom::whereIn('id',[121,354])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }else if($body_part == "Foot"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {

    $ed[4]++;

   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }

            $neds = 8;
            $symptoms = Symptom::whereIn('id',[193,44,326,329,331])->get();
            return view('get_symptoms3',compact('body_part','symptoms','ed'));
        }

        return view('get_symptoms3',compact('body_part','symptoms'));
    }


    public function analyze(Request $request){
        $mainresult =0;
        $body_part = $request->body_part;
        $symptoms =[];
        if($body_part == "Eye"){
            $ed[0]=$_POST['var1'];
            $ed[1]=$_POST['var2'];
            $ed[2]=$_POST['var3'];
            $ed[3]=$_POST['var4'];
            $ed[4]=$_POST['var5'];
            $ed[5]=$_POST['var6'];
            $ed[6]=$_POST['var7'];
            $ed[7]=$_POST['var8'];
            $ed[8]=$_POST['var9'];
            $ed[9]=$_POST['var10'];
               if(($_POST[1])=="Yes")
               {

				$ed[2]++;

               }
               if(($_POST[2])=="Yes")
               {
                $ed[2]++;

               }
               if(($_POST[3])=="Yes")
               {
                $ed[6]++;

               }
               if(($_POST[4])=="Yes")
               {
                $ed[5]++;

               }
               if(($_POST[5])=="Yes")
               {
                $ed[8]++;

               }


               $mainresult =0;
               if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0 &&$ed[8]==0 && $ed[9]==0)
               {
                   $mainresult=11;
               }
               else
               {
               if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=1;
               }
               if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=2;
               }
               if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=3;
               }
               if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=4;
               }
               if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=5;
               }
               if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=6;
               }
               if($ed[6]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=7;
               }
               if($ed[7]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=8;
               }
               if($ed[8]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=9;
               }
               if($ed[9]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
               {
                   $mainresult=10;
               }
               }


        }
        else if($body_part == "Ear"){
            $ed[0]=$_POST['var1'];
            $ed[1]=$_POST['var2'];
            $ed[2]=$_POST['var3'];
            $ed[3]=$_POST['var4'];
            $ed[4]=$_POST['var5'];
            $ed[5]=$_POST['var6'];
            $ed[6]=$_POST['var7'];
            $ed[7]=$_POST['var8'];

               if(($_POST[1])=="Yes")
               {
                $ed[0]++;

               }
               if(($_POST[2])=="Yes")
               {
                $ed[1]++;
               }
               if(($_POST[3])=="Yes")
               {
                $ed[1]++;
                $ed[2]++;
                $ed[3]++;
               }
               if(($_POST[4])=="Yes")
               {
                $ed[2]++;
               }
               if(($_POST[5])=="Yes")
               {
                $ed[2]++;
                $ed[7]++;
               }
               if(($_POST[6])=="Yes")
               {
                $ed[5]++;

               }
               $mainresult=0;
if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
{
    $mainresult=11;
}
else
{
if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=67;
}
if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=68;
}
if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=69;
}
if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=70;
}
if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=71;
}
if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=72;
}
if($ed[6]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=73;
}
if($ed[7]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=74;
}
}



        }else if($body_part == "Nose"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[2]++;
	$ed[7]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;

   }
   if(($_POST[4])=="Yes")
   {
    $ed[2]++;

   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }

   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=37;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=38;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=39;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=40;
   }
   if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=41;
   }
   if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=42;
   }
   if($ed[6]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=43;
   }
   if($ed[7]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=44;
   }
   }


        }else if($body_part == "Mouth"){

$ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
   if(($_POST[1])=="Yes")
   {
    $ed[6]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[6]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[5]++;

   }
   if(($_POST[4])=="Yes")
   {
    $ed[4]++;

   }
   if(($_POST[5])=="Yes")
   {
    $ed[3]++;
   }

   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6])))
   {
       $mainresult=12;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6])))
   {
       $mainresult=13;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6])))
   {
       $mainresult=14;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6])))
   {
       $mainresult=15;
   }
   if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6])))
   {
       $mainresult=16;
   }
   if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6])))
   {
       $mainresult=17;
   }
   if($ed[6]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6])))
   {
       $mainresult=18;
   }

   }


        }else if($body_part == "Neck"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;

   }
   if(($_POST[4])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }

   $mainresult = 0;
if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0 &&$ed[8]==0 && $ed[9]==0)
{
    $mainresult=11;
}
else
{
if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
{
    $mainresult=133;
}
if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
{
    $mainresult=134;
}
if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
{
    $mainresult=135;
}
if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
{
    $mainresult=136;
}
if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
{
    $mainresult=137;
}
if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
{
    $mainresult=138;
}
}




        }else if($body_part == "Chest"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
   if(($_POST[1])=="Yes")
   {

    $ed[8]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[9]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[2]++;
    $ed[4]++;
    $ed[5]++;
    $ed[9]++;
   }

   $mainresult = 0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0 &&$ed[8]==0 && $ed[9]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=45;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=46;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=47;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=48;
   }
   if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=49;
   }
   if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=50;
   }
   if($ed[6]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=51;
   }
   if($ed[7]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=52;
   }
   if($ed[8]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=53;
   }
   if($ed[9]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=54;
   }
   }

        }else if($body_part == "Abdomen"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
    $ed[3]++;
    $ed[7]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
    $ed[3]++;
    $ed[4]++;
    $ed[5]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
    $ed[4]++;
    $ed[7]++;

   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }

   $mainresult = 0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0 &&$ed[8]==0 && $ed[9]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=56;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=57;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=58;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=59;
   }
   if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=60;
   }
   if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=61;
   }
   if($ed[6]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=62;
   }
   if($ed[7]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=63;
   }
   if($ed[8]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=64;
   }
   }


        }else if($body_part == "Pelvis"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }

   $mainresult=0;
if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
{
    $mainresult=11;
}
else
{
if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=111;
}
if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=112;
}
if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=113;
}
if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=114;
}
if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=115;
}
if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=116;
}
}


        }else if($body_part == "Pubis"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[3]++;


   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }

   $mainresult=0;
if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
{
    $mainresult=11;
}
else
{
if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=117;
}
if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=118;
}
if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=119;
}
if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=120;
}
if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=121;
}

}


        }else if($body_part == "Shoulder"){
            $ed[0]=$_POST['var1'];
            $ed[1]=$_POST['var2'];
            $ed[2]=$_POST['var3'];
            $ed[3]=$_POST['var4'];
            $ed[4]=$_POST['var5'];
            $ed[5]=$_POST['var6'];
            $ed[6]=$_POST['var7'];
            $ed[7]=$_POST['var8'];

               if(($_POST[1])=="Yes")
               {
                $ed[1]++;
               }
               if(($_POST[2])=="Yes")
               {
                $ed[0]++;

               }
               if(($_POST[3])=="Yes")
               {
                $ed[0]++;
               }

               $mainresult=0;
if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
{
    $mainresult=11;
}
else
{
if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=65;
}
if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
{
    $mainresult=66;
}

}



        }else if($body_part == "Elbow"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[1]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;

   }

   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=75;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=76;
   }

   }


        }else if($body_part == "Forearm"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[4]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[4]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[5]++;

   }
   if(($_POST[5])=="Yes")
   {
    $ed[5]++;
   }


   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=77;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=78;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=79;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=80;
   }
   if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=81;
   }
   if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=82;
   }

   }


        }else if($body_part == "Wrist"){
$ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
   if(($_POST[1])=="Yes")
   {
    $ed[1]++;
    $ed[2]++;
    $ed[3]++;
    $ed[4]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[0]++;
    $ed[2]++;
    $ed[3]++;
    $ed[4]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[0]++;
   }
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4])))
   {
       $mainresult=32;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4])))
   {
       $mainresult=33;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4])))
   {
       $mainresult=34;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4])))
   {
       $mainresult=35;
   }
   if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4])))
   {
       $mainresult=36;
   }


   }


        }else if($body_part == "Hand"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }

   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=107;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=108;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=109;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=110;
   }

   }


        }else if($body_part == "Head"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
$ed[10]=$_POST['var11'];
$ed[11]=$_POST['var12'];
$ed[12]=$_POST['var13'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[3]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[4]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[6]++;
    $ed[7]++;
   }
   if(($_POST[8])=="Yes")
   {
    $ed[7]++;
   }
   if(($_POST[9])=="Yes")
   {
    $ed[8]++;
   }
   if(($_POST[10])=="Yes")
   {
    $ed[9]++;
   }
   if(($_POST[11])=="Yes")
   {
    $ed[10]++;
   }
   if(($_POST[12])=="Yes")
   {
    $ed[11]++;
   }
   if(($_POST[13])=="Yes")
   {
    $ed[12]++;
   }



        }else if($body_part == "Tigh"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[2])=="Yes")
   {

    $ed[1]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[0]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[5]++;
   }
   if(($_POST[5])=="Yes")
   {

    $ed[6]++;
   }
   if(($_POST[6])=="Yes")
   {
    $ed[7]++;
   }
   if(($_POST[7])=="Yes")
   {
    $ed[7]++;
   }

   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0 && $ed[8]==0 && $ed[9]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=89;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=90;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=91;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=92;
   }
   if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=93;
   }
   if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=94;
   }
   if($ed[6]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=95;
   }
   if($ed[7]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=96;
   }
   if($ed[8]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=97;
   }
   if($ed[9]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7],$ed[8],$ed[9])))
   {
       $mainresult=98;
   }

   }

        }else if($body_part == "Knee"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];
$ed[8]=$_POST['var9'];
$ed[9]=$_POST['var10'];
$ed[10]=$_POST['var11'];
$ed[11]=$_POST['var12'];
$ed[12]=$_POST['var13'];
   if(($_POST[1])=="Yes")
   {
    $ed[0]++;
    $ed[1]++;
    $ed[2]++;
    $ed[3]++;
    $ed[6]++;
    $ed[7]++;
    $ed[8]++;
   }
   if(($_POST[2])=="Yes")
   {

    $ed[1]++;
    $ed[3]++;
    $ed[4]++;
    $ed[7]++;
    $ed[8]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[7]++;
    $ed[8]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[7]++;
   }
   if(($_POST[5])=="Yes")
   {
    $ed[11]++;
   }




        }else if($body_part == "Arm"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
   }
   if(($_POST[3])=="Yes")
   {

    $ed[3]++;
   }
   if(($_POST[4])=="Yes")
   {
    $ed[2]++;
   }

   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=99;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=100;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=101;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=102;
   }


   }


        }else if($body_part == "Ankle"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {

    $ed[3]++;
   }
   if(($_POST[2])=="Yes")
   {
    $ed[2]++;
   }

   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=103;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=104;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=105;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=106;
   }


   }

        }else if($body_part == "Foot"){
            $ed[0]=$_POST['var1'];
$ed[1]=$_POST['var2'];
$ed[2]=$_POST['var3'];
$ed[3]=$_POST['var4'];
$ed[4]=$_POST['var5'];
$ed[5]=$_POST['var6'];
$ed[6]=$_POST['var7'];
$ed[7]=$_POST['var8'];

   if(($_POST[1])=="Yes")
   {
    $ed[0]++;

   }
   if(($_POST[2])=="Yes")
   {
    $ed[1]++;
    $ed[4]++;

   }
   if(($_POST[3])=="Yes")
   {
    $ed[2]++;
   }
   if(($_POST[4])=="Yes")
   {

    $ed[4]++;

   }
   if(($_POST[5])=="Yes")
   {
    $ed[5]++;
   }

   $mainresult=0;
   if($ed[0]==0 && $ed[1]==0 && $ed[2]==0 && $ed[3]==0 &&$ed[4]==0 && $ed[5]==0 &&$ed[6]==0 && $ed[7]==0)
   {
       $mainresult=11;
   }
   else
   {
   if($ed[0]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=83;
   }
   if($ed[1]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=84;
   }
   if($ed[2]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=85;
   }
   if($ed[3]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=86;
   }
   if($ed[4]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=87;
   }
   if($ed[5]==(max($ed[0],$ed[1],$ed[2],$ed[3],$ed[4],$ed[5],$ed[6],$ed[7])))
   {
       $mainresult=88;
   }

   }


        }

        $result = Disease::where('id',$mainresult)->get();
        //print_r($result);
        return view('analyze_result',compact('body_part','mainresult','result'));
    }


    public function show($doctorId, $date)
    {
        $appointment = Appointment::where('user_id', $doctorId)->where('date', $date)->first();
        $times = Time::where('appointment_id', $appointment->id)->where('status', 0)->get();
        $user = User::where('id', $doctorId)->first();
        $doctor_id = $doctorId;
        return view('appointment', compact('times', 'date', 'user', 'doctor_id'));
    }

    public function store(Request $request)
    {
        // Set timezone
        date_default_timezone_set('America/New_York');

        $request->validate(['time' => 'required']);
        $check = $this->checkBookingTimeInterval();
        if ($check) {
            return redirect()->back()->with('errMessage', 'You already made an appointment. Please check your email for the appointment!');
        }

        $doctorId = $request->doctorId;
        $time = $request->time;
        $appointmentId = $request->appointmentId;
        $date = $request->date;
        Booking::create([
            'user_id' => auth()->user()->id,
            'doctor_id' => $doctorId,
            'time' => $time,
            'date' => $date,
            'status' => 0
        ]);
        $doctor = User::where('id', $doctorId)->first();
        Time::where('appointment_id', $appointmentId)->where('time', $time)->update(['status' => 1]);

        // Send email notification
        $mailData = [
            'name' => auth()->user()->name,
            'time' => $time,
            'date' => $date,
            'doctorName' => $doctor->name
        ];
        try {
            \Mail::to(auth()->user()->email)->send(new AppointmentMail($mailData));
        } catch (\Exception $e) {
        }

        return redirect()->back()->with('message', 'Your appointment was booked for ' . $date . ' at ' . $time . ' with ' . $doctor->name . '.');
    }

    // check if user already make a booking.
    public function checkBookingTimeInterval()
    {
        return Booking::orderby('id', 'desc')
            ->where('user_id', auth()->user()->id)
            ->whereDate('created_at', date('y-m-d'))
            ->exists();
    }

    public function myBookings()
    {
        $appointments = Booking::latest()->where('user_id', auth()->user()->id)->get();
        return view('booking.index', compact('appointments'));
    }

    public function myPrescription()
    {
        $prescriptions = Prescription::where('user_id', auth()->user()->id)->get();
        return view('my-prescription', compact('prescriptions'));
    }
}
