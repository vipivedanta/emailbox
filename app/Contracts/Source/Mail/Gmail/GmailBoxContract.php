<?php 

namespace App\Contracts\Source\Mail\Gmail;

use App\Contracts\Source\Mail\MailBoxContract;
use Webklex\PHPIMAP\Clientmanager;
use App\Contracts\Repositories\Mail\MailRepositoryContract;
use Exception;
use App\Services\MailBoxService;

class GmailBoxContract implements MailBoxContract {

    /**
     * Construct
     */
    public function __construct( Clientmanager $cm, MailRepositoryContract $mailModel)
    {
        
        // $mailBox = $mailBoxService->getMailBox();
        // dd($mailBox);
        
        $client = $cm->make([
            'host'          => 'imap.googlemail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => false,
            'protocol'      => 'imap',
            'username'      => 'username@gmail.com',
            'password'      => 'app_password' //not regular password
        ]);
        $this->mail = $client->connect();

        $this->mailModel = $mailModel;
    }

    /**
     * Sync
     */
    public function sync()
    {
       
        try {
            $folders = $this->mail->getFolders();
            foreach($folders as $folder) {
                $messages = $folder->query()->since('17.10.2020')->get();
                foreach($messages as $message) {
                    $data = [
                        'uuid' => $message->getUid(),
                        'subject' => $message->getSubject(),
                        'from' => $message->getFrom()[0]->mail,
                        'body' => $message->getHTMLBody(),
                        'received_on' => $message->getDate(),
                        'message_obj' => serialize($message)
                    ];

                    $this->mailModel->save($data);
                }
            }    
        } catch ( Exception $e ) {
            return false;
        }     
    }

    /**
     * Delete mail
     */
    public function deleteMail($uid)
    {   
        try {

            $email = $this->mailModel->getEmail($uid);
            $message = unserialize($email->message_obj);
            $var = $message->delete();
            
            $this->mailModel->deleteMail($uid);

        } catch ( Exception $e ) {
            dd($e);
        }
    }
    
}