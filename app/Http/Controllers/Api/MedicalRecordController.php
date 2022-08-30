<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\PatientMedicalRecord;
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

            }
        }

        return response([
            'data' => $medicalRecord
        ]);
    }

    public function update(Request $req){
        $updateData = $req->all();

        $id = $updateData['medicalRecordID'];

        $medicalRecord = PatientMedicalRecord::find($id);

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
            'treatments' => 'required'
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
        // $arrPrescription = [];

        foreach($updateData['illnessess'] as $ill){
            $arrIllness[] = $ill['illnessID'];
        }

        foreach($updateData['treatments'] as $treatment){
            $arrTreatment[] = $treatment['treatmentID'];
        }

        foreach($updateData['prescriptions'] as $prescription){
            $arrPrescription[] = $prescription;
        }

        $medicalRecord->illnessess()->sync($arrIllness);
        $medicalRecord->treatments()->sync($arrTreatment);
        $medicalRecord->prescriptions()->sync($arrPrescription);
        
        if($medicalRecord->save()){
            return response([
                'message' => 'Update medical record successful',
                'data' => $medicalRecord,
                'illness' => $updateData['illnessess'],
                'treatment' => $updateData['treatments'],
                'prescription' => $arrPrescription
            ]);
        }

        return response([
            'message' => 'update medical record failed'
        ], 400);
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
