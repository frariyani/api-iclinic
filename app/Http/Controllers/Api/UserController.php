<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    //
    public function store(Request $req){
        $userData = $req->all();

        $validate = Validator::make($userData, [
            'fullname' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6|string',
            'roleID' => 'required'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $userData['password'] = Hash::make($req->password);
        $user = User::create($userData);

        return response([
            'message' => 'User created successfuly',
            'data' => $user
        ], 200);
    }

    public function show(){
        $users = User::query()
                 ->with(['role' => function ($query){
                    $query->select('roleID', 'rolename');
                 }])
                 ->get();

        if(!is_null($users)){
            return response([
                'message' => 'User retrieved successfuly',
                'data' => $users
            ]);
        }
    }

    public function showUserByID($id){
        $user = User::find($id)->role;

        if(!is_null($user)){
            return response([
                'message' => 'Retrieve user successful',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'User not found',
            'data' => null
        ], 404);
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['userID'];

        $user = User::find($id);

        if(is_null($user)){
            return response([
                'message' => 'User not found',
                'data' => null
            ], 404);
        }

        $validate = Validator::make($updateData, [
            'fullname' => 'required|max:255',
            'username' => 'required|max:255',
            'roleID' => 'required'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $user->username = $updateData['username'];
        $user->fullname = $updateData['fullname'];
        $user->roleID = $updateData['roleID'];

        if($user->save()){
            return response([
                'message' => 'Update user successful',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Update user failed',
            'data' => null
        ], 400);
    }

    public function delete($id){
        $user = User::find($id);

        if(is_null($user)){
            return response([
                'message' => 'User table is empty',
                'data' => null
            ], 404);
        }

        if($user->delete()){
            return response([
                'message' => 'User successfuly deleted',
                'data' => $user
            ], 200);
        }

        return response([
            'message' => 'Delete user failed',
            'data' => null
        ], 400);
    }

}