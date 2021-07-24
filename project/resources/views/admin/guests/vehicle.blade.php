<x-admin-master>


    @section('content')

    <h1 style="color:blue">Vehicle</h1>

    <div class="row">
        <div class="col-sm-6">
            <form method="post" action="{{route('vehicle.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="form-group" style="color:black;">
                    <label for="title"><b>Company Vehicle<span style="color: red;">*</span></b></label>
                    <select name="vehicle_company" class="form-select"  style="width:100%" aria-label="Default select example">
                    <option selected>Out Vehicle</option>
                    @foreach($company_vehicles as $company_vehicle)
                    <option value="{{$company_vehicle->vehicle_number}}">{{$company_vehicle->vehicle_number}}</option>
                    @endforeach
                    
                    </select>
            
                </div>

            

                <div class="form-group" style="color:black;">
                    <label for="title"><b>Vehicle Number<span style="color: red;">*</span></b></label>
                    <input type="text" style="width:50%" class="form-control" name="vehicle_number" value="none" id="title" aria-describedby="" placeholder="Enter Vehicle Number">
                    
                    
                </div>
                <div class="form-group" style="color:black;">
                    <label for="title"><b>Driver Name<span style="color: red;">*</span></b></label>
                    <input type="text" style="width:50%" class="form-control" name="driver_name" id="name" aria-describedby="" placeholder="Enter Driver Name">
                </div>

                <div class="form-group" style="color:black;">
                    <label for="title"><b>Carrying Items<span style="color: red;">*</span></b></label>
                    <input type="text" style="width:50%" class="form-control" name="carr_item" aria-describedby="" placeholder="enter guest name">
                </div>

                

                <div class="form-group" style="color:black;">
                    <label for="title"><b>Phone Number<span style="color: red;">*</span></b></label>
                    <input type="text" style="width:50%" class="form-control" name="phone_number" id="title" aria-describedby="" placeholder="Enter phone number">
                </div>


        </div>

        <div class="col-sm-3">
        
        <div class="form-group" style="color:black;">
            <label for="title"><b>Purpose</b></label>
            <textarea type="text" style="width:100%" class="form-control" name="purpose" id="title" aria-describedby="" placeholder="Write a reason"></textarea>
        </div>
     



        <div class="form-group" style="color:black;">
            <label for="title"><b>RFID<span style="color: red;">*</span></b></label>
            <select name="vehicle_rfid" class="form-select"  style="width:100%" aria-label="Default select example">
                <option selected>Available RFID</option>
                @foreach($rfids as $rfid)
                <option value="{{$rfid->id}}">{{$rfid->rfid}}</option>
                @endforeach
                
            </select>
            
        </div>



            <!-- <div class="form-group" style="color:black;">
                <label for="file"><b>Image</b></label>
                <input type="file" style="width:50%" class="form-control" name="guest_image" id="guest_image">
            </div> -->
    <!-- webcam query -->
           
          
            <div id="my_camera"></div> 
            <script language="JavaScript">
            Webcam.set({
                width: 300,
                height: 200,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
            
            
            function take_snapshot() {
            
                // take snapshot and get image data
                Webcam.snap(function(data_uri){
      $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
                });
            }

            </script>
         

         
                <div class="form-group">
                <br>
                <input class="btn btn-success" type=button value="Take Snapshot" onClick="take_snapshot()" style="margin:middle;" />
                <input type="hidden" name="vehicle_image" class="image-tag">
                </div>
        </div>

        <div class="col-sm-3">
            <div class="my_camera" id="results"></div>
        </div>

           


       


    </div>


    <div class="wsite-form-radio-container">

        <label class="wsite-form-label" style="width: 100%; color:blue">Please submit</label><br>
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">

    </div>
    </form>
            
         





    @endsection

</x-admin-master>