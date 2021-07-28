@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perakitan (Pemeriksaan)</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="/perakitan/pemeriksaan">Perakitan</a></li>
                    <li class="breadcrumb-item active">Tambah Pemeriksaan</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Info Perakitan</div>
                </div>
                <div class="card-body">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="Dalla dalla">
                        </div>
                        <div style="text-align:center;vertical-align:center;padding-top:10px">
                            <h5 class="card-heading">{{$p->bppb->produk->tipe}}</h5>
                            <h6 class="card-subheading text-muted">{{$p->bppb->produk->nama}}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" style="vertical-align: middle;">
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted">No BPPB</h6>
                                <h5 class="card-heading">{{$p->bppb->no_bppb}}</h5>
                            </hgroup>
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted ">Tanggal Perakitan</h6>
                                <h5 class="card-heading">{{$p->tanggal}}</h5>
                            </hgroup>
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted ">Jumlah</h6>
                                <h5 class="card-heading">{{count($p->hasilperakitan)}}</h5>
                            </hgroup>
                        </div>
                        <div class="col-lg-6" style="vertical-align: middle;">
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted ">Jumlah Sample</h6>
                                <h5 class="card-heading">{{count($p->hasilperakitan)}}</h5>
                            </hgroup>
                            <hgroup>
                                <!-- hgroup is deprecated, just defiantly using it anyway -->
                                <h6 class="card-subheading text-muted ">Kesimpulan</h6>
                                <h5 class="card-heading" id="kesimpulans"><span class="info-text">Pemeriksaan</span></h5>
                            </hgroup>
                        </div>
                        <hgroup class="col-lg-12">
                            <!-- hgroup is deprecated, just defiantly using it anyway -->
                            <h6 class="card-subheading text-muted ">Status</h6>
                            <h5 class="card-heading">
                                <div class="inline-flex">
                                    <a href="">
                                        <button type="button" class="btn btn-block btn-outline-danger karyawan-img-small" style="border-radius:50%;" title="Tolak Hasil Perakitan"><i class="fas fa-times"></i></button>
                                    </a>
                                </div>
                                <div class="inline-flex">
                                    <a href="">
                                        <button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" title="Terima Hasil Perakitan"><i class="fas fa-check"></i></button>
                                    </a>
                                </div>
                            </h5>
                        </hgroup>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="col-lg-12">
                <form action="form-pemeriksaan">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <h3>Pemeriksaan Rakit</h3>
                                <hr style="border-top: 1px solid #bbb;">

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Nomor Pemeriksaan</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="no_pemeriksaan" id="no_pemeriksaan" value="{{old('no_pemeriksaan')}}" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_pemeriksaan-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{old('tanggal')}}" style="width:45%;">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Jenis Pemeriksaan</label>

                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="jenis_sampling" checked="" id="no" value="no">
                                                        <label for="no">
                                                            Lolos 100%
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="jenis_sampling" id="sample" value="sample">
                                                        <label for="sample">
                                                            AQL 6.5
                                                        </label>
                                                    </div>
                                                    <div class="icheck-danger d-inline col-sm-4">
                                                        <input type="radio" name="jenis_sampling" id="all" value="all">
                                                        <label for="all">
                                                            Check 100%
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Kesimpulan</label>

                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="kesimpulan_pemeriksaan" id="terima" value="terima">
                                                        <label for="terima">
                                                            Terima
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="kesimpulan_pemeriksaan" id="dipertimbangkan" value="dipertimbangkan">
                                                        <label for="dipertimbangkan">
                                                            Dipertimbangkan
                                                        </label>
                                                    </div>
                                                    <div class="icheck-danger d-inline col-sm-4">
                                                        <input type="radio" name="kesimpulan_pemeriksaan" id="tolak" value="tolak">
                                                        <label for="tolak">
                                                            Tolak
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kesimpulan_pemeriksaan-msg"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="keterangan_pemeriksaan" id="keterangan_pemeriksaan" style="width:70%;"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                            <div class="col-lg-12">
                                <h3>Data Pemeriksaan</h3>
                                <hr style="border-top: 1px solid #bbb;">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table class="table table-bordered" id="tableitem">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>No Seri</th>
                                                    <th>Operator</th>
                                                    <th>Kondisi</th>
                                                    <th>Tindak Lanjut</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><select class="select2 form-control " name="no_seri_inp" id="no_seri_inp" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                            @foreach($p->hasilperakitan as $i)
                                                            <option value="{{$i->id}}">{{$i->no_seri}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><select class="select2 form-control" multiple="multiple" name="karyawan_id_inp[]" id="karyawan_id_inp" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                            @foreach($k as $ks)
                                                            <option value="{{$ks->id}}">{{$ks->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" name="kondisi" id="ok">
                                                                        <label for="ok">
                                                                            Baik
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" name="kondisi" id="nok">
                                                                        <label for="nok">
                                                                            Tidak Baik
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline">
                                                                        <input type="radio" name="tindak_lanjut" id="pengujian">
                                                                        <label for="pengujian">
                                                                            Pengujian
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-danger d-inline">
                                                                        <input type="radio" name="tindak_lanjut" id="karantina">
                                                                        <label for="karantina">
                                                                            Gudang Karantina
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span class="invalid-feedback" role="alert"></span>
                                                    </td>
                                                    <td><textarea class="form-control" name="keterangan_inp" id="keterangan_inp"></textarea></td>
                                                    <td><button class="btn btn-success  btn-circle btn-circle-sm m-1" id="tambahitem"><i class="fas fa-plus"></i></button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-right"><button class="btn btn-info rounded-pill" id="button_tambah">Tambah</button></span>
                        </div>
                    </div>
                </form>
            </div>
            <!-- <div class="col-lg-12">
                <div class="card" id="card-pemeriksaan">
                    
                    <div class="card-body">
                            <div class="col-lg-12">
                                <h3>Hasil Pemeriksaan</h3>
                                <hr style="border-top: 2px solid #bbb;">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">No Seri</label>
                                                <div class="col-sm-8">
                                                    <select class="select2 form-control" name="no_seri_inp" id="no_seri_inp" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                        @foreach($p->hasilperakitan as $i)
                                                            <option value="{{$i->id}}">{{$i->no_seri}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span role="alert" id="no_seri-msg"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Karyawan</label>
                                                <div class="col-sm-8">
                                                    <select class="select2 form-control" multiple="multiple" name="karyawan_id_inp[]" id="karyawan_id_inp" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                        @foreach($k as $ks)
                                                        <option value="{{$ks->id}}">{{$ks->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span role="alert" id="karyawan_id-msg"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Kondisi</label>
                                                
                                                <div class="col-sm-8"  style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-6">
                                                        <input type="radio" name="kondisi_inp" checked="" id="ok" value="ok">
                                                        <label for="ok">
                                                        Baik
                                                        </label>
                                                    </div>
                                                    <div class="icheck-danger d-inline col-sm-6">
                                                        <input type="radio" name="kondisi_inp" id="nok" value="nok">
                                                        <label for="nok">
                                                        Tidak Baik
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Tindak Lanjut</label>
                                                
                                                <div class="col-sm-8"  style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-6">
                                                        <input type="radio" name="tindak_lanjut_inp" checked="" id="pengujian" value="pengujian">
                                                        <label for="pengujian">
                                                        Pengujian
                                                        </label>
                                                    </div>
                                                    <div class="icheck-danger d-inline col-sm-6">
                                                        <input type="radio" name="tindak_lanjut_inp" id="karantina" value="karantina">
                                                        <label for="karantina">
                                                        Gudang Karantina
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control" name="keterangan_inp" id="keterangan_inp"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row float-right">
                                            <span class="float-right"><button class="btn btn-info rounded-pill" id="tambahbaris"><i class="fas fa-plus"></i>&nbsp;Tambahkan Data</button></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                    </div>
                    <div class="card-footer">
                    <span class="float-right"><button class="btn btn-success">Simpan</button></span>
                    </div>
                </div>
            </div> -->

        </div>
    </div>
</section>
@endsection

@section('footer_script')
<!-- <script>
$(function(){
    var no_seri_arr = [];
    var jumlah_rusak = 0;
    var jumlah_rakit = {{count($p->hasilperakitan)}};
    var id_perakitan = {{$p->id}};
    var jumlah_sampling = 0;

    $('input[type=radio][name=jenis_sampling]').change(function() {
        if(this.value == 'no') 
        {
            jumlah_sample = 0;
        }
        else if(this.value == 'sample') 
        {
            jumlah_sample = jumlah_sampling(jumlah_rakit);
        }
        else if(this.value == 'all')
        {
            jumlah_sample = jumlah_rakit;
        }
    });

    function jumlah_sampling(jumlah_rakit)
    {
        $.ajax({
            url : '/jumlah_sampling/' +jumlah_rakit,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                if(data > 0)
                {
                    return data;
                }
                else
                {
                    return 0;
                }
            }
        });
    }

    function change_no_seri(id, no_seri)
    {   
        if(no_seri.length <= 0)
        {
            no_seri = "[]";
        }
        $.ajax({
            url : '/get_no_seri_perakitan_not_in/'+id+'/'+no_seri,
            type : "GET",
            dataType : "json",
            success:function(data)
            {
                console.log(data);
                $('select[name="no_seri_inp"]').empty();
                $.each(data, function(key,value)
                {
                    console.log(value);
                    $('select[name="no_seri_inp"]').append('<option value="'+ value['id'] +'">'+ value['no_seri'] +'</option>');
                });
            }
        });
    }

    function removeElement(array, elem) {
        var index = array.indexOf(elem);
        if (index > -1) {
            array.splice(index, 1);
        }
    }
    
    $('#tanggal').val(today);

    $('#tambahbaris').on('click', function(){
        var no_seri = $('#no_seri_inp').val();
        var karyawan_id = [];
        var kl = [];
        $( "select[name='karyawan_id_inp[]'] option:selected" ).each(function(){
            karyawan_id.push($(this).val());
            kl.push($(this).text());
        })

        var kondisi = $('input[name="kondisi_inp"]:checked').val();
        var tindak_lanjut = $('input[name="tindak_lanjut_inp"]:checked').val();
        var keterangan = $('#keterangan_inp').val();
        var data = "";

        if(no_seri == 0 || karyawan_id.length <= 0)
        {
            if(no_seri == 0)
            {
                $('#no_seri-msg').addClass("invalid-feedback");
                $('#no_seri_inp').addClass("is-invalid");
                $('#no_seri-msg').html("Harap pilih No Seri");
            }
            if(karyawan_id.length <= 0)
            {
                $('#karyawan_id-msg').addClass("invalid-feedback");
                $('#karyawan_id_inp').addClass("is-invalid");
                $('#karyawan_id-msg').html("Harap pilih Karyawan");
            }
        }
        else
        {
            $('#no_seri-msg').removeClass("invalid-feedback");
            $('#no_seri_inp').removeClass("is-invalid");
            $('#no_seri-msg').html("");
            
            $('#karyawan_id-msg').removeClass("invalid-feedback");
            $('#karyawan_id_inp').removeClass("is-invalid");
            $('#karyawan_id-msg').html("");

            no_seri_arr.push(no_seri);
            change_no_seri(id_perakitan, no_seri_arr);
            data += `<tr>
                <td class="counterCell"></td>
                <td><input type="text" name="no_seri[]" class="form-control" value="`+no_seri+`" hidden>`+$('#no_seri_inp').text()+`</td>
                <td><input type="text" name="karyawan_id[]" class="form-control" value="`+karyawan_id+`" hidden>`
                for(var i=0; i<kl.length; i++)
                {
                    data += `<span class="purple-text">`+kl[i]+`</span><br><br>`;
                }
                data+=`</td>
                <td><input type="text" name="kondisi[]" class="form-control" value="`+kondisi+`" hidden>`;
                if(kondisi == "ok")
                {
                    data += `<span style="color:green;"><i class="fas fa-check-circle"></i></span>`;
                }
                else if(kondisi == "nok")
                {
                    data += `<span style="color:red;"><i class="fas fa-times-circle"></i></span>`;
                }
                data += `</td>
                <td><input type="text" name="tindak_lanjut[]" class="form-control" value="`+tindak_lanjut+`" hidden>`;
                if(tindak_lanjut == "pengujian")
                {
                    data += `<span class="success-text">Pengujian</span>`;
                }
                else if(tindak_lanjut == "karantina")
                {
                    data += `<span class="danger-text">Gudang Karantina</span>`;
                }
                data += `</td>
                <td><textarea name="keterangan[]" id="keterangan[]" class="form-control" hidden>`+keterangan+`</textarea>
                    `+keterangan+`
                </td>
                <td><button type="button" class="btn btn-block btn-danger btn-sm" id="closetable" ><i class="fas fa-times-circle"></i></button></td>
            </tr>`;
            $('#tableitem > tbody').append(data);
        }
    });

    $('#tableitem').on('click', '#closetable', function(e)
    {
        var no_seri = $(this).closest('tr').find('input[name="no_seri[]"').val();
        removeElement(no_seri_arr, no_seri);
        change_no_seri(id_perakitan, no_seri_arr);
        $(this).closest('tr').remove();
    });
})
</script> -->
@stop