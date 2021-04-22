@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Pemeriksaan Perakitan</h1>
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
            <!-- left column -->
            <div class="col-3">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title"><i class="fas fa-info-circle"></i>&nbsp;Info Perakitan</div>
                    </div>
                    <div class="card-body">

                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="product-img-small img-fluid" @if(empty($s->Bppb->DetailProduk->foto))
                                src="{{url('assets/image/produk')}}/noimage.png"
                                @elseif(!empty($s->Bppb->DetailProduk->foto))
                                src="{{url('assets/image/produk')}}/{{$s->Bppb->DetailProduk->foto}}"
                                @endif
                                title="{{$s->Bppb->DetailProduk->nama}}"
                                >
                            </div>
                            <div style="text-align:center;vertical-align:center;padding-top:10px">
                                <h5 class="card-heading">{{$s->Bppb->DetailProduk->nama}}</h5>
                                <h6 class="card-subheading text-muted">{{$s->Bppb->DetailProduk->Produk->nama}}</h6>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-6" style="vertical-align: middle;">
                                <hgroup>
                                    <!-- hgroup is deprecated, just defiantly using it anyway -->
                                    <h6 class="card-subheading text-muted">No BPPB</h6>
                                    <h5 class="card-heading">{{$s->Bppb->no_bppb}}</h5>
                                </hgroup>
                                <hgroup>
                                    <!-- hgroup is deprecated, just defiantly using it anyway -->
                                    <h6 class="card-subheading text-muted ">Tanggal</h6>
                                    <h5 class="card-heading">{{date("d-m-Y", strtotime($s->tanggal))}}</h5>
                                </hgroup>
                            </div>
                            <div class="col-lg-6" style="vertical-align: middle;">
                                <hgroup>
                                    <!-- hgroup is deprecated, just defiantly using it anyway -->
                                    <h6 class="card-subheading text-muted ">Jumlah</h6>
                                    <h5 class="card-heading">{{$s->Bppb->jumlah}}</h5>
                                </hgroup>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

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
                            <h3 class="card-title"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Pemeriksaan Perakitan</h3>
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
                                                    <th rowspan="2">No</th>
                                                    <th rowspan="2">No Seri</th>
                                                    <th hidden>ID</th>
                                                    <th rowspan="2">Operator</th>
                                                    <th colspan="2">Pemeriksaan Terbuka</th>
                                                    <th rowspan="2">Keterangan</th>
                                                </tr>
                                                <tr>
                                                    <th>Kondisi</th>
                                                    <th>Tindak Lanjut</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align:center;">
                                                @foreach($s->HasilPerakitan as $i)
                                                <tr>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$i->no_seri}}</td>
                                                    <td hidden><input type="text" name="id[]" value="{{$i->id}}"></td>
                                                    <td>@foreach ($i->Karyawan as $value)
                                                        {{ $loop->first ? '' : ',' }}
                                                        {{ $value->nama }}
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-success d-inline ">
                                                                        <input class="kondisi_terbuka" type="radio" name="kondisi_terbuka[{{$loop->iteration-1}}]" id="ok{{$loop->iteration-1}}" value="ok" checked>
                                                                        <label for="ok{{$loop->iteration-1}}" style="color:green;">
                                                                            <i class="fas fa-check-circle"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group clearfix">
                                                                    <div class="icheck-warning d-inline">
                                                                        <input class="kondisi_terbuka" type="radio" name="kondisi_terbuka[{{$loop->iteration-1}}]" id="nok{{$loop->iteration-1}}" value="nok">
                                                                        <label for="nok{{$loop->iteration-1}}" style="color:red;">
                                                                            <i class="fas fa-times-circle"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><select class="select2 form-control" name="tindak_lanjut_terbuka[{{$loop->iteration-1}}]" id="tindak_lanjut_terbuka{{$loop->iteration-1}}" data-placeholder="Pilih Data" data-dropdown-css-class="select2-info" style="width: 90%;">
                                                            <option value="produksi">Produksi</option>
                                                            <option value="operator">Operator</option>
                                                            <option value="produk_spesialis" disabled>Produk Spesialis</option>
                                                        </select></td>
                                                    <td><textarea class="form-control" name="keterangan[]" id="keterangan"></textarea></td>
                                                </tr>
                                                @endforeach
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

    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Laravel Crop Image Before Upload using Cropper JS - NiceSnippets.com</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">
                                <img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('adminlte_js')
<script>
    $(function() {
        $('#tableitem').on("change", 'input[type="radio"][class="kondisi_terbuka"]', function() {
            if (this.value == 'ok') {
                $(this).closest('tr').find("select option[value='produk_spesialis']").attr('disabled', true);
                $(this).closest('tr').find("select option[value='produksi']").attr('disabled', false);
                $(this).closest('tr').find("select").prop("selectedIndex", -1)
            } else if (this.value == 'nok') {
                $(this).closest('tr').find("select option[value='produk_spesialis']").attr('disabled', false);
                $(this).closest('tr').find("select option[value='produksi']").attr('disabled', true);
                $(this).closest('tr').find("select").prop("selectedIndex", -1)
            }
        });
    });
</script>
@stop