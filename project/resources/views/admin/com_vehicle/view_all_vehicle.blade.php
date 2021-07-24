<x-admin-master>


@section('content')
<div class="row">
  <div class="col-sm-6">
    <form method="post" action="{{route('company_vehicle.store')}}">
    @csrf
    <div class="form-group">
        <label for="title"><b>Register New Vehicle</b></label>
        <input type="text" class="form-control" name="vehicle_number" style="width:30%" id="title" aria-describedby="" placeholder="Enter New RFID" required>
        <input type="hidden" name="status" value="out" >
            
    </div>
    <button type="submit" class="btn btn-success btn-sm">Add</button>
    </form>
  </div>
 
</div>


<div class="row">
  <div class="col-sm-6">
  <h5> Vehicle</h5>
    <table class="table table-blue table-striped">
    <thead>
      <tr>

        
        <th scope="col">Vehicle Number</th>
        <th scope="col">Date</th>
        <th scope="col">Delete</th>

      
        
      </tr>
    </thead>
    <tbody>
    @foreach($vehicles as $vehicle)
      <tr>
      <!-- @method('DELETE') -->
        
        <td>{{ $vehicle->vehicle_number }}</td>
        <td>{{ $vehicle->created_at}}</td>
      
        
        <form method="post" action="{{route('company_vehicle.destroy', $vehicle->id)}}">
          @csrf
          @method('DELETE')
          <td><input type="submit" class="btn btn-danger btn-sm" value="Delete"></td>
          
        </form>
      
        

      </tr>
      @endforeach
    </table>
  </div>

</div>        



@endsection
</x-admin-master>