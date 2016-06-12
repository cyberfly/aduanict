<?php

namespace App\Listeners;

use App\Events\ComplainUserVerify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailComplainUserVerify
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
     * @param  ComplainUserVerify  $event
     * @return void
     */
    public function handle(ComplainUserVerify $event)
    {
        //dapatkan nama pengadu

        $complain_from = $event->complain->user->name;

        //dapatkan emel pengadu

        $complain_from_email = $event->complain->user->email;

        //dapatkan maklumat complain (mesej, tarikh, dll)

        $user_comment = $event->complain->user_comment;

        //dapatkan status complain

        $complain_status = $event->complain->complain_status->description;

        //send email to ICT helpdesk

        $helpdesk_email = 'cyberflyx@gmail.com';

        //dapatkan complain id

        $complain_id = $event->complain->complain_id;

        //if user SAHKAN H
        if ($event->complain->complain_status_id==4)
        {
            $email_view = 'email.complain_user_action_sahkanH';
            $subject = 'Pengadu telah SAHKAN H';
            $email_to = $helpdesk_email;
            $email_to_name = 'ICT Helpdesk';
        }
        else if ($event->complain->complain_status_id==2)
        {
            //if user REJECT dan status go back to TINDAKAN

            $email_view = 'email.complain_user_action_reject';
            $subject = 'Pengadu telah tolak status SAHKAN P kepada TINDAKAN';
            $email_to = $helpdesk_email;
            $email_to_name = 'ICT Helpdesk';
        }

        $data = [
            'complain_id'=>$complain_id,
            'complain_from'=>$complain_from,
            'complain_from_email'=>$complain_from_email,
            'helpdesk_email'=>$helpdesk_email,
            'complain_status'=>$complain_status,
            'user_comment'=>$user_comment,
        ];

        Mail::queue($email_view, $data, function ($message) use ($data,$subject,$email_to,$email_to_name) {

            $message->from($data['complain_from_email'], $data['complain_from']);

            $message->to($email_to, $email_to_name)->subject($subject);
        });
    }
}
