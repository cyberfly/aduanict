<?php

namespace App\Listeners;

use App\Events\ComplainHelpdeskAction;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailComplainHelpdeskAction
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
     * @param  ComplainHelpdeskAction  $event
     * @return void
     */
    public function handle(ComplainHelpdeskAction $event)
    {
        //dapatkan nama pengadu

        $complain_from = $event->complain->user->name;

        //dapatkan emel pengadu

        $complain_from_email = $event->complain->user->email;

        //dapatkan maklumat complain (mesej, tarikh, dll)

        $action_comment = $event->complain->action_comment;

        //dapatkan status complain

        $complain_status = $event->complain->complain_status->description;

        //send email to ICT helpdesk

        $helpdesk_email = 'cyberflyx@gmail.com';

        if ($event->complain->complain_status_id==3)
        {
            $email_view = 'email.complain_helpdesk_action_sahkanP';
            $subject = 'Aduan telah bertukar status SAHKAN P';
            $email_to = $complain_from_email;
            $email_to_name = $complain_from;
        }
        else if ($event->complain->complain_status_id==5)
        {
            $email_view = 'email.complain_helpdesk_action_tutup';
            $subject = 'Aduan anda telah di tutup';
            $email_to = $complain_from_email;
            $email_to_name = $complain_from;
        }
        else if ($event->complain->complain_status_id==7)
        {
            $email_view = 'email.complain_helpdesk_action_agihan';
            $subject = 'Anda telah di agihkan ADUAN oleh ICT Helpdesk';

            $unit_manager_name = $event->complain->kod_unit->unit_manager->name;
            $unit_manager_email = $event->complain->kod_unit->unit_manager->email;

            $email_to = $unit_manager_email;
            $email_to_name = $unit_manager_name;

            $complain_from = $email_to_name;
        }

        $data = [
            'complain_from'=>$complain_from,
            'complain_from_email'=>$complain_from_email,
            'helpdesk_email'=>$helpdesk_email,
            'complain_status'=>$complain_status,
            'action_comment'=>$action_comment,
        ];

        if ($event->complain->complain_status_id>2)
        {
            Mail::send($email_view, $data, function ($message) use ($data,$subject,$email_to,$email_to_name) {

                $message->from($data['helpdesk_email'], 'ICT Helpdesk');

                $message->to($email_to, $email_to_name)->subject($subject);
            });
        }
    }
}
