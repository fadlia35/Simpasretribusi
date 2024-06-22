@extends('partials.layout')

@section('content')
      
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Hasil Perhitungan Algoritma Regresi Linear Sederhana</h4>
                        <p class="text-muted"><code></code>
                        </p>
                        
                    </div>
                </div>
                
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Prediksi Pendapatan</h4>
                        <canvas id="singelBarChart" width="500" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-6" style="display: none">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Tabel Data Besaran Pendapatan</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bulan (X)</th>
                                        <th>Jumlah Pendapatan/dalam juta (Y)</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataBesaranPendapat as $item)
                                        @foreach ($item as $i)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $i->bulan.' bulan '.$i->year }}</td>
                                                <td style="font-size: 20px"><span class="badge badge-xl badge-primary px-2">Rp.{{ number_format($i->total) }}</span>
                                                </td>
                                                
                                            </tr>   
                                        @endforeach
                                        <tr>
                                            <th>#</th>
                                            <th>Bulan (X)</th>
                                            <th>Jumlah Pendapatan/dalam juta (Y)</th>
                                            
                                        </tr>
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6" style="display: none">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Penyederhanaan Data Besaran Pendapatan</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>(X)</th>
                                        <th>(Y)</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataBesaranPendapat as $item)
                                        @foreach ($item as $y)
                                            
                                        @endforeach
                                        <tr>    
                                            <th colspan="3" style="color:white;text-align: center" class="bg-info">{{$y->year}}</th>
                                        </tr>
                                        @foreach ($item as $i)
                                            <tr>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>{{ $i->bulan}}</td>
                                                <td style="font-size: 20px"><span class="badge badge-xl badge-primary px-2">{{ number_format($i->total) }}</span>
                                                </td>
                                            </tr>   
                                        @endforeach
                                        
                                        
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12" style="display: none">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Nilai Perhitungan X<sup>2</sup>, Y<sup>2</sup>, XY</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width:10%">#</th>
                                        <th>X</th>
                                        <th>Y</th>
                                        <th>X<sup>2</sup></th>
                                        <th>Y<sup>2</sup></th>
                                        <th>XY</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiPerhitungan as $item)
                                        <tr>
                                            <th>{{ $loop->iteration }}</th>
                                            <td>{{ $item->bulan}}</td>
                                            <td>{{ number_format($item->total)}}</td>
                                            <td>{{ $item->bulan*$item->bulan}}</td>
                                            <td>{{ number_format($item->total * $item->total ) }}</td>
                                            <td>{{ number_format($item->bulan * $item->total)}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td style="font-weight:700;">Total</td>
                                        <td>{{ $dataTotalNilaiPerhitungan->x }}</td>
                                        <td>{{ number_format($dataTotalNilaiPerhitungan->y) }}</td>
                                        <td>{{ $dataTotalNilaiPerhitungan->xx }}</td>
                                        <td>{{ number_format($dataTotalNilaiPerhitungan->yy) }}</td>
                                        <td>{{ number_format($dataTotalNilaiPerhitungan->xy) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12" style="display: none">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Nilai Perhitungan X<sup>2</sup>, Y<sup>2</sup>, XY</h4>
                        </div>
                        <p>
                            Maka langkah selanjutnya adalah menghitung nilai konstanta (a) dan koefisien (b) berdasarkan rumus di atas.
                            Menghitung konstanta a
                        </p>
                        <h4>Menghitung Konstanta a</h4>

                        <div>a = 
                                
                            <span style="border-bottom:1px black solid;">
                                (&Sigma;𝑌)(&Sigma;𝑋 <sup>2</sup>)&minus;(&Sigma;𝑋)(&Sigma;𝑋𝑌)
                            </span>
                            <br>
                            <span style="padding-left: 41px">

                                𝑛 &Sigma;𝑋<sup>2</sup>&minus;(&Sigma;𝑋)<sup>2</sup>
                            </span>
                        </div>
                        <div>a = 
                                
                            <span style="border-bottom:1px black solid;">
                                ({{ number_format($dataTotalNilaiPerhitungan->y) }}) ({{ $dataTotalNilaiPerhitungan->xx }}) &minus; ({{ $dataTotalNilaiPerhitungan->x }}) ({{ number_format($dataTotalNilaiPerhitungan->xy)  }})
                            </span>
                            <br>
                            <span style="padding-left: 41px">
                                ({{ count($nilaiPerhitungan) }}) ({{ $dataTotalNilaiPerhitungan->xx }}) &minus; ({{ $dataTotalNilaiPerhitungan->x }})<sup>2</sup>
                            </span>
                        </div>
                        <div>a = 
                            <span style="border-bottom:1px black solid;">
                                {{ number_format($dataTotalNilaiPerhitungan->y * $dataTotalNilaiPerhitungan->xx) }} &minus; {{ number_format($dataTotalNilaiPerhitungan->xy * $dataTotalNilaiPerhitungan->x)  }}
                            </span>
                            <br>
                            <span style="padding-left: 41px">
                                {{ count($nilaiPerhitungan) * $dataTotalNilaiPerhitungan->xx }} &minus; {{ pow($dataTotalNilaiPerhitungan->x, 2) }}
                            </span>
                        </div>
                        <div>a = 
                            @php
                                $a = $dataTotalNilaiPerhitungan->y * $dataTotalNilaiPerhitungan->xx;
                                $b =  $dataTotalNilaiPerhitungan->xy * $dataTotalNilaiPerhitungan->x;
                                $ab = abs($a - $b);

                            @endphp
                            <span style="border-bottom:1px black solid;">
                                {{ number_format($ab)  }} 
                            </span>
                            <br>
                            <span style="padding-left: 20px">
                                {{ count($nilaiPerhitungan) * $dataTotalNilaiPerhitungan->xx - pow($dataTotalNilaiPerhitungan->x, 2) }}
                            </span>
                        </div>
                        <div style="font-size:18px;">a = 
                            @php
                                $c = count($nilaiPerhitungan) * $dataTotalNilaiPerhitungan->xx - pow($dataTotalNilaiPerhitungan->x, 2);
                                $d = $ab;
                                $e = $ab/$c;
                            @endphp
                            <span style="border-bottom:0px black solid; font-weight:700; ">
                                {{ number_format($e,2)  }} 
                            </span>
                        </div>
                        <br>
                        <br>
                        <h4>Menghitung Koefisien b</h4>
                        <div>b = 
                                
                            <span style="border-bottom:1px black solid;">
                                𝑛 (&Sigma;XY)&minus;(&Sigma;𝑋)(&Sigma;Y) 
                            </span>
                            <br>
                            <span style="padding-left: 41px">

                                𝑛 &Sigma;𝑋<sup>2</sup>&minus;(&Sigma;𝑋) <sup>2</sup> 
                            </span>
                        </div>
                        <div>b = 
                            <span style="border-bottom:1px black solid;">
                                ({{ count($nilaiPerhitungan) }})({{ number_format($dataTotalNilaiPerhitungan->xy) }}) &minus; ({{ $dataTotalNilaiPerhitungan->x }}) ({{ number_format($dataTotalNilaiPerhitungan->y) }}) 
                            </span>
                            <br>
                            <span style="padding-left: 41px">
                                ({{ count($nilaiPerhitungan) }}) ({{ $dataTotalNilaiPerhitungan->xx }}) &minus; ({{ $dataTotalNilaiPerhitungan->x }})<sup>2</sup>
                            </span>
                        </div>
                        <div>b = 
                            <span style="border-bottom:1px black solid;">
                                ({{ number_format($dataTotalNilaiPerhitungan->xy * count($nilaiPerhitungan)) }}) &minus; ({{ number_format($dataTotalNilaiPerhitungan->y * $dataTotalNilaiPerhitungan->x) }}) 
                            </span>
                            <br>
                            <span style="padding-left: 41px">
                                {{ count($nilaiPerhitungan) * $dataTotalNilaiPerhitungan->xx }} &minus; {{ pow($dataTotalNilaiPerhitungan->x, 2) }}
                            </span>
                        </div>
                        <div>b = 
                           @php
                                $f = $dataTotalNilaiPerhitungan->xy * count($nilaiPerhitungan);
                                $g = $dataTotalNilaiPerhitungan->y * $dataTotalNilaiPerhitungan->x;
                                $h = $f - $g;
                            @endphp
                            <span style="border-bottom:1px black solid;">
                                {{ number_format($h) }}    
                            </span>
                            <br>
                            <span style="padding-left: 41px">
                                {{ count($nilaiPerhitungan) * $dataTotalNilaiPerhitungan->xx - pow($dataTotalNilaiPerhitungan->x, 2) }}
                            </span>
                        </div>
                        <div style="font-size:18px;">a = 
                            @php
                                $i = count($nilaiPerhitungan) * $dataTotalNilaiPerhitungan->xx - pow($dataTotalNilaiPerhitungan->x, 2);
                                $j = $h;
                                $k = $j/$i;
                            @endphp
                            <span style="border-bottom:0px black solid; font-weight:700; ">
                                {{ number_format($k,2)  }} 
                            </span>
                        </div>

                        <br>
                        <h4>Maka persamaan regresinya adalah : </h4>
                        <div style="font-size:18px;">Y = 
                            <span >
                                a &plus; bX
                            </span>
                            <br
                        <div style="font-size:18px;">Y = 
                            <span >
                                {{ number_format($e,2)  }} + {{ number_format($k,2) }}(X)
                            </span>
                            <br>
                        </div>
                        <br>
                        <h4>Jadi, Peramalan nilai estimasi untuk besaran pendapatan pertahun kedepannya adalah:</h4>
                        <div style="font-size:18px;">Y = 
                            <span >
                                {{ number_format($e,2)  }} + {{ number_format($k,2) }}(X)
                            </span>
                            <br>
                        </div>
                        <div style="font-size:18px;">Y = 
                             <span >
                                {{ number_format($e,2)  }} + {{ number_format($k,2) }} (12)
                            </span>
                            <br>
                        </div>
                        <div style="font-size:18px;">Y = 
                            <span >
                                {{ number_format($e,2)  }} + {{ number_format($k*12,2) }}
                            </span>
                            <br>
                        </div>
                        <div style="font-size:18px;font-weight:700;color:black">Y = 
                            @php
                                $z = $e + $k*12;
                            @endphp
                            <span >
                                {{ number_format($z,2)}}
                            </span>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@push('addScript')

    {{-- CHART --}}
    <script>
        var ctx = document.getElementById("singelBarChart");
        ctx.height = 150;
        // let ctp = '{{ json_encode($chartTotalPertahun) }}';
        let ctp = @json($chartTotalPertahun).reverse();
        let z = {{ $z }};

        ctp[ctp.length] = {
            bulan: 12,
            year: new Date().getFullYear(),
            total: z.toFixed(2)
        };

        console.log('CTP', ctp, z.toFixed(2));

        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: ctp.map(v => v.year),
                datasets: [
                    {
                        label: "Total Pendapatan per Tahun",
                        data: ctp.map(v => v.total),
                        borderColor: "rgba(117, 113, 249, 0.9)",
                        borderWidth: "0",
                        backgroundColor: "rgba(117, 113, 249, 0.5)",
                    },
                ] 
                // [
                //     {
                //         label: "My First dataset",
                //         data: [40, 55, 75, 81, 56, 55, 40],
                //         borderColor: "rgba(117, 113, 249, 0.9)",
                //         borderWidth: "0",
                //         backgroundColor: "rgba(117, 113, 249, 0.5)",
                //     },
                //     {
                //         label: "My Second dataset",
                //         data: [40, 55, 75, 81, 56, 55, 40],
                //         borderColor: "rgba(222, 60, 75, 0.9)",
                //         borderWidth: "0",
                //         backgroundColor: "rgba(222, 60, 75, 0.9)",
                //     },
                //     {
                //         label: "My Third dataset",
                //         data: [40, 55, 75, 81, 56, 55, 40],
                //         borderColor: "rgba(228, 146, 115, 0.9)",
                //         borderWidth: "0",
                //         backgroundColor: "rgba(228, 146, 115, 0.9)",
                //     },
                // ]
                ,
            },
            options: {
                scales: {
                    yAxes: [
                        {
                            ticks: {
                                beginAtZero: true,
                            },
                        },
                    ],
                },
            },
        });

    </script>


    {{-- POST DATA --}}
    <script >
        // $('#modal').modal({backdrop: 'static', keyboard: false})
        $(document).ready(function(){
        // $('#modal').modal('hide')
        // const form = document.getElementById('modal-tambah-data');
        var form = '#modal-tambah-data';

            $(form).on('submit', function(event){
                event.preventDefault();
                // spinner.style.display = 'block';
                
                var url = $(this).attr('data-action');
                let type = $(this).attr('data-type');
                let id = $(this).attr('data-id');
                let form = new FormData(this)
                console.log('GETATTRIBUTE', $(this).attr('data-id'), ...form);

                if (type == 'post') {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: form,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(response)
                        {
                            console.log('RESPONSE ', response.message);
                            $(form).trigger("reset");
                            $('#modal').modal('hide');
                            // alert(response.success)
                            toastr.success(`${response.message}`, "Success", {
                                timeOut: 3e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                positionClass: "toast-top-right",
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1,
                            });
                            setTimeout(() => {
                                
                                location.reload()
                            }, 3000);
                        },
                        error: function(response) {
                            $('#button-simpan').removeClass('button--loading')
                            console.log('RESPONSE ERROR', response.responseJSON);
                            const errorMessage = response.responseJSON;
                            if(errorMessage.error){
                                for (const erMsg in errorMessage.errors) {
                                    console.log('OBJ', errorMessage.errors[erMsg][0])
                                    const element = document.getElementById(`val-${erMsg}-error`);
                                    element.style.display = "block";
                                    element.innerText = `${errorMessage.errors[erMsg][0]}`
                                    element.classList.add("mystyle");
                                    
                                }
                            }
                        }
                    });
                }else{
                    // console.log('GETATTRIBUTE', $(this).attr('data-id'););
                    // form.setAttribute('data-type', 'edit');
                    // var token = $("meta[name='csrf-token']").attr("content");
                    form.set("_method", "PUT");
                    // form.set("_token", token)
                    // $(this).attr('method', 'PUT')
                    $.ajax({
                        url: `/rekening/${id}`,
                        method: 'POST',
                        data: form,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(response)
                        {
                            console.log('RESPONSE ', response.message);
                            $(form).trigger("reset");
                            $('#modal').modal('hide');
                            // alert(response.success)
                            toastr.success(`${response.message}`, "Success", {
                                timeOut: 3e3,
                                closeButton: !0,
                                debug: !1,
                                newestOnTop: !0,
                                progressBar: !0,
                                positionClass: "toast-top-right",
                                preventDuplicates: !0,
                                onclick: null,
                                showDuration: "300",
                                hideDuration: "1000",
                                extendedTimeOut: "1000",
                                showEasing: "swing",
                                hideEasing: "linear",
                                showMethod: "fadeIn",
                                hideMethod: "fadeOut",
                                tapToDismiss: !1,
                            });
                            setTimeout(() => {
                                
                                location.reload()
                            }, 3000);
                        },
                        error: function(response) {
                            $('#button-simpan').removeClass('button--loading')
                            console.log('RESPONSE ERROR', response.responseJSON);
                            const errorMessage = response.responseJSON;
                            if(errorMessage.error){
                                for (const erMsg in errorMessage.errors) {
                                    console.log('OBJ', errorMessage.errors[erMsg][0])
                                    const element = document.getElementById(`val-${erMsg}-error`);
                                    element.style.display = "block";
                                    element.innerText = `${errorMessage.errors[erMsg][0]}`
                                    element.classList.add("mystyle");
                                    
                                }
                            }
                        }
                    });
                }
                
                
            });
        });
    </script>
    {{-- EDIT DATA --}}
    <script>
        const form = document.getElementById('modal-tambah-data');
        const btnEdit = document.getElementById('btnEdit');

        function closeModal(){
            form.setAttribute('data-type', 'post');
            $('#nama').val('');
            $('#id_pasar').val('');
            console.log('FORMCLOSE', form.getAttribute('data-type'));
        }
        
        function edit(id){
            $('#modal').modal({backdrop: 'static', keyboard: false})
            const url =`/rekening/${id}/edit`;
            form.setAttribute('data-type', 'edit');
            console.log('ID', id);

            $.get(url, function (data) {
                console.log('DATA', data)
                $('#modal').modal('show');
                $('#nama_bank').val(data.nama_bank);
                $('#no_rek').val(data.no_rek);
                $('#atas_nama').val(data.atas_nama);
                form.setAttribute('data-id', data.id);

            })
        }


    </script>
    {{-- HAPUS DATA --}}
    <script>
        $(".deleteRecord").click(function(){
            var id = $(this).data("id");
            var token = $("meta[name='csrf-token']").attr("content");
        
            $.ajax(
            {
                url: "rekening/"+id,
                type: 'DELETE',
                data: {
                    "id": id,
                    "_token": token,
                },
                success: function (response){
                    console.log("it Works");
                        toastr.success(`${response.message}`, "Success", {
                            timeOut: 2e3,
                            closeButton: !0,
                            debug: !1,
                            newestOnTop: !0,
                            progressBar: !0,
                            positionClass: "toast-top-right",
                            preventDuplicates: !0,
                            onclick: null,
                            showDuration: "300",
                            hideDuration: "1000",
                            extendedTimeOut: "1000",
                            showEasing: "swing",
                            hideEasing: "linear",
                            showMethod: "fadeIn",
                            hideMethod: "fadeOut",
                            tapToDismiss: !1,
                        });
                        setTimeout(() => {
                            location.reload()
                        }, 3000);
                }
            });
        
        });
    </script>

@endpush