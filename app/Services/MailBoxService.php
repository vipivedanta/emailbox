<?php 

namespace App\Services;

use App\Contracts\Repositories\Mailbox\MailBoxContract;

class MailBoxService {

    public function __construct()
    {
        //$this->mailBox = $mailBox;
    }

    public function getMailBox()
    {   
        dd(1);
        //return $this->mailBox->getMailBox();
    }
}