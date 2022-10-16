<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PatientMedicalRecord;
use App\Queue;
use App\Patient;
use App\Payment;
use Illuminate\Support\Facades\DB;

class PrescriptionQueueController extends Controller
{
    //
    public function getPrescriptionQueue(){
        $medRecord = PatientMedicalRecord::where('isDone', '!=', 1)->get();

        foreach($medRecord as $m){
            $m->patient->queues;
            $m->payment;
            foreach($m->prescriptions as $p){

            }
        }

        return response([
            'data' => $medRecord
        ]);
    }

    public function servePrescription($id){
        $medicalRecord = PatientMedicalRecord::find($id);

        $payment = Payment::where('medicalRecordID', $medicalRecord->medicalRecordID)->first();

        $queue = DB::table('queues')
                 ->join('patients', 'queues.patientID', '=', 'patients.patientID')
                 ->join('patient_medical_records', 'patient_medical_records.patientID', '=', 'patients.patientID')
                 ->where('patient_medical_records.medicalRecordID', '=', $id)
                 ->update(['status' => 'Selesai']);

        if($payment->isPaid == 0){
            return response([
                'message' => 'Tagihan pemeriksaan belum dibayar'
            ], 404);
        }else{
            $medicalRecord->isDone = 1;
            $medicalRecord->save();

            return response([
                'message' => 'Resep obat berhasil diselesaikan',
                'data' => $queue
            ]);
        }

    }
}
