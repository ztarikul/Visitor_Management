<x-admin-master>
@section('content')
<h1 style="color:blue">VEHICLE REPORT</h1>

@if(auth()->user()->userHasRole('Admin'))

<form  method="post" action="{{route('vehicle_report.generates')}}">
@csrf
<div class="form-group" style="color:black;">
<label for="title"><b>Vehicle</b></label>
<select id="employee" name="vehicle_search" style="width:42%">
       <option value="all">All</option>
       <option value="single">Single</option>
</select>
</div>


<div class="form-group" style="color:black;">
<label for="title"><b>Vehicle Number (for single search)</b></label>
<input type="text"  style="width:50%" class="form-control" name="vehicle_number" id="title" aria-describedby="" placeholder="Enter id">
</div>

<div class="form-group" style="color:black;">
<label for="title"><b>From</b></label>
<input type="date" style="width:50%" class="form-control" name="from_date" id="title" aria-describedby="" placeholder="date">
</div>

<div class="form-group" style="color:black;">
<label for="title"><b>To</b></label>
<input type="date" style="width:50%" class="form-control" name="To_date" id="title" aria-describedby="" placeholder="date">
</div>

<div class="wsite-form-radio-container">

<label class="wsite-form-label" style="width: 100%; color:blue">Please submit</label><br>
<input type="submit" name="submit" value="Submit" class="btn btn-primary">

</div>



</form>

@endif


@endsection 

</x-admin-master>


