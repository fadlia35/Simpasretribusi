@extends('partials.layout')

@section('content')
      <div id="modal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title">Form Tambah Data</h5>
                      <button type="button" onclick="closeModal()" class="close" data-dismiss="modal"><span>&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Data Usaha</h4>
                                <div class="basic-form" id="formPembayaran" style="display: none">
                                    
                                    <form data-action="{{ route('usaha.store') }}" data-id="" data-type="post" method="POST" id="modal-tambah-data" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                            <div class="form-group row">
                                                <label class="col-sm-12 col-form-label">Nama Usaha : {{ $usaha->nama_usaha }}</label>
                                                
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Denda</label>
                                                <div class="col-sm-10">
                                                    <input id="denda" readonly type="number" name="denda" class="form-control" placeholder="...">
                                                    <div style="display: none" id="val-denda-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Biaya Retribusi Pasar</label>
                                                <div class="col-sm-10">
                                                    <input id="jlh_pembayaran" readonly type="number" name="jlh_pembayaran" class="form-control" placeholder="...">
                                                    <div style="display: none" id="val-jlh_pembayaran-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Total yang harus dibayar</label>
                                                <div class="col-sm-10">
                                                    <input id="total" readonly type="number" name="total" class="form-control" placeholder="...">
                                                    <div style="display: none" id="val-total-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Rekening Tujuan</label>
                                                <div class="col-sm-10">

                                                    <select id="id_rekening" name="id_rekening" class="form-control" >
                                                        <option value="" selected disabled>Pilih Rekening</option>
                                                        @foreach ($rekening as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_bank }} - {{ $item->no_rek }} - {{ $item->atas_nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div style="display: none" id="val-id_rekening-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                              <label class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                                              <div class="col-sm-10">
                                                  <div class="input-group mb-3">
                                                      <input onchange="loadFile(event)" id="bukti_pembayaran" accept="image/*" type="file" name="bukti_pembayaran" class="form-control-file">
                                                      
                                                  <img id="showFoto" src="" alt="" style="
                                                      width: 100%;
                                                      height: 300px;
                                                      object-fit: contain;
                                                      object-position: bottom;

                                                  ">
                                                  </div>
                                                <div style="display: none" id="val-bukti_pembayaran-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                              </div>
                                            </div>
                                            <input type="hidden" name="id_pemilik" id="id_pemilik">
                                            {{-- <input type="hidden" name="id_pasar" id="id_pasar">
                                            <input type="hidden" name="id_blok" id="id_blok"> --}}
                                        
                                       
                                        
                                    
                                </div>
                                <div id="pesanError" class="alert alert-danger alert-dismissible fade show">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button> 
                                    Maaf data pembayaran retribusi anda<strong> BELUM TERSEDIA!</strong>, Mohon dicek kembali nanti.
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  
                    <div class="modal-footer">
                        <button type="button" onclick="closeModal()" class="btn btn-danger" data-dismiss="modal">Keluar</button>
                        <button id="button-simpan" type="submit" class="btn btn-success button" onclick="this.classList.toggle('button--loading')">
                            <span class="button__text">Simpan</span>
                        </button>
                    </div>    
                  </form>
              </div>
          </div>
      </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="display: flex;justify-items: center;justify-content: space-between;align-items: center;">
                          <h4 class="card-title">RIWAYAT RETRIBUSI :  {{ $usaha->nama_usaha }}</h4>
                          {{-- <button class="btn btn-success font-weight-bold" style="color:white" type="button" id="btnEdit" onclick="edit('{{ $usaha->id }}')">
                            BAYAR RETRIBUSI <i class="fa fa-plus-circle" aria-hidden="true"></i>
                          </button> --}}
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemilik</th>
                                        <th>Nama Pasar</th>
                                        <th>Nama Usaha</th>
                                        <th>Tanggal Tagihan</th>
                                        <th>Retribusi</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_pemilik }}</td>
                                        <td>{{ $item->nama_pasar }}</td>
                                        <td>{{ $item->nama_usaha }}</td>
                                        <td>{{ $item->tgl_pembayaran }}</td>
                                        <td>
                                            pokok : Rp.{{ number_format($item->jlh_pembayaran) }} <br>
                                            denda : Rp.{{ number_format($item->denda) }} <br>
                                            total : Rp.{{ number_format($item->total) }}
                                        </td>
                                        <td> 
                                            <span class="label @switch($item->status)
                                                @case('baru')
                                                    label-primary
                                                    @break
                                                @case('lunas')
                                                    label-success
                                                    @break
                                                @case('jatuh_tempo')
                                                    label-danger
                                                    @break
                                                @case('verifikasi')
                                                    label-info
                                                    @break
                                                @default
                                                    
                                            @endswitch">{{ $item->status === 'verifikasi' ? 'menunggu verifikasi' : $item->status }}</span> 
                                        </td>
                                        <td>
                                            @if ($item->status !== 'lunas')
                                                <button @if ($item->status !== 'baru')
                                                    disabled
                                                @endif class="btn btn-success font-weight-bold" style="color:white" type="button" id="btnEdit" onclick="edit('{{ $item->id }}')">
                                                    BAYAR RETRIBUSI <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                </button>
                                            @endif

                                            @if ($item->status === 'lunas')
                                                <a  href="{{ route('pemilik.pembayaran-create-nota', $item->id) }}" class="btn btn-primary font-weight-bold" style="color:white">
                                                    CETAK NOTA 
                                                </a>
                                            @endif
                                            
                                        </td>

                                        
                                    </tr>
                                  @endforeach
                                    
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemilik</th>
                                        <th>Nama Pasar</th>
                                        <th>Nama Usaha</th>
                                        <th>Tanggal Tagihan</th>
                                        <th>Retribusi</th>
                                        <th>Status</th>
                                        <th>Opsi</th>

                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@push('addScript')
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
                // let form = $('#modal-tambah-data')
                console.log('GETATTRIBUTE', $(this).attr('data-id'), ...form);

                if (type == 'post') {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: form.serializeArray(),
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
                        url: `/usaha-pemilik/${id}/pembayaran`,
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
                            console.log('RESPONSE ERROR', response.responseJSON, response);
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
        
        let fileFoto = document.getElementById('foto_pemilik');
        var output = document.getElementById('showFoto');
        // fungsi update foto
        function loadFile(event) {
            console.log('EVENT', event.target);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        
        
        function closeModal(){
            form.setAttribute('data-type', 'post');
            $('#formPembayaran').hide();
            $('#pesanError').show();
            $('#id_pemilik').val('');
            $('#id_rekening').val('');
            $('#denda').val('');
            $('#jlh_pembayaran').val('');
            $('#total').val('');
            output.src = ''
            console.log('FORMCLOSE', form.getAttribute('data-type'), output.src);
        }
        
        function edit(id){
            $('#modal').modal({backdrop: 'static', keyboard: false})
            const url =`/usaha-pemilik/${id}/pembayaran`;
            form.setAttribute('data-type', 'edit');
            console.log('ID', id);

            $.get(url, function (data) {
                console.log('DATA', data)
                if(data !== ''){
                    $('#formPembayaran').show();
                    $('#pesanError').hide();
                    $('#modal').modal('show');
                    $('#denda').val(data.denda);
                    $('#jlh_pembayaran').val(data.jlh_pembayaran);
                    $('#total').val(data.total);
                    $('#id_pemilik').val(data.id_pemilik);
                    $('#id_rekening').val(data.id_rekening);
                    $('#id_pasar').val(data.id_pasar);
                    $('#id_blok').val(data.id_blok);
                    form.setAttribute('data-id', data.id);
                    console.log('DATA', data);
                }
                

                // output.src = `{{ asset('foto_usaha')}}/${data.foto_usaha}`

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
                url: "pemilik/"+id,
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