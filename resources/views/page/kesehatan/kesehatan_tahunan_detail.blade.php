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
                                    </div>
                                    <div class="col-lg-4">
                                        <!-- LINE CHART -->
                                        <div class="card card-info">
                                            <div class="card-header">
                                                <h3 class="card-title">Pengukuran Rabun</h3>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="card-body">
                                                    <canvas id="rabun_mata"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <form action="/kesehatan_harian/aksi_tambah" method="post">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="card-title">Mata</div>
                    </div>
                    <div class="card-body">
                        <div class='table-responsive'>
                            <table id="tabel" class="table table-hover styled-table table-striped">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th colspan="2">Rabun Mata</th>
                                    </tr>
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Pengecekan</th>
                                        <th>Pemeriksa</th>
                                        <th>Kiri</th>
                                        <th>Kanan</th>
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
        var tabel = $('#tabel').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/kesehatan_tahunan/detail/' + karyawan_id,
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
                    data: 'mata_kiri',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">Tidak Normal</span>';
                        $n = '<br><span class="badge bg-success">Normal</span>';
                        if (data <= 6) {
                            return data + $l;
                        } else {
                            return data + $n;
                        }
                    }
                },
                {
                    data: 'mata_kanan',
                    render: function(data) {
                        $l = '<br><span class="badge bg-danger">Tidak Normal</span>';
                        $n = '<br><span class="badge bg-success">Normal</span>';
                        if (data <= 6) {
                            return data + $l;
                        } else {
                            return data + $n;
                        }
                    }
                },
            ]
        });

    });
</script>

<script>
    //Tensi Sistolik
    var ctx = document.getElementById("rabun_mata");
    var rabun_mata = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                    label: 'Mata Kiri',
                    data: [],
                    borderWidth: 2,
                    backgroundColor: 'transparent',
                    borderColor: 'red',
                },
                {
                    label: 'Mata Kanan',
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

    $('#karyawan_id').change(function() {
        var karyawan_id = $(this).val();
        $('#tabel').DataTable().ajax.url('/kesehatan_tahunan/detail/' + karyawan_id).load();
        var updateChart = function() {
            $.ajax({
                url: "/kesehatan_tahunan/detail/data/" + karyawan_id,
                type: 'GET',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data);
                    rabun_mata.data.labels = data.tgl;
                    rabun_mata.data.datasets[0].data = data.labels1;
                    rabun_mata.data.datasets[1].data = data.labels2;
                    rabun_mata.update();
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