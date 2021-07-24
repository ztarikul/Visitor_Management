<x-admin-master>


@section('content')
<div class="row">
  <div class="col-sm-6">
    <form method="post" action="{{route('rfid.store')}}">
    @csrf
    <div class="form-group">
        <label for="title"><b>Create New Rfid</b></label>
        <input type="text" class="form-control" name="rfid" style="width:30%" id="title" aria-describedby="" placeholder="Enter New RFID" required>
        <input type="hidden" name="status" value="available" >
            
    </div>
    <button type="submit" class="btn btn-success btn-sm">Add</button>
    </form>
  </div>
  <div class="col-sm-6">
    <form method="post" action="{{route('rfid.return')}}">
    @csrf
  
    <div class="form-group">
      <label for="title"><b>Return Rfid</b></label>
      <input type="text" class="form-control" name="rfid" style="width:30%" id="title" aria-describedby="" placeholder="Enter Given RFID" required>
      <input type="hidden" name="status" value="available" >
          
    </div>
    <button type="submit" class="btn btn-danger btn-sm">Return Back</button>
    </form>
  </div>
</div>


<div class="row">
  <div class="col-sm-6">
    <h5>Available RFIDs</h5>
    <table class="table table-blue table-striped">
    <thead>
      <tr>

        
        <th scope="col">RFID</th>
        <th scope="col">Status</th>
        <th scope="col">Date</th>
        <th scope="col">Delete</th>

      
        
      </tr>
    </thead>
    <tbody>
    @foreach( $available_rfids as $available_rfid)
      <tr>
      <!-- @method('DELETE') -->
        
        <td>{{ $available_rfid->rfid }}</td>
        <td><button class="btn btn-success btn-sm">{{ $available_rfid->status}}</button></td>
        <td>{{ $available_rfid->created_at}}</td>
      
        
        <form method="post" action="{{route('rfid.destroy', $available_rfid->id)}}">
          @csrf
          @method('DELETE')
          <td><input type="submit" class="btn btn-danger btn-sm" value="Delete"></td>
          
        </form>
      
        

      </tr>
      @endforeach
    </table>
  </div>

  <div class="col-sm-6">
  <h5>Busy RFIDs</h5>
    <table class="table table-blue table-striped">
    <thead>
      <tr>

        
        <th scope="col">RFID</th>
        <th scope="col">Status</th>
        <th scope="col">Date</th>
        <th scope="col">Delete</th>

      
        
      </tr>
    </thead>
    <tbody>
    @foreach( $busy_rfids as $busy_rfid)
      <tr>
      <!-- @method('DELETE') -->
        
        <td>{{ $busy_rfid->rfid }}</td>
        <td><button class="btn btn-warning btn-sm">{{ $busy_rfid->status}}</button></td>
        <td>{{ $busy_rfid->created_at}}</td>
      
        
        <form method="post" action="{{route('rfid.destroy', $busy_rfid->id)}}">
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