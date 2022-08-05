<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Role;

class RoleController extends Controller
{
    //
    public function store(Request $req){
        $roleData = $req->all();

        $validate = Validator::make($roleData, [
            'rolename' => 'required|max:255'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $role = Role::create($roleData);

        return response([
            'message' => 'Role successfuly created',
            'data' => $role
        ], 200);
    }

    public function show(){
        $role = Role::all();

        if(!is_null($role)){
            return response([
                'message' => 'Retrieve roles successful',
                'data' => $role
            ]);
        }

        return response([
            'message' => 'Role table is empty',
            'data' => null
        ], 404);
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['roleID'];

        $role = Role::find($id);

        if(is_null($role)){
            return response([
                'message' => 'Role not found',
                'data' => null
            ], 404);
        }

        $validate = Validator::make($updateData, [
            'rolename' => 'required|max:255'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $role->rolename = $updateData['rolename'];
        
        if($role->save()){
            return response([
                'message' => 'Update role successful',
                'data' => $role
            ], 200);
        }

        return response([
            'message' => 'Update role failed',
            'data' => null,
        ], 400);
    }

    public function delete($id){
        $role = Role::find($id);

        if(is_null($role)){
            return response([
                'message' => 'Role table is empty',
                'data' => null
            ], 404);
        }

        if($role->delete()){
            return response([
                'message' => 'Role successfuly deleted',
                'data' => $role
            ], 200);
        }

        return response([
            'message' => 'Delete role failed',
            'data' => null
        ], 400);
    }
}
