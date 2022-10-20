<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Client;
use App\Models\User;
use Auth;
use File;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfileRequest;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole('partner')){
           
             return view('partnerdash');
            
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function show(Partner $partner)
    {
        $partners= Partner::all();
       
        return view('list',compact('partners'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
   public function edit(Partner $partner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, User $user )
    {
         auth()->user()->update($request->only('name', 'email' , 'mobile','avatar'));

        if ($request->input('password','name', 'email' , 'mobile' ,'avatar')) {
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

        return redirect()->route('dashboard.partnerprofile')->with('message', 'Profile saved successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Partner $partner)
    {
        //
    }
    public function myprofile()
    {
        return view('partnerprofile');
    }
}
