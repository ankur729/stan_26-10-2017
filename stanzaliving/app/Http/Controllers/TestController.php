<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Role;

class TestController extends Controller
{


	public function testMethod(Request $req){

		//return 'test';
		
			//$roles_user=Role::where('id','17')->get();
			//$roles_user=unserialize($roles_user->access_level);

			// $user_role=\DB::select('select * from role_user where user_id = ?', [\Auth::user()->id]);
			// $roles_user=Role::where('id',$user_role[0]->role_id)->first();
			return session('student_id');
			//print_r($roles_user);
			//$roles_user= json_decode($roles_user);

			//return unserialize($roles_user->access_level);
	}

}


?>