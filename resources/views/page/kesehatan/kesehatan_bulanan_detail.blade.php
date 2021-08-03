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
                                    <div class="col-lg-6">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">GCU</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="gcu_chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Berat Badan</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="berat_chart"></canvas>
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
                        <div class="card-title">GCU</div>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table id="tensi_tabel" class="table table-hover styled-table table-striped">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengecekan</th>
                                        <th>Glucose</th>
                                        <th>Cholesterol</th>
                                        <th>Uric Acid</th>
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
                        <div class="card-title">Berat Badan</div>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table id="berat_tabel" class="table table-hover styled-table table-striped">
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
            ajax: '/kesehatan_bulanan_gcu/detail/' + karyawan_id,
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
                    data: 'glu',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">' + data + '</span>';
                        $n = '<br><span class="badge bg-success">' + data + '</span>';
                        $w = '<br><span class="badge bg-warning">' + data + '</span>';

                        if (data >= 200) {
                            return 'Diabetes' + $l;
                        } else if (data < 200) {
                            return 'Normal' + $n;;
                        } else if (data >= 140 && data <= 199) {
                            return 'Pra Diabetes' + $w;
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'kol',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">' + data + '</span>';
                        $n = '<br><span class="badge bg-success">' + data + '</span>';
                        $w = '<br><span class="badge bg-warning">' + data + '</span>';
                        if (data > 239) {
                            return 'Bahaya' + $l;
                        } else if (data < 200) {
                            return 'Normal' + $n;
                        } else if (data >= 200 && data <= 239) {
                            return 'Hati hati' + $w;
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'asam',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">' + data + '</span>';
                        $n = '<br><span class="badge bg-success">' + data + '</span>';
                        $w = '<br><span class="badge bg-warning">' + data + '</span>';

                        if (data >= 2 && data <= 7.5) {
                            return 'Normal' + $n;
                        } else if (data > 7.5) {
                            return 'Asam Urat' + $l;
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'keterangan'
                },
            ]
        });



        var berat_tabel = $('#berat_tabel').DataTable({
            processing: true,
            serverSide: false,
            ajax: '/kesehatan_bulanan_gcu/detail/' + karyawan_id,
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

    });
</script>

<script>
    //Tensi Sistolik
    var ctx = document.getElementById("gcu_chart");
    var gcu_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: 'Glucose',
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: 'red',
                },
                {
                    label: 'Colesterol',
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: 'blue',
                },
                {
                    label: 'Uri Acid',
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: 'black',
                }
            ]
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
    //Berat
    var ctx = document.getElementById("berat_chart");
    var berat_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Berat',
                data: [],
                borderWidth: 2,
                backgroundColor: 'transparent',
                borderColor: 'blue',
            }, ]
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
    $('#karyawan_id').change(function() {
        var karyawan_id = $(this).val();
        $('#tensi_tabel').DataTable().ajax.url('/kesehatan_bulanan_gcu/detail/' + karyawan_id).load();
        $('#berat_tabel').DataTable().ajax.url('/kesehatan_bulanan_berat/detail/' + karyawan_id).load();
        var updateChart = function() {
            $.ajax({
                url: "/kesehatan_bulanan/detail/data/" + karyawan_id,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    gcu_chart.data.labels = data.tgl;
                    gcu_chart.data.datasets[0].data = data.labels2;
                    gcu_chart.data.datasets[1].data = data.labels3;
                    gcu_chart.data.datasets[2].data = data.labels4;
                    gcu_chart.update();

                    berat_chart.data.labels = data.tgl2;
                    berat_chart.data.datasets[0].data = data.labels5;
                    berat_chart.update();

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