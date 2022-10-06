<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Queue;

class QueueDone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:done';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $queues = Queue::all();

        foreach($queues as $queue){
            $queue->status = 'Selesai';
            $queue->save();
        }

        return info('Berhasil mengubah status antrian');
    }
}
