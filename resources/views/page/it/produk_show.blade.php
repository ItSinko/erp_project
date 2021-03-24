@extends('layouts.app')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Produk</h1>
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
          <table id="example2" class="table table-hover styled-table">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="{{route('produk.create')}}" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah Produk</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>No AKD</th>
                <th>Barcode</th>
                <th>Gambar</th>
                <th>Tipe dan Nama</th>
                <th>Nama COO</th>
                <th>Kategori</th>
                <th>Berat</th>
                <th>Satuan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody style="text-align:center;">
              @foreach($s as $i)
              <tr>
                <td class="counterCell"></td>
                <td>{{$i->no_akd}}</td>
                <td>{{$i->kode_barcode}}</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" @if(empty($i->foto))
                    src="{{url('assets/image/produk')}}/noimage.png"
                    @elseif(!empty($p->foto))
                    src="{{asset('image/produk/')}}/{{$i->foto}}"
                    @endif
                    title="{{$i->nama}}"
                    >
                  </div>
                </td>
                <td style="vertical-align:middle;text-align:left;">
                  <hgroup>
                    <h6 class="heading">{{$i->tipe}} - {{$i->nama}}</h6>
                    <div class="subheading text-muted">{{$i->kategoriproduk->nama}}</div>
                  </hgroup>
                <td>{{$i->nama_coo}}</td>
                <td>{{$i->kelompokproduk['nama']}}</td>
                <td>{{$i->berat}} gr</td>
                <td>{{ucfirst($i->satuan)}}</td>
                <td>
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat detail BPPB">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{route('produk.edit', ['id' => $i->id])}}"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>
                    <a class="dropdown-item delete-produk" data-url="{{route('produk.delete', ['id' => $i->id])}}" data-toggle="modal" data-target="#deletemodal"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a>
                  </div>
                </td>
              </tr>
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
                        <form id="delete-produk" action="" method="POST">
                          {{ csrf_field() }}
                          {{ method_field('PUT') }}
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
                              <button type="button" class="btn btn-block btn-info batalsk" data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                            </span>
                            <span>
                              <button type="submit" class="btn btn-block btn-danger hapussk" id="hapussk" style="width:30%;float:right;">Hapus</button>
                            </span>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </tbody>

          </table>
        </div>
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

@section('footer_script')
<script>
  $(function() {
    $(document).on('click', '.delete-produk', function() {
      var url = $(this).attr('data-url');
      $("#delete-produk").attr("action", url);
    });
  });

  $(function() {

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('produk') }}",
      columns: [{
          data: 'id',
          name: 'id'
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'email',
          name: 'email'
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false
        },
      ]
    });

  });
</script>
@stop