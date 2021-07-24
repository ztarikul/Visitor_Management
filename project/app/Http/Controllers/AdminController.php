<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Guest;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function index(){
                                // TODAY EMP GUEST FIND QUERY 
        $todays_guests = Guest::where('guest_status', 'emp_guest')->whereDate('created_at', Carbon::today())->get();

        $todays_contractual_worker = Guest::where('guest_status', 'contractual_worker')->whereDate('created_at', Carbon::today())->get();
        // dd($employee_guests);

        $todays_vehicle = Vehicle::whereDate('created_at', Carbon::today())->get();

        $today_total_guests = Guest::whereDate('created_at', Carbon::today())->get();//--QUERY OF TODAY'S TOTAL EMPLOYEE GUEST AND CARBON IS A MODEL WHICH USES FOR COUNT--//
        $today_total_emp = Attendance::whereDate('date', Carbon::today())->where('token_status', 'taken')->get();//--QUERY OF TODAY'S TOTAL EMPLOYEE AND CARBON IS A MODEL WHICH USES FOR COUNT --//

        return view('admin.index', ['todays_guests' => $todays_guests, 'todays_contractual_worker'=>$todays_contractual_worker, 'todays_vehicle'=> $todays_vehicle, 'today_total_guests'=> $today_total_guests, 'today_total_emp' => $today_total_emp ]);
    }


