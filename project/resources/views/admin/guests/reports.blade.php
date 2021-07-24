<x-admin-master>


@section('content')


<!-- Blog Post -->


<table class="table table-blue table-striped">
<thead>
<tr>

<th scope="col">Name</th>
<th scope="col">Refer Name</th>
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
    @foreach($guests as $guest)
      <td>{{$guest->name}}</td>
      <td>{{$guest->user_name}}</td>
      <td>{{$guest->phone_number}}</td>
        <!-- Button trigger modal -->
     
      <td><img  class="zoom" width="50" height="50" src="/storage/{{$guest->guest_image}}"></td>

    <td>{{$guest->guest_rfid}}</td>
     
     <?php

      $rfid = App\Models\Rfid_assign::where('guest_id', $guest->id)->first();
    

     ?>
     
    <td>{{$rfid->in_time}}</td>
    <td>{{$rfid->out_time}}</td>
    <td><a href="{{route('guest.show', $guest->id)}}" class="btn btn-warning btn-sm">Details</a></td>
    </tr>
  @endforeach   

</tbody>
</table>

@endsection
</x-admin-master>