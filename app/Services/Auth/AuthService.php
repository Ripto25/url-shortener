<?php
namespace App\Services\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService{

    public function register($request){
        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'status' => 'success',
                'code'   => '200',
                'message'=> 'Registration Success',
                'access_token' =>  $token,
                'token_type'   => 'Bearer'
            ]);
        }
        catch (Exception $error){
            return response()->json([
                'status' => 'error',
                'code'   => '500',
                'message'=> 'Registration Failed',
                'access_token' =>  null,
                'token_type'   => null
            ]);
        }
    }

    public function login($request){
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                return response()->json([
                    'status'  => 'error',
                    'code'    => 401,
                    'message' => 'Unauthorized'
                ]);
            }
            else{
                $user  = User::where('email', $request->email)->firstOrFail();
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'status'       => 'success',
                    'code'         => '200',
                    'message'      => 'Hi '.$user->name.', welcome to home',
                    'access_token' =>  $token,
                    'token_type'   => 'Bearer'
                ]);
            }
        }
        catch (\Exception $error){
            return response()->json([
                'status'       => 'error',
                'code'         => '500',
                'message'      => 'Login Failed',
                'access_token' => null,
                'token_type'   => null
            ]);
        }

    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'  => 'success',
            'code'    => 200,
            'message' => 'Logout Success'
        ]);
    }
}
