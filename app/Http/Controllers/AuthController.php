<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum', ['except' => ['create', 'login']]);
    }

    public function login(Request $request)
    {
        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if (empty($validator->fails())) {

            $credentials = $request->only('email', 'password');


            if (Auth::attempt($credentials)) {

                $item = time() . rand(0, 9999);
                $token = $request->user()->createToken($item);

                $response['token'] = $token->plainTextToken;
                $response['user'] = $request->user();
            } else {
                $response['error'] = 'User and/or password are incorrect';
                return $response;
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }
        return $response;
    }

    public function store(Request $request)
    {
        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if (empty($validator->fails())) {
            $data = $request->only('name', 'email');
            $data['password'] = Hash::make($request->password);

            User::create($data);

            $credentials = $request->only('email', 'password');


            if (Auth::attempt($credentials)) {

                $item = time() . rand(0, 9999);
                $token = $request->user()->createToken($item);

                $response['token'] = $token->plainTextToken;
                $response['user'] = $request->user();
            } else {
                $response['error'] = 'An error has occurred';
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }


        return $response;
    }

    public function logout(Request $request)
    {
        $response = ['error' => ''];

        $request->user()->tokens()->delete();

        $response['success'] = 'logged out';

        return $response;
    }
}
