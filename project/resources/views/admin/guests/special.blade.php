<x-admin-master>


@section('content')
<h1 style="color:blue">Contractual Worker</h1>

<form  method="post" action="{{route('guest.store')}}" enctype="multipart/form-data">
@csrf
<div class="row">
        <div class="col-sm-6">

    

        <div class="form-group" style="color:black;">
        <label for="title"><b>Worker Name<span style="color: red;">*</span></b></label>
        <input type="text" style="width:50%" class="form-control" name="name" id="title" aria-describedby="" placeholder="enter name">
        <input type="hidden" name="special" value="special">
        </div>

        <!-- <div class="form-group" style="color:black;">
        <label for="title"><b>Reference Name</b></label>
        <input type="text" style="width:50%" class="form-control" name="user_name" id="title" aria-describedby="" placeholder="enter employee name">
        </div> -->

        
        <div class="form-group" style="color:black;">
        <label for="title"><b>Department Name</b></label>
        <input type="text"  style="width:50%" class="form-control" name="emp_dept" id="title" aria-describedby="" placeholder="enter department name">
        </div>

        <div class="form-group" style="color:black;">
        <label for="title"><b>Phone Number<span style="color: red;">*</span></b></label>
        <input type="text"  style="width:50%" class="form-control" name="phone_number" id="title" aria-describedby="" placeholder="enter phone number">
        </div>

        
        
        <div class="form-group" style="color:black;">
            <label for="title"><b>RFID<span style="color: red;">*</span></b></label>
            <select name="guest_rfid" class="form-select"style="width:50%" aria-label="Default select example">
                <option selected>Available RFID</option>
                @foreach($rfids as $rfid)
                <option value="{{$rfid->id}}">{{$rfid->rfid}}</option>
                @endforeach
                
            </select>
            
        </div>


        </div>

        <div class="col-sm-3">

        <div class="form-group" style="color:black;">

        <input type="hidden"  name="guest_status" value="contractual_worker" >
        </div>
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
                <input type="hidden" name="guest_image" class="image-tag">
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