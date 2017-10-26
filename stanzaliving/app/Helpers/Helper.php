<?php

namespace App\Helpers;
use App\Role;


class Helper

{
     public static function displayString($string){
          return $string;
      }

      public static function leftMenu(){

   
	
		$leftMenu=array(
			
				0=>array('label'=>'Dashboard','icon_label'=>'<i class="fa fa-dashboard"></i>','link'=>url('admin/dashboard'),'current'=>'dashboard','msort'=>1,'child'=>array()),
				
				1=>array('label'=>'Catalogue','icon_label'=>'<i class="fa fa-dashboard"></i>','link'=>url('admin/catalogue'),'current'=>'catalogue','msort'=>2,
							'child'=>array(
								0=>array('label'=>'Manage Facility','link'=>url('admin/category/list')),
								1=>array('label'=>'Manage Service','link'=>url('admin/facility/list')),
								2=>array('label'=>'Manage Rooms','link'=>url('admin/room/list')),
								3=>array('label'=>'Manage Hostels','link'=>url('admin/hostel/list')),
								4=>array('label'=>'Manage Spring Board (Events)','link'=>url('admin/event/list')),
								5=>array('label'=>'Manage Social','link'=>url(''))
								
							)),
							
				2=>array('label'=>'Communication  Portal','icon_label'=>'<i class="fa fa-dashboard"></i>','link'=>url('admin/communication'),'current'=>'communication','msort'=>3,
							'child'=>array(
								0=>array('label'=>'Manage Complaints Category','link'=>url('admin/complaint_category/list')),
								1=>array('label'=>'Manage Complaints Subcategory','link'=>url('admin/complaint_subcategory/list')),
								2=>array('label'=>'Manage Complaints List','link'=>url('admin/complaint/list')),
								3=>array('label'=>'Response to the complainant','link'=>url('')),
								4=>array('label'=>'Manage Night Request','link'=>url('admin/request/list')),
								5=>array('label'=>'Manage Request Type','link'=>url('admin/request_type/list')),
								6=>array('label'=>'Manage Food Menu','link'=>url('admin/foodmenu/menulist')),
								7=>array('label'=>'Manage Food Items','link'=>url('admin/menu/list')),
								8=>array('label'=>'Manage Food Category','link'=>url('admin/f_cat/list')),
								9=>array('label'=>'Manage Vox Populi','link'=>url('admin/communicate/list')),
								10=>array('label'=>'Manage Vox Populi Category','link'=>url('admin/communicate_category/list')),
								11=>array('label'=>'Manage Vox Populi Sub Category','link'=>url('admin/communicate_subcategory/list')),								
								12=>array('label'=>'Manage Attendance','link'=>url(''))				
								
							)),	
						
				3=>array('label'=>'Website Enquiry','icon_label'=>'<i class="fa fa-dashboard"></i>','link'=>url('admin/enquiry'),'current'=>'enquiry','msort'=>4,
							'child'=>array(
								0=>array('label'=>'Contact Us','link'=>url('admin/contactus/list')),
								1=>array('label'=>'Book Online','link'=>url('admin/bookonline/list')),
								2=>array('label'=>'Arrange Viewing','link'=>url('admin/arrangeview/list')),
								3=>array('label'=>'Feedback Report','link'=>url('admin/feedback/list'))
								
							)),
							
				
				4=>array('label'=>'Manage Users','icon_label'=>'<i class="fa fa-dashboard"></i>','link'=>url('admin/profile'),'current'=>'profile','msort'=>5,
							'child'=>array(
								0=>array('label'=>'Manage Roles','link'=>url('admin/access/list')),
								1=>array('label'=>'Manage Subadmins','link'=>url('admin/user/list')),
								2=>array('label'=>'Manage Students Profile','link'=>url('admin/student/list')),
								3=>array('label'=>'Manage Parents Profile','link'=>url('admin/guardian/list'))
								
							)),
							
				5=>array('label'=>'Payment Module','icon_label'=>'<i class="fa fa-dashboard"></i>','link'=>url('admin/enquiry'),'current'=>'enquiry','msort'=>6,
							'child'=>array(
								0=>array('label'=>'Manage Taxes','link'=>url('admin/taxes/list')),
								1=>array('label'=>'Manage Payment','link'=>url('admin/payment/list')),
								2=>array('label'=>'Manage Invoice','link'=>url(''))
								
							)),

				6=>array('label'=>'Manage Settings','icon_label'=>'<i class="fa fa-dashboard"></i>','link'=>url('admin/settings'),'current'=>'settings','msort'=>7,
							'child'=>array(
								0=>array('label'=>'General Setting','link'=>url('admin/setting/general')),
								1=>array('label'=>'Manage Website CMS','link'=>url('admin/information/list')),
								2=>array('label'=>'Manage Notifications','link'=>url('')),						
								3=>array('label'=>'Profile','link'=>url('admin/profile/edit')),
							
								4=>array('label'=>'Logout','link'=>url('admin_logout'))
								
							)),							
				
			);
		
		return $leftMenu;
	//	dd($leftMenu);
	}

