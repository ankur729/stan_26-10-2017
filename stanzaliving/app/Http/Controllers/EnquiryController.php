<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Enquiry;


class EnquiryController extends Controller
{

	public function contactlist(){

		$enquiries=Enquiry::where('type','C')->get();

		return view('pages.admin.enquiry.contactlist',compact('enquiries'));

	}

	public function contactlistdetail(Request $request){

		$enquiry=Enquiry::findOrFail($request->id);


		return view('pages.admin.enquiry.contactlistview',compact('enquiry'));
	}

	public function bookonlinelist(){

		$enquiries=Enquiry::where('type','P')->get();

		return view('pages.admin.enquiry.bookonlinelist',compact('enquiries'));


	}

		public function bookonlinelistdetail(Request $request,$id){

			$enquiry=Enquiry::findOrFail($request->id);

		return view('pages.admin.enquiry.bookonlinelistview',compact('enquiry'));

	}


	public function arrangeviewlist(){

			$enquiries=Enquiry::where('type','A')->get();

		return view('pages.admin.enquiry.arrangeviewlist',compact('enquiries'));


	}

	public function arrangeviewlistdetail($id){

		$enquiry=Enquiry::findOrFail($id);

		return view('pages.admin.enquiry.arrangeviewlistview',compact('enquiry'));


	}

    //
}
