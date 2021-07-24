<x-admin-master>
    @section('content')
    <h3>Create New Role</h3>

    <form action="{{route('attendance.update', $attendance->id)}}" method="post">
    @csrf 
    @method('PATCH')


   <div class="form-group">
    <label for="title">Comments</label>
        <input type="text" style="width:30%" name="comment" value="{{$attendance->comment}}"  class="form-control" id="name" aria-describedby="" placeholder="Enter Comments">
        
   </div>

    
        <button type="submit" class="btn btn-primary">Submit</button> 
    </form>


    @endsection
</x-admin-master>