//--QUERY OF TODAY'S EMPLOYEE GUEST COUNT AND SHOW TABLE IN ADMIN PANEL--//
    public  function today_emp_guest(){
        $guests = Guest::where('guest_status', 'emp_guest')->whereDate('created_at', Carbon::today())->get();
        


        return view('admin.guests.reports', ['guests' => $guests]);
    }

  
    public  function today_con_worker(){

        $guests = Guest::where('guest_status', 'contractual_worker')->whereDate('created_at', Carbon::today())->get();

        return view('admin.guests.reports', ['guests'=>$guests]);
    }
    public  function today_vehicle(){

        $vehicles = Vehicle::whereDate('created_at', Carbon::today())->get();

        return view('admin.vehicle.reports', ['vehicles'=>$vehicles]);
    }



    //---SHOW THE GUEST REPORT--//
    public function admin_reports(){
        return view('admin.guests.random');
    }
    public function contractual_worker(){
        return view('admin.rfid.random');
    }



    public function report_generates(Request $request){
        // dd($request);

        $single = "single";
        $all = "all";
        $emp_search = $request['emp_search'];
        $user_refer_id = $request['user_refer_id'];
        $from_date = $request['from_date'];
        $To_date = $request['To_date'];
        // dd($To_date);
        if($emp_search == $all){


            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $guests = Guest::where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)->where('guest_status', "emp_guest")
                    ->get();
                
                }
                else{
                    $guests = Guest::whereDate('created_at', $from_date)->where('guest_status', "emp_guest")->get();
            

                }
                
            }
            else{
                $guests = Guest::where('guest_status',"emp_guest")->get();//--FOR ALL EMPLOYEE GUESTS REPORT QUERY--//
            }
            // dd($request);
            
            
            
            return view('admin.guests.reports', ['guests' => $guests]);
        }
        if($emp_search == $single){ //--FOR SINGLE EMPLOYEE GUESTS REPORT QUERY--//

            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $guests = Guest::where('user_ref_id', $user_refer_id)->where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)->where('guest_status', "emp_guest")
                    ->get();
                
                }
                else{
                    $guests = Guest::where('user_ref_id', $user_refer_id)->whereDate('created_at', $from_date)->where('guest_status', "emp_guest")->get();
            

                }
                
            }
            else{
                $guests = Guest::where('user_ref_id', $user_refer_id)->where('guest_status', "emp_guest")->get();
            
                
            }
            
            
            return view('admin.guests.reports', ['guests' => $guests]);
        }
  
    }

    public function contractual_worker_report(Request $request){
        // dd($request);

        $single = "single";
        $all = "all";
        $emp_search = $request['emp_search'];
        $user_name = $request['name'];
        $from_date = $request['from_date'];
        $To_date = $request['To_date'];
        // dd($To_date);
        if($emp_search == $all){


            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $guests = Guest::where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)->where('guest_status', "contractual_worker")
                    ->get();
                
                }
                else{
                    $guests = Guest::whereDate('created_at', $from_date)->where('guest_status', "contractual_worker")->get();
            

                }
                
            }
            else{
                $guests = Guest::where('guest_status', "contractual_worker")->get();//--FOR ALL EMPLOYEE GUESTS REPORT QUERY--//
            }
            // dd($request);
            
            
            
            return view('admin.guests.reports', ['guests' => $guests]);
        }
        if($emp_search == $single){ //--FOR SINGLE EMPLOYEE GUESTS REPORT QUERY--//

            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $guests = Guest::where('name', $user_name)->where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)->where('guest_status', "contractual_worker")
                    ->get();
                
                }
                else{
                    $guests = Guest::where('name', $user_name)->whereDate('created_at', $from_date)->where('guest_status', "contractual_worker")->get();
            

                }
                
            }
            else{
                $guests = Guest::where('name', $user_name)->where('guest_status', "contractual_worker")->get();
            
                
            }
            
            
            return view('admin.guests.reports', ['guests' => $guests]);
        }
  
    }



    
    public function admin_attendance_reports(){
        return view('attendance.random');
    }



    public function attendance_report_generates(Request $request){
        // dd($request);

        $single = "single";
        $all = "all";
        $emp_search = $request['emp_search'];
        $user_refer_id = $request['user_refer_id'];
        $from_date = $request['from_date'];
        $To_date = $request['To_date'];
        // dd($To_date);
        if($emp_search == $all){


            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $users = Attendance::where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)
                    ->get();
                
                }
                else{
                    $users = Attendance::whereDate('created_at', $from_date)->get();
            

                }
                
            }
            else{
                $users = Attendance::all();//--FOR ALL EMPLOYEE GUESTS REPORT QUERY--//
            }
            // dd($request);
            
            
            
            // return view('admin.guests.reports', ['guests' => $guests]);
        }
        if($emp_search == $single){ //--FOR SINGLE EMPLOYEE GUESTS REPORT QUERY--//

            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $users = Attendance::where('user_ref_id', $user_refer_id)->where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)
                    ->get();
                
                }
                else{
                    $users = Attendance::where('user_ref_id', $user_refer_id)->whereDate('created_at', $from_date)->get();
            

                }
                
            }
            else{
                $users = Attendance::where('user_ref_id', $user_refer_id)->get();
            
                
            }
            
            
            // return view('admin.guests.reports', ['guests' => $guests]);
        }

       

    return view('attendance.reports', ['users' => $users]); 

       
    }






    public function vehicle_reports(){
        return view('admin.vehicle.random');
    }




    public function vehicle_report_generates(Request $request){
        // dd($request);

        $single = "single";
        $all = "all";
        $vehicle_search = $request['vehicle_search'];
        $vehicle_number = $request['vehicle_number'];
        $from_date = $request['from_date'];
        $To_date = $request['To_date'];

        if($vehicle_search == $all){


            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $vehicles = Vehicle::where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)
                    ->get();
                
                }
                else{
                    $vehicles = Vehicle::whereDate('created_at', $from_date)->get();
            

                }
                
            }
            else{
                $vehicles = Vehicle::all();//--FOR ALL EMPLOYEE GUESTS REPORT QUERY--//
            }
  
        }

        if($vehicle_search == $single){ //--FOR SINGLE EMPLOYEE GUESTS REPORT QUERY--//

            if($from_date != null){

                if($To_date != null){
                    
                    // echo "to date not null";
                    $vehicles = Vehicle::where('vehicle_number', $vehicle_number)->where('created_at', '>=', $from_date)
                    ->where('created_at', '<=', $To_date)
                    ->get();
                
                }
                else{
                    $vehicles = Vehicle::where('vehicle_number', $vehicle_number)->whereDate('created_at', '>=', $from_date)->get();
            
                }
                
            }
            else{
                $vehicles = Vehicle::where('vehicle_number', $vehicle_number)->get();
                
                
            }
            
        }
     

       

    return view('admin.vehicle.reports', ['vehicles' => $vehicles]); 

       
    }

}
