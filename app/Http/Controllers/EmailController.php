<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use App\Services\EmailService;
use App\Services\MessageService;
use Session;


class EmailController extends Controller
{
    
    public function __construct(MessageService $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, EmailService $emailService)
    {
        try {
            
            $emails = $emailService->getMails();
            return view('emails.web.list')
                ->with('emails', $emails);

        } catch ( Exception $e ) {
            dd($e);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, EmailService $emailService)
    {
        $email = $emailService->getEmail($id);

        if($email == null)
            return abort(404);

        return view('emails.web.single')
        ->with('email',$email)
        ->with('title',substr($email->subject,9,50));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmailService $emailService, $uid)
    {   

        $emailService->deleteMail($uid);
        $this->messageService->setSuccessMessage('Mail has been deleted successfully');
        return redirect('emails');
    }

    /**
     * Set filter for emails
     */
    public function setFilter( Request $request )
    {
        Session::put('from_filter',$request->from);
        Session::put('subject_filter', $request->subject);
        return redirect('emails');
    }

    /**
     * Reset filters for emails
     */
    public function resetFilters()
    {
        Session::forget('from_filter');
        Session::forget('subject_filter');
        return redirect('emails');
    }
}
