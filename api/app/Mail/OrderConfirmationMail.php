<?php

namespace App\Mail;

use App\Application\DTOs\OrderDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public OrderDTO $orderDTO;

    public function __construct(OrderDTO $orderDTO)
    {
        $this->orderDTO = $orderDTO;
    }

    public function build()
    {
        return $this->view('emails.order_confirmation')
            ->with([
                'order' => $this->orderDTO,
            ]);
    }
}
