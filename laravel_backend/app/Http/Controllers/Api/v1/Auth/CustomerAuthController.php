<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CustomerAuthController extends Controller
{


    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email_or_phone' => 'required',
            'password' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $user = User::where(['email' => $request['email_or_phone']])->orWhere('phone_number', $request['email_or_phone'])->first();

        if (isset($user)) {

            $data = [
                'email' => $user->email,
                'password' => $request->password
            ];

            if (auth()->attempt($data)) {

                $token = auth()->user()->createToken('SmartHealthAuth')->accessToken;
                return response()->json(['token' => $token, 'user' => $user], 200);
            }
        }

        $errors = [];
        array_push($errors, ['code' => 'auth-001', 'message' => 'Invalid credential.']);
        return response()->json([
            'errors' => $errors
        ], 401);
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:users',
            'phone_number' => 'required',
            'password' => 'required|min:6',
        ], [
            'name.required' => 'The Name field is required.',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => Helpers::error_processor($validator)], 403);
        }

        $user = User::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'role_id' => 3,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('SmartHealthAuth')->accessToken;

        return response()->json(['token' => $token, 'user' => $user], 200);
    }
}
