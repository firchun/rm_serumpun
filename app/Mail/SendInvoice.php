<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Tagihan ' . env('APP_NAME'))->view('emails.tagihan');
    }

    // Uncomment the following methods if needed

    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Send Invoice',
    //     );
    // }

    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    // public function attachments()
    // {
    //     return [];
    // }
}
