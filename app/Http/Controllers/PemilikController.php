<?php

namespace App\Http\Controllers;

use App\Models\Pemilik;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\MainController;
use File, Hash, Auth;

class PemilikController extends Controller
{
    public function validateForm($req){
        $validator = Validator::make($req->all(), [ 
            'nama_pemilik' => 'required|unique:pemiliks,nama_pemilik',
            'foto_pemilik' => 'required',
            'alamat' => 'required',
            'nik' => 'required',
            'password' => 'required'
            // 'foto' => 'required',
        ]);
        return $validator;
    }

    public function index()
    {
        //
        return view('pemilik.index', [
            'data' => Pemilik::all()
        ]);
    }

    

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request);
        $validate = $this->validateForm($request);

        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }
        if($request->file('foto_pemilik')){
            $fileName = MainController::storeFile($request,'foto_pemilik', 'foto_pemilik');
        }
        // dd($fileName);
        $input = $request->except(['_token']);
        $input['password'] = Hash::make($request->password);
        $input['foto_pemilik'] = $fileName;
        
        // dd($input);
        
        $data = MainController::store(Pemilik::class, $input);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ], 200);
        // dd(  $request);
    }

   
    public function show(Blok $pemilik)
    {
        //
    }

    
    public function edit($id)
    {
        return MainController::findId(Pemilik::class, $id);
    }

    
    public function update(Request $request, $id)
    {   
        $input = $request->except(['_token', '_method']);
        if($request->password !== null){
            $validate = $this->validateForm($request);
            $input['password'] = Hash::make($request->password);

            
        }
        $validate = Validator::make($req->all(), [ 
            'nama_pemilik' => 'required',
            // 'foto_pemilik' => 'required',
            'alamat' => 'required',
            'nik' => 'required',
            // 'foto' => 'required',
        ]);
        $oldData = MainController::findId(Pemilik::class, $id);
        
        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }

        if($request->file('foto_pemilik')){
            $fileName = MainController::storeFile($request,'foto_pemilik', 'foto_pemilik');
            File::delete('foto_pemilik/'.$oldData->foto_pemilik);
        }

        $input['foto_pemilik'] = $fileName;
        $data = MainController::update(Pemilik::class, $input, $id);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $destroy = MainController::destroy(Pemilik::class, $id);
        return response()->json([
            'delete'=> true,
            'message' => 'Data berhasil dihapus!',
            'data' => $destroy
        ], 200);
    }

    public function indexPemilik(){
        return view('pemilik.index-pemilik', [
            'data' => MainController::findId(Pemilik::class, Auth::guard('pemilik')->user()->id)
        ]);
    }

    public function editPemilik($id)
    {
        return MainController::findId(Pemilik::class, $id);
    }
    public function updatePemilik(Request $request, $id)
    {   
        $input = $request->except(['_token', '_method']);
        if($request->password !== null || $request->password !== ''){
            $validate = $this->validateForm($request);
            $input['password'] = Hash::make($request->password);

            
        }
        $validate = Validator::make($request->all(), [ 
            'nama_pemilik' => 'required',
            // 'foto_pemilik' => 'required',
            'alamat' => 'required',
            'nik' => 'required',
            // 'foto' => 'required',
        ]);
        $oldData = MainController::findId(Pemilik::class, $id);
        $input['password'] = $oldData->password;
        
        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }

        if($request->file('foto_pemilik')){
            $fileName = MainController::storeFile($request,'foto_pemilik', 'foto_pemilik');
            File::delete('foto_pemilik/'.$oldData->foto_pemilik);
        }

        $input['foto_pemilik'] = $fileName;
        $data = MainController::update(Pemilik::class, $input, $id);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }
}