	public static function lmsort($a, $b) {
   	return $a['msort'] - $b['msort'];
	}	


	public static function urlmaker($str, $replace=array(), $delimiter='-') {
			setlocale(LC_ALL, 'en_US.UTF8');
			if( !empty($replace) ) {
			$str = str_replace((array)$replace, ' ', $str);
			}

			$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
			$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
			$clean = strtolower(trim($clean, '-'));
			$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

			return $clean;
}




	public static function sendMail($data,$from_email,$to_email,$title,$subject){

	  \Mail::send('emails.welcome', $data, function ($message)use($from_email,$title,$to_email,$subject) {

	        $message->from($from_email, $title);

	        $message->to($to_email)->subject($subject);

	    });

	}



	public static function manageAccessableMenu($userid){

//	$Left_menu=$leftMenu;
	//print_r(self::leftMenu());


		 	$user_role=\DB::select('select * from role_user where user_id = ?', [\Auth::user()->id]);
		 	
// GETTING ROLE of THAT PARTICULAR ID

		 	$roles_user=Role::where('id',$user_role[0]->role_id)->first();
		 	$roles_user=unserialize($roles_user->access_level);
	

	$accessMenu=self::leftMenu();
	
		//print_r($accessMenu);
	$Left_menu=$roles_user;
	//print_r($Left_menu);
	$mynewarr=array();

	// 	foreach($Left_menu as $mkey=>$lm){
	// 		//	print_r($mkey);
	// 	if(array_key_exists($mkey,$accessMenu)){
		
	// 		$mynewarr[$mkey]=$accessMenu[$mkey];
		
	// 		if(isset($lm['child']) && count($lm['child'])>0){
				
	// 			foreach($lm['child'] as $skey=>$cm){
					
	// 				if(array_key_exists($skey,$accessMenu[$mkey])){
	// 					$mynewarr[$mkey][$skey]=$accessMenu[$mkey][$skey];
	// 				}
	// 			}
	// 		}
		
	// 	}
	
	
	// }


	foreach($Left_menu as $mkey=>$lm){
			//	print_r($mkey);
		if(array_key_exists($mkey,$accessMenu)){
				

			$mynewarr[$mkey]=$accessMenu[$mkey];
			$mynewarr[$mkey]['child']=[];
		
			if(isset($lm['child']) && count($lm['child'])>0){

				
				foreach($lm['child'] as $skey=>$cm){
					
					if(in_array($cm,array_keys($accessMenu[$mkey]['child']))){
						$mynewarr[$mkey]['child'][$skey]=$accessMenu[$mkey]['child'][$skey];
					}
				}
			}else{

				$mynewarr[$mkey]=$accessMenu[$mkey];
			}
		
		}
	
	
	}
		//print_r($mynewarr);
	return $mynewarr;
	die();
}

}