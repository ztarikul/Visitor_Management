<x-admin-master>
    @section('content')

            <div class="card mb-4">
                <img class="card-img-top" src="storage/{{$guest->guest_image}}" width="200" height="200" alt="Card image cap">
                <h4>Guest Name : {{$guest->name}} </h4>
                <h5>Refer User Name : {{$guest->user_name}} </h5>
                <h5>Phone Number : {{$guest->phone_number}} </h5>
                <h5>Purpose : {{$guest->guest_purpose}} </h5>
                <h5>Department : {{$guest->emp_dept}} </h5>
                <h5>Userd RFID : {{$guest->guest_rfid}} </h5>
                <h5>Date&Time : {{$guest->created_at}} </h5>
    
                

            </div>


    @endsection
</x-admin-master>