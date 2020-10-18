@extends('layouts.app')

@section('content')

    <div class="row justify-content-md-center">
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item">From : {{ $email->mail_from }}</li>
                <li class="list-group-item">Received on : {{ date('d M,Y h:i A',strtotime($email->mail_received_on)) }}</li>
                <li class="list-group-item"><a href="{{ route('emails.index')}}" class="btn btn-warning">See inbox</a></li>                
            </ul>
        </div>
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-12">
                    <h2>Sub : {{$email->subject}}</h2>
                </div>                
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-4">
                        <form method="post" action="{{ route('emails.destroy',$email->mail_uuid)}}" onClick="return confirm('Do you want to delete this mail?')">
                            @csrf 
                            @method('DELETE')
                            <input type="submit" class="btn btn-sm btn-danger" value="Delete" />
                        </form>
                    </div>

                    {!! $email->content !!}
                </div>
            </div>
            
            
        </div>
    </div>

@endsection