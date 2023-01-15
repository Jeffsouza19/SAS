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
            'password' => 'required|unique:users,email'
        ]);

        if (empty($validator->fails())) {

            $credentials = $request->only('email', 'password');


            if (Auth::attempt($credentials)) {

                $item = time() . rand(0, 9999);
                $token = $request->user()->createToken($item);

                $response['token'] = $token->plainTextToken;
                $response['user'] = $request->user();
            } else {
                $response['error'] = 'Usuario e/ou senha estão incorretos';
                return $response;
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }
        return $response;
    }

    public function create(Request $request)
    {
        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
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
                $response['error'] = 'Usuario e/ou senha estão incorretos';
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }


        return $response;
    }

    public function getAllUsers()
    {
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return ['error' => ''];
    }
}
