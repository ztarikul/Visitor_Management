<x-admin-master>
@section('content')
<h1 style="color:blue">TRUNCATE FORM</h1>

@if(auth()->user()->userHasRole('SuperAdmin'))

<form  method="post" action="{{route('attendance.truncate')}}" >
@csrf


<div class="form-group" style="color:black;">
<label for="title"><b>From</b></label>
<input type="date" style="width:50%" class="form-control" name="from_date" id="title" aria-describedby="" placeholder="date">
</div>

<div class="form-group" style="color:black;">
<label for="title"><b>To</b></label>
<input type="date" style="width:50%" class="form-control" name="to_date" id="title" aria-describedby="" placeholder="date">
</div>

<div class="wsite-form-radio-container">

<label class="wsite-form-label" style="width: 100%; color:blue">Please submit</label><br>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>



</form>

@endif


@endsection 

</x-admin-master>


