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
                                <h4 class="card-title">Data Pembayaran</h4>
                                
                                <div class="basic-form">
                                    
                                    <form data-action="{{ route('pembayaran.store') }}" data-id="" data-type="post" method="POST" id="modal-tambah-data" enctype="multipart/form-data">
                                        @csrf
                                        @if (Auth::user()->tipe == 'operator')
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nama Pemilik</label>
                                                <div class="col-sm-10">

                                                    <select id="id_pemilik" onchange="handlePemilik()" name="id_pemilik" class="form-control" >
                                                        <option value="" selected  disabled>Pilih Pemilik</option>
                                                        @foreach ($pemilik as $item)
                                                            <option value="{{$item->id}}">{{ $item->nama_pemilik }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div style="display: none" id="val-id_pemilik-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nama Usaha</label>
                                                <div class="col-sm-10">

                                                    <select id="id_usaha" onchange="handleUsaha()" name="id_usaha" class="form-control" >
                                                        <option value="" selected disabled>Pilih Usaha</option>
                                                        {{-- @foreach ($usaha as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama_usaha }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                    <div style="display: none" id="val-id_usaha-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Nama Pasar</label>
                                                <div class="col-sm-10">

                                                    <select id="id_pasar" name="id_pasar" class="form-control" >
                                                        <option value="" selected disabled>Pilih Pasar</option>
                                                        @foreach ($pasar as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div style="display: none" id="val-id_pasar-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div> --}}
                                            <input id="id_pasar" type="hidden" name="id_pasar">
                                            <input id="total" type="hidden" name="total">
                                            
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Tanggal Pembayaran</label>
                                                <div class="col-sm-10">
                                                    <input id="tgl_pembayaran" type="date" name="tgl_pembayaran" class="form-control" placeholder="...">
                                                    <div style="display: none" id="val-tgl_pembayaran-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Jumlah Tagihan</label>
                                                <div class="col-sm-10">
                                                    <input readonly onchange="handleTotal()" id="jlh_pembayaran" type="number" name="jlh_pembayaran" class="form-control" placeholder="...">
                                                    <div style="display: none" id="val-jlh_pembayaran-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Denda</label>
                                                <div class="col-sm-10">
                                                    <input onchange="handleTotal()" id="denda" type="number" name="denda" value="0" class="form-control" placeholder="...">
                                                    <div style="display: none" id="val-denda-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        
                                        @if (Auth::user()->tipe == 'bendahara')
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Bukti Pembayaran</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group mb-3">
                                                     
                                                    <img id="showFoto" src="" alt="" style="
                                                        width: 100%;
                                                        height: 300px;
                                                        object-fit: contain;
                                                        object-position: bottom;

                                                    ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Status Pembayaran</label>
                                                <div class="col-sm-10">

                                                    <select id="status" name="status" class="form-control" >
                                                        <option value="" selected disabled>Pilih Status Pembayaran</option>
                                                        <option value="baru">Baru</option>
                                                        <option value="lunas">Lunas</option>
                                                        <option value="jatuh_tempo">Jatuh Tempo</option>
                                                    </select>
                                                    <div style="display: none" id="val-status-error" class="invalid-feedback animated fadeInDown" style="display: block;"></div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        
                                        {{-- <div class="form-group row">
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
                                            </div>
                                        </div> --}}
                                       
                                        
                                    
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
                          <h4 class="card-title">Data Pembayaran</h4>
                          <div style="display: flex;justify-items: center;align-items: baseline">
                            <div class="btn-group mb-1 mr-2">
                                <button class="btn btn-outline-info  font-weight-bold dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pilih Pasar
                                </button>
                                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 42px, 0px);">
                                    @foreach ($pasar as $item)
                                        <a class="dropdown-item" href="{{ route('pembayaran.filter', $item->id) }}">{{ $item->nama }}</a>
                                    @endforeach
                                    
                                    <div class="dropdown-divider"></div>
                                    <p class="dropdown-item" href="#">Pilih Pasar</p>
                                </div>
                            </div>
                          @if (Auth::user()->tipe === 'operator')
                            
                            <button class="btn btn-success font-weight-bold" style="color:white" type="button" data-toggle="modal" data-target=".bd-example-modal-lg">
                                TAMBAH DATA <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>
                              
                          @endif
                          </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemilik</th>
                                        <th>Nama Usaha</th>
                                        <th>Nama Pasar</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Retribusi</th>
                                        <th>Status</th>
                                        <th>Opsi</th>

                                        {{-- @if (Auth::user()->tipe === 'bendahara')
                                            <th>Opsi</th>
                                            
                                        @endif --}}
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_pemilik }}</td>
                                        <td>{{ $item->nama_usaha }}</td>
                                        <td>{{ $item->nama_pasar }}</td>
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
                                                    
                                            @endswitch">
                                                {{ $item->status === 'verifikasi' ? 'menunggu verifikasi' : $item->status }}
                                            </span> 
                                        </td>
                                        <td>
                                          
                                            <button 
                                            
                                            type="button" id="btnEdit" 
                                                onclick="edit('{{ $item->id }}')"
                                                  
                                             style="color: white" class="btn btn-warning">
                                              <i class="fa fa-pencil"></i>

                                            </button>
                                            <button 
                                                {{-- @if ($item->status === 'lunas')
                                                    disabled
                                                @endif --}}
                                                class="btn btn-danger deleteRecord" data-id="{{ $item->id }}" type="submit">
                                              <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        {{-- @if (Auth::user()->tipe === 'bendahara')
                                        <td>
                                          
                                            <button 
                                            @if ($item->status === 'lunas')
                                                disabled
                                            @endif 
                                            type="button" id="btnEdit" 
                                                onclick="edit('{{ $item->id }}')"
                                                  
                                             style="color: white" class="btn btn-warning">
                                              <i class="fa fa-pencil"></i>

                                            </button>
                                            <button 
                                                @if ($item->status === 'lunas')
                                                    disabled
                                                @endif
                                                class="btn btn-danger deleteRecord" data-id="{{ $item->id }}" type="submit">
                                              <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        @endif --}}
                                    </tr>
                                  @endforeach
                                    
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemilik</th>
                                        <th>Nama Usaha</th>
                                        <th>Nama Pasar</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Retribusi</th>
                                        <th>Status</th>
                                        {{-- @if (Auth::user()->tipe === 'bendahara') --}}
                                            <th>Opsi</th>
                                            
                                        {{-- @endif --}}
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
                        url: `/pembayaran/${id}`,
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
            $('#id_pemilik').val('');
            $('#id_pasar').val('');
            $('#id_usaha').val('');
            $('#nama_usaha').val('');
            $('#bukti_pembayaran').val('');
            $('#tgl_pembayaran').val('');
            $('#jlh_pembayaran').val('');
            $('#jlh_pembayaran').val('');
            $('#denda').val('');
            $('#status').val('');
            output.src = ''
            console.log('FORMCLOSE', form.getAttribute('data-type'), output.src);
        }
        const handleGetUsaha = async (idUsaha) => {
            let data = await handleGetDataPemilik();
            
            console.log('testUSAHA', data);
            // const idUsaha = $('#id_usaha').val();

            const selectedUsaha = data.filter((v) => v.id == idUsaha)[0];
            console.log('HANDLEUSAHA', selectedUsaha, idUsaha);

            const idPasar = $('#id_usaha');
            const jlh_pembayaran = $('#jlh_pembayaran');
            $('#id_usaha').val(selectedUsaha.id);
            // idPasar.val(selectedUsaha.id_usaha);
            jlh_pembayaran.val(selectedUsaha.jlh_tagihan);
            handleTotal();
        }

        async function edit(id){
            $('#modal').modal({backdrop: 'static', keyboard: false})
            const url =`/pembayaran/${id}/edit`;
            form.setAttribute('data-type', 'edit');
            console.log('ID', id);
            
            
            $.get(url, function (data) {
                console.log('DATA', data.data.id)
                form.setAttribute('data-id', data.data.id);
                $('#modal').modal('show');
                $('#id_pasar').val(data.data.id_pasar);
                $('#id_usaha').val(data.data.id_usaha);
                $('#nama_usaha').val(data.data.nama_usaha);
                $('#id_pemilik').val(data.data.id_pemilik);
                $('#tgl_pembayaran').val(data.data.tgl_pembayaran);
                $('#jlh_pembayaran').val(data.data.jlh_pembayaran);
                $('#status').val(data.data.status);
                $('#denda').val(data.data.denda);

                handlePemilik()
                handleGetUsaha(data.data.id_usaha);

                output.src = `{{ asset('bukti_pembayaran')}}/${data.data.bukti_pembayaran}`;
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
                url: "pembayaran/"+id,
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
    
    {{-- ONCHANGE FUNCTION --}}
    <script>
        


        var handleGetDataPemilik = async () => {
            let getData;
            const idPemilik = $('#id_pemilik').val();
            var url = '{{ route("pembayaran.detail-usaha", ":id") }}';
            url = url.replace(':id', idPemilik);
            getData = await $.get(url, function (data) {
                    // console.log('DATA', data)
                    
                    return data;
                    console.log('HANDLEGETPEMILIK', getData);
                })
            return getData.data;
        }
        
         var handlePemilik = async () => {

            console.log('testPEMILIk');
            selectPasar = document.getElementById('id_usaha');
            $('#jlh_pembayaran').val('');

            
            // removeOptions(selectPasar);
            removeThenAdd();
            createOptionDisabled(selectPasar);



            let data = await handleGetDataPemilik();
            
            // $('#id_pasar').val(data.id_pasar);
            data.map((v, key) => {
                console.log('LOG', v);
                console.log('key', key);
                let opt = document.createElement('option');
                opt.value = v.id;
                opt.innerHTML = `${v.nama_usaha} -- ${v.nama_pasar} -- ${v.nama_blok}`;
                
                selectPasar.appendChild(opt);
            })
            // getData = data.data;

            
            console.log('HANDLEPEMILIK', data);
        }
        function createOptionDisabled (selectElement){
            let opt = document.createElement('option');
            opt.value = ''
            opt.selected = true;
            opt.disabled = true;
            opt.innerHTML = '-- Pilih USAHA Pemilik --'

            selectElement.appendChild(opt);
        }

        function removeThenAdd() {
            $("#id_usaha").find("option").remove().end();
        }

        var handleTotal = () => {
            const denda = $('#denda').val()
            const jlh_pembayaran = $('#jlh_pembayaran').val()

            let total = $('#total');
            total = total.val(parseInt(jlh_pembayaran) + parseInt(denda) )
            console.log('TOTAL', total, 'DENDA', denda,'JLH', jlh_pembayaran, );

        }

        // function removeOptions(selectElement) {
        //     console.log('SELECTELEMENTLENGTH', selectElement.options.length);
        //     var i, L = selectElement.options.length - 1;
        //     for(i = 1; i >= 0; i--) {
        //         selectElement.remove(i);
        //     }
        // }

        var handleUsaha = async () => {
            let data = await handleGetDataPemilik();
            
            console.log('testUSAHA', data);
            const idUsaha = $('#id_usaha').val();

            const selectedUsaha = data.filter((v) => v.id == idUsaha)[0];

            const idPasar = $('#id_pasar');
            const jlh_pembayaran = $('#jlh_pembayaran');
            idPasar.val(selectedUsaha.id_pasar);
            jlh_pembayaran.val(selectedUsaha.jlh_tagihan);
            handleTotal();
            console.log('HANDLEUSAHA', selectedUsaha);
        }

    </script>

@endpush