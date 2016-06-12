<?php

namespace App\Listeners;

use App\Events\ComplainCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailComplainCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ComplainCreated  $event
     * @return void
     */
    public function handle(ComplainCreated $event)
    {
        //dapatkan nama pengadu

        $complain_from = $event->complain->user->name;

        //dapatkan emel pengadu

        $complain_from_email = $event->complain->user->email;

        //dapatkan maklumat complain (mesej, tarikh, dll)

        $complain_description = $event->complain->complain_description;

        //dapatkan status complain

        $complain_status = $event->complain->complain_status->description;

        //send email to ICT helpdesk

        $helpdesk_email = 'cyberflyx@gmail.com';

        $data = [
                'complain_from'=>$complain_from,
                'complain_from_email'=>$complain_from_email,
                'helpdesk_email'=>$helpdesk_email,
                'complain_status'=>$complain_status,
                'complain_description'=>$complain_description,
                ];

        Mail::queue('email.complain_created', $data, function ($message) use ($data,$complain_from_email,$helpdesk_email,$complain_from) {

            $message->from($complain_from_email, $complain_from);

            $message->to($helpdesk_email, 'ICT Helpdesk')->subject('Aduan baru diterima!');
        });

    }
}
