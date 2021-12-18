<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use  \Illuminate\Support\Facades\Hash;
use PharIo\Version\Exception;

class passportAuthController extends Controller
{
    public function registerUSer(Request $request)
    {
        try {

            $data = $request->all();
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:55',
                'lastname' => 'required|max:55',
                'email' => 'required|email|unique:users',
                'password' => 'required',

            ]);
            if ($validator->failed()) {
                return response()->json($validator->errors()->first(), 422);
            }

            $data['password'] = \Illuminate\Support\Facades\Hash::make(($request->password));
            $data['status'] = 'active';
            $data['category'] = 'specific role';

            $user = User::create($data);
            $accessToken = $user->createToken('userToken')->accessToken;
            return response()->json([
                'token' => $accessToken,
                'token_type' => 'Bearer'
            ]);

        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);

        }
    }


    public function loginUSer(Request $request)
    {

        try {
            $data = $request->all();
            $validator = Validator::make($data, [
                'email' => 'required|email',
                'password' => 'required' | 'max:12'//confirmed asked
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'error' => $validator->errors()->all()
                ]);

            }
            $user = User::where('email', $request->email)->first();//yebar test kon bebin chi mide?collection ya?array mide
            if (!$user) {

                return response()->json([
                    'message' => 'User does not exist'
                ]);
            }
            if (!Hash::check($request->password, $user->password)) {

                return response()->json([
                    'message' => 'Password mismath'
                ]);
            }


            $token = $user->createToken('Laravel Passport Grant Client')->accessToken;
            return response()->json([
                'token' => $token
            ]);


        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function unAuthenticate()
    {
        return response()->json(['message', "you are not login"]);
    }
}

