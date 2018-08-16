<?php

namespace App\Http\Controllers;
use App\User;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
        function home()
    {
        //$array = ['prduct'=>'HD77','price'=>'160'];
        $array = User::all();
        return response()->json($array);
    }
}
