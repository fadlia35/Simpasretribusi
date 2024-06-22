<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Validator, Hash;
use App\Http\Controllers\MainController;


class UserController extends Controller
{   
    public $model;

    public function __construct()
    {
        $this->model = User::class;
    }
    public function validateForm($req){
        $validator = Validator::make($req->all(), [ 
            'name' => 'required|unique:users,name',
            'tipe' => 'required',
            'password' => 'required'
        ]);
        return $validator;
    }
    
    public function index(Request $req)
    {
        // dd($req);
        return view('user.index', [
            'data' => MainController::getAllData($this->model)
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
        $input['password'] = Hash::make($request->password);
        $data = MainController::store($this->model, $input);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ], 200);
    }

    public function show(User $user)
    {
        //
    }

    
    public function edit($id)
    {
        //
        // dd($id);
        return MainController::findId($this->model, $id);
        
    }

    
    public function update(Request $request, $id)
    {
        //
        // dd($request->password !== null);
        if($request->password !== null){
            $validate = $this->validateForm($request);
        }
        $validate = Validator::make($request->all(), [ 
            'name' => 'required|unique:users,name',
            'tipe' => 'required',
            // 'password' => 'required'
        ]);
        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }

        $input = $request->except(['_token', '_method']);
        $input['password'] = Hash::make($request->password);
        $data = MainController::update($this->model, $input, $id);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }

    
    public function destroy($id)
    {
        $destroy = MainController::destroy($this->model, $id);
        return response()->json([
            'delete'=> true,
            'message' => 'Data berhasil dihapus!',
            'data' => $destroy
        ], 200);
    }

    

}
