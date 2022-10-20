<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Partner;
use App\Models\Client;



class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
     
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'max:20'],
            'role_id' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'avatar'=> ['sometimes', 'image','mimes:jpg,jpeg,png,bmp,svg','max:5000'],
        ]);
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'type' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);
        if($request->hasfile('avatar')){
            $avataruploaded = $request->file('avatar');
            $extention = $avataruploaded->getClientOriginalExtension();
            $avatarname = time() . '.' .$extention; 
            $avatarpath = public_path('/image/');
            $avataruploaded->move($avatarpath, $avatarname);
            $user->avatar = $avatarname; 
            $user->save();
        }
        
        $user->attachRole($request->role_id); 
        event(new Registered($user));

        Auth::login($user);

        if($user->type == 'Client'){
            $client = new Client();
            $client->user_id = $user->id;
            $client->client_name = $user->name;
            $client->client_email = $user->email;
            $client->client_mobile = $user->mobile;
            $client->save();
        }elseif($user->type == 'Partner'){
            $partner = new Partner();
            $partner->user_id = $user->id;
            $partner->partner_name = $user->name;
            $partner->partner_email = $user->email;
            $partner->partner_mobile = $user->mobile;
            $partner->save();
        }


        return redirect(RouteServiceProvider::HOME);
    }
    
}
