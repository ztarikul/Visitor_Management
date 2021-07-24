<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Guest;
use App\Models\Rfid;
use App\Models\Rfid_assign;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function employeeindex()
    {
        //
        $rfids = Rfid::where('status', '=', "available")->get();
        
        $users = User::all();//--EMPLOYEE GUEST--//
        return view('admin.guests.employee_guest', ['users' => $users, 'rfids' => $rfids]);
    }
    public function managementindex()
    {
        //
        $users = User::all();//--MANAGEMENT GUEST-//
        return view('admin.guests.management', ['users' => $users]);
    }
    public function specialindex()
    {
        //
        $rfids = Rfid::where('status', '=', "available")->get();
        $users = User::all();//--SPECIAL FORM GUEST--//
        return view('admin.guests.special', ['users' => $users, 'rfids' => $rfids]);
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
     * 
     * 
     * 
     * 
     */
   //guest token query//



    public function store(Request $request)
    {
        //dd($request->all());

////////// MANAGEMENT GUEST ENTRY ////////////////////
/////////////////////////////////////////////////////

        if(request('user_id_optional')){
            //dd($request->all());

            $ref_id = $request['user_id_optional'];

            $user = User::where('user_ref_id', $ref_id)->first();
            
            $inputs = request()->validate([
                'name'=>'required',
                'phone_number' => 'required',
                'user_name' => 'required',
                'guest_status' => 'required',
                
            ]);
            $inputs['user_id'] = $user->id;
            $inputs['user_ref_id'] = $request['user_id_optional'];
            
            if(request('guest_image')){
                $image = $request->get('guest_image');  // your base64 encoded
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                
                $imagePath= 'images/'. Str::random(20) . '.jpeg';
                Storage::disk('public')->put($imagePath, base64_decode($image));
                $inputs['guest_image'] = $imagePath;
            }


            $guest = new Guest($inputs);
        
            
            $guest->save();
            $users = Guest::latest('id')->first();//new guest entry//


            // New Guest 


         



            return redirect()->back();
            
        }

        /// SPECIAL GUEST ENTRY//////////
        //////////////////////////////

        if(request('special')){
            // dd($request);
            $user = User::where('name', 'admin')->first();
            
            
            $inputs = request()->validate([
                'name'=>'required',
                'guest_status' => 'required',
                'guest_rfid'  => 'required'
                
            ]);
            $inputs['phone_number'] = $request['phone_number'];
            $inputs['user_id'] = $user->id;
            $inputs['user_name'] = $user->name;
            $inputs['user_ref_id'] = $user->user_ref_id;


            $guest_rfid = $request['guest_rfid'];
            $rfid = Rfid::find($guest_rfid);
            $rfid_inputs['status'] = "busy";
    
            $rfid->update($rfid_inputs); 
            
            if(request('guest_image')){
                $image = $request->get('guest_image');  // your base64 encoded
                $image = str_replace('data:image/jpeg;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                
                $imagePath= 'images/'. Str::random(20) . '.jpeg';
                Storage::disk('public')->put($imagePath, base64_decode($image));
                $inputs['guest_image'] = $imagePath;
            }


            $guest = new Guest($inputs);
        
            
            $guest->save();
            $users = Guest::latest('id')->first();
        

            $rfid_assign['guest_id'] = $users->id;
            $rfid_assign['rfid_id'] = $guest_rfid;
            $rfid_assign['in_status'] = "in";
            $rfid_assign['out_status'] = "0";
            $rfid_assign['in_date'] = date('Y-m-d');
            $rfid_assign['in_time'] = Carbon::now();
        //    dd($rfid_assign);
             $rfid_assign_table= new Rfid_assign($rfid_assign);
             $rfid_assign_table->save();



            // New Guest 


       



            return redirect()->back();
            


        }


/////////////////// EMPLOYEE GUEST ENTRY ////////////////
//////////////////////////////////////////////////////////


        else{

            // dd($request);

            $ref_id = $request['user_id'];

            $user = User::where('user_ref_id', $ref_id)->first();
            
            $inputs = request()->validate([
                
                'name'=>'required',
                'phone_number' => 'required',
                'user_name' => 'required',
                'guest_status' => 'required',
                'guest_image' => 'required',
                'guest_rfid' => 'required'

            ]);

            $inputs['user_id'] = $user->id;
            $inputs['user_ref_id'] = $request['user_id'];
            $inputs['guest_purpose'] = $request['guest_purpose'];
            $inputs['emp_dept'] = $request['emp_dept'];


            $guest_rfid = $request['guest_rfid'];
            $rfid = Rfid::find($guest_rfid);
            $rfid_inputs['status'] = "busy";
    
            $rfid->update($rfid_inputs); 
            
            

            // webcam image find query //
            $image = $request->get('guest_image');  // your base64 encoded
            $image = str_replace('data:image/jpeg;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            
            $imagePath= 'images/'. Str::random(20) . '.jpeg';
            Storage::disk('public')->put($imagePath, base64_decode($image));
            $inputs['guest_image'] = $imagePath;

        
            $guest = new Guest($inputs);
        
            
            $guest->save();



            $users = Guest::latest('id')->first();//new guest entry//


            $rfid_assign['guest_id'] = $users->id;
            $rfid_assign['rfid_id'] = $guest_rfid;
            $rfid_assign['in_status'] = "in";
            $rfid_assign['out_status'] = "0";
            $rfid_assign['in_date'] = date('Y-m-d');
            $rfid_assign['in_time'] = Carbon::now();
        //    dd($rfid_assign);
             $rfid_assign_table= new Rfid_assign($rfid_assign);
             $rfid_assign_table->save();

       
            // $today_date  = strtotime($today);
            // $day   = date('d',$today_date);
            // $month = date('m',$today_date);
            // $year  = date('Y',$today_date);
            
            // $search_date = $year . "-". $month ."-" . "01";
    






            return redirect()->back();

        }

        
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
