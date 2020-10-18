@extends('layouts.app')

@section('content')

    <div class="row justify-content-md-center">
        <div class="col-md-12">
                    @include('layouts.message')

                    @include('emails.web.filter_bar')

                    <table class="table table-condensed table-striped table-bordered">
                    <thead>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Received On</th>
                        <th colspan="2">Actions</th>
                    </thead>
                    <tbody>
                        @if(empty($emails))
                        <tr><td colspan="3"><span class="alert alert-danger">No mails found</span></td></tr>
                        @else 

                        @foreach($emails as $email)
                        <tr>
                            <td>{{ $email->mail_from }}</td>
                            <td>{{ substr($email->subject,0,70).'..' }}</td>
                            <td>{{ date('d/m/Y h:i A',strtotime($email->mail_received_on)) }}</td>
                            <td>
                                <a href="{{ route('emails.show',$email->mail_uuid) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                            <td>
                                <form method="post" method="post" action="{{ route('emails.destroy', $email->mail_uuid) }}" onsubmit="return confirm('Do you want to delete this ?')">
                                    @csrf 
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Delete" />
                                </form>
                            </td>                            
                        </tr>
                        @endforeach

                        @endif
                    </tbody>
                    </table>

                    {{ $emails->links() }}
        </div>
    </div>

@endsection