<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon, DB;
use stdObject;
class DashboardController extends Controller
{
    public function indexAlgoritma(){
        return view('algoritma.index');
    }
    public function perhitunganAlgoritma(Request $request){
        // dd($request);
        $dateNow = Carbon::now();
        // $dateNow->month = -10;       
        $lastYearDate = Carbon::now()->subYear()->startOfYear();
        
        // dd($dateNow);
        $listMonth = [2, 3, 4, 6, 12];
        $array = array();
        // $array[1] = new \stdClass('testing');
        // $array[1]->testing = 1;
        // dd($array);
        for ($i=1; $i <= intval($request->year); $i++) {
            $array[$i] = array();
            // $array[date('Y') - $i] = array();
            // $array = new \stdClass();
            // $getCurrentYear =
            // $array->testing = '';

            for ($j=1; $j <= 5; $j++) { 
                $totalPendapatanPerBulan = $this->getTotalPerbulan($listMonth[$j-1], $i);
                // dd($totalPendapatanPerBulan);
                
                
                array_push($array[$i], $totalPendapatanPerBulan);
                
            }
        }
        
        // dd(count($array));
        // dd($array);
        // combine all array
        $newArray = $array[1];
        if($request->year > 1){
            for($k=2;$k <= count($array); $k++){
                // dd($array[$k], $newArray);
                $newArray = array_merge($newArray,$array[$k]);
                // dd($newArray);
            }
        }
        // dd($newArray);
        //perhitungan total-totalan
        $dataNilaiPerhitungan = new \stdClass();
        $dataNilaiPerhitungan->x = 0;
        $dataNilaiPerhitungan->y = 0;
        $dataNilaiPerhitungan->xx = 0;
        $dataNilaiPerhitungan->yy = 0;
        $dataNilaiPerhitungan->xy = 0;

        
        $chartTotalPertahun = array();
        for ($j=4; $j <= count($newArray) ; $j+=5) {
            // dd($newArray[$j], $j, count($chartTotalPertahun), count($newArray));
            $td = count($chartTotalPertahun);
            if($request->year >= 1){
                $chartTotalPertahun[$td] = $newArray[$j] ;
                // $chartTotalPertahun[$td]->total = number_format($chartTotalPertahun[$td]->total);
            }
        }
        // dd($chartTotalPertahun);

        foreach ($newArray as $key) {
            // x
            $x = $dataNilaiPerhitungan->x;
            $dataNilaiPerhitungan->x = $x + $key->bulan;
            // y
            $dataNilaiPerhitungan->y = $dataNilaiPerhitungan->y + $key->total;

            // x^2
            $dataNilaiPerhitungan->xx = $dataNilaiPerhitungan->xx + $key->bulan * $key->bulan;

            // y^2
            $dataNilaiPerhitungan->yy = $dataNilaiPerhitungan->yy + pow($key->total, 2) ;

            // xy
            $dataNilaiPerhitungan->xy = $dataNilaiPerhitungan->xy + $key->bulan * $key->total;

        }
        // dd($dataNilaiPerhitungan, $newArray);



        return view('algoritma.detail-algoritma',[
            'dataBesaranPendapat' => $array,
            'nilaiPerhitungan' => $newArray,
            'dataTotalNilaiPerhitungan' => $dataNilaiPerhitungan,
            'chartTotalPertahun' => $chartTotalPertahun
        ]);
        // dd($totalPendapatan12Bulan);
    }

    public function getTotalPerbulan($month, $year) {
        // dd($month, $year);
        $total = DB::table('pembayarans')
                            ->where('tgl_pembayaran', '>=', Carbon::now()->subYear($year)->startOfYear())
                            ->where('status', 'lunas')
                            ->whereNull('deleted_at')
                            ->whereMonth('tgl_pembayaran', '<=', $month)
                            ->whereYear('tgl_pembayaran', '<=', Carbon::now()->subYear($year))
                            ->sum('total');
        $data = new \stdClass();
        $data->bulan = $month;
        $data->year = Carbon::now()->subYear($year)->year;
        $data->total = $total;
        // dd($data);
                            // ->get();
        return $data;
    }


    public function index()
    {
        return view('dashboard.index');
    }

    
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

  
    public function destroy($id)
    {
        //
    }
}
