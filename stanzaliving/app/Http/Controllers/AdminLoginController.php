<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Role;

class AdminLoginController extends Controller
{


	public function login_check(Request $req){


		 if (\Auth::attempt(Input::only('email', 'password'))) {
       		
       		// GETTING ROLE ID OF LOGGED IN USER;		
		 	
		 	// $user_role=\DB::select('select * from role_user where user_id = ?', [\Auth::user()->id]);
		 	
		 	// // GETTING ROLE fopen(filename, mode)R THAT PARTICULAR ID

		 	// $roles_user=Role::where('id','15')->first()->toArray();
		 	// //print_r($roles_user);
		 	// $roles_all=Role::all()->toArray();
		 		
		 //   $leftmenu=\Helper::manageAccessableMenu($roles_user);
		     	//print_r($leftmenu);
		  //  echo str_after(\Auth::user()->id);
		 
		 	//die();
		 //	return \Auth::user();
		   // return view('layouts.master.admin.index',compact('leftmenu'));
		 	//return  redirect()->route('admin-redirect',  ['leftmenu']);
       		return redirect('/admin/dashboard')->with('message','You are logged in:');
		 	//return 'VALID ';
   		 }

    		//return 'INCORRECT';			
			return redirect('/admin_logout')->with('duplicate','Invalid Info');
			
   
	}

	public function logout(){

	//	echo 'logout';
		 \Auth::logout();

		 return view('pages.admin.login.login');
		// if(\Auth::logout())
		// 	{

		// 		return "success logout";
		// 	}
	}

	public function show_admin_auth_view(){



			if(\Auth::check()){
			
				return view('pages.admin.home');
			//	return redirect('/admin-home');
			}
	}
    //
}
