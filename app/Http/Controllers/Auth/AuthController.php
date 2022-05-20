<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AuthController extends controller
{
    private $service;
    public function __construct(AuthService $service){
        $this->service = $service;
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        else{
            return $this->service->register($request);
        }
    }

    public function login(Request $request){
            return $this->service->login($request);
    }

    public function logout(){
        return $this->service->logout();
    }
}
