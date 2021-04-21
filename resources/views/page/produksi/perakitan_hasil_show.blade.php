@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Perakitan</h1>
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
  <div class="row">
    <div class="col-3">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Info Perakitan</div>
        </div>
        <div class="card-body">

          <div class="card-body box-profile">
            <div class="text-center">
              <img class="product-img-small img-fluid" @if(empty($sh->Bppb->DetailProduk->foto))
              src="{{url('assets/image/produk')}}/noimage.png"
              @elseif(!empty($sh->Bppb->DetailProduk->foto))
              src="{{url('assets/image/produk')}}/{{$sh->Bppb->DetailProduk->foto}}"
              @endif
              title="{{$sh->Bppb->DetailProduk->nama}}"
              >
            </div>
            <div style="text-align:center;vertical-align:center;padding-top:10px">
              <h5 class="card-heading">{{$sh->Bppb->DetailProduk->nama}}</h5>
              <h6 class="card-subheading text-muted">{{$sh->Bppb->DetailProduk->Produk->nama}}</h6>
            </div>
          </div>
          <div class="row" style="padding-bottom:10%;">
            @if($sh->status == 0)
            <div class="inline-flex col-lg-6">
              <a href="{{route('perakitan.laporan.edit', ['id' => $sh->id])}}" class="col-lg-12">
                <button type="button" class="btn btn-block btn-warning rounded-pill"><i class="fas fa-edit"></i> Edit</button>
              </a>
            </div>
            <div class="inline-flex col-lg-6">
              <a class="delete-perakitan col-lg-12" data-toggle="modal" data-target="#delete-perakitan" data-url="{{route('perakitan.laporan.delete', ['id' => $sh->id])}}">
                <button type="button" class="btn btn-block btn-danger rounded-pill"><i class="fas fa-trash"></i> Delete</button>
              </a>
            </div>
            @else
            <div class="inline-flex col-lg-6">
              <button type="button" class="btn btn-block btn-warning rounded-pill" disabled><i class="fas fa-edit"></i> Edit</button>
            </div>
            <div class="inline-flex col-lg-6">
              <button type="button" class="btn btn-block btn-danger rounded-pill" disabled><i class="fas fa-trash"></i> Delete</button>
            </div>
            @endif
          </div>

          <div class="row">
            <div class="col-lg-6" style="vertical-align: middle;">
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted">No BPPB</h6>
                <h5 class="card-heading">{{$sh->Bppb->no_bppb}}</h5>
              </hgroup>
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted ">Tanggal</h6>
                <h5 class="card-heading">{{date("d-m-Y", strtotime($sh->tanggal))}}</h5>
              </hgroup>
            </div>
            <div class="col-lg-6" style="vertical-align: middle;">
              <hgroup>
                <!-- hgroup is deprecated, just defiantly using it anyway -->
                <h6 class="card-subheading text-muted ">Jumlah</h6>
                <h5 class="card-heading">{{$sh->Bppb->jumlah}}</h5>
              </hgroup>
            </div>
            <hgroup class="col-lg-12">
              <!-- hgroup is deprecated, just defiantly using it anyway -->
              <h6 class="card-subheading text-muted ">Status</h6>
              <h5 class="card-heading">
                @if( Auth::user()->divisi_id == "17")
                @if($sh->status == 0)
                <div class="inline-flex">
                  <a href="{{route('perakitan.laporan.status', ['id' => $id, 'status' => '12'])}}">
                    <button type="button" class="btn btn-block btn-outline-info karyawan-img-small" style="border-radius:50%;" title="Kirim Laporan ke Quality Control"><i class="far fa-paper-plane"></i></button>
                  </a>
                </div>
                @elseif($sh->status == '12')
                <span class="label info-text">Dibuat</span>
                @endif
                @elseif(Auth::user()->divisi_id == "23")
                @if($sh->status == '12')
                <div class="inline-flex">
                  <a href="">
                    <button type="button" class="btn btn-block btn-outline-danger karyawan-img-small" style="border-radius:50%;" title="Tolak Hasil Perakitan"><i class="fas fa-times"></i></button>
                  </a>
                </div>
                <div class="inline-flex">
                  <a href="">
                    <button type="button" class="btn btn-block btn-success karyawan-img-small" style="border-radius:50%;" title="Terima Hasil Perakitan"><i class="fas fa-check"></i></button>
                  </a>
                </div>
                @endif
                @endif
              </h5>
            </hgroup>
          </div>
        </div>
      </div>
    </div>
    <div class="col-9">
      <div class="card">
        <div class="card-header">
          <div class="card-title">Hasil Perakitan</div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          @if ($errors->has('file'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('file') }}</strong>
          </span>
          @endif

          {{-- notifikasi sukses --}}
          @if ($sukses = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $success }}</strong>
          </div>
          @endif

          <table id="example" class="table table-hover styled-table">
            <thead style="text-align: center;">
              @if(($sh->HasilPerakitan->count() < $sh->Bppb->jumlah) && ($sh->status == "0"))
                <tr style="text-align: left;">
                  <th colspan="12">

                    <a href="{{route('perakitan.hasil.create', ['id' => $id])}}" style="color: white; display:inline-block;"><button type="button" class="btn btn-block btn-success btn-sm"><i class="fas fa-plus"></i> &nbsp; Tambah No Seri Perakitan</i></button></a>
                    <button type="button" class="btn btn-block btn-primary btn-sm" style="width: 100px; display:inline-block;" data-toggle="modal" data-target="#importExcel"><i class="fas fa-plus"></i> &nbsp; Import</i></button>

                  </th>
                </tr>
                @endif
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>No Seri</th>
                  <th>Operator</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
            </thead>
            <tbody style="text-align:center;">
            </tbody>

          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->


      <!-- /.card -->
    </div>

    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form method="post" action="{{route('perakitan.hasil.import', ['id' => $sh->id])}}" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
            </div>
            <div class="modal-body">
              {{ csrf_field() }}
              {{ method_field('PUT') }}
              <label>Pilih file excel</label>
              <div class="form-group">
                <input type="file" name="file" required="required" accept=".xls,.xlsx,.csv">
              </div>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Import</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#cc0000;">
            <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus Data</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body" id="delete">

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deletenoserimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header" style="background-color:#cc0000;">
            <h4 class="modal-title" id="myModalLabel" style="color:white;">Hapus No Seri</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body" id="deletenoseri">

          </div>
        </div>
      </div>
    </div>

    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
