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
                        <div class="card-title">Chart</div>
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
                                    <div class="col-lg-4">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Pengukuran Tensi</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="tensi_sistolik_chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Pengukuran Tensi</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="tensi_diastolik_chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Rapid Test</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="rapid_chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <form action="/kesehatan_harian/aksi_tambah" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title">Tensi</div>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table id="tensi_tabel" class="table table-hover styled-table table-striped">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengecekan</th>
                                        <th>Sistolik</th>
                                        <th>Diastolik</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-lg-6">
            <form action="/kesehatan_harian/aksi_tambah" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title">Rapid</div>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table id="rapid_tabel" class="table table-hover styled-table table-striped">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengecekan</th>
                                        <th>Pemeriksa</th>
                                        <th>Hasil Rapid</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>

        </div>
</section>
@endsection
@section('adminlte_js')
<script>
    $(function() {
        var karyawan_id = 0;
        var tensi_tabel = $('#tensi_tabel').DataTable({
            processing: true,
            serverSide: false,
            ajax: '/kesehatan_mingguan_tensi/detail/' + karyawan_id,
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
                    data: 'sis'
                },
                {
                    data: 'dias'
                },
                {
                    data: 'keterangan'
                },
            ]
        });

    });
</script>
<script>
    $(function() {
        var karyawan_id = 0;
        var tensi_tabel = $('#rapid_tabel').DataTable({
            processing: true,
            serverSide: false,
            ajax: '/kesehatan_mingguan_rapid/detail/' + karyawan_id,
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
                    data: 'hasil'
                },
                {
                    data: 'keterangan'
                },
            ]
        });

    });
</script>
<script>
    //Tensi Sistolik
    var ctx = document.getElementById("tensi_sistolik_chart");
    var tensi_sistolik_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Sistolik',
                data: [],
                borderWidth: 2,
                backgroundColor: 'transparent',
                borderColor: 'red',
            }]
        },
        options: {
            scales: {
                xAxes: [],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    //Tenesi Diastolik
    var ctx = document.getElementById("tensi_diastolik_chart");
    var tensi_diastolik_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Diastolik',
                data: [],
                borderWidth: 2,
                backgroundColor: 'transparent',
                borderColor: 'blue',
            }]
        },
        options: {
            scales: {
                xAxes: [],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    //Rapid
    var ctx = document.getElementById("rapid_chart");
    var rapid_chart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [],
            datasets: [{
                label: ['Non Reaktif', 'IgG', 'IgM', 'IgG-IgM'],
                data: [],
                borderWidth: 3,
                backgroundColor: ['rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(102, 204, 0)',
                    'rgb(255, 102, 78)',
                ],
                hoverOffset: 4,
                borderColor: 'white',
            }]
        }
    });
    $('#karyawan_id').change(function() {
        var karyawan_id = $(this).val();
        $('#tensi_tabel').DataTable().ajax.url('/kesehatan_mingguan_tensi/detail/' + karyawan_id).load();
        $('#rapid_tabel').DataTable().ajax.url('/kesehatan_mingguan_rapid/detail/' + karyawan_id).load();
        var updateChart = function() {
            $.ajax({
                url: "/kesehatan_mingguan_tensi/detail/data/" + karyawan_id,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    tensi_sistolik_chart.data.labels = data.tgl;
                    tensi_sistolik_chart.data.datasets[0].data = data.labels2;
                    tensi_sistolik_chart.update();

                    tensi_diastolik_chart.data.labels = data.tgl;
                    tensi_diastolik_chart.data.datasets[0].data = data.labels3;
                    tensi_diastolik_chart.update();

                    rapid_chart.data.labels = ['Non Reaktif', 'IgG', 'IgM', 'IgG-IgM'];
                    rapid_chart.data.datasets[0].data = [data.data2, data.data3, data.data4, data.data5];
                    rapid_chart.update();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }
        updateChart();
    });
</script>
@endsection