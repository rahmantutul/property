<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionAgent extends Mailable
{
    use Queueable, SerializesModels;

    protected $transaction_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Test Mail')->view('emails.transaction')->with(['transaction_id' => $this->transaction_id]);
    }
}
