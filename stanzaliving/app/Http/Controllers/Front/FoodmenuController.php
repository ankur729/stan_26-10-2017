<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Student;
use App\Hostel;
use App\Country;
use App\RoomSharing;
use App\State;
use App\City;
use App\Complaint;
use App\Food;
use App\Foodmenu;
use App\Foodmenudetail;
use App\FoodCategory;
use App\Http\Controllers\Controller;

class FoodmenuController extends Controller{
   
    
    public function index(Request $request, $id=null){
		
		$foodmenuObj = new Foodmenu;		
		$studentid = $id;
		$session_value = session('student_id');
		$currentdate = date('Y-m-d');
		$oneweek=7;
		$afterweek =  date('Y-m-d', strtotime($currentdate. ' + '."$oneweek".' days'));		
		
		try{
			
			$students=Student::findOrFail($session_value);
			$fooddata=Foodmenu::all();		
			//$fooddata=Foodmenu::where('WEEK(from_date)','WEEK(NOW())')->get();
            //$fooddata=$fooddata->toArray();			
			$foodcat=FoodCategory::all();			
   
			foreach ($foodcat as $key => $value) {
				$mysubcat[$value->id]=$value->name;
			}
			
			
			$foodmenudata = Foodmenu::select("foodmenus.*","food_categories.id as fcatid","food_categories.name as fcatname")
            ->join("food_categories","food_categories.id","=","foodmenus.f_cat")		
			->where([['foodmenus.from_date', '>=',$currentdate],['foodmenus.to_date', '<=',$afterweek],['foodmenus.f_type', '=',$students['s_veg']]])
			->orderBy('id', 'DESC')
			->first();
			//->get();
            //,['foodmenus.cook_id', '=','8']			

            if(count($foodmenudata)>0){
                    $foodmenudata=$foodmenudata->toArray();
                     $foodmenudetailinfo = Foodmenudetail::select("*")       
                    ->where('fmenu_id',$foodmenudata['id'])
                    ->get();
                    $foodmenudetailinfo=$foodmenudetailinfo->toArray();
                        
                        return $foodmenudetailinfo;
            }
			else{
                 $foodmenudata=[];
                   $foodmenudetailinfo=[];
               //   return \Redirect::back();
                   

            }

		
        }
        catch(\Illuminate\Database\QueryException $ex){
            \Session::flash('message','Query Exception Occurred. Call Developer!');
			return \Redirect::back();
        }		
		
		if($session_value!=''){		
			return view('pages.front.food-menu',compact('fooddata','foodcat','foodmenudata','foodmenudetailinfo'));
		}else{
			return view('layouts.master.front.index');			
		}	 		
	
		
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
