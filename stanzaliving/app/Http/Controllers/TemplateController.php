<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Template;
use App\Templatekey;

class TemplateController extends Controller
{
	

	public function show(){

		$templates=Template::all();
		return view('pages.admin.template.templatelist',compact('templates'));
	}

	public function edit($key=''){

		$templatekeys=Templatekey::where('template_key',$key)->get();
	//	return $templatekeys;

		return view('pages.admin.template.templateedit',compact('templatekeys'));
	}
    //
}
