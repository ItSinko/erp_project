@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kalibrasi</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Kalibrasi </li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4>Daftar Kalibrasi</h4><br>
                    <div class="form-horizontal">
                        <div class="form-group row">
                            <label for="kalibrasi_internal_id" class="col-sm-4 col-form-label" style="text-align:right;">List Kalibrasi</label>
                            <div class="col-sm-8">
                                <select class="form-control select2 select2-info @error('kalibrasi_internal_id') is-invalid @enderror" data-dropdown-css-class="select2-info" style="width: 40%;" data-placeholder="Pilih Kalibrasi Internal" name="kalibrasi_internal_id" id="kalibrasi_internal_id">
                                    <option value=""></option>
                                    @foreach($k as $i)
                                    <option value="{{$i->id}}">{{$i->tanggal_daftar}} - @if(!empty($i->no_pendaftaran)) {{$i->no_pendaftaran}} @else <span class="text-muted">No Pendaftaran Belum Tersedia</span> @endif</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="example1" class="table table-hover styled-table">
                            <thead style="text-align: center;">
                                <tr>
                                    <th>No</th>
                                    <th>Kode Perakitan</th>
                                    <th>Tgl Kalibrasi</th>
                                    <th>Tgl Selesai</th>
                                    <th>Hasil</th>
                                    <th>Tindak Lanjut</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="text-align:center;" id="tbodies">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#cc0000;">
                            <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Laporan</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body" id="delete">

                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        $('select[name="kalibrasi_internal_id"]').on('change', function() {
            var id = jQuery(this).val();
            var jumlah = $('#jumlah').val();
            console.log(id);
            if (id != "") {
                id = id;
            } else {
                id = "0";
            }
            $('#example1').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: "/kalibrasi_internal/show/" + "{{$bppb_id}}" + "/" + id,
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'hasil_perakitan_id',
                        name: 'hasil_perakitan_id'
                    },
                    {
                        data: 'tanggal_kalibrasi',
                        name: 'tanggal_kalibrasi'
                    },
                    {
                        data: 'tanggal_selesai',
                        name: 'tanggal_selesai'
                    },
                    {
                        data: 'hasil',
                        name: 'hasil'
                    },
                    {
                        data: 'tindak_lanjut',
                        name: 'tindak_lanjut'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });

        });
    });
</script>
@stop