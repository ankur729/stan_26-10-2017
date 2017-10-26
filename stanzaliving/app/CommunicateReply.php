<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunicateReply extends Model
{
		protected $fillable=[

				'student_id',
				'communicate_id',
				'msg',
						
		];

		protected $table='communicate_replies';
    //
}
