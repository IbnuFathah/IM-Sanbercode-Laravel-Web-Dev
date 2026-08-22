<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function getProfile()
    {
        // Mengecek apakah user yang sedang login sudah memasukan data profil
        $currentUser = Auth::user();
        $user = User::find($currentUser->id);
        //Jika ada masukan ke halaman update, jika belum tampilkan halaman menambahkan/memasukkan data profile
        if($user->profile){
            $profile = Profile::where('user_id', $user->id)->first();
            return view ('profile.update', ['profile' => $profile]);
        }else{
            return view('profile.add');
        }
    }
    
    //Proses menyimpan data profile baru yang terhubung dengan id user sedang login
    public function store(Request $request)
    {
        //Validation
        $request->validate([
            'age' => ['required'],
            'bio' => ['required'],
        ], [
            "required" => "inputan :attribute wajib diisi",
            "min" => "inputan :attribute :min karakter"
        ]);

        $currentUser = Auth::user();
        //Menyimpan data profile baru
        $profile = new Profile;

        $profile->age = $request->input('age');
        $profile->bio = $request->input('bio');
        $profile->user_id = $currentUser->id;
 
        $profile->save();
 
        return redirect('/profile')->with('success', 'Berhasil Buat Profile!');
    }



    public function update(Request $request)
    {
        //Validation
        $request->validate([
            'age' => ['required'],
            'bio' => ['required'],
        ], [
            "required" => "inputan :attribute wajib diisi",
            "min" => "inputan :attribute :min karakter"
        ]);

        $currentUser = Auth::user();
        //Memperbarui data profile berdasarkan user_id
        $profile = Profile::where('user_id', $currentUser->id)->first();

        $profile->age = $request->input('age');
        $profile->bio = $request->input('bio');
        $profile->user_id = $currentUser->id;
 
        $profile->save();
 
        return redirect('/profile')->with('success', 'Berhasil Update Profile!');
    }
}
