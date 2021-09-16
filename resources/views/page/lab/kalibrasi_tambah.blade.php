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
                                                        <input type="text" class="form-control d-none" value="{{$kalibrasi->id }}" id="kalibrasi_id">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Jenis</label>
                                                <div class="col-sm-2">
                                                    <select type="text" class="form-control @error('karyawan_id') is-invalid @enderror select2" name="kode_sertifikat" id="jenis">
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
                                                    <select type="text" class="form-control @error('teknisi_id') is-invalid @enderror select2" name="teknisi_id" id="pic">
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
                                                    <input type="date" class="form-control @error('tanggal_selesai') is-invalid @enderror" name="tanggal_selesai" id="tanggal_selesai">
                                                </div>
                                            </div>
                                            <div class=" form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Penyerahan</label>
                                                <div class="col-sm-2">
                                                    <input type="date" class="form-control @error('tanggal_penyerahan') is-invalid @enderror" name="tanggal_penyerahan" id="tanggal_penyerahan">
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
    $('#date_master').change(function() {
        $('.date').val($(this).val());
    });

    $('#noseri_list > tbody').on('click', '#div_check', function() {
        var id = $(this).data("id")
        $('#check_row' + id + '').change(function() {
            var dates = $("#date_master").val();
            if ($(this).is(":checked")) {
                $('#date' + id + '').prop('readonly', false);
            } else {
                $('#date' + id + '').prop('readonly', true);
                $('#date' + id + '').val(dates);
            }
        });
        console.log(id);
    })
    $(function() {
        var value = $("#kalibrasi_id").val();
        var noseri_list = $('#noseri_list').DataTable({
            processing: true,
            searching: false,
            serverSide: false,
            language: {
                processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
            },
            ajax: '/kalibrasi/list/data/' + value,
            columns: [{
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            }, {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false,
                render: function(data) {
                    return `<div class="form-check" id="div_check" data-id=` + data + `>
                    <input class="form-check-input" type="checkbox"  id="check_row` + data + `">
                    <label class="form-check-label" for="flexCheckDefault">
                    <input type="date" class="form-control date" id="date` + data + `" readonly>
                    </label>
                    </div>`;
                }
            }, {
                data: 'barcode',
                orderable: false,
                searchable: false
            }, {
                data: 'type',
                orderable: false,
                searchable: false
            }, {
                data: 'nama',
                orderable: false,
                searchable: false
            }, {
                data: 'dsb',
                orderable: false,
                searchable: false
            }]
        });
        $('#button_tambah').click(function() {
<<<<<<< HEAD
            //var data = noseri_list.rows(0).data();
=======
            var data = noseri_list.rows().data();

>>>>>>> 202b602cedb0b7d149e4d23eae66bb8c91ee7fe2
            var no_pendaftaran = $("#no_pendaftaran").val();
            var jenis = $("#no_pendaftaran").val();
            var pic = $("#date_master").val();
            var tanggal_selesai = $("#tanggal_selesai").val();
            var tanggal_kalibrasi = $("#tanggal_kalibrasi").val();
            var tanggal_penyerahan = $("#tanggal_penyerahan").val();
<<<<<<< HEAD

            console.log(no_pendaftaran);
            alert('ok');
=======

            console.log(data);
            console.log(noseri_list.cell(0, 1).nodes().to$().find('.date').val())

            for (var i = 0; i < data.count(); ++i) {
                console.log(noseri_list.cell(0, 1).nodes().to$().find('.date').val())
            };
>>>>>>> 202b602cedb0b7d149e4d23eae66bb8c91ee7fe2
            return false;
        });
    });
</script>
@stop