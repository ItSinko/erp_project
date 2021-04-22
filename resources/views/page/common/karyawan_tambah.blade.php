@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop


@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Template Form</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <form action="form-pemeriksaan">

                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i></strong> Berhasil menambahkan data
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-times"></i></strong> Gagal menambahkan data
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <div class="card">
                        <div class="card-header bg-success">
                            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Tambah</div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12">
                                <h4>Full Form</h4>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Nama</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('data') is-invalid @enderror" name="no_pemeriksaan" id="no_pemeriksaan" placeholder="Masukkan data" value="{{old('no_pemeriksaan')}}" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_pemeriksaan-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Tgl Lahir</label>
                                                <div class="col-sm-8">
                                                    <input type="date" class="form-control @error('data') is-invalid @enderror" name="tanggal" id="tanggal" value="{{old('tanggal')}}" placeholder="Masukkan tanggal" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_seri-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">Select</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control custom-select select2 select2-info @error('data') is-invalid @enderror" data-dropdown-css-class="s-2" style="width: 50%;" name="s-2" data-placeholder="Pilih Operator">
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="C">C</option>
                                                        <option value="D">D</option>
                                                        <option value="E">E</option>
                                                    </select>
                                                    <span role="alert" id="no_seri-msg"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Multiple Select</label>
                                                <div class="col-sm-8">
                                                    <select class="select2 form-control custom-select @error('data') is-invalid @enderror" multiple="multiple" name="sm-2[]" id="sm-2" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                        <option value="A">A</option>
                                                        <option value="A">B</option>
                                                        <option value="A">C</option>
                                                    </select>
                                                    <span role="alert" id="karyawan_id-msg"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Radio Button Inline</label>

                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="radio" name="rb-1" checked="" id="no" value="no">
                                                        <label for="no">
                                                            A
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="radio" name="rb-1" id="sample" value="sample">
                                                        <label for="sample">
                                                            B
                                                        </label>
                                                    </div>
                                                    <div class="icheck-danger d-inline col-sm-4">
                                                        <input type="radio" name="rb-1" id="all" value="all">
                                                        <label for="all">
                                                            C
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="kondisi" class="col-sm-4 col-form-label @error('data') is-invalid @enderror" style="text-align:right;">Checkbox Inline</label>

                                                <div class="col-sm-8" style="margin-top:7px;">
                                                    <div class="icheck-success d-inline col-sm-4">
                                                        <input type="checkbox" id="checkboxPrimary1" checked="" name="cb-1">
                                                        <label for="checkboxPrimary1">
                                                            A
                                                        </label>
                                                    </div>
                                                    <div class="icheck-warning d-inline col-sm-4">
                                                        <input type="checkbox" id="checkboxPrimary2" name="cb-1">
                                                        <label for="checkboxPrimary2">
                                                            B
                                                        </label>
                                                    </div>
                                                    <div class="icheck-danger d-inline col-sm-4">
                                                        <input type="checkbox" id="checkboxPrimary3" name="cb-1">
                                                        <label for="checkboxPrimary3">
                                                            C
                                                        </label>
                                                    </div>
                                                    <span class="invalid-feedback" role="alert" id="kesimpulan_pemeriksaan-msg"></span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Textarea</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control @error('data') is-invalid @enderror" name="keterangan_pemeriksaan" id="keterangan_pemeriksaan" style="width:70%;" placeholder="Masukkan data"></textarea>
                                                </div>
                                                <span class="invalid-feedback" role="alert" id="kesimpulan_pemeriksaan-msg"></span>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><button class="btn btn-danger rounded-pill" id=""><i class="fas fa-times"></i>&nbsp;Batal</button></span>
                            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                        </div>
                    </div>
                </form>
            </div>
            <form action="">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <div class="card-title">Tes Buta Warna</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="tableitem" style="text-align:center;">
                                <thead>
                                    <tr>

                                        <th>Hal</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@section('adminlte_js')

@stop