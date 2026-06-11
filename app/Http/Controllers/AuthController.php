<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //Menampilkan Halaman Login
    public function showLogin(){
        return view('login');
    }
    //Proses Login
    public function login(Request $request){
        $akun = $request->validate([
                'email'=>'required|email',
                'password'=>'required'
            ]
        );

        if (Auth::attempt($akun)){
            //buat session
            $request->session()->regenerate();
            return redirect()->route('products.index');
        };
        //Jika email/password salah
        return back()->withErrors(['login_error' => 'email atau password salah']);
    }
    //Proses Logout
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login'); 
    }
}
