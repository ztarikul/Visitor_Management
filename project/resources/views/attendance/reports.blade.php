<x-admin-master>


@section('content')


<!-- Blog Post -->


<table class="table table-blue table-striped">
<thead>
<tr>
<th scope="col">User ID</th>
<th scope="col">Name</th>
<th scope="col">Token Status</th>
<th scope="col">Date</th>
<th scope="col">Time</th>
<th scope="col">Comment</th>
<th scope="col"></th>
</tr>
</thead>
<tbody>

    <tr>
    @foreach($users as $user)
      <td>{{$user->user_ref_id}}</td>
      <?php
        $attendant = App\Models\User::where('user_ref_id', $user->user_ref_id)->first();

      ?>
      <td>{{$attendant->name}}</td>
      <td>{{$user->token_status}}</td>
      <td>{{$user->date}}</td>
      <td>{{$user->time}}</td>
      <td>{{$user->comment}}</td>
        <!-- Button trigger modal -->
    
    @endforeach   
    </tr>
  

</tbody>
</table>

@endsection
</x-admin-master>