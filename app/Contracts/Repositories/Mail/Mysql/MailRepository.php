<?php 

namespace App\Contracts\Repositories\Mail\Mysql;

use App\Contracts\Repositories\Mail\MailRepositoryContract;
use App\Models\Inbox\Email;
use Exception;
use Session;

class MailRepository implements MailRepositoryContract {

    /**
     * Save the mail record to table
     */
    public function save($data)
    {
        try {
            
            Email::updateOrCreate(
                [
                    'mail_uuid' => $data['uuid']
                ],
                [
                    'mail_uuid' => $data['uuid'],
                    'mail_from' => $data['from'],
                    'subject' => $data['subject'],
                    'content' => $data['body'],
                    'mail_received_on' => $data['received_on'],
                    'message_obj' => $data['message_obj']
                ]
            );

            return true;

        } catch ( Exception $e ) {
            return false;
        }
    }

    /**
     * Get emails
     */
    public function getEmails()
    {   
        $from_filter = Session::get('from_filter');
        $subject_filter = Session::get('subject_filter');

        return Email::orderBy('created_at','desc')
        ->when( $from_filter != null && $from_filter != '', function($query) use ( $from_filter ){
            return $query->where('mail_from','like',"%$from_filter%");
        })
        ->when( $subject_filter != null && $subject_filter != '', function($query) use ( $subject_filter ){
            return $query->where('subject','like',"%$subject_filter%");
        })
        ->paginate(10);
    }

    /**
     * Delete email
     */
    public function deleteMail( $uuid )
    {
        Email::where('mail_uuid',$uuid)->delete();
    }

    /**
     * Get Email by UID
     */
    public function getEmail( $uid )
    {
        return Email::where('mail_uuid',$uid)->first();
    }
    
    
}