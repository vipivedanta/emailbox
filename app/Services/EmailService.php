<?php 

namespace App\Services;

use App\Contracts\Source\Mail\MailBoxContract;
use App\Contracts\Repositories\Mail\MailRepositoryContract;

class EmailService {

    public function __construct( MailBoxContract $mailBoxContract, MailRepositoryContract $mailModel)
    {
        $this->mail = $mailBoxContract;
        $this->mailModel = $mailModel;
    }


    /**
     * @param void
     * @return null
     * Sync Emails 
     */
    public function syncEmail()
    {
        $this->mail->sync();
    }

    /**
     * Get all emails
     */
    public function getMails()
    {
        return $this->mailModel->getEmails();
    }

    /**
     * Delete a mail
     */
    public function deleteMail($uuid)
    {
        $this->mail->deleteMail( $uuid );
    }

    /**
     * Get email by UID
     */
    public function getEmail( $uid )
    {
        return $this->mailModel->getEmail( $uid );
    }


}