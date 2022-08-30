<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Treatment;
use Illuminate\Support\Facades\Validator;

class TreatmentController extends Controller
{
    //
    public function store(Request $req){
        $treatmentData = $req->all();

        $validate = Validator::make($treatmentData, [
            'treatmentName' => 'required|max:255',
            'treatmentPrice' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $treatment = Treatment::create($treatmentData);

        return response([
            'message' => 'Data jenis perawatan berhasil dibuat',
            'data' => $treatment
        ], 200);
    }

    public function show(){
        $treatment = Treatment::all();

        if(!is_null($treatment)){
            return response([
                'message' => 'Treatment retrieved successfuly',
                'data' => $treatment
            ]);
        }
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['treatmentID'];

        $treatment = Treatment::find($id);

        if(is_null($treatment)){
            return response([
                'message' => 'Treatment not found'
            ], 404);
        }

        $validate = Validator::make($updateData, [
            'treatmentName' => 'required|max:255',
            'treatmentPrice' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $treatment->treatmentName = $updateData['treatmentName'];
        $treatment->treatmentPrice = $updateData['treatmentPrice'];

        if($treatment->save()){
            return response([
                'message' => 'Data jenis perawatan berhasil diubah',
                'data' => $treatment
            ]);
        }

        return response([
            'message' => 'Data jenis perawatan gagal diubah'
        ], 400);
    }

    public function delete($id){
        $treatment = Treatment::find($id);

        if(is_null($treatment)){
            return response([
                'message' => 'Treatment table is empty'
            ], 404);
        }

        if($treatment->delete()){
            return response([
                'message' => 'Data jenis perawatan berhasil dihapus',
                'data' => $treatment
            ], 200);
        }
    }
}
