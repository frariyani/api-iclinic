<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PatientMedicalRecord;
use App\Medicine;
use App\Queue;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class MedicalRecordController extends Controller
{
    //
    public function store(Request $req){
        $medicalRecordData = $req->all();

        $validate = Validator::make($medicalRecordData, [
            'date' => 'required|max:255',
            'temperature' => 'numeric',
            'systolic' => 'numeric',
            'diastolic' => 'numeric',
            'patientID' => 'required',
            'illnessess' => 'required',
            'treatments' => 'required',
            'prescriptions' => 'required'
        ]);

        if($validate->fails()){
            return response(['message' => 'Harap mengisi input dengan benar'], 400);
        }

        $medicalRecordData['doctorID'] = Auth::user()->userID;

        foreach(json_decode($medicalRecordData['prescriptions'], true) as $prescription){
            if($prescription['supply'] < $prescription['quantity']){
                return response([
                    'message' => 'Stok obat kurang'
                ], 400);
            }
        }

        //CREATE OBJECT MEDICAL RECORD
        $medicalRecord = PatientMedicalRecord::create($medicalRecordData);

        //UBAH STATUS QUEUE
        $patientID = $medicalRecordData['patientID'];
        $queue = new QueueController;
        $queue->updateToWaitMedicine($patientID);

        //json_decode($medicalRecordData['illnessess'], true) as $ill
        foreach(json_decode($medicalRecordData['illnessess'], true) as $ill){
            $medicalRecord->illnessess()->attach($ill['illnessID']);
        }

        //json_decode($medicalRecordData['treatments'], true) as $treatment
        foreach(json_decode($medicalRecordData['treatments'], true) as $treatment){
            $medicalRecord->treatments()->attach($treatment['treatmentID']);
        }

        foreach(json_decode($medicalRecordData['prescriptions'], true) as $prescription){
            $medicalRecord->prescriptions()->attach($prescription['medicineID'], [
                'dosage' => $prescription['dosage'],
                'quantity' => $prescription['quantity']
            ]);
        }

        return response([
            'message' => 'Rekam medis berhasil dibuat',
            'data' => $medicalRecordData
        ], 200);
    }

    public function show(){
        $medicalRecord = PatientMedicalRecord::query()
                         ->with(['patient' => function($query){
                            $query->select('*');
                         }])
                         ->get();

        if(!is_null($medicalRecord)){
            return response([
                'message' => 'Medical record retrieved successfuly',
                'data' => $medicalRecord
            ]);
        }
    }

    public function showWithIllness($id){
        $medicalRecord = PatientMedicalRecord::query()
                         ->with(['doctor' => function($query){
                            $query->select('userID', 'fullname');
                         }])
                         ->where('patientID', '=', $id)->get();

        foreach($medicalRecord as $med){
            foreach($med->illnessess as $illness){

            } 
        }

        // foreach($medicalRecord as $med){
        //     foreach($med->treatments as $treatment){

        //     }
        // }

        return response([
            'data' => $medicalRecord
        ]);
    }

    public function getMedicalRecordByPatientID($id){
        $medicalRecord = PatientMedicalRecord::query()
                        ->with(['doctor' => function($query){
                        $query->select('userID', 'fullname');
                        }])
                        ->where('patientID', '=', $id)->get();

        //$prescriptions = PatientMedicalRecord::query()
                        //  ->with(['prescriptions' => function($query){
                        //     $query->select('*');
                        //  }])
                        //  ->where('patientID', $id)->get();
        $medicines = Medicine::all();

        foreach($medicalRecord as $med){
            foreach($med->illnessess as $illness){

            } 
        }

        foreach($medicalRecord as $med){
            foreach($med->treatments as $treatment){

            }
        }

        foreach($medicalRecord as $med){
            foreach($med->prescriptions as $pre){
                // echo $pre;
                $prescriptions[] = $pre;
            }
        }

        
        // $newPrescriptions = $medicines->map(function ($m) use ($pre){
        //     $m->dosage = data_get($pre->where('medicineID', $m->medicineID), 'pivot.dosage', 0);

        //     return $m;
        // });

        return response([
            'data' => $medicalRecord
        ]);
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['medicalRecordID'];

        $medicalRecord = PatientMedicalRecord::find($id);
        $storePre = PatientMedicalRecord::find($id)->prescriptions;

        if(is_null($medicalRecord)){
            return response([
                'message' => 'Medical record not found'
            ], 404);
        }else if($medicalRecord->isDone == 1){
            return response([
                'message' => 'Can not update medical record'
            ]);
        }

        $validate = Validator::make($updateData, [
            'date' => 'required|max:255',
            'temperature' => 'numeric',
            'systolic' => 'numeric',
            'diastolic' => 'numeric',
            'medicalRecordID' => 'required',
            'illnessess' => 'required',
            'treatments' => 'required',
            'prescriptions' => 'required'
        ]);

        if($validate->fails()){
            return response(['message' => $validate->errors()], 400);
        }

        $medicalRecord->date = $updateData['date'];
        $medicalRecord->temperature = $updateData['temperature'];
        $medicalRecord->systolic = $updateData['systolic'];
        $medicalRecord->diastolic = $updateData['diastolic'];

        $arrIllness = [];
        $arrTreatment = [];
        $arrPrescription = [];

        foreach($updateData['illnessess'] as $ill){
        // foreach(json_decode($updateData['illnessess'], true) as $ill){
            $arrIllness[] = $ill['illnessID'];
        }

        foreach($updateData['treatments'] as $treatment){
        // foreach(json_decode($updateData['treatments'], true) as $treatment){
            $arrTreatment[] = $treatment['treatmentID'];
        }
        
        foreach($storePre as $sp){
            $medicalRecord->prescriptions()->updateExistingPivot($sp['medicineID'], ["status" => false]);
            $medicalRecord->prescriptions()->detach($sp['medicineID']);
        }

        foreach($updateData['prescriptions'] as $prescription){
        // foreach(json_decode($updateData['prescriptions'], true) as $prescription){
            $arrPrescription[] = $prescription;
            $medicalRecord->prescriptions()->attach([$prescription['medicineID'] => ["quantity" => $prescription['quantity'], "dosage" => $prescription['dosage']]]);
        }

        $medicalRecord->illnessess()->sync($arrIllness);
        $medicalRecord->treatments()->sync($arrTreatment);
        
        // foreach($arrPrescription as $p){
        //     // $medicalRecord->prescriptions()->sync($arrPrescription);
        //     $medicalRecord->prescriptions()->attach([$p['medicineID'] => ["quantity" => $p['quantity'], "dosage" => $p['dosage']]]);
        // }
        
        if($medicalRecord->save()){
            return response([
                'message' => 'Update medical record successful',
                'data' => $medicalRecord,
                'storePre' => $storePre,
                'illness' => $updateData['illnessess'],
                'treatment' => $updateData['treatments'],
                'prescription' => $updateData['prescriptions']
            ]);
        }

        return response([
            'message' => 'update medical record failed'
        ], 400);
    }

    public function setIsDone($id){
        $medicalRecord = PatientMedicalRecord::find($id);

        $medicalRecord->isDone = 1;

        if($medicalRecord->save()){
            return response([
                'message' => 'Status rekam medis menjadi selesai',
                'data' => $medicalRecord
            ]);
        }else{
            return response([
                'message' => 'Status rekam medis tidak dapat diubah'
            ], 400);
        }
    }

    public function delete($id){
        $medicalRecord = PatientMedicalRecord::find($id);

        if(is_null($medicalRecord)){
            return response([
                'message' => 'Medical record table is empty'
            ], 404);
        }

        if($medicalRecord->delete()){
            return response([
                'message' => 'Rekam medis berhasil dihapus',
                'data' => $medicalRecord
            ], 200);
        }

        return response([
            'message' => 'Rekam medis gagal dihapus'
        ], 400);
    }
}
