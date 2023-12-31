<?php

namespace App\Http\Controllers\API\UserControllers\AuthControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserLoginController extends Controller
{
    // user login controller logic
    public function login (Request $request){
        // validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        // if validation fails
        if ($validator->fails()) {
            // send relevant error message
            $response = [
                'success' => false,
                'message' => $validator->errors()
            ];
            // return response in json
            return response()->json(
                $response,
                400
            );
        }
        ########################
        // if validation succeeds
        // Authenticate the user
        // if correct credentials
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            $user = Auth::user();
            // create token
            $token = $user->createToken('MyApp')->plainTextToken;
            // user datils
            $success['name'] = $user->name;
            $success['email'] = $user->email;
            // response
            $response = [
                'success' => true,
                'token' => $token,
                'data' => $success,
                'message' => 'Login Successfully',

            ];
            // return the response
            return response()->json($response, 200);
        } else {
            $response = [
                'success' => false,
                'message' => 'Unauthorized',
            ];

            $token = $user->createToken('token')->plainTextToken;
            // return the response
            return response()->json($response);
        }
    }
}