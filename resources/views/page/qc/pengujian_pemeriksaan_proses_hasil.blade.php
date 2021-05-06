@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pengujian</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h3>Informasi</h3><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->no_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$s->DetailProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label text-muted">Ubah Pemeriksaan</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                <a href="{{ route('pengujian.monitoring_proses.laporan.edit', ['id' => $id]) }}"><button class="btn btn-warning rounded-pill"><i class="fas fa-edit"></i>&nbsp;Edit</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <h3>Hasil Monitoring Proses</h3><br>
                    @if ($errors->has('file'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                    @endif

                    {{-- notifikasi sukses --}}
                    @if ($sukses = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $success }}</strong>
                    </div>
                    @endif

                    <table id="example" class="table table-hover styled-table">
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Pemeriksaan</th>
                                <th rowspan="2">Standar Keberterimaan</th>
                                <th colspan="2">Jumlah</th>
                                <th rowspan="2">Detail Rusak</th>
                            </tr>
                            <tr>
                                <th><i class="fas fa-check-circle" style="color:green;"></i></th>
                                <th><i class="fas fa-times-circle" style="color:red;"></i></th>
                            </tr>
                        </thead>
                        <tbody style="text-align:center;">

                            @foreach($s->DetailProduk->IkPemeriksaanPengujian as $i)
                            <tr>
                                <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}">{{$loop->iteration}}</td>
                                <td rowspan="{{$i->HasilIkPemeriksaanPengujian->pluck('id')->count()}}">{{$i->hal_yang_diperiksa}}</td>
                                @foreach($i->HasilIkPemeriksaanPengujian as $j)
                                <td>{{$j->standar_keberterimaan}}</td>
                                <td>{{$s->countMonitoringProses() - $s->countPemeriksaanProses($j->id)}}</td>
                                <td>{{$s->countPemeriksaanProses($j->id)}}</td>
                                <td>@if($s->countPemeriksaanProses($j->id) != 0)<a class="pemeriksaanprosesmodal" data-toggle="modal" data-target="#pemeriksaanprosesmodal" data-attr="{{route('pengujian.pemeriksaan_proses.not_ok.show', ['bppb_id' => $s->id, 'ik_pengujian_id' => $j->id])}}"><button type="button" class="btn btn-sm m-1 btn-info" style="border-radius: 50%;"><i class="fas fa-search"></i></button></a>@endif</td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="modal fade" id="pemeriksaanprosesmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:	#006400;">
                        <h4 class="modal-title" id="myModalLabel" style="color:white;">Laporan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" id="pemeriksaanproses">

                    </div>
                </div>
            </div>
        </div>

        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        $(document).on('click', '.pemeriksaanprosesmodal', function(event) {
            event.preventDefault();
            var href = $(this).attr('data-attr');
            var dataid = $(this).attr('data-id');
            $.ajax({
                url: "{{route('pengujian.pemeriksaan_proses.not_ok')}}",
                beforeSend: function() {
                    $('#loader').show();
                },
                // return the result
                success: function(result) {
                    $('#pemeriksaanprosesmodal').modal("show");
                    $('#pemeriksaanproses').html(result).show();
                    console.log(result);
                    $('#detaildata').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: href,
                        columns: [{
                                data: 'DT_RowIndex',
                                name: 'DT_RowIndex',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'tanggal',
                                name: 'tanggal'
                            },
                            {
                                data: 'karyawan',
                                name: 'karyawan'
                            },
                            {
                                data: 'no_seri',
                                name: 'no_Seri'
                            }
                        ]
                    });
                },
                complete: function() {
                    $('#loader').hide();
                },
                error: function(jqXHR, testStatus, error) {
                    console.log(error);
                    alert("Page " + href + " cannot open. Error:" + error);
                    $('#loader').hide();
                },
                timeout: 8000
            })
        });

    });
</script>
@stop