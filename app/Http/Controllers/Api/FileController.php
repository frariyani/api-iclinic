<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\File as PatientFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    //
    public function store(Request $req){
        $fileData = $req->all();

        $validate = Validator::make($fileData, [
            'URL' => 'required|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:10240',
            'patientID' => 'required'
        ]);

        if($validate->fails()){
            return response(['message' => 'Format file: jpeg, png, jpg, pdf, doc, atau docx'], 400);
        }

        if(!is_null($req->file('URL'))){
            $file = $req->file('URL');
            

            if($fileData['title'] != null){
                $fileName = time()."_".$fileData['patientID']."_".$fileData['title'].".".$file->getClientOriginalExtension();
            }else{
                $fileName = time()."_".$fileData['patientID']."_".$file->getClientOriginalName();
                $fileData['title'] = $file->getClientOriginalName();
            }

            $folder = 'patient_'.$fileData['patientID'];
            $file->move($folder, $fileName);

        }

        $fileNew = new PatientFile();
        $fileNew->patientID = $fileData['patientID'];
        $fileNew->title = $fileData['title'];
        $fileNew->URL = $fileName;

        $fileNew->save();

        return response([
            'message' => 'File berhasil disimpan',
            'data' => $fileNew
        ]);
    }

    public function getFiles($id){
        $files = PatientFile::where('patientID', $id)->get();

        return response([
            'data' => $files
        ]);
    }

    public function deleteFile($id){
        $file = PatientFile::find($id);

        $filePath = 'patient_'.$file->patientID.'/'.$file->URL;
        if(File::exists($filePath)){
            File::delete($filePath);
        }else{
           return response([
            'message' => 'File tidak ditemukan'
           ]);
        }

        $file->delete();

        return response([
            'message' => 'File berhasil dihapus'
        ]);
    }

    public function getDownload($id){
        $file = PatientFile::find($id);
        $filePath = 'patient_'.$file->patientID.'/'.$file->URL;
        $headers = array('Content-Type: application/pdf');
        return Response::download($filePath, $file->url, $headers);

    }


}
