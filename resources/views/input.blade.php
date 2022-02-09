@extends('layouts.main')
@section('title', 'Input')
@section('content')
<div class="container card">
    <div class="card-body">
        <h2>Input Nomor Handphone</h2>
        <hr>
    
        <form>
            <div class="card-body">
                <div class="col-md-12">
                    <input type="hidden" id="user_id" value="{{auth()->user()->id}}">
                    <div class="form-group">
                        <label for="no_hp">Nomor Handphone</label>
                        <input name="no_hp" id="no_hp" class="form-control" placeholder="Contoh:08584839264"
                            type="number" value="{{ old('no_hp') }}"
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
            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-submit" onclick="tambahData()" >Simpan</button>
                <a class="btn btn-warning" id="auto">Auto</a>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

    let $form = $('form');

    $('#auto').on('click', () => {
        $form.find("select").each((i, el) => {
            let $options = $(el).find('option');
            let index = Math.floor(Math.random() * $options.length);
            $options.eq(index).prop('selected', true);
        });
        let no_hp = '08'+ Math.floor((Math.random() * 9) + 1)+Math.floor((Math.random() * 500) + 100)+Math.floor((Math.random() * 500) + 100)+Math.floor((Math.random() * 500) + 100);
        $('#no_hp').val(no_hp)
        tambahData()
    });

    function tambahData(){
        var no_hp = $("#no_hp").val();
        var provider = $("#provider").val();
        var user_id = $("#user_id").val();
        event.preventDefault();
        swal({
            title: 'Anda akan menambahkan data?',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                $.ajax({
                    url: '/api/input',
                    data : {
                        "_token" : "{{csrf_token()}}",
                        no_hp:no_hp, 
                        provider:provider, 
                        user_id:user_id
                    },
                    type: 'post',
                    dataType: 'json',
                    success: function(result){
                        if(result){
                            swal({ 
                                title: "Berhasil!", 
                                text: "Berhasil menambahkan data !", 
                                icon: "success" 
                            }).then(function() {
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

</script>
@endsection