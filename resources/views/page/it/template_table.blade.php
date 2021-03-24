@extends('layouts.app')
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Table Template</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Calendar</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h2>Table A</h2>
          <table id="example2" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Tipe</th>
                <th>Kondisi</th>
                <th>Tanggal</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              <tr>
                <td>1</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>
                  <div style="color:red;"><i class="fas fa-times-circle"></i></div>
                </td>
                <td>
                  <!--{{date("d-m-Y", strtotime("01-01-1970"))}}--> 23-01-2021
                </td>
                <td>
                  <button class="btn btn-success  btn-circle btn-circle-sm m-1"><i class="fas fa-check"></i></button>

                  <button class="btn btn-danger  btn-circle btn-circle-sm m-1"><i class="fas fa-times"></i></button>
                </td>
                <td>
                  <button class="btn btn-info  btn-circle btn-circle-sm m-1"><i class="fas fa-eye"></i></button>

                  <button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button>

                  <button class="btn btn-danger  btn-circle btn-circle-sm m-1" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>
                  <div style="color:green;"><i class="fas fa-check-circle"></i></div>
                </td>
                <td>
                  <!--{{date("d-m-Y", strtotime("01-01-1970"))}}--> 23-01-2021
                </td>
                <td>
                  <p>
                  <div class="warning-text">Menunggu</div>
                  </p>
                </td>
                <td>
                  <button class="btn btn-info  btn-circle btn-circle-sm m-1"><i class="fas fa-eye"></i></button>

                  <button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button>

                  <button class="btn btn-danger  btn-circle btn-circle-sm m-1" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>
                  <div style="color:green;"><i class="fas fa-check-circle"></i></div>
                </td>
                <td>
                  <!--{{date("d-m-Y", strtotime("01-01-1970"))}}--> 23-01-2021
                </td>
                <td>

                  <p>
                  <div class="success-text">Diterima</div>
                  </p>
                </td>
                <td>
                  <button class="btn btn-info  btn-circle btn-circle-sm m-1"><i class="fas fa-eye"></i></button>

                  <button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button>

                  <button class="btn btn-danger  btn-circle btn-circle-sm m-1" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>
                  <div style="color:red;"><i class="fas fa-times-circle"></i></div>
                </td>
                <td>
                  <!--{{date("d-m-Y", strtotime("01-01-1970"))}}--> 23-01-2021
                </td>
                <td>
                  <p>
                  <div class="danger-text">Ditolak</div>
                  </p>
                </td>
                <td>
                  <button class="btn btn-info  btn-circle btn-circle-sm m-1"><i class="fas fa-eye"></i></button>

                  <button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button>

                  <button class="btn btn-danger  btn-circle btn-circle-sm m-1" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
              <tr>
                <td>5</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>
                  <div style="color:red;"><i class="fas fa-times-circle"></i></div>
                </td>
                <td>
                  <!--{{date("d-m-Y", strtotime("01-01-1970"))}}--> 23-01-2021
                </td>
                <td>
                  <p>
                  <div class="info-text">Draft</div>
                  </p>
                </td>
                <td>
                  <button class="btn btn-info  btn-circle btn-circle-sm m-1"><i class="fas fa-eye"></i></button>

                  <button class="btn btn-warning  btn-circle btn-circle-sm m-1"><i class="fas fa-edit"></i></button>

                  <button class="btn btn-danger  btn-circle btn-circle-sm m-1" data-toggle="modal" data-target="#delete"><i class="fas fa-trash"></i></button>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#cc0000;">
                  <h4 class="modal-title" id="myModalLabel" style="color:white;"><i class="fas fa-warning-circle"></i>&nbsp;Hapus </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="delete">
                  <div class="card">
                    <div class="card-body" style="text-align:center;">
                      <h6>Kenapa anda ingin menghapus Laporan ini?</h6>
                    </div>
                    <form id="delete-form" action="" method="POST">
                      <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="revisi_perakitan" name="keterangan_log" value="revisi" checked>
                            <label for="revisi_perakitan">
                              Revisi
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="salah_input_perakitan" name="keterangan_log" value="salah_input">
                            <label for="salah_input_perakitan">
                              Salah Input
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="pembatalan_perakitan" name="keterangan_log" value="pembatalan">
                            <label for="pembatalan_perakitan">
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
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <h2>Table B</h2>
          <table id="example2" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>No AKD</th>
                <th>Barcode</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Tipe dan Nama</th>
                <th>Kategori</th>
                <th>Berat</th>
                <th>Satuan</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
              <tr>
                <td>1</td>
                <td>KEMENKES RI AKD 20403318003</td>
                <td>CN01</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>Alat Kesehatan</td>
                <td>
                  500 gr
                </td>
                <td>
                  Unit
                </td>
                <td>
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat detail BPPB">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>
                    <a class="dropdown-item delete-produk" data-url="#" data-toggle="modal" data-target="#deletemodal"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a>
                  </div>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>KEMENKES RI AKD 20403318003</td>
                <td>CN01</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>Alat Kesehatan</td>
                <td>
                  500 gr
                </td>
                <td>
                  Unit
                </td>
                <td>
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat detail BPPB">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>
                    <a class="dropdown-item delete-produk" data-url="#" data-toggle="modal" data-target="#deletemodal"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a>
                  </div>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>KEMENKES RI AKD 20403318003</td>
                <td>CN01</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>Alat Kesehatan</td>
                <td>
                  500 gr
                </td>
                <td>
                  Unit
                </td>
                <td>
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat detail BPPB">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>
                    <a class="dropdown-item delete-produk" data-url="#" data-toggle="modal" data-target="#deletemodal"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a>
                  </div>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td>KEMENKES RI AKD 20403318003</td>
                <td>CN01</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>Alat Kesehatan</td>
                <td>
                  500 gr
                </td>
                <td>
                  Unit
                </td>
                <td>
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat detail BPPB">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>
                    <a class="dropdown-item delete-produk" data-url="#" data-toggle="modal" data-target="#deletemodal"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a>
                  </div>
                </td>
              </tr>
              <tr>
                <td>5</td>
                <td>KEMENKES RI AKD 20403318003</td>
                <td>CN01</td>
                <td>Medical Nebulizer</td>
                <td>
                  <div class="text-center">
                    <img class="product-img-small img-fluid" src="{{url('assets/image/produk')}}/noimage.png" title="">
                  </div>
                </td>
                <td style="text-align: left;">
                  <hgroup>
                    <h6 class="heading">PROMIST-1 - Mini Compressor Nebulizer</h6>
                    <div class="subheading text-muted">Anesthesia</div>
                  </hgroup>
                </td>
                <td>Alat Kesehatan</td>
                <td>
                  500 gr
                </td>
                <td>
                  Unit
                </td>
                <td>
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Klik untuk melihat detail BPPB">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                  </a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="#"><span style="color: black;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Ubah</span></a>
                    <a class="dropdown-item delete-produk" data-url="#" data-toggle="modal" data-target="#deletemodal"><span style="color: black;"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;Hapus</span></a>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-md" role="document">
              <div class="modal-content">
                <div class="modal-header" style="background-color:#cc0000;">
                  <h4 class="modal-title" id="myModalLabel" style="color:white;"><i class="fas fa-warning-circle"></i>&nbsp;Hapus </h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body" id="delete">
                  <div class="card">
                    <div class="card-body" style="text-align:center;">
                      <h6>Kenapa anda ingin menghapus Laporan ini?</h6>
                    </div>
                    <form id="delete-form" action="" method="POST">
                      <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="revisi_perakitan" name="keterangan_log" value="revisi" checked>
                            <label for="revisi_perakitan">
                              Revisi
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-4">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="salah_input_perakitan" name="keterangan_log" value="salah_input">
                            <label for="salah_input_perakitan">
                              Salah Input
                            </label>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="icheck-danger d-inline">
                            <input type="radio" id="pembatalan_perakitan" name="keterangan_log" value="pembatalan">
                            <label for="pembatalan_perakitan">
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
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('footer_script')
<script>

</script>
@endsection