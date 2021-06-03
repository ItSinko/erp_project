@extends('adminlte.page')

@section('title', 'Beta Version')

@section('adminlte_css')
<style>
    .dt-body-left {
        text-align: left;
    }
</style>
@endsection

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>BPPB</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">BPPB</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@stop

@section('content')
<section class="content">
    <div class="row">
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <h4>Info</h4><br>
                    <div class="form-horizontal">
                        <div class="row">
                            <label for="no_seri" class="col-sm-6 col-form-label">No BPPB</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{$s->no_bppb}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-4 col-form-label">Produk</label>
                            <div class="col-sm-8 col-form-label" style="text-align:right;">
                                {{$s->DetailProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="no_seri" class="col-sm-5 col-form-label">Kelompok Produk</label>
                            <div class="col-sm-7 col-form-label" style="text-align:right;">
                                {{$s->DetailProduk->Produk->KelompokProduk->nama}}
                            </div>
                        </div>

                        <div class="row">
                            <label for="tanggal" class="col-sm-6 col-form-label">Tanggal Laporan</label>
                            <div class="col-sm-6 col-form-label" style="text-align:right;">
                                {{date("d-m-Y", strtotime($s->tanggal_bppb))}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
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
            <form action="{{route('bppb.penyerahan_barang_jadi.store', ['id' => $id])}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="card">
                    <div class="card-header bg-success">Penyerahan Barang Jadi</div>
                    <div class="card-body">

                        <div class="form-horizontal">
                            <div class="form-group row">
                                <label for="tanggal" class="col-sm-5 col-form-label" style="text-align:right;">Tanggal</label>
                                <div class="col-sm-7">
                                    <input type="date" class="form-control  @error('tanggal') is-invalid @enderror" name="tanggal" id="tanggal" style="width: 50%;">
                                    @if ($errors->has('tanggal'))
                                    <span class="invalid-feedback" role="alert">{{$errors->first('tanggal')}}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <table id="tableitem" class="table table-hover table-bordered styled-table">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>No</th>
                                            <th>Divisi</th>
                                            <th>No Seri</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody style="text-align:center;">
                                        @php $num=0; @endphp
                                        @if($s->countHasilPengemasanByHasil('ok') > 0)
                                        @php $num++; @endphp
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td><input type="number" name="divisi_id[{{$num-1}}]" id="divisi_id{{$num-1}}" value="13" hidden><span class="success-text">Gudang Barang Jadi</span></td>
                                            <td><select class="select2 select2-info form-control hasil_perakitan_id" name="hasil_perakitan_id[{{$num-1}}][]" id="hasil_perakitan_id{{$num-1}}" multiple>
                                                    @foreach($hp as $i)
                                                    @if($i->tindak_lanjut == "ok")
                                                    <option value="{{$i->HasilPerakitan->id}}" selected>{{$i->HasilPerakitan->no_seri}}</option>
                                                    @endif
                                                    @endforeach
                                                </select></td>
                                            <td><input type="number" class="form-control jumlah" name="jumlah[{{$num-1}}]" id="jumlah{{$num-1}}" value="{{$s->countHasilPengemasanByHasil('ok')}}"></td>
                                            <td>
                                                <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closeitem"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        @endif
                                        @if($s->countHasilPengemasanByHasil('nok') > 0)
                                        @php $num++; @endphp
                                        <tr>
                                            <td>{{$num}}</td>
                                            <td><input type="number" name="divisi_id[{{$num-1}}]" id="divisi_id{{$num-1}}" value="12" hidden><span class="danger-text">Gudang Karantina</span></td>
                                            <td><select class="select2 select2-info form-control hasil_perakitan_id" name="hasil_perakitan_id[{{$num-1}}][]" id="hasil_perakitan_id{{$num-1}}" multiple>
                                                    @foreach($hp as $i)
                                                    @if($i->tindak_lanjut != "ok")
                                                    <option value="{{$i->HasilPerakitan->id}}" selected>{{$i->HasilPerakitan->no_seri}}</option>
                                                    @endif
                                                    @endforeach
                                                </select></td>
                                            <td>
                                                <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closeitem"><i class="fas fa-times"></i></button>
                                            </td>
                                        </tr>
                                        @endif

                                        @if($s->countHasilPengemasanByHasil('nok') <= 0 && $s->countHasilPengemasanByHasil('ok') <= 0) <tr>
                                                <td colspan="12">Tidak ada data</td>
                                                </tr>
                                                @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span>
                            <button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;" @if($s->countHasilPengemasanByHasil('nok') <= 0 && $s->countHasilPengemasanByHasil('ok') <= 0) disabled @endif><i class="fas fa-times"></i>&nbsp;Batal</button>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" @if($s->countHasilPengemasanByHasil('nok') <= 0 && $s->countHasilPengemasanByHasil('ok') <= 0) disabled @endif><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                        </span>
                    </div>
                </div>
            </form>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
@endsection

@section('adminlte_js')
<script>
    $(function() {
        $('#tableitem').on('change', '.hasil_perakitan_id', function(e) {
            $(this).closest('tr').find('.jumlah').val($(this).closest('tr').find('select.hasil_perakitan_id :selected').length);
        });
    })
</script>
@stop