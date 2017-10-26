<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Facility;
use App\Category;
use App\RoomSharing;
use App\Hostel;
use App\RoomCount;
use App\Country;
use App\State;
use App\City;
use DB;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
          $hostels=Hostel::all();
        }
         catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }

       // return $info;
        return view('pages.admin.hostel.hostellist',compact('hostels'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try{
        $categories=Category::all();
        $countries=Country::all();
        $roomtypes=RoomSharing::all();
    } catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }
         $arr=[];
        foreach ($categories as $key => $value) {
        
         $categories[$key]['facility']=$categories[$key]->getFacility()->get();
            
        }
   
        return view('pages.admin.hostel.hosteladd',compact(['categories','roomtypes','countries']));
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
        //echo ;

    //  return $request->all();
      //   $ob=array_flip($request->facility);
      //       print_r($ob);
      //   //return $ob;
      //   return '$ob';
            //return $request->all();
            
   // //    $data=json_encode($request->roomtype);
      // $this->validate($request, [
      //                           'name'=>'required|regex:/^[a-zA-Z ]/',
      //                           'contact'=>'required|digits:10',

      //                           'warden'=>'required|regex:/^[a-zA-Z ]/',
      //                           'contact_warden'=>'required|digits:10',

                               
      //                           'h_nationality'=>'required',
      //                          // 'h_state'=>'required',
                            
      //                           'addr'=>'required|regex:/^[a-zA-Z-\.\, ]/'
                               
      //              ]);
       //  $data=(object)$request->roomtype;
         $imgname='';

             if($request->file('image')){

            $file = $request->file('image');
            $imgname = time().$file->getClientOriginalName();


            $path = public_path("images/$imgname");
            $file->move('public/images/hostel/',$imgname);
            
        }
          
                 // try{
       $hostel_data= Hostel::create([

            'name'=>$request->name,
            'contact'=>$request->contact,

            'warden'=>$request->warden,
            'contact_warden'=>$request->contact_warden,

            'hoteldesc'=>$request->hoteldesc,
            'h_nationality'=>$request->h_Country,
            'h_state'=>$request->h_state,
            'h_city'=>$request->h_city,
            'hoteldesclist'=>$request->hoteldesclist,
            'addr'=>$request->addr,
            'facility'=>json_encode((object)($request->facility)),
            // 'roomtype'=>(object)($request->roomtype),
            // 'roomcount'=>(object)($request->roomcount),
            
            'image'=>$imgname,
            'googleurl'=>$request->googleurl,

            ]);
       // }
        //  catch(\Illuminate\Database\QueryException $ex)
        // {
        //     \Session::flash('message','Query Exception Occurred. Call Developer!');

        //  return \Redirect('admin/hostel/list');
        // }
        //return count($request->roomtype);
        //    dd($data);

        //        dd($hostel_data->id);


          


            for($i=0;$i<count($request->roomcount);$i++){

                    //echo $request->roomcount[$i];
                       $roomcountadd= RoomCount::create([

                            'hostel_id'=>$hostel_data->id,
                            'roomtype'=>$request->roomtype[$i],
                            'roomcount'=>$request->roomcount[$i]
                                      
                ]);

            }

         
 \Session::flash('message','Hostel Successfully Added !');
            return \Redirect::back();
       
       // dd(json_decode($data));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        try{
         $hostel=Hostel::findOrFail($request->id);
         $country=Country::findOrFail($hostel->h_nationality);
         $state=State::findOrFail($hostel->h_state);
         $city=City::findOrFail($hostel->h_city);
        $categories=Category::all();

        
         $desired=RoomCount::select('roomcounts.*')
            ->where('hostel_id','=',$request->id) 
            ->get();
        }
         catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }
          $desired=$desired->toArray();
          
          foreach ($desired as $value) {
             $k[$value['roomtype']]=$value['roomcount'];
          }
      

          try{
        $roomtypes=RoomSharing::all();
    }
     catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }
         $arr=[];
        foreach ($categories as $key => $value) {
        
         $categories[$key]['facility']=$categories[$key]->getFacility()->get();
            
        }
        // //return $images;
        $kill=json_decode($hostel->facility);
       $kill=(array)$kill;

         return view('pages.admin.hostel.hostelview',compact(['hostel','categories','roomtypes','k','kill','city','state','country']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   

        //  dd($request->id);
        try{
        $countries=Country::all();
        $hostel=Hostel::findOrFail($request->id);

        $hostel_fac= json_decode($hostel->facility);
       // $room_selected=RoomCount::where('hostel_id',$request->id)->get();

        $room_selected = DB::table('roomcounts')
            ->join('roomsharings', 'roomcounts.roomtype', '=', 'roomsharings.id')
            
            ->where('hostel_id','=',$request->id)
            ->select('roomcounts.*', 'roomsharings.name')
            ->get();
            // print_r($room_selected);
             //return $room_selected;
       
        // $hostel->facility=json_decode($hostel->facility);
        // $hostel->roomtype=json_decode($hostel->roomtype);
        // $hostel->roomcount=json_decode($hostel->roomcount);

    //   echo $hostel;
       // dd($hostel);
         $categories=Category::all();
         $states_list=State::where('country_id',$hostel->h_nationality)->get();
         $cities_list=City::where('state_id',$hostel->h_state)->get();  
         $roomtypes=RoomSharing::all();
     }
      catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }
             $arr=[];
        foreach ($states_list as $key => $value) {
          
             $mystates[$value->id]=$value->name;
           
        }
        
             $arr=[];
        foreach ($cities_list as $key => $value) {
          
             $mycities[$value->id]=$value->name;
           
        }
        

         $arr=[];
        foreach ($categories as $key => $value) {
        
         $categories[$key]['facility']=$categories[$key]->getFacility()->get();
            
        }
        // //return $images;
         return view('pages.admin.hostel.hosteledit',compact(['hostel','categories','roomtypes','countries','mystates','mycities','hostel_fac','room_selected']));
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
          
       // return $request->all();
        //
      /*   for($i=0;$i<count($request->roomcount);$i++){
          $exist=RoomCount::where([['hostel_id', '=',$request->id],
                            ['roomtype','=',$request->roomtype[$i]]])->first();
      }
           dd(count($exist)); */

             $this->validate($request, [
                                'name'=>'required|regex:/^[a-zA-Z0-9 ]/',
                                'contact'=>'required|digits:10',

                                'warden'=>'required|regex:/^[a-zA-Z ]/',
                                'contact_warden'=>'required|digits:10',

                               
                                'h_nationality'=>'required',
                              //  'h_state'=>'required',
                         
                                'addr'=>'required|regex:/^[a-zA-Z-\.\, ]/'
                             
                   ]);
         $data=(object)$request->roomtype;
         $imgname=$request->imgnameh;

             if($request->file('image')){

            $file = $request->file('image');
            $imgname = time().$file->getClientOriginalName();
            $path = public_path("images/$imgname");
            $file->move('images/hostel/',$imgname);
            
        }
        try{

         if(isset($request->facility)){


             $hostel_data= Hostel::where('id', $request->id)
        
                              ->update([

            'name'=>$request->name,
            'contact'=>$request->contact,
            'warden'=>$request->warden,
            'contact_warden'=>$request->contact_warden,
            'hoteldesc'=>$request->hoteldesc,
            'hoteldesclist'=>$request->hoteldesclist,
            'addr'=>$request->addr,
            'h_nationality'=>$request->h_nationality,
            'h_state'=>$request->h_state,
            'h_city'=>$request->h_city,
            'facility'=>json_encode((object)($request->facility)),
            'image'=>$imgname,
            'googleurl'=>$request->googleurl,

            ]);    
        
         }
         else{

                  $hostel_data= Hostel::where('id', $request->id)
        
                              ->update([

            'name'=>$request->name,
            'contact'=>$request->contact,
            'warden'=>$request->warden,
            'contact_warden'=>$request->contact_warden,
            'hoteldesc'=>$request->hoteldesc,
            'hoteldesclist'=>$request->hoteldesclist,
            'addr'=>$request->addr,
            'h_nationality'=>$request->h_nationality,
            'h_state'=>$request->h_state,
            'h_city'=>$request->h_city,
           
            'image'=>$imgname,
            'googleurl'=>$request->googleurl,

            ]); 

         }



              }
         catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }


          $len=count($request->roomtype);

            if($len==1){

                if($request->roomtype[0]==''){

                   
                }
                else{

                   // \DB::table('roomcounts')->whereIn('hostel_id', $request->id)->delete(); 
                       \DB::delete('delete from roomcounts where hostel_id=?',[$request->id]);

                        for($i=0;$i<count($request->roomcount);$i++){

                    //echo $request->roomcount[$i];
                       $roomcountadd= RoomCount::create([

                            'hostel_id'=>$request->id,
                            'roomtype'=>$request->roomtype[$i],
                            'roomcount'=>$request->roomcount[$i]
                                      
                                   ]);

                             }
                  // $roomcountupd= RoomCount::where([
                  //                   ['hostel_id', '=',$request->id],
                  //                   ['roomtype','=',$request->roomtype[$i]]
                  //                   ])
                  //                  ->update([
                  //                       'roomcount'=>$request->roomcount[$i]
                                                  
                  //           ]);
                }
            }
            else if($len>1){

                      \DB::delete('delete from roomcounts where hostel_id=?',[$request->id]);

                        for($i=0;$i<count($request->roomcount);$i++){

                    //echo $request->roomcount[$i];
                       $roomcountadd= RoomCount::create([

                            'hostel_id'=>$request->id,
                            'roomtype'=>$request->roomtype[$i],
                            'roomcount'=>$request->roomcount[$i]
                                      
                                   ]);

                             }

            }
            //  for($i=0;$i<count($request->roomcount);$i++){

            //             $exist=RoomCount::where([['hostel_id', '=',$request->id],
            //                 ['roomtype','=',$request->roomtype[$i]]])->first();
            //             if(count($exist)>0)
            //             {
            //                         $roomcountupd= RoomCount::where([
            //                         ['hostel_id', '=',$request->id],
            //                         ['roomtype','=',$request->roomtype[$i]]
            //                         ])
            //                        ->update([
            //                             'roomcount'=>$request->roomcount[$i]
                                                  
            //                 ]);
            //             }
            //             else 
            //             {
            //                   $roomcountadd= RoomCount::create([

            //                 'hostel_id'=>$request->id,
            //                 'roomtype'=>$request->roomtype[$i],
            //                 'roomcount'=>$request->roomcount[$i]
                                      
            //     ]);
            //             }
            // }

         
            \Session::flash('message','Hostel Successfully Updated !');
         return \Redirect('admin/hostel/list');
    
      
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        try{
        Hostel::destroy($request->id);
    }
     catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }
         \Session::flash('message','Hostel Successfully Deleted !');
            return \Redirect::back();
    }

    public function findstates(Request $request)
    {   
            $states=State::where('country_id',$_GET['c_id'])->get();
            $states=$states->toArray();
            foreach ($states as $value) {
                echo "<option value=".$value['id'].">".$value['name']."</option>";
            }
            
    }

     public function findcities(Request $request)
    {   
            $cities=City::where('state_id',$_GET['s_id'])->get();
            $cities=$cities->toArray();
            foreach ($cities as $value) {
                echo "<option value=".$value['id'].">".$value['name']."</option>";
            }
            
           
    }

    public function hostelList(){

        $hostels=Hostel::all();
        return $hostels;
         //return view('pages.admin.hostel.hostellist',compact('hostels'));
       //  $returnHTML = view('pages.admin.hostel.hostellist',[' hostels'=> $hostels])->render();// or method that you prefere to return data + RENDER is the key here

         //retrun $returnHTML
       //     return response()->json( array('success' => true, 'html'=>$returnHTML) );

     //   return $hostels;

    }
}