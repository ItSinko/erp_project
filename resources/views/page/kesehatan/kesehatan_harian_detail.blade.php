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

                                    <div class="col-lg-4">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Suhu</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="suhu_chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">SpO2 (%)</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="spo2_chart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Pulse Rate (bpm)</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="pr_chart"></canvas>
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
                    data: 'pagi',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">Hiportemia</span>';
                        $n = '<br><span class="badge bg-success">Normal</span>';
                        $w = '<br><span class="badge bg-warning">Hiperpireksia</span>';
                        $i = '<br><span class="badge bg-info">Hiperpireksia</span>';

                        if (data > 40) {
                            return data + ' °C' + $w;
                        } else if (data < 35) {
                            return data + ' °C' + $l;
                        } else if (data >= 35 && data <= 37.5) {
                            return data + ' °C' + $n;
                        } else if (data >= 37.6 && data <= 40) {
                            return data + ' °C' + $i;
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'siang',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">Hipotermia</span>';
                        $n = '<br><span class="badge bg-success">Normal</span>';
                        $w = '<br><span class="badge bg-warning">Hiperpireksia</span>';
                        $i = '<br><span class="badge bg-info">Hipertermia</span>';
                        if (data > 40) {
                            return data + ' °C' + $w;
                        } else if (data < 35) {
                            return data + ' °C' + $l;
                        } else if (data >= 35 && data <= 37.5) {
                            return data + ' °C' + $n;
                        } else if (data >= 37.6 && data <= 40) {
                            return data + ' °C' + $i;
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'sp',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">Rendah</span>';
                        $n = '<br><span class="badge bg-success">Normal</span>';
                        $w = '<br><span class="badge bg-warning">Tinggi</span>';
                        if (data > 100) {
                            return data + ' %' + $w;
                        } else if (data < 59) {
                            return data + ' %' + $l;
                        } else if (data >= 60 || data <= 100) {
                            return data + ' %' + $n;
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'prx',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">Rendah</span>';
                        $n = '<br><span class="badge bg-success">Normal</span>';
                        $w = '<br><span class="badge bg-warning">Tinggi</span>';
                        if (data > 100) {
                            return data + ' bpm' + $w;
                        } else if (data < 59) {
                            return data + ' bpm' + $l;
                        } else if (data >= 60 || data <= 100) {
                            return data + ' bpm' + $n;
                        } else {
                            return '';
                        }

                    }
                },
            ]
        });

    });
</script>



<script>
    //Suhu 
    var ctx = document.getElementById("suhu_chart");
    var suhu_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: 'Suhu Pagi',
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: 'red',
                },
                {
                    label: 'Suhu Siang',
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: 'blue',
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
    //Spo2
    var ctx = document.getElementById("spo2_chart");
    var spo2_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Spo2 (%)',
                data: [],
                borderWidth: 2,
                backgroundColor: 'transparent',
                borderColor: 'green',
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
    //Pulse Rate
    var ctx = document.getElementById("pr_chart");
    var pr_chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Pulse rate (bpm)',
                data: [],
                borderWidth: 2,
                backgroundColor: 'transparent',
                borderColor: 'black',
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
    $('#karyawan_id').change(function() {
        var karyawan_id = $(this).val();
        $('#tabel').DataTable().ajax.url('/kesehatan_harian/detail/' + karyawan_id).load();

        var updateChart = function() {
            $.ajax({
                url: "/kesehatan_harian/data/karyawan/" + karyawan_id,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    suhu_chart.data.labels = data.tgl;
                    suhu_chart.data.datasets[0].data = data.labels2;
                    suhu_chart.data.datasets[1].data = data.labels3;
                    suhu_chart.update();

                    spo2_chart.data.labels = data.tgl;
                    spo2_chart.data.datasets[0].data = data.labels4;
                    spo2_chart.update();

                    pr_chart.data.labels = data.tgl;
                    pr_chart.data.datasets[0].data = data.labels5;
                    pr_chart.update();
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