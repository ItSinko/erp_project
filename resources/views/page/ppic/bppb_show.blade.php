@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <h1>BPPB</h1>
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

<section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-hover styled-table"  style="text-align: center;">
                <thead>
                  @if(Auth::user()->divisi->kode == "ppic")
                  <tr>
                    <th colspan="12">
                      <a href="{{route('bppb.create')}}" style="color: white;">
                        <button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;">
                          <i class="fas fa-plus"></i> &nbsp; Tambah Data BPPB</i>
                        </button>
                      </a>
                    </th>
                  </tr>
                  @endif
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No BPPB</th>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Divisi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($b as $i)
                  <tr>
                    <td class="counterCell"></td>
                    <td>{{date("d-m-Y", strtotime($i->tanggal_bppb))}}</td>
                    <td>{{$i->no_bppb}}</td>
                    <td><div class="text-center">
                        <img class="product-img-small img-fluid"
                        @if(empty($i->produk->foto))
                          src="{{url('assets/image/produk')}}/noimage.png"
                        @elseif(!empty($i->foto))
                          src="{{asset('image/produk/')}}/{{$i->produk->foto}}"
                        @endif
                          title="{{$i->produk->nama}}"
                        >
                      </div></td>
                    <td style="vertical-align:middle;text-align:left;">
                        <hgroup>
                          <h6 class="heading">{{$i->produk->tipe}} - {{$i->produk->nama}}</h6>
                          <div class="subheading text-muted">{{$i->produk->kelompokproduk->nama}}</div>
                        </hgroup>
                    </td>
                    <td>{{$i->jumlah}}</td>
                    <td>{{$i->divisi->nama}}</td>
                    <td>
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"  title="Klik untuk melihat detail BPPB">
                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="{{route('bppb.edit', [$i->id])}}"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>
                        <a class="dropdown-item deletemodal" data-toggle="modal" data-target="#deletemodal" data-url="{{route('bppb.delete', ['id' => $i->id])}}"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a>
                        </div>
                    </td>
                  </tr>
                  
                  @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#cc0000;">
                  <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Data</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="delete">
                  <div class="card">
                    <div class="card-body" style="text-align:center;">
                      <input id="labelid" name="labelid" hidden>
                      <h6>Kenapa anda ingin menghapus data ini?</h6>
                    </div>
                    <form id="deleteform" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="revisi" name="keterangan_log" value="revisi" checked>
                            <label for="revisi">
                              Revisi
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="salah_input" name="keterangan_log" value="salah_input">
                            <label for="salah_input">
                              Salah Input
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="pembatalan" name="keterangan_log" value="pembatalan">
                            <label for="pembatalan">
                              Pembatalan
                            </label>
                          </div>
                        </div>

                    </div>
                    <div class="card-footer col-12" style="margin-bottom: 2%;">
                      <span>
                        <button type="button" class="btn btn-block btn-info batalsk"  data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                      </span>
                      <span>
                        <button type="submit" class="btn btn-block btn-danger" id="hapussk" style="width:30%;float:right;">Hapus</button>
                      </span>
                    </div>
                    </form>
                </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      
    </section>
@endsection

@section('footer_script')
<script>
$(function(){
  $(document).on('click', '.deletemodal', function(){
    var url = $(this).attr('data-url');
    alert(url);
    $("#deleteform").attr("action", url);
  });
});
</script>
@stop