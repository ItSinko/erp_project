@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
@stop
@section('content')
<section class="content-header">
    <div class="container-fluid">
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
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
            </div>
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{url('assets/image/user')}}/nora.png" alt="User profile picture">
                        </div>
                        <h3 class="profile-username text-center" id="nama">-</h3>
                        <p class="text-muted text-center" id="divisi">-</p>
                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Umur</b> <a class="float-right" id="umur">- Tahun</a>
                            </li>
                            <li class="list-group-item">
                                <b>Kelamin</b> <a class="float-right" id="kelamin">-</a>
                            </li>
                            <li class="list-group-item">
                                <b>Tinggi</b> <a class="float-right" id="tinggi">- Cm</a>
                            </li>
                            <li class="list-group-item">
                                <b>Buta Warna</b> <a class="float-right" id="butawarna">-</a>
                            </li>
                            <li class="list-group-item">
                                <b>Rabun Mata</b> <a class="float-right" id="matakiri">(kiri)</a>
                            </li>
                            <li class="list-group-item">
                                <a class="float-right" id="matakanan">(kanan)</a>
                            </li>
                            <li class="list-group-item">
                                <b>Vaksin</b> <a class="float-right" id="status_vaksin">-</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#berat" data-toggle="tab"><i class="fas fa-weight"></i> Berat badan</a></li>
                            <li class="nav-item"><a class="nav-link" href="#vaksin" data-toggle="tab"><i class="fas fa-syringe"></i> Riwayat vaksin</a></li>
                            <li class="nav-item"><a class="nav-link" href="#penyakit" data-toggle="tab"><i class="fas fa-head-side-cough"></i> Riwayat penyakit</a></li>
                            <li class="nav-item"><a class="nav-link" href="#obat" data-toggle="tab"><i class="fas fa-tablets"></i> Riwayat permintaan obat</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="berat">
                                <div class='table-responsive'>
                                    <table id="tabel_berat" class="table table-hover styled-table table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Bulan</th>
                                                <th>Berat</th>
                                                <th>Fat</th>
                                                <th>Tbw</th>
                                                <th>Muscle</th>
                                                <th>Bone</th>
                                                <th>Kalori</th>
                                                <th>Catatan</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="vaksin">
                                <div class='table-responsive'>
                                    <table class="table table-hover styled-table table-striped" width="100%" id="tabel_detail">
                                        <thead>
                                            <tr>
                                                <th width="1%">No</th>
                                                <th>Tgl</th>
                                                <th>Dosis</th>
                                                <th>Tahap</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="penyakit">
                                <div class='table-responsive'>
                                    <table class="table table-hover styled-table table-striped" width="100%" id="tabel_detail_penyakit">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Penyakit</th>
                                                <th>Jenis Penyakit</th>
                                                <th>Kriteria</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="obat">
                                <div class='table-responsive'>
                                    <table class="table table-hover styled-table table-striped" width="100%" id="tabel_obat">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Nama</th>
                                                <th>Analisa</th>
                                                <th>Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody style="text-align: center;">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection
@section('adminlte_js')
<script>
    $(function() {
        var karyawan_id = 0;
        var tabel_berat = $('#tabel_berat').DataTable({
            processing: true,
            serverSide: false,
            ajax: '/kesehatan_bulanan_berat/detail/' + karyawan_id,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tgl_cek'
                },
                {
                    data: 'z'
                },
                {
                    data: 'l'
                },
                {
                    data: 'k'
                },
                {
                    data: 'o'
                },
                {
                    data: 't'
                },
                {
                    data: 'ka'
                },
                {
                    data: 'keterangan'
                },
            ]
        });

        var vaksin_karyawan = $('#tabel_detail').DataTable({
            processing: true,
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: '/kesehatan/vaksin/' + karyawan_id,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tgl'
                },
                {
                    data: 'dosis'
                },
                {
                    data: 'tahap'
                },
            ],
        });

        $('#tabel_detail_penyakit').DataTable({
            processing: true,
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: '/kesehatan/penyakit/' + karyawan_id,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'nama'
                },
                {
                    data: 'jenis'
                },
                {
                    data: 'kriteria_penyakit'
                },
                {
                    data: 'keterangan'
                },
            ],
        });

        $('#tabel_obat').DataTable({
            processing: true,
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: '/obat/data/detail/' + karyawan_id,
            columns: [{
                    data: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'tgl_cek'
                },
                {
                    data: 'obat.nama'
                },
                {
                    data: 'analisa'
                },
                {
                    data: 'jumlah'
                },
            ],
        });
    });

    $('#karyawan_id').change(function() {
        var karyawan_id = $(this).val();
        $('#tabel_detail_penyakit').DataTable().ajax.url('/kesehatan/penyakit/' + karyawan_id).load();
        $('#tabel_detail').DataTable().ajax.url('/kesehatan/vaksin/' + karyawan_id).load();
        $('#tabel_berat').DataTable().ajax.url('/kesehatan_bulanan_berat/detail/' + karyawan_id).load();
        $('#tabel_obat').DataTable().ajax.url('/obat/data/detail/' + karyawan_id).load();
        $.ajax({
            url: "/kesehatan/data/" + karyawan_id,
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data[0].karyawan)
                $("#nama").text(data[0].karyawan.nama);
                $("#divisi").text(data[0].karyawan.divisi.nama);
                if (data[0].karyawan.kelamin == "L") {
                    $("#kelamin").text('Laki Laki');
                } else {
                    $("#kelamin").text('Perempuan');
                }
                $("#tinggi").text(data[0].tinggi + " Cm");
                $("#butawarna").text(data[0].status_mata);

                //Hitung Umur 
                dobDate = new Date(data[0].karyawan.tgllahir);
                nowDate = new Date();
                var diff = nowDate.getTime() - dobDate.getTime();
                var ageDate = new Date(diff); // miliseconds from epoch
                var age = Math.abs(ageDate.getUTCFullYear() - 1970);
                $("#umur").text(age + " Tahun");

                if (data[0].mata_kiri <= 6) {
                    $('#matakiri').text('Tidak Normal (kiri)');
                } else {
                    $('#matakiri').text('Normal (kiri)');
                }

                if (data[0].mata_kanan <= 6) {
                    $('#matakanan').text('Tidak Normal (kanan)');
                } else {
                    $('#matakanan').text('Normal (kanan)');
                }

            }
        });
    });
</script>
@endsection