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
                                                <label for="no_pemeriksaan" class="col-sm-4 col-form-label" style="text-align:right;">Input Text</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control @error('data') is-invalid @enderror" name="no_pemeriksaan" id="no_pemeriksaan" placeholder="Masukkan data" value="{{old('no_pemeriksaan')}}" style="width:45%;">
                                                </div>
                                                <span role="alert" id="no_pemeriksaan-msg"></span>
                                            </div>
                                            <div class="form-group row">
                                                <label for="tanggal" class="col-sm-4 col-form-label" style="text-align:right;">Input Date</label>
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

            <div class="col-lg-12">
                <div class="card" id="card-pemeriksaan">
                    <div class="card-header bg-warning">
                        <div class="card-title"><i class="fas fa-edit"></i>&nbsp;Edit</div>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12">
                            <h4>Form B</h4>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="no_seri" class="col-sm-4 col-form-label" style="text-align:right;">Select</label>
                                            <div class="col-sm-8 ">
                                                <select class="form-control select2 select2-info @error('data') is-invalid @enderror" data-dropdown-css-class="s-1" style="width: 50%;" name="s-1">
                                                    <option value="A">A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                    <option value="D">D</option>
                                                    <option value="E">E</option>
                                                </select>
                                                @if ($errors->has('data'))
                                                <span role="alert" id="no_seri-msg"></span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="karyawan_id" class="col-sm-4 col-form-label" style="text-align:right;">Multiple Select</label>
                                            <div class="col-sm-8 ">
                                                <select class="select2 form-control @error('data') is-invalid @enderror" multiple="multiple" name="sm-1[]" id="sm-1" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                    <option value="A">A</option>
                                                    <option value="A">B</option>
                                                    <option value="A">C</option>
                                                </select>
                                                @if ($errors->has('data'))
                                                <span role="alert" id="karyawan_id-msg"></span>
                                                @end
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Radio Button Inline</label>

                                            <div class="col-sm-8" style="margin-top:7px;">
                                                <div class="icheck-success d-inline col-sm-4">
                                                    <input type="radio" name="rb-2" checked="" id="no" value="no">
                                                    <label for="no">
                                                        A
                                                    </label>
                                                </div>
                                                <div class="icheck-warning d-inline col-sm-4">
                                                    <input type="radio" name="rb-2" id="sample" value="sample">
                                                    <label for="sample">
                                                        B
                                                    </label>
                                                </div>
                                                <div class="icheck-danger d-inline col-sm-4">
                                                    <input type="radio" name="rb-2" id="all" value="all">
                                                    <label for="all">
                                                        C
                                                    </label>
                                                </div>
                                                <span class="invalid-feedback" role="alert" id="kondisi-msg"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="kondisi" class="col-sm-4 col-form-label" style="text-align:right;">Checkbox Inline</label>

                                            <div class="col-sm-8" style="margin-top:7px;">
                                                <div class="icheck-success d-inline col-sm-4">
                                                    <input type="checkbox" id="checkboxPrimary1" checked="" name="cb-2">
                                                    <label for="checkboxPrimary1">
                                                        A
                                                    </label>
                                                </div>
                                                <div class="icheck-warning d-inline col-sm-4">
                                                    <input type="checkbox" id="checkboxPrimary2" name="cb-2">
                                                    <label for="checkboxPrimary2">
                                                        B
                                                    </label>
                                                </div>
                                                <div class="icheck-danger d-inline col-sm-4">
                                                    <input type="checkbox" id="checkboxPrimary3" name="cb-2">
                                                    <label for="checkboxPrimary3">
                                                        C
                                                    </label>
                                                </div>
                                                <span class="invalid-feedback" role="alert" id="kesimpulan_pemeriksaan-msg"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                            <div class="col-sm-8">
                                                <textarea class="form-control @error('data') is-invalid @enderror" name="keterangan_inp" id="keterangan_inp"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group row float-left">
                            <button class="btn btn-danger rounded-pill"><i class="fas fa-times"></i>&nbsp;Batal</button>
                        </div>
                        <div class="form-group row float-right">
                            <button class="btn btn-warning rounded-pill" id="tambahbaris"><i class="far fa-edit"></i>&nbsp;Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
            <form action="">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <div class="card-title">Form Table</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="tableitem" style="text-align:center;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Input Text</th>
                                        <th>Input Date</th>
                                        <th>Input Number</th>
                                        <th>Select</th>
                                        <th>Multiple Select</th>
                                        <th>Radio Button</th>
                                        <th>Checkbox</th>
                                        <th>Textarea</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" placeholder="Masukkan data" class="form-control @error('data') is-invalid @enderror" name="text-1" id="text-1" value="{{old('text-1')}}"></td>
                                        <td><input type="date" placeholder="Masukkan data" class="form-control @error('data') is-invalid @enderror" name="date-1" id="date-1" value="{{old('date-1')}}"></td>
                                        <td><input type="number" placeholder="Masukkan data" class="form-control @error('data') is-invalid @enderror" name="number-1" id="number-1" value="{{old('number-1')}}"></td>
                                        <td><select class="select2 form-control @error('data') is-invalid @enderror" name="no_seri_inp" id="no_seri_inp " data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 80%;">
                                                <option value="A">A</option>
                                                <option value="A">B</option>
                                                <option value="A">C</option>
                                            </select>
                                        </td>
                                        <td><select class="select2 form-control @error('data') is-invalid @enderror" multiple="multiple" name="karyawan_id_inp[]" id="karyawan_id_inp" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                                                <option value="A">A</option>
                                                <option value="A">B</option>
                                                <option value="A">C</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline checked">
                                                            <input type="radio" name="rb-3" id="r3">
                                                            <label for="r3">
                                                                A
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="radio" name="rb-3" id="r2">
                                                            <label for="r2">
                                                                B
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-danger d-inline">
                                                            <input type="radio" name="rb-3" id="r1">
                                                            <label for="r1">
                                                                C
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-success d-inline">
                                                            <input type="checkbox" id="cb3-1" checked="" name="cb-3">
                                                            <label for="cb3-1">
                                                                A
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-warning d-inline">
                                                            <input type="checkbox" id="cb3-2" name="cb-3">
                                                            <label for="cb3-2">
                                                                B
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group clearfix">
                                                        <div class="icheck-danger d-inline">
                                                            <input type="checkbox" id="cb3-3" name="cb-3">
                                                            <label for="cb3-3">
                                                                C
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="invalid-feedback" role="alert"></span>
                                        </td>
                                        <td><textarea class="form-control @error('data') is-invalid @enderror" name="keterangan_inp" id="keterangan_inp"></textarea></td>
                                        <td><button type="button" class="btn btn-block btn-success btn-sm circle-button karyawan-img-small" id="tambahitem"><i class="fas fa-plus"></i></button></td>
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
<script>
    $(function() {
        $('#tambahitem').click(function(e) {
            $('#tableitem tr:last').after(`<tr>
                                <td>1</td>
                                <td><input type="text" class="form-control" name="text-1" id="text-1" value="{{old('text-1')}}"></td>
                                <td><input type="date" class="form-control" name="date-1" id="date-1" value="{{old('date-1')}}"></td>
                                <td><input type="number" class="form-control" name="number-1" id="number-1" value="{{old('number-1')}}"></td>
                                <td><select class="select2 form-control" name="no_seri_inp" id="no_seri_inp" data-placeholder="Pilih No Seri" data-dropdown-css-class="select2-info" style="width: 80%;">
                                        <option value="A">A</option>
                                        <option value="A">B</option>
                                        <option value="A">C</option>
                                    </select>
                                </td>
                                <td><select class="select2 form-control" multiple="multiple" name="karyawan_id_inp[]" id="karyawan_id_inp" data-placeholder="Pilih Operator" data-dropdown-css-class="select2-info" style="width: 100%;">
                                        <option value="A">A</option>
                                        <option value="A">B</option>
                                        <option value="A">C</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-success d-inline checked">
                                                    <input type="radio" name="rb-3" id="r3">
                                                    <label for="r3">
                                                    A
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-warning d-inline">
                                                    <input type="radio" name="rb-3" id="r2">
                                                    <label for="r2">
                                                    B
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                                <div class="icheck-danger d-inline">
                                                    <input type="radio" name="rb-3" id="r1">
                                                    <label for="r1">
                                                    C
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><div class="row">
                                        <div class="col-sm-6">
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="cb3-1" checked="" name="cb-3">
                                                <label for="cb3-1">
                                                    A
                                                </label>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                            <div class="icheck-warning d-inline">
                                                <input type="checkbox" id="cb3-2"  name="cb-3">
                                                <label for="cb3-2">
                                                    B
                                                </label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group clearfix">
                                            <div class="icheck-danger d-inline">
                                                <input type="checkbox" id="cb3-3" name="cb-3">
                                                <label for="cb3-3">
                                                    C
                                                </label>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <span class="invalid-feedback" role="alert"></span>
                                </td>
                                <td><textarea class="form-control" name="keterangan_inp" id="keterangan_inp"></textarea></td>
                                <td><button type="button" class="btn btn-block btn-danger btn-sm circle-button karyawan-img-small" id="closetable" ><i class="fas fa-trash"></i></button></td>
                            </tr>`);
        });

        $('#tableitem').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tableitem"));
        });
    })
</script>
@stop