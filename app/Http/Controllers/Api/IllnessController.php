<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Illness;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class IllnessController extends Controller
{
    //
    public function store(Request $req){
        $illnessData = $req->all();

        $validate = Validator::make($illnessData, [
            'illnessName' => 'required|max:255',
            'description' => 'required|max:255',
            'advice' => 'required|max:255'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->fails()], 400);
        }

        $illness = Illness::create($illnessData);

        return response([
            'message' => 'Illness created successfuly',
            'data' => $illness
        ], 200);
    }

    public function show(){
        $illness = Illness::all();

        if(!is_null($illness)){
            return response([
                'message' => 'Illness retrieved successfuly',
                'data' => $illness
            ]);
        }
    }

    public function showIllnessByID($id){
        $illness = Illness::find($id);

        if(!is_null($illness)){
            return response([
                'message' => 'Retrieve illness successful',
                'data' => $illness
            ], 200);
        }

        return response([
            'message' => 'Illness not found'
        ], 404);
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['illnessID'];

        $illness = Illness::find($id);

        if(is_null($illness)){
            return response([
                'message' => 'Illness not found'
            ], 404);
        }

        $validate = Validator::make($updateData, [
            'illnessName' => 'required|max:255',
            'description' => 'required|max:255',
            'advice' => 'required|max:255'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->fails()], 400);
        }

        $illness->illnessNama = $updateData['illnessNama'];
        $illness->description = $updateData['description'];
        $illness->advice = $updateData['advice'];

        if($illness->save()){
            return response([
                'message' => 'Update illness successful',
                'data' => $illness
            ], 200);
        }

        return response([
            'message' => 'Update illness failed'
        ], 400);
    }

    public function delete($id){
        $illness = Illness::find($id);

        if(is_null($illness)){
            return response([
                'message' => 'Illness table is empty'
            ], 404);
        }

        if($illness->delete()){
            return response([
                'message' => 'Illness deleted successful',
                'data' => $illness
            ], 200);
        }

        return response([
            'message' => 'Delete illness failed'
        ], 400);
    }
}
