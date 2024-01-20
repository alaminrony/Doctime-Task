<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserCsvProcess implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data   = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {

        foreach ($this->data as $userData) {
            // $userData = array_combine($headerArr, $user);

            $user = new User;
            // $user->user_id = (int) $userData[0];
            $user->email            = $userData[1];
            $user->name             = $userData[2];
            $user->date_of_birth    = date('Y-m-d H:i:s',strtotime($userData[3]));
            $user->birth_year       = date('Y',strtotime($userData[3]));
            $user->birth_month      = date('m',strtotime($userData[3]));
            $user->phone            = $userData[4];
            $user->ip               = $userData[5];
            $user->country          = $userData[6];
            $user->save();
        }
    }


}
