<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator as Validator;

use App\Models\User;

class UserController extends Controller
{
    public function login(Request $request){
        
        $validatedData = $request->validate([
            'email' => ['required', 'max:255'],
            'password' => ['required'],
        ]);
        $userData=$request->all();
        $email=$userData["email"];
        $password=$userData["password"];

        try {
            if (Auth::attempt(array('email' => $email, 'password' => $password, 'active' => 1))) {

                if (Auth::user()->role == 1) {
                    return redirect('dashboard');
                } else{
                    return redirect('/');
                }
               
            }
        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
        }
        return back()->withErrors(['message' => 'User Credentials are incorrect']);
    }

    public function register(Request $request){
        
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:user','max:255'],
            'phone' => ['required'],
            'password' => ['required'],
        ]);


        $userData=$request->all();
        $name=$userData["name"];
        $email=$userData["email"];
        $phone=$userData["phone"];
        $password=$userData["password"];

        $token = Str::random(40);
       try {
        $user = User::create([
            'name'          => $name,
            'email'         => $email,
            'phone'         => $phone,
            'role'          => 2,
            'password'      => Hash::make($password),
            'token' =>  $token,
            'active' => 1
        ]);
       } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
       }
        return view("login")->with('success', ('Successfully account created !'));
    }

    public function userProfile(){
        
        try {
            $userId=Auth::user()->id;

            $user = User::select('id','name', 'email','phone')->where('id','=', $userId)->get();
            $user_details=$user[0];
            return view("profile",compact('user_details'));
        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
        }
    }

    public function editUserProfile(Request $request){
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required','max:255'],
            'phone' => ['required'],
        ]);
        $userId=Auth::user()->id;

        $userData=$request->all();
        $name=$userData["name"];
        $email=$userData["email"];
        $phone=$userData["phone"];

        try {
            $userId=Auth::user()->id;

            $user = User::where('id', $userId)
            ->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
            ]);

            return redirect('/profile');
        } catch (\Throwable $th) {
            return back()->withErrors(['message' => 'Internal Server Error !']);
        }
    }
}
