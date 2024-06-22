<?php

namespace App\Http\Controllers;

use App\Models\{Pembayaran, Pasar,Blok, Pemilik, Usaha};
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\MainController;
use File, Auth, PDF;
use Spatie\Browsershot\Browsershot;

class PembayaranController extends Controller
{
    public function validateForm($req){
        $tipe = Auth::user()->tipe;
        if($tipe == 'operator'){
            $validator = Validator::make($req->all(), [ 
                'id_pemilik' => 'required',
                'id_usaha' => 'required',
                'id_pasar' => 'required',
                'jlh_pembayaran' => 'required',
                'denda' => 'required',
                'tgl_pembayaran' => 'required',
                // 'status' => 'required',
                // 'bukti_pembayaran' => 'required',

            ]);
        }else{
            $validator = Validator::make($req->all(), [ 
                'status' => 'required',

            ]);
        }
        
        return $validator;
    }

    public function index($idPasar = null)
    {
        //
        // dd($idPasar);
        // dd(Auth::user()->tipe);
        $data = $idPasar ? Pembayaran::leftJoin('pemiliks', 'pembayarans.id_pemilik', 'pemiliks.id')
                      ->leftJoin('usahas', 'pembayarans.id_usaha', 'usahas.id')
                      ->leftJoin('pasars', 'pembayarans.id_pasar', 'pasars.id')
                      ->where('pasars.id', $idPasar)
                      ->whereNull('pembayarans.deleted_at')
                      ->orderBy('pembayarans.created_at', 'desc')
                      ->select('pembayarans.*', 'pemiliks.nama_pemilik as nama_pemilik', 'pasars.nama as nama_pasar','usahas.nama_usaha')
                      ->get()
                        :
                        Pembayaran::leftJoin('pemiliks', 'pembayarans.id_pemilik', 'pemiliks.id')
                      ->leftJoin('usahas', 'pembayarans.id_usaha', 'usahas.id')
                      ->leftJoin('pasars', 'pembayarans.id_pasar', 'pasars.id')
                      ->whereNull('pembayarans.deleted_at')
                      ->orderBy('pembayarans.created_at', 'desc')
                      ->select('pembayarans.*', 'pemiliks.nama_pemilik as nama_pemilik', 'pasars.nama as nama_pasar','usahas.nama_usaha')
                      ->get()
                      ;

        
        return view('pembayaran.index', [
            'data' => $data,
            'pemilik' => Pemilik::all(),
            'pasar' => Pasar::all(),
            'usaha' => Usaha::all(),
        ]);
    }
    public function getDetailUsaha($id)
    {
        $usaha = Usaha::leftJoin('pemiliks', 'usahas.id_pemilik', 'pemiliks.id')
                      ->leftJoin('pasars', 'usahas.id_pasar', 'pasars.id')
                      ->leftJoin('bloks', 'usahas.id_blok', 'bloks.id')
                      ->whereNull('usahas.deleted_at')
                      ->where('usahas.id_pemilik', $id)
                      ->orderBy('usahas.created_at', 'desc')
                      ->select('usahas.*', 'pemiliks.nama_pemilik as nama_pemilik', 'bloks.nama as nama_blok','pasars.nama as nama_pasar')
                      ->get();
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diterima!',
            'data' => $usaha
        ], 200);
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
        $input = $request->except(['_token']);
        if($request->file('bukti_pembayaran')){
            $fileName = MainController::storeFile($request,'bukti_pembayaran', 'bukti_pembayaran');
            $input['bukti_pembayaran'] = $fileName;
        }
        // dd($fileName);
        $input['updated_by'] = 'Admin';
        $data = MainController::store(Pembayaran::class, $input);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil disimpan!',
            'data' => $data
        ], 200);
        // dd(  $request);
    }

   
    public function show(Blok $pembayaran)
    {
        //
    }

    
    public function edit($id)
    {

        $findId =  MainController::findId(Pembayaran::class, $id);
        // dd($findId);
        $getPembayaran = MainController::findId(Usaha::class, $id);
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil di get!',
            'data' => $findId
        ], 200);
    }

    
    public function update(Request $request, $id)
    {
        $validate = $this->validateForm($request);
        // dd($id);
        $oldData = MainController::findId(Pembayaran::class, $id);

        if($validate->fails()){
            return response()->json([
                'error' => true,
                'errors' => $validate->errors()->toArray()
            ], 422);
        }
        $input = $request->except(['_token', '_method']);
        if($request->file('bukti_pembayaran')){
            $fileName = MainController::storeFile($request,'bukti_pembayaran', 'bukti_pembayaran');
            File::delete('bukti_pembayaran/'.$oldData->bukti_pembayaran);
            $input['bukti_pembayaran'] = $fileName;

        }
        $input['updated_by'] = Auth::user()->tipe;
        $data = MainController::update(Pembayaran::class, $input, $id);
        // dd($request, $data);

        
        return response()->json([
            'success'=> true,
            'message' => 'Data berhasil diperbaharui!',
            'data' => $data
        ], 200);
    }

    
    public function destroy($id)
    {
        $destroy = MainController::destroy(Pembayaran::class, $id);
        return response()->json([
            'delete'=> true,
            'message' => 'Data berhasil dihapus!',
            'data' => $destroy
        ], 200);
    }


    public function createNota($id){
        $data = Pembayaran::leftJoin('pemiliks', 'pembayarans.id_pemilik', 'pemiliks.id')
                      ->leftJoin('usahas', 'pembayarans.id_usaha', 'usahas.id')
                      ->leftJoin('pasars', 'pembayarans.id_pasar', 'pasars.id')
                      ->leftJoin('rekenings', 'pembayarans.id_rekening', 'rekenings.id')
                      ->where('pembayarans.id', $id)
                      ->whereNull('pembayarans.deleted_at')
                      ->orderBy('pembayarans.created_at', 'desc')
                      ->select(
                                'pembayarans.*', 
                                'pemiliks.nama_pemilik as nama_pemilik', 
                                'pasars.nama as nama_pasar',
                                'usahas.nama_usaha',
                                'rekenings.*'
                        )
                        ->get()
                    //   ->first();
                      ->toArray();
        $getBlok = Blok::where('id_pasar', $data[0]['id_pasar'])->first('nama');
        dd($getBlok, $data[0]['id_pasar']);
        $data[0]['nama_blok'] = $getBlok->nama;
        $currenDate = date("d-m-Y");
        // dd($data, $id);
        $pdf = PDF::loadView('format_nota.formatNota2', ['data'=>$data]);


        return $pdf->download('Nota Retribusi-'.date("d-m-Y").'.pdf');

        // $html = view('format_nota.formatNota2', ['data' => $data])->render();

        // $pdf = Browsershot::html($html)
        //             ->showBackground()
        //             ->save(storage_path('app/public').'/'.'Nota Retribusi-'.$currenDate.'.pdf');    
        // return \Storage::disk('public')->download('Nota Retribusi-'.$currenDate.'.pdf');
        // return $html;
        
        // return view('format_nota.formatNota1', ['data' => $data]);
    }
}
