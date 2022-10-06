<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Medicine;

class MedicineController extends Controller
{
    //
    public function store(Request $req){
        $medicineData = $req->all();

        $validate = Validator::make($medicineData, [
            'medicineName' => 'required|max:255|string',
            'supply' => 'required|numeric|min:0|max:999999',
            'unit' => 'required|max:255|string',
            'pricePerUnit' => 'required|numeric|min:0|max:999999'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $medicine = Medicine::create($medicineData);

        return response([
            'message' => 'Data obat berhasil dibuat',
            'data' => $medicine
        ], 200);
    }

    public function show(){
        $medicine = Medicine::all();

        if(!is_null($medicine)){
            return response([
                'message' => 'Medicine retrieved successfuly',
                'data' => $medicine
            ]);
        }
    }

    public function getMedicineByID($id){
        $medicine = Medicine::find($id);

        if(!is_null($medicine)){
            return response([
                'data' => $medicine
            ]);
        }
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['medicineID'];

        $medicine = Medicine::find($id);

        if(is_null($medicine)){
            return response([
                'message' => 'Medicine not found'
            ], 404);
        }

        $validate = Validator::make($updateData, [
            'medicineName' => 'required|max:255|string',
            'unit' => 'required|max:255|string',
            'pricePerUnit' => 'required|numeric|min:0|max:999999'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $medicine->medicineName = $updateData['medicineName'];
        $medicine->unit = $updateData['unit'];
        $medicine->pricePerUnit = $updateData['pricePerUnit'];

        $medicine->save();

        if($medicine->save()){
            return response([
                'message' => 'Data obat berhasil diubah',
                'data' => $medicine
            ]);
        }

        return response([
            'message' => 'Data obat gagal diubah'
        ], 400);
    }

    public function delete($id){
        $medicine = Medicine::find($id);

        if(is_null($medicine)){
            return response([
                'message' => 'Medicine table is empty'
            ], 404);
        }

        if($medicine->delete()){
            return response([
                'message' => 'Data obat berhasil dihapus',
                'data' => $medicine
            ], 200);
        }
    }

    public function addStock(Request $req){
        $stockData = $req->all();

        $id = $stockData['medicineID'];

        $medicine = Medicine::find($id);

        $validate = Validator::make($stockData, [
            'additionalStock' => 'required|numeric|min:0|max:999999'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $initialStock = $medicine->supply;

        $medicine->supply = $initialStock + $stockData['additionalStock'];

        if($medicine->save()){
            return response([
                'message' => 'Stok obat berhasil ditambah',
                'data' => $medicine,
                'additional_stock' => $stockData['additionalStock']
            ]);
        }
    }
}
