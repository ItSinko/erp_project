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
                        <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Detail pengecekan harian</div>
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
                                <div class="row">

                                    <div class="col-lg-6">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Suhu</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">

                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                {!! $chart->container() !!}
                                                {!! $chart->script() !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Pulse Oximeter</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="chart">
                                                    <canvas id="canvas">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        <table id="tabel" class="table table-hover styled-table table-striped">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th colspan="2">Suhu</th>
                                                    <th colspan="2">Oximeter</th>
                                                </tr>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tgl Pengecekan</th>
                                                    <th>Pagi</th>
                                                    <th>Siang</th>
                                                    <th>SpO2 (%)</th>
                                                    <th>PR (bpm)</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                            </tbody>
                                        </table>
                                    </div>
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
    $(function() {



        var karyawan_id = 0;
        var tabel = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/kesehatan_harian/detail/' + karyawan_id,
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
                    data: 'pagi'
                },
                {
                    data: 'siang'
                },
                {
                    data: 'sp'
                },
                {
                    data: 'pr'
                },
            ]
        });

    });

    $('#karyawan_id').change(function() {
        var karyawan_id = $(this).val();
        $('#tabel').DataTable().ajax.url('/kesehatan_harian/detail/' + karyawan_id).load();
    });
</script>
@endsection