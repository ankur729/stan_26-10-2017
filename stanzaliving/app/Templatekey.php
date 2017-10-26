<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Templatekey extends Model
{
	protected $table='templatekeys';

	protected $fillable=[

			'template_key',
			'variable_key',
			'variable_name',


	];
    //
}
