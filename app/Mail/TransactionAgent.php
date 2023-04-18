<?php

namespace App\Mail;

use App\Models\Transection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TransactionAgent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $transaction;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Transection $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Test Mail')->view('emails.transaction')->with(['transaction' => $this->transaction]);
    }
}
