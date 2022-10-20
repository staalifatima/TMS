<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;
use File;
use App\Models\User;
class ClientController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       if(Auth::user()->hasRole('client')){
        return view('clientdash');
            
    }
   
}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        $clients= Client::all();
        return view('clientlist',compact('clients'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request , User $user)
    {
         auth()->user()->update($request->only('name', 'email' , 'mobile', 'avatar'));

        if ($request->input('password','name', 'email' , 'mobile', 'avatar')) {
            auth()->user()->update([
                'password' => bcrypt($request->input('password')),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
            ]);
            if($request->hasfile('avatar'))
            {
               
                $avataruploaded = $request->file('avatar');
                $extention = $avataruploaded->getClientOriginalExtension();
                $avatarname = time() . '.' .$extention; 
                $avatarpath = public_path('/image/');
                $avataruploaded->move($avatarpath, $avatarname);
                $user->avatar = $avatarname; 
                $user->update();
            }
        }
        

        return redirect()->route('dashboard.myprofile')->with('message', 'Profile saved successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }
    public function myprofile()
    {
        return view('myprofile');
    }
}

/*$destination = '/image/' .$user->avatar;
if(File::exists($destination))
{
    File::delete($destination);
}
*/