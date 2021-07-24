<x-admin-master>


@section('content')


<!-- Blog Post -->


<table class="table table-blue table-striped">
<thead>
<tr>

<th scope="col">Vehicle Number</th>
<th scope="col">Driver Name</th>
<th scope="col">Phone Number</th>
<th scope="col">Image</th>
<th scope="col">RFID</th>
<th scope="col">In Time</th>
<th scope="col">Out Time</th>
<th scope="col">Details</th>
</tr>
</thead>
<tbody>

    <tr>
    @foreach($vehicles as $vehicle)
      <td>{{$vehicle->vehicle_number}}</td>
      <td>{{$vehicle->driver_name}}</td>
      <td>{{$vehicle->phone_number}}</td>
        <!-- Button trigger modal -->
     
      <td><img  class="zoom" width="50" height="50" src="/storage/{{$vehicle->vehicle_image}}"></td>

    <td>{{$vehicle->vehicle_rfid}}</td>
     
     <?php

      $rfid = App\Models\Rfid_assign::where('vehicle_id', $vehicle->id)->first();
    

     ?>
     
    <td>{{$rfid->in_time}}</td>
    <td>{{$rfid->out_time}}</td>
    <td><a href="{{route('vehicle.show', $vehicle->id)}}" class="btn btn-warning btn-sm">Details</a></td>
    </tr>
  @endforeach   

</tbody>
</table>

@endsection
</x-admin-master>