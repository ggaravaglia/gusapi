<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
 
use Illuminate\Support\Facades\Hash;
 
use Illuminate\Http\Request;
 
use App\User;
use Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

        function home()
    {
        $array = ['prduct'=>'HD77','price'=>'160'];
        return response()->json($array);
    }
    //

    public function validateRequest(Request $request) {
      $rules = [
       'nombre' => 'required',
       'apellido' => 'required',
       'email' => 'required|unique:users',
       'password' => 'required'
      ];
      $this->validate($request, $rules);
    }

    //Get the input and create a user
    public function createUser(Request $request) 
    {
        $this->validateRequest($request);
        $user = new User;

        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $user->save();    

/*        $user = User::create([
            'nombre' => $request->get('nombre'),
            'apellido' => $request->get('apellido'),
            'email' => $request->get('email'),
            'password'=> Hash::make($request->get('password'))
        ]);
*/        
        return response()->json(['status' => "success", "user_id" => $user->id], 201);
    }

   public function authenticate(Request $request)
   {
 
     $user = User::where('email', $request->input('email'))->first();
 
     if(Hash::check($request->header('password'), $user->password)){
          $apitoken = base64_encode(str_random(40));
          User::where('email', $request->input('email'))->update(['api_token' => "$apitoken"]);
          return response()->json(['status' => 'success','api_token' => $apitoken,'user'=>$user]);
      }else{
          return response()->json(['status' => 'fail'],401);
      }
 
   }

    //Return the user
    public function show(Request $request) 
    {
      //$user = User::find($request->input('id'));
      $user = Auth::user();
      if(!$user) {
        return response()->json(['status' => "invalid", "message" => "el usuario no existe"], 404);
      }
        return response()->json(['status' => "success", 'data' => $user], 200);
    }
}
