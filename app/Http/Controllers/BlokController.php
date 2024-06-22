<?php

namespace App\Http\Controllers;

use App\Models\{Blok, Pasar};
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\MainController;

class BlokController extends Controller
{
    
    public function validateForm($req){
        $validator = Validator::make($req->all(), [ 
            'id_pasar' => 'required',
            'nama' => 'required',
        ]);
        return $validator;
    }

    public function index()
    {
        //
        return view('blok.index', [
            'data' => Blok::leftJoin('pasars','bloks.id_pasar', 'pasars.id')
                        ->select('bloks.*', 'pasars.nama as nama_pasar')
                        ->get(),
            'pasar' => Pasar::all()
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
        $data = MainController::store(Blok::class, $input);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ], 200);
        // dd(  $request);
    }

   
    public function show(Blok $blok)
    {
        //
    }

    
    public function edit($id)
    {
        return MainController::findId(Blok::class, $id);
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
        $data = MainController::update(Blok::class, $input, $id);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $destroy = MainController::destroy(Blok::class, $id);
        return response()->json([
            'delete'=> true,
            'message' => 'Data berhasil dihapus!',
            'data' => $destroy
        ], 200);
    }
}
