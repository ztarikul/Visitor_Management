<?php

namespace App\Http\Controllers;
use App\Models\Rfid;
use App\Models\Rfid_assign;

use Carbon\Carbon;

use Illuminate\Http\Request;

class RfidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $available_rfids = Rfid::where('status', "available")->get();
        $busy_rfids = Rfid::where('status', "busy")->get();
        return view('admin.rfid.view_all_rfid', ['available_rfids' => $available_rfids, 'busy_rfids' => $busy_rfids]);
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
        $inputs = $request->all();
        $rfid = new Rfid($inputs);
        $rfid->save();
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
        $rfid = Rfid::find($id);
        $rfid->delete();//--DELETE EMPLOYEE'S INFORMATION QUERY--//
        return redirect()->back();
    }

    public function return(Request $request)
    {
        //
        $rfid = Rfid::where('rfid', $request['rfid'])->first();
        $inputs['status'] = "available";
        
        
        $id = $rfid->id;
        $search_id = Rfid_assign::where('rfid_id',$id)->where('in_status','=', "in" )->where('out_status', '=', "0")->first();
        // dd($search_id);
        $rfid_assign['out_status'] = "out";
        $rfid_assign['out_date'] = date('Y-m-d');
        $rfid_assign['out_time'] = Carbon::now();
       
        $search_id->update($rfid_assign);


        $rfid->update($inputs);
        
        //--DELETE EMPLOYEE'S INFORMATION QUERY--//
        // 


        return redirect()->back();
    }


    public function rfid_search(Request $request){
        
        if($request->ajax()) {
          
            $data = Rfid::where('rfid', 'LIKE', $request->rfid.'%')
                ->get();
           
            $output = '';
           
            if (count($data)>0) {
              
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
              
                foreach ($data as $row){
                   
                    $output .= '<li class="list-group-item">'.$row->rfid.'</li>';
                }
              
                $output .= '</ul>';
            }
            else {
             
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
           
            return $output;
        }
    }
}
