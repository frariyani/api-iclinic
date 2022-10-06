<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Queue;
use Carbon\Carbon;
use PDF;

class QueueController extends Controller
{
    public function store(Request $req){
        $queueData = $req->all();

        $validate = Validator::make($queueData, [
            'patientID' => 'required'
        ]);

        $date = Carbon::now()->format('Y-m-d');

        if(Queue::where('patientID', $queueData['patientID'])->where('status', '!=', 'Selesai')->where('date', $date)->exists()){
            return response([
                'message' => 'Pasien sudah terdaftar'
            ], 400);
        }else{
        
            $storedQueue = Queue::where('date', $date)->withTrashed()->get();
    
            $countQueue = count($storedQueue);
    
            $queueNumber = $countQueue+1;
    
            $queueData['date'] = $date;
            $queueData['queueNumber'] = $queueNumber;
    
            $queue = Queue::create($queueData);
    
            return response([
                'data' => $queue,
                'message' => 'Antrian berhasil dibuat'
            ]);
        }
    }

    public function show(){
        $date = Carbon::now()->format('Y-m-d');

        $queue = Queue::query()
                 ->with(['patient' => function($query){
                    $query->select('*');
                 }])
                 ->where('date', $date)
                 ->where('status', 'Menunggu')
                 ->get();
            
        $otherQueue = Queue::query()
                      ->with(['patient' => function($query){
                        $query->select('*');
                      }])
                      ->where('date', $date)
                      ->where('status', 'Sedang Diperiksa')
                      ->get();

        if(!is_null($queue)){
            return response([
                'data' => $queue,
                'data2' => $otherQueue
            ]);
        }else{
            return response([
                'data' => null
            ]);
        }
    }

    public function updateToOnProgress($id){
        $queue = Queue::find($id);

        $queue->status = 'Sedang Diperiksa';

        if($queue->save()){
            return response([
                'message' => 'Pasien berhasil dipanggil',
                'data' => $queue
            ]);
        }else{
            return response([
                'message' => 'Pasien tidak dapat dipanggil'
            ]);
        }
    }

    public function updateToWaiting($id){
        $queue = Queue::find($id);

        $queue->status = 'Menunggu';

        if($queue->save()){
            return response([
                'message' => 'Berhasil membatalkan antrian',
                'data' => $queue
            ]);
        }else{
            return response([
                'message' => 'Gagal membatalkan antrian'
            ]);
        }    
    }

    public function updateToChecked($id){
        $patientID = $id;
        $queue = Queue::where('patientID', $patientID)->where('status', '!=', 'Selesai')->latest('created_at')->first();
        $queue->status = 'Selesai Diperiksa';
        $queue->save();

        return response([
            'data' => $queue
        ]);
    }

    public function updateToWaitMedicine($id){
        $patientID = $id;
        $queue = Queue::where('patientID', $patientID)->where('status', '!=', 'Selesai')->latest('created_at')->first();
        $queue->status = 'Menunggu Obat';
        $queue->save();

        return response([
            'data' => $queue
        ]);
    }

    public function delete($id){
        $queue = Queue::find($id);

        if($queue->delete()){
            return response([
                'message' => 'Data antrian berhasil dihapus',
                'data' => $queue
            ]);
        }else{
            return response([
                'message' => 'Data antrian gagal dihapus'
            ]);
        }
    }

    public function print($id){
        $queue = Queue::find($id);
        $queue->patient; 

        $size = array(0,0,200,250);
        $pdf = PDF::loadview('queueCard', ['noAntrian' => $queue->queueNumber, 
                                           'namaPasien' => $queue->patient->fullname, 
                                           'noRM' => $queue->patient->medicalRecordNumber
                                          ],  
               )->setPaper($size, 'landscape');
        return $pdf->download('queue.pdf');
    }
}
