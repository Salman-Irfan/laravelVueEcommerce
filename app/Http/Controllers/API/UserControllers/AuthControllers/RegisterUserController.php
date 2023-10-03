<?php

namespace App\Http\Controllers\API\UserControllers\AuthControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterUserController extends Controller
{
    // register user controller logic
    public function register (Request $request) {
        // validation
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        // if validation fails
        if($validator->fails()){
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
        // if validation succeeds
        // store data in input variable
        $input = $request->all();
        // bcrypt the password
        $input['password'] = bcrypt($input['password']);
        // create the user
        $user = User::create($input);
        // create success message
        
        // user details
        $success['name'] = $user->name;
        $success['email'] = $user->email;
        // response
        $response = [
            'success' => true,
            'data' => $success,
            'message' => 'Successfully registered',

        ];
        // return the response
        return response()->json($response, 200);
    }
}
