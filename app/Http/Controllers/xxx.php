<? php

namespace App\Http\Controllers;
use Laravel\Lumen\Routing\Controller as BaseController; 
use App\Http\Controllers\Controller;
 
use Illuminate\Support\Facades\Hash;
 
use Illuminate\Http\Request;
 
use App\Users;
 
class UserController extends BaseController
 
{
 
  public function __construct()
 
   {
 
     //  $this->middleware('auth:api');
 
   }
 
   /*
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
   */
 


   //delete the user
   public function destroy($id) {
          $user = User::find($id);
          if(!$user){
              return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
          }
          $user->delete();
          return response()->json(['data' => "The user with with id {$id} has been deleted"], 200);
        }


    //Authenticate the user
    public function verify(Request $request) {
      $email = $request->get('email');
      $password = $request->get('password');
      $user = User::where('email', $email)->first();
      if($user && Hash::check($password, $user->password)) {
        return response()->json($user, 200);
      }
      return response()->json(['message' => "User details incorrect"], 404);
    }



    //Update the password
    public function update(Request $request, $id) {
      $user = User::find($id);
      if(!$user){
          return response()->json(['message' => "The user with {$id} doesn't exist"], 404);
      }
      $this->validateRequest($request);
      $user->email        = $request->get('email');
      $user->password     = Hash::make($request->get('password'));
      $user->save();
      return response()->json(['data' => "The user with with id {$user->id} has been updated"], 200);
    }
 
}    
 