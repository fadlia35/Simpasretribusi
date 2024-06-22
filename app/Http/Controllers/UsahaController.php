<?php

namespace App\Http\Controllers;

use App\Models\{Usaha, Pemilik, Blok,Pasar, Pembayaran, Rekening};
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\MainController;
use File, Auth;

class UsahaController extends Controller
{
    public function validateForm($req){
        $validator = Validator::make($req->all(), [ 
            'id_pemilik' => 'required',
            'id_pasar' => 'required',
            'id_blok' => 'required',
            'nama_usaha' => 'required',
            // 'foto_usaha' => 'required',
            'tgl_tagihan' => 'required',
            'jlh_tagihan' => 'required',
            // 'foto' => 'required',
        ]);
        return $validator;
    }

    public function index()
    {
        //
        return view('usaha.index', [
            'data' => Usaha::leftJoin('pemiliks', 'usahas.id_pemilik', 'pemiliks.id')
                      ->leftJoin('pasars', 'usahas.id_pasar', 'pasars.id')
                      ->leftJoin('bloks', 'usahas.id_blok', 'bloks.id')
                      ->whereNull('usahas.deleted_at')
                      ->orderBy('usahas.created_at', 'desc')
                      ->select('usahas.*', 'pemiliks.nama_pemilik as nama_pemilik', 'bloks.nama as nama_blok','pasars.nama as nama_pasar')
                      ->get()
            ,
            'pemilik' => Pemilik::all(),
            'pasar' => Pasar::all(),
            'blok' => Blok::all(),
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
        if($request->file('foto_usaha')){
            $fileName = MainController::storeFile($request,'foto_usaha', 'foto_usaha');
        }
        // dd($fileName);
        $input = $request->except(['_token']);
        $input['foto_usaha'] = $fileName;
        $input['total'] = $request->jlh_pembayaran + $request->denda;

        $data = MainController::store(Usaha::class, $input);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ], 200);
        // dd(  $request);
    }

   
    public function show(Blok $usaha)
    {
        //
    }

    
    public function edit($id)
    {
        return MainController::findId(Usaha::class, $id);
    }

    
    public function update(Request $request, $id)
    {
        $validate = $this->validateForm($request);
        $oldData = MainController::findId(Usaha::class, $id);

        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }

        $input = $request->except(['_token', '_method']);
        if($request->file('foto_usaha')){
            $fileName = MainController::storeFile($request,'foto_usaha', 'foto_usaha');
            File::delete('foto_usaha/'.$oldData->foto_usaha);
            $input['foto_usaha'] = $fileName;
        }


