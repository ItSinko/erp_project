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
                {{session()->get('success')}}
            </div>
            @elseif(session()->has('error') || count($errors) > 0)
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                Data gagal ditambahkan
            </div>
            @endif
            <div class="col-lg-12">
                <form action="/kalibrasi/aksi_tambah" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">No Pendaftaran</label>
                                                <div class="col-sm-2">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">LAB-</span>
                                                        </div>
                                                        <input type="text" class="form-control" value="{{$no }}" name="no_pendaftaran" id="no_pendaftaran">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Jenis</label>
                                                <div class="col-sm-2">
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="kode_sertifikat">
                                                        <option value="">Pilih</option>
                                                        <option value="rsud">Rumah Sakit Umum Daerah (RSUD)</option>
                                                        <option value="dinkes">Dinas Kesehatan</option>
                                                        <option value="puskes">Puskesmas</option>
                                                        <option value="puskes">Personal</option>
                                                        <option value="lab">Laboratorium</option>
                                                        <option value="cip">PT Cipta Jaya</option>
                                                        <option value="cip">PT Sinko Prima Alloy</option>
                                                        <option value="pt">Perseorangan Terbatas (PT)</option>
                                                        <option value="univ">Universitas</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">PIC</label>
                                                <div class="col-sm-2">
                                                    <select type="text" class="form-control @error('teknisi_id') is-invalid @enderror select2" name="teknisi_id">
                                                        <option value="">Pilih</option>
                                                        @foreach($karyawan as $k)
                                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('teknisi_id'))
                                                    <div class="text-danger">
                                                        {{ $errors->first('teknisi_id')}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Kalibrasi</label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control @error('tanggal_kalibrasi') is-invalid @enderror" name="tanggal_kalibrasi" id="date_master">
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Selesai</label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai">
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Penyerahan</label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control @error('tanggal_penyerahan') is-invalid @enderror" name="tanggal_penyerahan">
                                                </div>
                                            </div>
                                            <table class=" table table-bordered table-striped" style="width:100%" id="noseri_list">
                                                <thead>
                                                    <tr>
                                                        <th width="1%">No</th>
                                                        <th width="10%">Tgl Kalibrasi</th>
                                                        <th width="10%">No Seri</th>
                                                        <th width="10%">Type</th>
                                                        <th width="15%">Nama</th>
                                                        <th width="15%">Distributor</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kalibrasi"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
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
    // $('#date_master').change(function() {
    //     $('#date').val($(this).val());
    // });

    // $("#user_table ").append(`<tr>
    //                             <td></td>
    //                             </tr>`);
    var draw = function() {
        $('#check_row1').click(function() {
            //var dates = $("#date_master").val();
            // if ($(this).is(":checked")) {
            //     $('#date1').prop('readonly', false);

            // } else {
            //     $('#date1').prop('readonly', true);
            //     //  $('#date').val(dates);
            // }
            alert('tes');
        });
    }
    $(function() {
        var noseri_list = $('#noseri_list').DataTable({
            drawCallback: draw,
            processing: true,
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: '/kalibrasi/data',
            columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                render: function(data) {
                    return `<div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="check_row1">
                    <label class="form-check-label" for="flexCheckDefault">
                    <input type="date" class="form-control" id="date ` + data + `">
                    </label>
                    </div>`;
                }
            }, {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }]
        });

        $('#button_tambah').click(function() {
            var noseri_list = noseri_list.$('input').serialize();
            var no_pendaftaran = $('#no_pendaftaran').val();

            alert(noseri_list);
        });
    });
</script>
@stop