<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Disease;
use App\Feedback;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the doctor info
        $users  = User::get()->where('role_id', 1);
        return view('admin.doctor.index', compact('users'));
    }

    public function disease_info(){
        $diseases = Disease::all();
        return view('admin.doctor.disease_info', compact('diseases'));
    }

    public function view_patient_data($id){
        $user = User::where('id',$id)->get();
        $user_id = $id;
        $bmi =  DB::table('bmi')->where('user_id', $user_id)->get();

        $bmi_index = $bmi[0]->bmi;
        $height = $bmi[0]->height;
        $weight = $bmi[0]->weight;
        $shours = DB::table('sleep_hours')->where('user_id',$user_id)->select('created_at', DB::raw('SUM(sleep_hours) as total_shours'))->groupBy('created_at')->get();
        $water_intakes = DB::table('water_intakes')->where('user_id',$user_id)->select('created_at', DB::raw('SUM(water_intake) as total_water'))->groupBy('created_at')->get();
        $cal_intakes =  DB::table('food_intakes')->where('user_id',$user_id)->select('created_at', DB::raw('SUM(calorie) as total_cal'))->groupBy('created_at')->get();
        $fat_intakes = DB::table('food_intakes')->where('user_id',$user_id)->select('created_at', DB::raw('SUM(fat) as total_fat'))->groupBy('created_at')->get();
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
        return view('admin.doctor.patient_data', compact('user','height','weight','bmi_index','output','shours','water_intakes','cal_intakes','fat_intakes'));
    }

    public function patients()
    {
        // Get the doctor info
        $users  = User::get()->where('role_id', 3);
        return view('admin.doctor.patients', compact('users'));
    }

    public function dpatients()
    {
        // Get the doctor info
        $users  = User::get()->where('role_id', 3);
        return view('admin.doctor.dpatients', compact('users'));
    }

    public function my_profile(Request $request)
    {
        // Get the doctor info
        $user  = $request->user();
        return view('admin.doctor.my_profile', compact('user'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateStore($request);
        $data = $request->all();
        $name = (new User)->userAvatar($request);

        $data['image'] = $name;
        $data['password'] = bcrypt($request->password);
        User::create($data);

        return redirect()->back()->with('message', 'Doctor added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('admin.doctor.delete', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.doctor.edit', compact('user'));
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
        $this->validateUpdate($request, $id);
        $data = $request->all();
        $user = User::find($id);
        $imageName = $user->image;
        $userPassword = $user->password;
        if ($request->hasFile('image')) {
            $imageName = (new User)->userAvatar($request);
            unlink(public_path('images/' . $user->image));
        }
        $data['image'] = $imageName;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        } else {
            $data['password'] = $userPassword;
        }
        $user->update($data);
        return redirect()->route('doctor.index')->with('message', 'Doctor ' . $user->name . ' information updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Prevent user delete himself
        if (auth()->user()->id == $id) {
            abort(401);
        };
        $user = User::find($id);
        $userDelete = $user->delete();
        if ($userDelete) {
            unlink(public_path('images/' . $user->image));
        };
        return redirect()->route('doctor.index')->with('message', 'Doctor ' . $user->name . ' deleted successfully');
    }

    public function validateStore($request)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:6|max:25',
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'department' => 'required',
            'phone_number' => 'required|numeric',
            'image' => 'required|mimes:jpeg,jpg,png',
            'role_id' => 'required',
            'description' => 'required'

        ]);
    }

    public function validateUpdate($request, $id)
    {
        return  $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'gender' => 'required',
            'education' => 'required',
            'address' => 'required',
            'department' => 'required',
            'phone_number' => 'required|numeric',
            'image' => 'mimes:jpeg,jpg,png',
            'role_id' => 'required',
            'description' => 'required'

        ]);
    }

    public function feedback(Request $request){
        return view('admin.doctor.feedback');
    }

    public function feedback_store(Request $request){
        $feedback = array(
            "feedback_message" => $request->feedback_message,
            "feedback_date" => date('Y-m-d'),
            "user_id" => $request->user()->id
        );
        DB::table('feedback')->insert($feedback);
        return redirect()->back()->with('message','Feedback Sent Successfully');
    }
}
