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
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data berhasil ditambahkan
            </div>
            @elseif(session()->has('error') || count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data gagal ditambahkan
            </div>
            @endif
        </div>
        <div class="col-lg-12" id="rapid">
            <div class="col-lg-12">
                <form action="/kesehatan_mingguan_tensi/aksi_tambah" method="post" enctype="multipart/form-data" id="form">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Pemeriksaan Tensi</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table id="tabel_rapid" class="table table-hover styled-table table-striped">
                                            <thead style="text-align: center;">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Nama</th>
                                                    <th>Systol(mmHg)</th>
                                                    <th>Dyastol(mmHg)</th>
                                                    <th>Catatan</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                                <tr>
                                                    <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control date" name="date[]">
                                                    </td>
                                                    <td>
                                                        <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror karyawan_id select2 select2-info" name="karyawan_id[]" style="width:100%;" id="karyawan_id[]">
                                                            <option value=""></option>
                                                            @foreach ($karyawan as $k)
                                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control sistolik" name="sistolik[]">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">mmHg</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control diastolik" name="diastolik[]">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">mmHg</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                                    </td>
                                                    <td>
                                                        <button name="add" type="button" id="tambahitem" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan_mingguan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
                            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@section('adminlte_js')
<script>
    $(function() {
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('.jenis_tes').attr('name', 'jenis_tes[' + j + ']');
                $(el).find('.date').attr('name', 'date[' + j + ']');
                $(el).find('.karyawan_id').attr('name', 'karyawan_id[' + j + ']');
                $(el).find('.sistolik').attr('name', 'sistolik[' + j + ']');
                $(el).find('.diastolik').attr('name', 'diastolik[' + j + ']');
                $('.karyawan_id').select2();
            });
        }

        $('#tambahitem').click(function(e) {
            var data = `  <tr>
            <td>
                                                        1
                                                    </td>
                                                    <td>
                                                        <input type="date" class="form-control date" name="date[]">
                                                    </td>
                                                    <td>
                                                        <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror karyawan_id select2 select2-info" name="karyawan_id[]" style="width:100%;" >
                                                            <option value=""></option>
                                                            @foreach ($karyawan as $k)
                                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control sistolik" name="sistolik[]">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">mmHg</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control diastolik" name="diastolik[]">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">mmHg</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                                    </td>
                                                    <td>
                                                    <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button> 
                                                    </td>
                                                </tr>`;
            $('#tabel_rapid tr:last').after(data);
            numberRows($("#tabel_rapid"));
        });
        $('#tabel_rapid').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tabel_rapid"));
        });
    })
</script>
@endsection