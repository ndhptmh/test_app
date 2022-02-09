@extends('layouts.main')
@section('title', 'Home')
@section('content')
<div class="container card">
    <div class="card-body">
        <h2>Daftar Nomor Handphone</h2>
        <hr>
        @if(session()->has('status'))
            @if (!session('hasError'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @elseif(session('hasError'))
                <div class="alert alert-danger">
                    {{ session('status') }}
                </div>
            @endif
        @endif
    
        <div class="table-responsive">
            <div class="row">
                <div class="col-md-6" style="padding: 0 !important;margin: 0 !important;">
                    <table id="ganjil" class="table table-bordered table-striped">
                        <thead>
                        <tr class="table-success">
                            <th class="text-center">Ganjil</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6" style="padding: 0 !important;margin: 0 !important;">
                    <table id="genap" class="table table-bordered table-striped">
                        <thead>
                        <tr class="table-success">
                            <th class="text-center">Genap</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editProvider" tabindex="-1" role="dialog" aria-labelledby="modalEditProvider" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form method="post" action="/admin/sop" autocomplete="off" id="formId" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditProvider">Tambah SOP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <input type="hidden" name="id" id="id_data">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <label for="no_hp">Nomor Handphone</label>
                        <input name="no_hp" id="no_hp" class="form-control" placeholder="Contoh:08584839264"
                            type="number"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="lokasi">Provider</label>
                        <select name="provider" id="provider" class="form-control" required>
                            <option value="" selected disabled> Pilih Provider</option>
                            <option value="telkomsel">Telkomsel</option>
                            <option value="xl">XL</option>
                            <option value="tri">Tri</option>
                            <option value="im3">Im3</option>
                            <option value="axis">Axis</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" onclick="simpanData()">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>

    $(document).ready(function() {
        $.ajax({ 
            type: "GET",
            url: "/api/output",       
            success: function (data) {
                //console.log(data.data.ganjil)       
                if(data.data.ganjil.length > 0){
                    for(var i=0; i<data.data.ganjil.length; i++){
                        var id = data.data.ganjil[i].id;
                        var no_hp = data.data.ganjil[i].no_hp;
                        var provider = data.data.ganjil[i].provider;

                        var tr_str = "<tr>" +
                        "<td align='center'>" + no_hp + 
                        "<a class='btn btn-xs btn-success' data-id="+data.data.ganjil[i].id+" data-toggle='modal' data-target='#editProvider'><i class='fas fa-edit'></i></a>"+
                        "<a href='javascript:void(0)' class='btn btn-xs btn-danger' type='button' onclick='hapusData("+id+")'>"
                        +"<i class='fa fa-trash'></i></a> </td>" +
                        "</tr>";

                        $("#ganjil tbody").append(tr_str);
                    }
                }else{
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='1'>Belum ada data</td>" +
                    "</tr>";

                    $("#ganjil tbody").append(tr_str);
                }  

                if(data.data.genap.length > 0){
                    for(var i=0; i<data.data.genap.length; i++){
                        var id = data.data.genap[i].id;
                        var no_hp = data.data.genap[i].no_hp;
                        var provider = data.data.genap[i].provider;
                        var tr_str = "<tr>" +
                        "<td align='center'>" + no_hp + 
                        "<a class='btn btn-xs btn-success' data-id="+data.data.genap[i].id+" data-toggle='modal' data-target='#editProvider'><i class='fas fa-edit'></i></a>"+
                        "<a href='javascript:void(0)' class='btn btn-xs btn-danger' type='button' onclick='hapusData("+id+")'>"
                        +"<i class='fa fa-trash'></i></a> </td>" +
                        "</tr>";

                        $("#genap tbody").append(tr_str);
                    }
                }else{
                    var tr_str = "<tr>" +
                        "<td align='center' colspan='1'>Belum ada data</td>" +
                    "</tr>";

                    $("#genap tbody").append(tr_str);
                }       
            }
        });
    });

    $('#editProvider').on('show.bs.modal', function(e) {
        var id = $(e.relatedTarget).data('id');
        $.ajax({ 
            type: "GET",
            url: "/api/provider/" + id,       
            success: function (data) {
                if(data.status==1){
                    $(e.currentTarget).find('#id_data').val(data.data.id);
                    $(e.currentTarget).find('#no_hp').val(data.data.no_hp);
                    $(e.currentTarget).find('#provider').val(data.data.provider);
                    $(e.currentTarget).find('#user_id').val(data.data.user_id);
                }
                // console.log(data)
            }
        })
        // $(e.currentTarget).find('#no_hp').val(data.no_hp);
    });

    function simpanData(){
        var id = $("#id_data").val();
        var no_hp = $("#no_hp").val();
        var provider = $("#provider").val();
        var user_id = $("#user_id").val();
        event.preventDefault();
        swal({
            title: 'Anda akan mengedit data?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                $.ajax({
                    url: '/api/provider/update/'+ id,
                    data : {
                        // "_token" : "{{csrf_token()}}",
                        no_hp:no_hp, 
                        provider:provider, 
                        user_id:user_id
                    },
                    type: 'put',
                    dataType: 'json',
                    success: function(result){
                        if(result){
                            swal({ 
                                title: "Berhasil!", 
                                text: "Berhasil mengedit data!", 
                                icon: "success" 
                            })
                            .then(function() {
                                window.location = "/home";
                            });

                        }else{
                            swal({ title: "Gagal!", text: result.message, icon: "error" })
                        }
                    },
                    error: function(err){
                        swal({ title: "Gagal!", text: "Terjadi kesalahan saat menambah data !", icon: "error" })
                    }
                })
            }
        });
    }

    function hapusData(id){
        event.preventDefault();
        swal({
            title: 'Anda akan menghapus data?',
            text: 'Data akan dihapus secara permanen!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                $.ajax({
                    url: '/api/provider/'+id,
                    data : {
                        "_token" : "{{csrf_token()}}"
                    },
                    type: 'delete',
                    dataType: 'json',
                    success: function(result){
                        //console.log(result)
                        if(result.status==1){
                            swal({ 
                                title: "Berhasil!", 
                                text: "Penghapusan berhasil dilakukan !", 
                                icon: "success" 
                            }).then(function() {
                                window.location = "/home";
                            });

                        }else{
                            swal({ title: "Gagal!", text: result.message, icon: "error" })
                        }
                    },
                    error: function(err){
                        swal({ title: "Gagal!", text: "Terjadi kesalahan saat menghapus data !", icon: "error" })
                    }
                })
            }
        });
    }
</script>
@endsection