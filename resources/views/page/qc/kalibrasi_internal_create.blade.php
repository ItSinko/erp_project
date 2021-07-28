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
                    <li class="breadcrumb-item"><a href="/pengujian">Laporan Pengujian</a></li>
                    <li class="breadcrumb-item active">Kalibrasi</li>
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
            <!-- left column -->
            <div class="col-md-12">
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
                        <h3 class="card-title" style="color:white;"><i class="fa fa-plus-circle" aria-hidden="true"></i>&nbsp;Daftar Kalibrasi</h3>
                    </div>
                    <div class="card-body">

                        <div class="col-md-12">
                            <form action="{{ route('kalibrasi_internal.store', ['bppb_id' => $s->id]) }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <h3>Info BPPB</h3>
                                <div class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="no_bppb" class="col-sm-4 col-form-label" style="text-align:right;">No BPPB</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="no_bppb" id="no_bppb" value="{{$s->no_bppb}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="nama_produk" class="col-sm-4 col-form-label" style="text-align:right;">Nama Produk</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama_produk" id="nama_produk" value="{{old('nama_produk', $s->DetailProduk->nama)}}" style="width: 50%;" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tanggal Pendaftaran</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="tanggal" id="tanggal" value="" style="width: 50%;">
                                        </div>
                                    </div>

                                    <h3>Data No Seri</h3>
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <div class="table-responsive">
                                                <table id="tableitem" class="table table-hover table-bordered">
                                                    <thead style="text-align: center;">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Kode Perakitan</th>
                                                            <th>Perakit</th>
                                                            <th>Aksi</th>
                                                            <th hidden>ID</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody style="text-align:center;">
                                                        @if(count($hp) > 0)
                                                        @foreach($hp as $i)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>
                                                                {{str_replace("/", "", $i->Perakitan->alias_tim)}}{{$i->no_seri}}
                                                            </td>
                                                            <td>
                                                                @foreach ($i->Perakitan->Karyawan as $kry)
                                                                {{ $loop->first ? '' : '' }}
                                                                <div>{{ $kry->nama}}</div>
                                                                @endforeach
                                                            </td>
                                                            <td><button type="button" class="btn btn-danger btn-sm m-1 removeitem" style="border-radius:50%;" id="removeitem"><i class="fas fa-times-circle"></i></button></td>
                                                            <td hidden><input type="text" class="hasil_perakitan_id" name="hasil_perakitan_id[]" id="hasil_perakitan_id" value="{{$i->id}}" hidden></td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="5">Tidak Ada Data No Seri</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span>
                            <a class="cancelmodal" data-toggle="modal" data-target="#cancelmodal"><button type="button" class="btn btn-block btn-danger rounded-pill" style="width:200px;float:left;"><i class="fas fa-times"></i>&nbsp;Batal</button></a>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-success rounded-pill" style="width:200px;float:right;" id="tambahlaporan" disabled><i class="fas fa-plus"></i>&nbsp;Tambah Data</button>
                        </span>
                    </div>
                    </form>
                </div>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
        <div class="modal fade" id="cancelmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:	#778899;">
                        <h4 class="modal-title" id="myModalLabel" style="color:white;">Keluar Halaman</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body" id="cancel">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body" style="text-align:center;">
                                        <h6>Apakah anda yakin meninggalkan halaman ini?</h6>
                                    </div>
                                    <div class="card-footer col-12" style="margin-bottom: 2%;">
                                        <span>
                                            <button type="button" class="btn btn-block btn-secondary" data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                                        </span>
                                        <span>
                                            <a href="/pengujian"><button type="submit" class="btn btn-block btn-danger" id="hapussk" style="width:30%;float:right;">Keluar</button></a>
                                        </span>
                                    </div>
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
        $('#tanggal').on('change', function() {
            var t = $(this).val();
            if (t != "") {
                $('#tambahlaporan').removeAttr('disabled');
            } else {
                $('#tambahlaporan').attr('disabled', true);
            }
        });

        $('#tableitem').on('click', '#removeitem', function(e) {
            $(this).closest('tr').remove();
        });

    });
</script>
@stop