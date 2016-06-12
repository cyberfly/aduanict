<?php

namespace App\Listeners;

use App\Events\ComplainAssignStaff;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailComplainAssignStaff
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
     * @param  ComplainAssignStaff  $event
     * @return void
     */
    public function handle(ComplainAssignStaff $event)
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

        $email_view = 'email.complain_helpdesk_action_agihan_teknikal';
        $subject = 'Anda telah di agihkan ADUAN oleh Unit Manager';

        $unit_manager_name = $event->complain->kod_unit->unit_manager->name;
        $unit_manager_email = $event->complain->kod_unit->unit_manager->email;

        $email_from = $unit_manager_email;
        $email_from_name = $unit_manager_name;

        $assign_staff_name = $event->complain->assign_user->name;
        $assign_staff_email = $event->complain->assign_user->email;

        $email_to = $assign_staff_email;
        $email_to_name = $assign_staff_name;

        $complain_from = $email_to_name;

        $data = [
            'email_from'=>$email_from,
            'email_from_name'=>$email_from_name,
            'email_to_name'=>$email_to_name,
            'email_to'=>$email_to,
            'complain_status'=>$complain_status,
            'action_comment'=>$action_comment,
        ];

        Mail::queue($email_view, $data, function ($message) use ($data,$subject,$email_to,$email_to_name) {

            $message->from($data['email_from'], $data['email_from_name']);

            $message->to($email_to, $email_to_name)->subject($subject);
        });
    }
}
