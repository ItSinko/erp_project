@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Analisa</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Analisa</li>
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
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Analisa Perakitan</div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{ route('perakitan.analisa_ps.store', ['id' => $s->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <h3>BPPB</h3>
                        <div class="form-group row">
                            <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">Kode Perakitan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_seri" id="no_seri" value="{{$s->Perakitan->alias_tim}} {{$s->no_seri}}" style="width: 30%;" readonly>
                                @if ($errors->has('no_seri'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('no_seri')}}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="no_bppb" class="col-sm-4 col-form-label" style="text-align:right;">BPPB</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_bppb" id="no_bppb" value="{{old('no_bppb',  $s->Perakitan->Bppb->no_bppb)}}" style="width: 30%;" readonly>
                                @if ($errors->has('no_bppb'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('no_bppb')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:right;">Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="{{old('nama_produk', $s->Perakitan->Bppb->DetailProduk->nama)}}" style="width: 50%;" readonly>
                                @if ($errors->has('nama_produk'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('nama_produk')}}</span>
                                @endif
                            </div>
                        </div>

                        <h3>Analisa</h3>

                        <div class="form-group row">
                            <label for="analisa" class="col-sm-4 col-form-label" style="text-align:right;">Analisa</label>
                            <div class="col-sm-8">
                                <textarea class="form-control @error('analisa') is-invalid @enderror" name="analisa" id="analisa"></textarea>
                                @if ($errors->has('analisa'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('analisa')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="realisasi_pengerjaan" class="col-sm-4 col-form-label" style="text-align:right;">Realisasi Pengerjaan</label>
                            <div class="col-sm-8">
                                <textarea class="form-control @error('realisasi_pengerjaan') is-invalid @enderror" name="realisasi_pengerjaan" id="realisasi_pengerjaan"></textarea>
                                @if ($errors->has('realisasi_pengerjaan'))
                                <span class="invalid-feedback" role="alert">{{$errors->first('realisasi_pengerjaan')}}</span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tindak_lanjut" class="col-sm-4 col-form-label" style="text-align:right;">Tindak Lanjut</label>
                            <div class="col-sm-2 col-form-label">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" class="@error('tindak_lanjut') is-invalid @enderror" id="tindak_lanjut_operator" name="tindak_lanjut" value="operator" @if($s->status == "rej_pemeriksaan_tertutup") disabled @endif>
                                    <label for="tindak_lanjut_operator">
                                        Operator
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-2 col-form-label">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" class="@error('tindak_lanjut') is-invalid @enderror" id="tindak_lanjut_perbaikan" name="tindak_lanjut" value="perbaikan" @if($s->status == "rej_pemeriksaan_terbuka") disabled @endif>
                                    <label for="tindak_lanjut_perbaikan">
                                        Perbaikan
                                    </label>
                                </div>
                            </div>

                            <div class="col-sm-2 col-form-label">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" class="@error('tindak_lanjut') is-invalid @enderror" id="tindak_lanjut_karantina" name="tindak_lanjut" value="karantina">
                                    <label for="tindak_lanjut_karantina">
                                        Karantina
                                    </label>
                                </div>
                            </div>
                            @if ($errors->has('tindak_lanjut'))
                            <span class="invalid-feedback" role="alert">{{$errors->first('tindak_lanjut')}}</span>
                            @endif
                        </div>

                        <h3>Part</h3>
                        <div class="form-group row">
                            <label for="realisasi_pengerjaan" class="col-sm-4 col-form-label" style="text-align:right;">Keperluan Part</label>
                            <div class="col-sm-8">
                                @foreach($bom as $i)
                                <div class="form-check col-form-label">
                                    <input class="form-check-input" type="checkbox" value="{{$i->bill_of_material_id}}" name="part[]" id="part">
                                    <label class="form-check-label" for="part">
                                        {{$i->BillOfMaterial->part_eng_id}} - {{$i->BillOfMaterial->PartEng->nama}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                </div>
                <div class="card-footer">
                    <span>
                        <button type="button" class="btn btn-block btn-danger btn-rounded" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button>
                    </span>
                    <span>
                        <button type="submit" class="btn btn-block btn-warning btn-rounded" style="width:200px;float:right;"><i class="fas fa-plus-circle"></i>&nbsp;Tambah Data</button>
                    </span>
                </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

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
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('input[name="tanggal_pengerjaan"]').val(today);
        $('#tanggal_permintaan').val(today);
    });
</script>
@endsection