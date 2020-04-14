<?php

namespace App\Exceptions;

use Log;
use Exceptions;

class HackerAlertException extends Exception{

	public function report(){
		Log::critical('Hacker tried to hack us today');
	}

	public render(){
		return response()->json([
			'message' => 'Hacker, you got no luck today'
		]);
	}
}