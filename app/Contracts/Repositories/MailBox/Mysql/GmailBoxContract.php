<?php 

namespace App\Contracts\Repositories\MailBox\Mysql;

use App\Contracts\Repositories\Mailbox\MailBoxContract;
use App\Models\Inbox\MailBox;

class GmailBoxContract implements MailBoxContract {

    public function getMailBox()
    {
        return MailBox::first();
    }
}