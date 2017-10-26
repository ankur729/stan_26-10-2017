<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RRequest extends Model
{

	protected $fillable=[

				'r_student',
				'r_cat',
				'r_type',
				'r_date',
				'r_time',
				'r_l_date',
				'r_l_time',
				'r_r_date',
				'r_r_time',
				'status',


	];

	protected $table='r_requests';

	
    //
}
