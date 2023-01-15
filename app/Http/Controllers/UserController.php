<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = ['error' => ''];
        $users = User::all();

        $response['users'] = $users;

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

            $user = User::create($data);

            $response['user'] = $user;
        } else {
            $response['error'] = $validator->errors()->first();
        }


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if (empty($validator->fails())) {
            $user = User::find($request->id);
            if ($user) {
                $response['user'] = $user;
            } else {
                $response['error'] = 'User not found';
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if (empty($validator->fails())) {
            $user = User::find($request->id);
            if ($user) {
                $response['user'] = $user;
            } else {
                $response['error'] = 'User not found';
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'password' => 'different:old_password',
            'confirm_password' => 'same:password'
        ]);

        if (empty($validator->fails())) {
            $data['name'] = $request->name;
            $user = User::find($request->id);

            if ($user) {
                if ($request->email && $request->user()->email == $user->email) {
                    $email = User::where('email', $request->email)->first();

                    if (isset($email) && $email['id'] != $user['id']) {
                        $response['error'] = 'Email is already used';
                        return $response;
                    }

                    $data['email'] = $request->email;
                } elseif ($request->email) {
                    $response['error'] = "You cannot change another user's email.";
                    return $response;
                }

                if ($request->password && $request->user()->id == $user->id) {
                    $password = Hash::make($request->password);
                    $oldPassword = $request->old_password ? $request->old_password : '';

                    if ($oldPassword != '' && Hash::check($oldPassword, $request->user()->password)) {
                        $data['password'] = $password;
                    } else {
                        $response['error'] = 'The provided password does not match our records.';
                        return $response;
                    }
                } elseif ($request->password) {
                    $response['error'] = "You cannot change another user's password.";
                    return $response;
                }

                $user->update($data);
                $user->save();
                $response['user'] = $user;
            } else {
                $response['error'] = 'User not found';
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }


        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if (empty($validator->fails())) {
            $user = User::find($request->id);
            if ($user) {
                $user->delete();
                $response['success'] = 'The user has been deleted';
            } else {
                $response['error'] = 'User not found';
            }
        } else {
            $response['error'] = $validator->errors()->first();
        }

        return $response;
    }
}
