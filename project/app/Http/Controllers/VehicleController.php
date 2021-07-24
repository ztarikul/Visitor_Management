<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use App\Models\Rfid_assign;
use App\Models\Vehicle;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rfids = Rfid::where('status', '=', "available")->get();
        return view('admin.guests.vehicle', ['rfids' => $rfids]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);

        $ref_id = $request['user_id'];
        
        $inputs = request()->validate([
            
            'vehicle_number'=>'required',
            'driver_name' => 'required',
            'phone_number' => 'required'

        ]);

        $inputs['purpose'] = $request['purpose'];
        $inputs['carr_item'] = $request['carr_item'];


        $vehicle_rfid = $request['vehicle_rfid'];
        $rfid = Rfid::find($vehicle_rfid);
        $rfid_inputs['status'] = "busy";

        $rfid->update($rfid_inputs); 

        $inputs['vehicle_rfid'] = $vehicle_rfid;
        
        

        // webcam image find query //
        $image = $request->get('vehicle_image');  // your base64 encoded
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        
        $imagePath= 'images/'. Str::random(20) . '.jpeg';
        Storage::disk('public')->put($imagePath, base64_decode($image));
        $inputs['vehicle_image'] = $imagePath;

    
        $vehicle = new Vehicle($inputs);
    
        
        $vehicle->save();



        $new_vehicle = Vehicle::latest('id')->first();//new guest entry//


        $rfid_assign['vehicle_id'] = $new_vehicle->id;
        $rfid_assign['rfid_id'] = $vehicle_rfid;
        $rfid_assign['in_status'] = "in";
        $rfid_assign['out_status'] = "0";
        $rfid_assign['in_date'] = date('Y-m-d');
        $rfid_assign['in_time'] = Carbon::now();
    //    dd($rfid_assign);
         $rfid_assign_table= new Rfid_assign($rfid_assign);
         $rfid_assign_table->save();


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // dd($id);
        $vehicle = Vehicle::find($id);
        return view('admin.vehicle.details', ['vehicle' => $vehicle]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
