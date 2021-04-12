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
    <div class="col-12">
      <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
          <table id="example2" class="table table-hover table-bordered styled-table">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="{{route('perakitan.create')}}" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah Perakitan BPPB</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>No BPPB</th>
                <th>Gambar</th>
                <th>Tipe dan Nama</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody style="text-align:center;">
              @foreach($p as $i)
              <tr>
                <td rowspan="{{count($i->Perakitan)}}">{{$loop->iteration}}</td>
                <td rowspan="{{count($i->Perakitan)}}">{{$i->no_bppb}}</td>
                <td rowspan="{{count($i->Perakitan)}}">
                  <div class="text-center">
                    <img class="product-img-small img-fluid" @if(empty($i->Produk->foto))
                    src="{{url('assets/image/produk')}}/noimage.png"
                    @elseif(!empty($i->Produk->foto))
                    src="{{asset('image/produk/')}}/{{$i->Produk->foto}}"
                    @endif
                    title="{{$i->Produk->nama}}"
                    >
                  </div>
                </td>
                <td rowspan="{{count($i->Perakitan)}}">
                  <hgroup>
                    <h6 class="heading">{{$i->Produk->tipe}} - {{$i->Produk->nama}}</h6>
                    <div class="subheading text-muted">{{$i->Produk->KelompokProduk->nama}}</div>
                  </hgroup>
                </td>
                <td rowspan="{{count($i->Perakitan)}}">{{$i->jumlah}} {{$i->Produk->satuan}}</td>
                @php ($first = true) @endphp
                @foreach($i->Perakitan as $j)
                @if($first == true)
                <td>
                  <a href="{{route('perakitan.hasil', [ 'id' => $j->id ])}}">Laporan tanggal {{date("d-m-Y", strtotime($j->tanggal))}}</a>
                </td>
                @if(Auth::user()->Divisi->nama == "Produksi")
                <td rowspan="{{count($i->Perakitan)}}">
                  @if($i->jumlah > $i->countHasilPerakitan())
                  <a href="{{route('perakitan.create_laporan', ['bppb_id' => $i->id])}}">
                    <button type="button" class="rounded-pill btn btn-primary">
                      <span style="color:white;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Laporan</a></span>
                  </button>
                  </a>
                  @else($i->Bppb->jumlah <= $i->countHasilPerakitan())
                    <button type="button" class="rounded-pill btn btn-secondary" disabled>
                      <span style="color:white;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Tambah Laporan</a></span>
                    </button>
                    @endif
                </td>
                @elseif(Auth::user()->Divisi->nama == "Quality Control")
                <td>
                  <a href="{{route('perakitan.pemeriksaan.create', ['id' => $j->id])}}">
                    <button type="button" class="rounded-pill btn btn-warning">
                      <span style="color:white;"><i class="fas fa-search" aria-hidden="true"></i>&nbsp;Pemeriksaan</a></span>
                  </button>
                  </a>
                </td>
                @endif
              </tr>
              @php ($first = false) @endphp
              @elseif($first == false)
              <tr>
                <td>
                  <a href="{{route('perakitan.hasil', [ 'id' => $j->id ])}}">Laporan tanggal {{date("d-m-Y", strtotime($j->tanggal))}}</a>
                </td>
                @if(Auth::user()->Divisi->nama == "Quality Control")
                <td>
                  <a href="{{route('perakitan.pemeriksaan.create', ['id' => $j->id])}}">
                    <button type="button" class="rounded-pill btn btn-warning">
                      <span style="color:white;"><i class="fas fa-search" aria-hidden="true"></i>&nbsp;Pemeriksaan</a></span>
                  </button>
                  </a>
                </td>
                @endif
              </tr>
              @endif
              @endforeach
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th>No</th>
                <th>No BPPB</th>
                <th>Gambar</th>
                <th>Tipe dan Nama</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
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