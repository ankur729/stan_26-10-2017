<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Communicate;

use App\CommunicateCategory;

use App\CommunicateSubCategory;
use App\CommunicateReply;


class CommunicateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
  try{
        $messages=Communicate::all();


       $compcat=CommunicateCategory::all();

       $compsubcat=CommunicateSubCategory::all();
       // return $compsubcat;
        foreach ($compcat as $key => $value) {
            $mycat[$value->id]=$value->name;
            }
   
        foreach ($compsubcat as $key => $value) {
            $mysubcat[$value->id]=$value->name;
            }
        }
             catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }
       // return $messages;
        return view('pages.admin.communicate.communicatetlist',compact('messages','mycat','mysubcat'));
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
       // return $request->file('files');
       // return $request->all();
         $has_image="false";
         $imgname='';

        if($request->file('files')){
          //  return 'dd';    
           // dd( $request->file('files'));
            $file = $request->file('files');
             $imgname = time().$file->getClientOriginalName();
          
            if (!$file->move(public_path().'/images/communicate/',$imgname)){

                return 'err';

            }
            else{

                    $has_image="true";
            }
            
        }

            $communicate=new Communicate;

            $communicate->m_cat=$request->m_cat;
            $communicate->m_sub_cat=$request->m_sub_cat;
            $communicate->m_topic=$request->m_topic;
            $communicate->m_date=$request->m_date;
            $communicate->m_person_name=$request->m_person_name;
            $communicate->m_contact=$request->m_contact;
            $communicate->m_idproof=$imgname; 
            $communicate->m_desc=$request->m_desc;

            $communicate->save();

              \Session::flash('message','Query Successfully Send.!');

            return \Redirect::back();         
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
        $messages=Communicate::findOrFail($request->id);
        $compcat=CommunicateCategory::all();
        $compsubcat=CommunicateSubCategory::all();

        foreach ($compcat as $key => $value) {
            $mycat[$value->id]=$value->name;
         }
   
        foreach ($compsubcat as $key => $value) {
            $mysubcat[$value->id]=$value->name;
         }
       }
         catch(\Illuminate\Database\QueryException $ex)
                     {
                     \Session::flash('message','Query Exception Occurred. Call Developer!');

                     return \Redirect::back();
                     }
        return view('pages.admin.communicate.communicateview',compact('messages','mycat','mysubcat'));
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
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
         try{
           Communicate::destroy($request->id);
       }
        catch(\Illuminate\Database\QueryException $ex)
        {
            \Session::flash('message','Query Exception Occurred. Call Developer!');

         return \Redirect::back();
        }
         \Session::flash('message','Row Successfully Deleted !');
            return \Redirect::back();
        //

    }

    public function addReply(Request $request){

            // $reply=new CommunicateReply;


            // $reply->student_id=

            return $request->all();
    }
}