        $data = MainController::update(Usaha::class, $input, $id);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }

    public function destroy($id)
    {
        $destroy = MainController::destroy(Usaha::class, $id);
        return response()->json([
            'delete'=> true,
            'message' => 'Data berhasil dihapus!',
            'data' => $destroy
        ], 200);
    }

    public function indexPemilik(){
        // $data = Usaha::leftJoin('pemiliks', 'usahas.id_pemilik', 'pemiliks.id')
        //               ->leftJoin('pasars', 'usahas.id_pasar', 'pasars.id')
        //               ->leftJoin('bloks', 'usahas.id_blok', 'bloks.id')
        //               ->whereNull('usahas.deleted_at')
        //               ->where('usahas.id_pemilik', Auth::guard('pemilik')->user()->id)
        //               ->orderBy('usahas.created_at', 'desc')
        //               ->select('usahas.*', 'pemiliks.nama_pemilik as nama_pemilik', 'bloks.nama as nama_blok','pasars.nama as nama_pasar')
        //               ->get();
        // dd($data, Auth::guard('pemilik')->user()->id);
        return view('usaha.index-pemilik', [
            'data' => Usaha::leftJoin('pemiliks', 'usahas.id_pemilik', 'pemiliks.id')
                      ->leftJoin('pasars', 'usahas.id_pasar', 'pasars.id')
                      ->leftJoin('bloks', 'usahas.id_blok', 'bloks.id')
                      ->whereNull('usahas.deleted_at')
                      ->where('usahas.id_pemilik', Auth::guard('pemilik')->user()->id)
                      ->orderBy('usahas.created_at', 'desc')
                      ->select('usahas.*', 'pemiliks.nama_pemilik as nama_pemilik', 'bloks.nama as nama_blok','pasars.nama as nama_pasar')
                      ->get()
            ,
            'pemilik' => Pemilik::all(),
            'pasar' => Pasar::all(),
            'blok' => Blok::all(),
        ]);
    }
    public function editPemilik($id)
    {
        return MainController::findId(Usaha::class, $id);
    }

    public function storePemilik(Request $request)
    {
        // dd($request);

         $validate = Validator::make($request->all(), [ 
            'id_pemilik' => 'required',
            'id_pasar' => 'required',
            'id_blok' => 'required',
            'nama_usaha' => 'required',
            'foto_usaha' => 'required',
            // 'tgl_tagihan' => 'required',
            // 'jlh_tagihan' => 'required',
            // 'foto' => 'required',
        ]);

        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }
        if($request->file('foto_usaha')){
            $fileName = MainController::storeFile($request,'foto_usaha', 'foto_usaha');
        }
        // dd($fileName);
        $input = $request->except(['_token']);
        $input['foto_usaha'] = $fileName;

        $data = MainController::store(Usaha::class, $input);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ], 200);
        // dd(  $request);
    }

    public function updatePemilik(Request $request, $id)
    {
        $validate = $this->validateForm($request);
        $oldData = MainController::findId(Usaha::class, $id);

        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }
        if($request->file('foto_usaha')){
            $fileName = MainController::storeFile($request,'foto_usaha', 'foto_usaha');
            File::delete('foto_usaha/'.$oldData->foto_usaha);
            $input['foto_usaha'] = $fileName;
        }

        $input = $request->except(['_token', '_method']);

        $data = MainController::update(Usaha::class, $input, $id);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }

    public function destroyPemilik($id)
    {
        $destroy = MainController::destroy(Usaha::class, $id);
        return response()->json([
            'delete'=> true,
            'message' => 'Data berhasil dihapus!',
            'data' => $destroy
        ], 200);
    }


    public function detailUsahaPemilik($id){
        // $getPembayaran = Pembayaran::where('id_usaha', $id)->get()->dd();

        return view('usaha.detail-usaha-pemilik', [
            'data' => Pembayaran::leftJoin('pemiliks', 'pembayarans.id_pemilik', 'pemiliks.id')
                      ->leftJoin('usahas', 'pembayarans.id_usaha', 'usahas.id')
                      ->leftJoin('pasars', 'pembayarans.id_pasar', 'pasars.id')
                      ->where('pembayarans.id_usaha', $id)
                      ->whereNull('pembayarans.deleted_at')
                      ->orderBy('pembayarans.created_at', 'desc')
                      ->select('pembayarans.*', 'pemiliks.nama_pemilik as nama_pemilik', 'pasars.nama as nama_pasar','usahas.nama_usaha')
                      ->get()
            ,
            'usaha' => MainController::findId(Usaha::class, $id),
            'pemilik' => Pemilik::all(),
            'pasar' => Pasar::all(),
            'blok' => Blok::all(),
            'rekening' => Rekening::all()
        ]);
    }

    public function getPembayaran($idUsaha) {
        // dd($idUsaha);
        // $data = MainController::findId(Pembayaran::class, $idUsaha);
        // dd($data);
        return MainController::findId(Pembayaran::class, $idUsaha);
    }

    public function sendBuktiPembayaran(Request $request, $idPembayaran){
        $validate = $validator = Validator::make($request->all(), [ 
            'id_pemilik' => 'required',
            // 'bukti_pembayaran' => 'required',
            'id_rekening' => 'required'
        ]);
        $oldData = MainController::findId(Pembayaran::class, $idPembayaran);
        // dd($request, $oldData);

        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }

        if($oldData['total'] !== floatval($request->total)){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }

        if($request->file('bukti_pembayaran')){
            $fileName = MainController::storeFile($request,'bukti_pembayaran', 'bukti_pembayaran');
            File::delete('bukti_pembayaran/'.$oldData->bukti_pembayaran);

        }
        // dd($fileName);
        $input = $request->except(['_token', '_method']);
        $input['bukti_pembayaran'] = $fileName;
        $input['updated_by'] = 'Pemilik';
        $input['status'] = 'verifikasi';
        $input['tgl_pembayaran'] = date("Y-m-d H:i:s");
        $data = MainController::update(Pembayaran::class, $input, $idPembayaran);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }
}
