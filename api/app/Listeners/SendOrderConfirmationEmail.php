<?php

namespace App\Listeners;

use App\Events\OrderRegistered;
use App\Mail\OrderConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderConfirmationEmail implements ShouldQueue
{
    private $mailer;
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }


    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderRegistered  $event
     * @return void
     */
    public function handle(OrderRegistered $event)
    {
        $orderDTO = $event->orderDTO;

        $email = new OrderConfirmationMail($orderDTO);

        $this->mailer->to($orderDTO->userEmail)->send($email);
    }
}
