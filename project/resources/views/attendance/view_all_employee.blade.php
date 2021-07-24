<x-admin-master>


@section('content')


        <!-- Blog Post -->

        
  <table class="table table-blue table-striped">
  <thead>
    <tr>

      
      <!-- <th scope="col">Name</th> -->
      <th scope="col">Emp ID</th>
      <th scope="col">Token Status</th>
      <th scope="col">Date</th>
      <th scope="col">Time </th>
      <th scope="col">Comments </th>
   
     
      
    </tr>
  </thead>
  <tbody>
  @foreach( $attendances as $attendance)
    <tr>
    <!-- @method('DELETE') -->
      
      <td>{{ $attendance->user_ref_id }}</td>
      <td><button class="btn btn-danger btn-sm">{{ $attendance->token_status}}</button></td>
      <td>{{ $attendance->date}}</td>
      <td>{{ $attendance->time}}</td>

      @if(auth()->user()->userHasRole('Admin'))
      <td>{{ $attendance->comment}}</td>
      
      @endif

      @if(auth()->user()->userHasRole('Manager'))

      <td><a class="btn btn-success btn-sm" href="{{route('attendance.edit', $attendance->id)}}">Comment</a></td>
      
      @endif

  
      

    </tr>
    @endforeach
</table>
@endsection
</x-admin-master>