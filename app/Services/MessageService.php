<?php 

namespace App\Services;

use Session;

class MessageService {

    /**
     * Set message
     */
    public function setSuccessMessage( $message )
    {
        Session::put('success', $message);
    }
}