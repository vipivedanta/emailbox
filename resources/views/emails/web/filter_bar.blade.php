<form method="post" action="{{ url('filter-emails') }}">
<div class="row">
    
        @csrf 
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" class="form-control" name="from" placeholder="Mail from" @if(Session::has('from_filter')) value="{{ Session::get('from_filter')}}" @endif />
            </div>            
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="Subject" @if(Session::has('subject_filter')) value="{{ Session::get('subject_filter')}}" @endif />
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <input type="submit" class="btn btn-info" value="Filter" />
                <a href="{{ url('reset-filter-emails') }}" class="btn btn-danger">Clear</a>
            </div>
        </div>      
    
</div>
</form>