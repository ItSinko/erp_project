@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemeriksaan Proses</h1>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-check"></i></strong> {{session()->get('success')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-times"></i></strong> {{session()->get('error')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @elseif(count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-times"></i></strong> Lengkapi data terlebih dahulu
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <form id="" action="{{route('perakitan.pemeriksaan.laporan.update', ['id' => $id])}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card">
                        <div class="card-header bg-warning">
                            <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Pemeriksaan Proses Perakitan</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <!-- /.card-header -->
                                <!-- form start -->
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <table id="tableitem" class="table table-hover table-bordered styled-table">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th rowspan="2">Hal yang diperiksa</th>
                                                    <th rowspan="2">Standar Keberterimaan</th>
                                                    <th rowspan="2">Jumlah</th>
                                                    <th colspan="2">Hasil</th>
                                                    <th colspan="2">Tindak Lanjut</th>
                                                    <th rowspan="2">Keterangan</th>
                                                    <th rowspan="2">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th><i class="fas fa-check-circle" style="color:green;"></i></th>
                                                    <th><i class="fas fa-times-circle" style="color:red;"></i></th>
                                                    <th>Karantina</th>
                                                    <th>Perbaikan</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align:center;">
                                                <tr class="pemeriksaan">
                                                    <td><textarea class="form-control" name="hal_yang_diperiksa[]" id="hal_yang_diperiksa"></textarea></td>
                                                    <td>
                                                        <table class="standar_keberterimaan" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0">
                                                            <tr class="standar_keberterimaan_row">
                                                                <td>
                                                                    <textarea class="form-control" name="standar_keberterimaan[]" id="standar_keberterimaan"></textarea>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="jumlah" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0">
                                                            <tr class="jumlah_row">
                                                                <td>
                                                                    <input class="form-control" type="number" name="jumlah[]" id="jumlah">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="hasil_ok" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0">
                                                            <tr class="hasil_ok_row">
                                                                <td>
                                                                    <input class="form-control" type="number" name="hasil_ok[]" id="hasil_ok">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="hasil_nok" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0">
                                                            <tr class="hasil_nok_row">
                                                                <td>
                                                                    <input class="form-control" type="number" name="hasil_nok[]" id="hasil_nok">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="karantina" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0">
                                                            <tr class="karantina_row">
                                                                <td>
                                                                    <input class="form-control" type="number" name="karantina[]" id="karantina">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="perbaikan" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0">
                                                            <tr class="perbaikan_row">
                                                                <td>
                                                                    <input class="form-control" type="number" name="perbaikan[]" id="perbaikan">
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="tambahitem" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0">
                                                            <tr class="tambahitem_row">
                                                                <td>
                                                                    <button class="btn btn-success btn-sm m-1" style="border-radius:50%;" id="tambahitem"><i class="fas fa-plus-circle"></i></button>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card -->
                        </div>
                        <div class="card-footer">
                            <span>
                                <button type="button" class="btn btn-block btn-danger btn-rounded" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                            </span>
                            <span>
                                <button type="submit" class="btn btn-block btn-warning btn-rounded" style="width:200px;float:right;"><i class="fas fa-edit"></i>&nbsp;Simpan Perubahan</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>

        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
@section('adminlte_js')
<script>
    $(function() {
        $(document).on('click', 'tr.:last-child td input', function() {
            $(this).closest("tr.schedule").find('table.from_hour tr.from_hour_row').last().after('<tr class="from_hour_row"><td><input type="text" name="fromHour" class="fromHour" id="fromHour" size="10"/></td></tr>');
            $(this).closest("tr.schedule").find('table.to_hour tr.to_hour_row').last().after('<tr class="to_hour_row"><td><input type="text" name="toHour" class="toHour" id="toHour" size="10"/></td></tr>');
            $(this).closest("tr.schedule").find('table.mw tr.mw_row').last().after('<tr class="mw_row"><td><input type="text" name="mw" class="mw" id="mw" value="0.00" size="10"/></td></tr>');
            $(this).closest("tr.schedule").find('table.mw_hr tr.mw_hr_row').last().after('<tr class="mw_hr_row"><td><input type="text" name="mwhrs" class="mwhrs" id="mwhrs" value="0.00" size="10"/></td></tr>');
        });

        $(document).on('focusout', 'tr.mw_hr_row td:last-child input', function() {
            $(this).closest("tbody.tbody").append('<tr class="schedule"><td><input type="text" name="fromDate" class="fromDate"/></td><td><input type="text" name="toDate" class="toDate"/></td><td><table class="from_hour" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0"><tr class="from_hour_row"><td><input type="text" name="fromHour" class="fromHour" size="10"/></td></tr></table></td><td><table class="to_hour" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0"><tr class="to_hour_row"><td><input type="text" name="toHour" class="toHour" size="10" /></td></tr></table></td><td><table class="mw" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0"><tr class="mw_row"><td><input type="text" name="mw" class="mw" value="0.00" size="10"/></td></tr></table></td><td><table class="mw_hr" width="100%" cellspacing="0" cellpadding="0" bordercolor="#111111" border="0"><tr class="mw_hr_row"><td><input type="text" name="mwhrs" class="mwhrs" /></td></tr></table></td></tr>');
        });
    });
</script>
@stop