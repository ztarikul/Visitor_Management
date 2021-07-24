<x-admin-master>
    @section('content')

            <div class="card mb-4">
                <h4>Vehicle Number : {{$vehicle->vehicle_number}} </h4>
                <h5>Driver Name : {{$vehicle->driver_name}} </h5>
                <h5>Phone Number : {{$vehicle->phone_number}} </h5>
                <h5>Carrying Item : {{$vehicle->carr_item}} </h5>
                <h5>Purpose : {{$vehicle->purpose}} </h5>
                <h5>Vehicle RFID : {{$vehicle->vehicle_rfid}} </h5>
                <h5>Time : {{$vehicle->created_at}} </h5>
    
                <img class="card-img-top" src="" width="200" height="200" alt="Card image cap">

            </div>


    @endsection
</x-admin-master>