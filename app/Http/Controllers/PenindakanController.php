<?php

namespace App\Http\Controllers;

use App\Models\Penindakan;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\MainController;
use File;
class PenindakanController extends Controller
{
    public function validateForm($req){
        $validator = Validator::make($req->all(), [ 
            'judul',
            'deskripsi' => 'required',
            'foto' => 'required',
        ]);
        return $validator;
    }

    public function index()
    {
        //
        return view('penindakan.index', [
            'data' => Penindakan::all()
        ]);
    }

    public function indexPemilik()
    {
        //
        return view('penindakan.index', [
            'data' => Penindakan::all()
        ]);
    }
    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validate = $this->validateForm($request);

        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }
        if($request->file('foto')){
            $fileName = MainController::storeFile($request,'foto', 'foto_penindakan');
        }
        // dd($fileName);
        $input = $request->except(['_token']);
        $input['foto'] = $fileName;
        $data = MainController::store(Penindakan::class, $input);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ], 200);
        // dd(  $request);
    }

   
    public function show(Blok $penindakan)
    {
        //
    }

    
    public function edit($id)
    {
        return MainController::findId(Penindakan::class, $id);
    }

    
    public function update(Request $request, $id)
    {
        $validate = $this->validateForm($request);
        $oldData = MainController::findId(Penindakan::class, $id);
        
        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }
        if($request->file('foto')){
            $fileName = MainController::storeFile($request,'foto', 'foto_penindakan');
            File::delete('foto_penindakan/'.$oldData->foto);
        }

        $input = $request->except(['_token', '_method']);
        $input['foto'] = $fileName;

        $data = MainController::update(Penindakan::class, $input, $id);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $destroy = MainController::destroy(Penindakan::class, $id);
        return response()->json([
            'delete'=> true,
            'message' => 'Data berhasil dihapus!',
            'data' => $destroy
        ], 200);
    }
}
