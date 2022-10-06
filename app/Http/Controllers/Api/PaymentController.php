<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\PatientMedicalRecord;
use Illuminate\Http\Request;
use App\Payment;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class PaymentController extends Controller
{
    //
    public function show(){
        $date = Carbon::now()->format('Y-m-d');

        $paymentList = Payment::where('isPaid', 0)->get();

        foreach($paymentList as $p){
            $p->medicalRecord->patient->queues;
        }

        return response([
            'data' => $paymentList
        ]);
    }

    public function showDetail($id){
        $payment = Payment::find($id);

        $payment->medicalRecord->prescriptions;
        $payment->medicalRecord->treatments;
        $payment->medicalRecord->patient->queues;

        return response([
            'data' => $payment
        ]);
    }

    public function update(Request $req){
        $paymentData = $req->all();

        $id = $paymentData['paymentID'];

        $validate = Validator::make($paymentData, [
            'method' => 'required',
            'paymentID' => 'required'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $payment = Payment::find($id);

        $uuid = IdGenerator::generate(['table' => 'payments', 'field' => 'paymentCode','length' => 12, 'prefix' => date('dmy', strtotime($payment->date))]);

        $payment->method = $paymentData['method'];
        $payment->paymentCode = $uuid;
        $payment->isPaid = 1;

        if($payment->save()){
            return response([
                'message' => 'Pembayaran berhasil',
                'data' => $payment
            ]);
        }else{
            return response([
                'message' => 'Pembayaran gagal'
            ], 400);
        }
    }

    public function printBill($id){
        $payment = Payment::find($id);
        $payment->medicalRecord;
        $payment->medicalRecord->prescriptions;
        $payment->medicalRecord->treatments;

        $pdf = PDF::loadview('invoicePDF', ['payment' => $payment, 
                                            'prescriptions' => $payment->medicalRecord->prescriptions, 
                                            'treatments' => $payment->medicalRecord->treatments 
                                           ]);
        return $pdf->download('invoice.pdf');
    }

}
