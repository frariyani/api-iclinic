<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\IncomingStock;
use App\Medicine;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    //
    public function store(Request $req){
        $stockData = $req->all();

        $validate = Validator::make($stockData, [
            'medicineID' => 'required',
            'date' => 'required|date',
            'quantity' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap memasukkan input dengan benar'], 400);
        }

        $incomingStock = IncomingStock::create($stockData);

        return response([
            'message' => 'Data stok masuk berhasil dibuat',
            'data' => $incomingStock
        ]);
    }

    public function show($id){
        $stockHistory = IncomingStock::select(DB::raw('*, DATE_FORMAT(date, "%d-%m-%Y") as dateDisplay'))
                        ->where('medicineID', '=', $id)->get();

        if(!is_null($stockHistory)){
            return response([
                'message' => 'Histori stok obat berhasil ditampilkan',
                'data' => $stockHistory
            ]);
        }
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['incomingStockID'];

        $historyStock = IncomingStock::find($id);

        if(is_null($historyStock)){
            return response([
                'message' => 'Histori stok tidak ditemukan'
            ], 404);
        }

        $validate = Validator::make($updateData, [
            'incomingStockID' => 'required',
            'date' => 'required|date',
            'quantity' => 'required|numeric'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $historyStock->date = $updateData['date'];
        $historyStock->quantity = $updateData['quantity'];

        if($historyStock->save()){
            return response([
                'message' => 'Data histori stok berhasil diubah',
                'data' => $historyStock
            ]);
        }

        return response([
            'message' => 'Data histori stok gagal diubah'
        ], 400);
    }

    public function delete($id){
        $incomingStock = IncomingStock::find($id);

        $medicine = Medicine::find($incomingStock->medicineID);
        $medicine->supply = $medicine->supply - $incomingStock->quantity;
        $medicine->save();

        if(is_null($incomingStock)){
            return response([
                'message' => 'Histori stok tidak dapat ditemukan'
            ], 404);
        }

        if($incomingStock->delete()){
            return response([
                'message' => 'Histori stok berhasil dihapus'
            ], 200);
        }else{
            return response([
                'message' => 'Histori stok gagal dihapus'
            ], 404);
        }
    }
}
