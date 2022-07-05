<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller as BaseController;

abstract class Controller extends BaseController
{
    public function __construct(){
    	$this->middleware(['auth:api', 'verified']);
    }
}
