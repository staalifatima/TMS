<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
 use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function show(){
      $users= User::all();
       
        return view('userslist',compact('users'));
   }
   public function destroy($id){
      $users= User::find($id)->delete();
      return redirect()->route('dashboard.userslist')->with('message', 'User deleted successfully');
   }
   public function upload(Request $request){
      if($request->hasfile('avatar')){
         $avataruploaded = $request->file('avatar');
         $avatarname = time() . '.' . $avataruploaded->getClientOriginalExtension();
         $avatarpath = public_path('/image/');
         $avataruploaded->move($avatarpath, $avatarname);
         Auth()->user()->update(['avatar'=>$nameavatar]);
         $user->save();
     }
   }
}
