<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Illness;
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
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $illness = Illness::create($illnessData);

        return response([
            'message' => 'Jenis penyakit berhasil dibuat',
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
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $illness->illnessName = $updateData['illnessName'];
        $illness->description = $updateData['description'];
        $illness->advice = $updateData['advice'];

        if($illness->save()){
            return response([
                'message' => 'Data jenis penyakit berhasil diubah',
                'data' => $illness
            ], 200);
        }

        return response([
            'message' => 'Gagal mengubah data jenis penyakit'
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
                'message' => 'Data jenis penyakit berhasil dihapus',
                'data' => $illness
            ], 200);
        }

        return response([
            'message' => 'Delete illness failed'
        ], 400);
    }
}
