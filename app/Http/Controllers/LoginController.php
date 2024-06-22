<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth, Hash, File;
use Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Pemilik;
use App\Http\Controllers\MainController;



class LoginController extends Controller
{
    //
    public function index(){
        // dd('login view');
        if(Auth::user()){
            return Redirect::to(url()->previous());
        }

        return view('login');
    }
    public function indexPemilik(){
        // dd('login view');
        if(Auth::user()){
            return Redirect::to(url()->previous());
        }

        return view('login-pemilik');
    }
    public function post(Request $request){
        // dd($request);
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('name', 'password');
        // dd($credentials);
        if(Auth::attempt($credentials)){
            // dd(Auth::user());
            $tipe = Auth::user()->tipe;
            $redirect = 'algoritma';
            if($tipe === 'operator'){
                $redirect = 'pasar';
            }
            if($tipe === 'bendahara'){
                $redirect = 'pembayaran';
            }
            // if($tipe === 'kadis'){
            //     $redirect = 'dashboard';
            // }
            // dd($redirect);
            return redirect()->intended($redirect)
                            ->withSuccess('Login Successful');

        }
        return redirect("login")->with('deleted', 'Login Failed');
    }
    public function postPemilik(Request $request){
        // dd($request);
        $request->validate([
            'nama_pemilik' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('nama_pemilik', 'password');
        // dd($credentials);
        if(Auth::guard('pemilik')->attempt($credentials)){
            // dd(Auth::guard('pemilik')->user());
            
            return redirect('pemilik-profile');

        }
        return redirect("login-pemilik")->with('deleted', 'Login Failed');
    }

    public function registerPemilik(){

        return view('register-pemilik');
    }

    public function storeRegisterPemilik(Request $request){
        $request->validate([
            'nama_pemilik' => 'required|unique:pemiliks,nama_pemilik',
            'alamat' => 'required',
            'nik' => 'required',
            'password' => 'required'
        ]);
        $fileName = '';
        if($request->file('foto_pemilik')){
            $fileName = MainController::storeFile($request,'foto_pemilik', 'foto_pemilik');
        }
        // dd($fileName);
        $input = $request->except(['_token']);
        $input['password'] = Hash::make($request->password);
        
        $input['foto_pemilik'] = $fileName;
        
        // dd($input);
        $data = MainController::store(Pemilik::class, $input);

        return view('login-pemilik');
    }

    public function logout()
    {
        Auth::logout();
 
        request()->session()->invalidate();
 
        request()->session()->regenerateToken();
 
        return redirect('/login');
    }
}