@endsection
@section('adminlte_js')
<script>
  $(function() {
    $('#example').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('perakitan.hasil.show', ['id' => $id]) }}",
      columns: [{
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        }, {
          data: 'tanggal',
          name: 'tanggal'
        },
        {
          data: 'no_seri',
          name: 'no_seri'
        },
        {
          data: 'operator',
          name: 'operator'
        },
        {
          data: 'status',
          name: 'status'
        },
        {
          data: 'aksi',
          name: 'aksi',
          orderable: false,
          searchable: false
        },
      ]
    });

    $(document).on('click', '.deletemodal', function(event) {
      event.preventDefault();
      var href = $(this).attr('data-attr');
      $.ajax({
        url: '/template_form_delete',
        beforeSend: function() {
          $('#loader').show();
        },
        // return the result
        success: function(result) {
          $('#deletemodal').modal("show");
          $('#delete').html(result).show();
          $("#deleteform").attr("action", href);
        },
        complete: function() {
          $('#loader').hide();
        },
        error: function(jqXHR, testStatus, error) {
          console.log(error);
          alert("Page " + href + " cannot open. Error:" + error);
          $('#loader').hide();
        },
        timeout: 8000
      })
    });

    $(document).on('click', '.deletenoserimodal', function(event) {
      event.preventDefault();
      var href = $(this).attr('data-attr');
      $.ajax({
        url: '/template_form_delete',
        beforeSend: function() {
          $('#loader').show();
        },
        // return the result
        success: function(result) {
          $('#deletenoserimodal').modal("show");
          $('#deletenoseri').html(result).show();
          $("#deleteform").attr("action", href);
        },
        complete: function() {
          $('#loader').hide();
        },
        error: function(jqXHR, testStatus, error) {
          console.log(error);
          alert("Page " + href + " cannot open. Error:" + error);
          $('#loader').hide();
        },
        timeout: 8000
      })
    });

  });
</script>
@stop