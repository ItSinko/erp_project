@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
@stop
@section('content')
<section class="content-header">
    <div class="container-fluid">
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Detail pengecekan awal</div>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <div class="col-lg-12">
                                <div class="form-group row">

                                    <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Nama Karyawan</label>
                                    <div class="col-sm-8">
                                        <select type="text" class="form-control @error('divisi') is-invalid @enderror select2" name="divisi" style="width:45%;" id="karyawan_id">
                                            <option value="0">Pilih Data</option>
                                            @foreach ($karyawan as $k)
                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('divisi'))
                                        <div class="text-danger">
                                            {{ $errors->first('divisi')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row " id="detail_gagal" style="display:none">
                                    <div class="col-lg-4 col-md-4">
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <p>Data yang dicari tidak ada</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                    </div>
                                </div>
                                <div class="row " id="detail" style="display:none">
                                    <div class="col-sm-4 col-xs-12">
                                    </div>
                                    <!-- Profile Image -->
                                    <div class="col-sm-4 col-xs-12">
                                        <div class="card card-primary card-outline">
                                            <div class="card-body box-profile">
                                                <h3 class="profile-username text-center" id="nama"></h3>
                                                <p class="text-muted text-center" id="jabatan">Produksi</p>
                                                <ul class="list-group list-group-unbordered mb-3">
                                                    <li class="list-group-item">
                                                        <b>Umur</b> <a class="float-right" id="umur">23 tahun</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Jenis kelamin</b> <a class="float-right">Wanita</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Berat badan</b> <a class="float-right" id="berat"></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Tinggi badan</b> <a class="float-right" id="tinggi"></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Body Mass Index</b> <a class="float-right" id="bmi"></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Status Tubuh</b> <a class="float-right" id="status_tubuh"></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Buta Warna</b> <a class="float-right" id="buta_warna"></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Status vaksin</b> <a class="float-right" id="status_vaksin"></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Keterangan vaksin</b> <a class="float-right" id="ket_vaksin"></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Jenis rapid test</b> <a class="float-right" id="jenis_rapid"></a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <b>Hasil rapid test</b> <a class="float-right" id="hasil_rapid"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-xs-12">
                                    </div>
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-brown"><i class="fa fa-files-o"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Lemak</span>
                                                <span class="info-box-number" id="lemak"></span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-blue"><i class="fa fa-star-o"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kadar air dalam tubuh</span>
                                                <span class="info-box-number" id="kandungan_air"></span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-red"><i class="fa fa-star-o"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Massa Otot</span>
                                                <span class="info-box-number" id="otot"></span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-black"><i class="fa fa-star-o"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kalori</span>
                                                <span class="info-box-number" id="kalori"></span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->
                                    <div class="col-sm-6 col-xs-12">
                                        <div class="info-box">
                                            <span class="info-box-icon bg-white"><i class="fa fa-star-o"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Tulang</span>
                                                <span class="info-box-number" id="tulang"></span>
                                            </div><!-- /.info-box-content -->
                                        </div><!-- /.info-box -->
                                    </div><!-- /.col -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</section>
@endsection
@section('adminlte_js')
<script>
    $('#karyawan_id').change(function() {
        var karyawan_id = $(this).val();
        var detail_karyawan = function() {
            $.ajax({
                url: "/kesehatan/data/" + karyawan_id,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.length > 0) {
                        var sum = data[0].berat / ((data[0].tinggi / 100) * (data[0].tinggi / 100))
                        if (sum >= 30) {
                            $('#status_tubuh').text('Kegemukan (Obesitas)');
                        } else if (sum >= 25 || sum >= 29.9) {
                            $('#status_tubuh').text('Kelebihan Berat Badan');
                        } else if (sum >= 18.5 || sum >= 24.9) {
                            $('#status_tubuh').text('Normal (Ideal)');
                        } else {
                            $('#status_tubuh').text('Kekurangan Berat Badan');
                        }
                        $("#detail_gagal").hide('1000');
                        $("#detail").show('1000');
                        $("#umur").text(23);
                        $("#nama").text(data[0].karyawan.nama);
                        $("#jabatan").text(data[0].karyawan.jabatan);
                        $("#tinggi").text(data[0].tinggi + " Cm");
                        $("#berat").text(data[0].berat + " Kg");
                        $("#bmi").text(sum.toFixed(2));
                        $("#buta_warna").text(data[0].status_mata);
                        $("#status_vaksin").text(data[0].vaksin);
                        $("#ket_vaksin").text(data[0].ket_vaksin);
                        $("#jenis_rapid").text(data[0].tes_covid);
                        $("#hasil_rapid").text(data[0].hasil_covid);
                        $("#lemak").text(data[0].lemak);
                        $("#kandungan_air").text(data[0].kandungan_air);
                        $("#otot").text(data[0].otot);
                        $("#kalori").text(data[0].kalori);
                        $("#tulang").text(data[0].tulang);
                    } else {
                        $("#detail").hide('1000');
                        $("#detail_gagal").show('1000');
                    }
                },
                error: function(data) {
                    alert('nok');
                }
            });
        }
        detail_karyawan();
    });
</script>

@endsection