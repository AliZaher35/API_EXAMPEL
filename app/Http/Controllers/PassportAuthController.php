<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Models\User;
use Laravel\Passport\HasApiTokens;


class PassportAuthController extends Controller
{
    public function register(Request $request){
       $this->validate($request,[
         'name'=>'required',
         'email'=>'required|email',
         'password'=>'required|min:8',
       ]);
        $user=User::create([
         'name'=>$request->name,
         'email'=>$request->email,
         'password'=>sha1($request->password),
        ]);
        $token=$user->createToken('alilaravel')->accessToken;
        return response()->json(['token'=>$token],200);
      }
    public function login(Request $request){

      $date=[
        'email'=>$request->email,
        'password'=>sha1($request->password), 
      ];
       if (auth()->attempt($date)) {
        $token=auth()->user()->createToken('alilaravel')->accessToken;
        return response()->json(['token'=>$token],200);
       } else {
        return response()->json(['error'=>'UnAuthorised'],401);
       }
    
    }
    public function Userinfo(){

      $user=auth()->user();
      return response()->json(['user'=>$user],200);
    }
    
   
}
