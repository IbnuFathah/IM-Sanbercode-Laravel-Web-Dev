<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function formregister()
    {
        //Mengarah ke halaman Register
        return view('auth.register');
    }
    public function register(Request $request)
    {
        //Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        //Logic hanya User yang mendaftar pertama menjadi role Admin
         $userCount = User::count();
         if($userCount == 0 ){
            $userCount = "admin";
         }else{
            $userCount = "staff";
         }
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            //Hash pada baris password untuk mengenkripsi password pada Database
            'password' => Hash::make($request->input('password')),
            'role' => $userCount
        ]);

        //Jika interaksi dengan register selesai, maka akan dipindahkan ke halaman login, dan data yang sudah di input di register sudah masuk
        return redirect('/login');
    }

    public function formlogin()
    {
        //Mengarah ke halaman Login
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        //Mengambil data user berdasar email
        $pengguna = User::where('email', $request->email)->first();
 
        //Mengecek apakah email sudah terdaftar di database
        if (!$pengguna){
            return back()->withErrors([
                'email' => 'email belum terdaftar di database',
            ])->onlyInput('email');
        }

        //Mengecek apakah password sesuai dengan email yang terdaftar didatabase
        if(!Auth::attempt($credentials)){
            return back()->withErrors([
                'password' => 'Password salah!',
            ])->onlyInput('email');
        }
        

        
    }

    //Logout user, membersihkan data session dan mengarahkan ke halaman login
    public function logout(Request $request)
    {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/login');
    }
}
