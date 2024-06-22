<?php

namespace App\Http\Controllers;

use App\Models\Sembako;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\MainController;

class SembakoController extends Controller
{
    public function validateForm($req){
        $validator = Validator::make($req->all(), [ 
            'nama_sembako' => 'required',
            'harga' => 'required',
            // 'foto' => 'required',
        ]);
        return $validator;
    }

    public function index()
    {
        //
        return view('sembako.index', [
            'data' => Sembako::all()
        ]);
    }

    public function indexPemilik()
    {
        //
        return view('sembako.index', [
            'data' => Sembako::all()
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

        $input = $request->except(['_token']);
        $data = MainController::store(Sembako::class, $input);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ], 200);
        // dd(  $request);
    }

   
    public function show(Blok $sembako)
    {
        //
    }

    
    public function edit($id)
    {
        return MainController::findId(Sembako::class, $id);
    }

    
    public function update(Request $request, $id)
    {
        $validate = $this->validateForm($request);

        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }

        $input = $request->except(['_token', '_method']);
        $data = MainController::update(Sembako::class, $input, $id);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $destroy = MainController::destroy(Sembako::class, $id);
        return response()->json([
            'delete'=> true,
            'message' => 'Data berhasil dihapus!',
            'data' => $destroy
        ], 200);
    }
}
