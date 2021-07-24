<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $attendances = Attendance::all();//SHOW ALL EMPLOYEE//
        // dd($attendances);
        return view('attendance.view_all_employee', ['attendances' => $attendances]);
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
        

        $attendance = Attendance::find($id);
        // dd($attendance);
        
        return view('attendance.edit', ['attendance'=>$attendance]);
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

        // dd($request);
        $attendance = Attendance::find($id);
        $input = request()->validate([
            'comment' => 'required'
        ]);

        $attendance->token_status = "missed";
        $attendance->comment = $input['comment'];
        $attendance->update();
        return redirect()->route('attendance.index');

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
    //EMPLOYEE TOKEN QUERY//
    public function attendance_get_token($id){
        // dd($id);
        $attendance = Attendance::where('user_id', $id)->first();
        $attendance['token_status'] = "taken";
        $attendance->save();
        // dd($attendance);
        $user = User::find($id);
        return view('attendance.attendance_token', ['user'=> $user, 'attendance'=>$attendance]);
    }


    public function truncate_form(){
        return view('attendance.truncate_form');
    }


    public function truncate(Request $request){
        // dd($request);
        if(request('from_date')){
            if(request('to_date')){
                $from_date = $request['from_date'];
                $to_date = $request['to_date'];
                $attendances = Attendance::where('date', '>=', $from_date)->where('date', '<=', $to_date)->delete();
                
                return view('attendance.truncate_form');
            }
            else{
                return view('attendance.truncate_form');
            }
        }
        
        return view('attendance.truncate_form');
    }

    public function attendance_form(){
        return view('attendance.attendance_form');

    }

    public function attendance_datasheet(Request $request){
        // dd($request);
        $from_date = request('from_date');
        $to_date = request('to_date');
        // dd($to_date);
        $attendances = Attendance::where('date', '>=', $from_date)->where('date', '<=', $to_date)->get();

        return view('attendance.data_to_exel', ['attendances' => $attendances]);

    }


    public function attendance_api(){
        $attendances = Attendance::all();
        return $attendances;
    }
    





}
