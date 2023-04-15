<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class TransactionAgentMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mail;
    protected $transaction_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($mail, $transaction_id)
    {
        $this->mail = $mail;
        $this->transaction_id = $transaction_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->mail)->send(new \App\Mail\TransactionAgent($this->transaction_id));
    }
}
