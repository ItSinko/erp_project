@extends('adminlte.page')
@section('title', 'Beta Version')
@section('content_header')
@stop
@section('adminlte_css')
<style>

</style>
@stop
@section('content')
<div class="row">
    <div class="col-12">
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data berhasil ditambahkan
        </div>
        @elseif(session()->has('error') || count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            Data gagal ditambahkan
        </div>
        @endif
        <div class="card">
            <div class="card-header  bg-success">
                <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Pengukuran Berat Badan</div>
            </div>
            <form action="/kesehatan_bulanan_berat/aksi_tambah" method="post" enctype="multipart/form-data">

                <div class="card-body">
                    <div class="table-responsive">
                        {{ csrf_field() }}
                        <table class="table  table-striped table-hover" id="tabel_berat" style="width:150%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th width="15%">Nama</th>
                                    <th>Tinggi</th>
                                    <th>Berat</th>
                                    <th>Lemak</th>
                                    <th>Kandungan air</th>
                                    <th>Otot</th>
                                    <th>Tulang</th>
                                    <th>Kalori</th>
                                    <th>Catatan</th>
                                    <th></th>
                            </thead>
                            <tbody style="text-align: center;">
                                <tr>
                                    <td>1</td>
                                    <td><input type="date" class="form-control tgl_cek" name="tgl_cek[]"></td>
                                    <td><select class="form-control select2" style="width:100%" name="karyawan_id[]">
                                            <option value="">Pilih Karyawan</option>
                                            @foreach($karyawan as $k)
                                            <option value="{{$k->id}}">{{$k->nama}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <div class=" input-group mb-3">
                                            <input type="text" class="form-control" name="tinggi[]" readonly id="tinggi">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Cm</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control berat" name="berat[]" id="berat">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                        <small id="status_bmi" class="form-text text-muted"></small>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control lemak" name="lemak[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">gram</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control kandungan_air" name="kandungan_air[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">%</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control otot" name="otot[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control tulang" name="tulang[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control kalori" name="kalori[]">
                                            <div class="input-group-append">
                                                <span class="input-group-text">kkal</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                    </td>
                                    <td>
                                        <button name="add" type="button" id="tambahitem" class="btn btn-success"><i class="nav-icon fas fa-plus-circle"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
                <div class="card-footer">
                    <span class="float-left"><a class="btn btn-danger rounded-pill" href="/kesehatan_bulanan"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
                    <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Tambah Data</button></span>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('adminlte_js')
<script>
    $(document).ready(function() {
        $('#tabel_berat').DataTable({
            "scrollX": true,
            "searching": false,
            "paging": false,
            "lengthChange": false,
            "info": false
        });
    });
</script>
<script>
    $(function() {
        function numberRows($t) {
            var c = 0 - 1;
            $t.find("tr").each(function(ind, el) {
                $(el).find("td:eq(0)").html(++c);
                var j = c - 1;
                $(el).find('.tgl_cek').attr('name', 'tgl_cek[' + j + ']');
                $(el).find('.karyawan_id').attr('name', 'karyawan_id[' + j + ']');
                $(el).find('.berat').attr('name', 'berat[' + j + ']');
                $(el).find('.lemak').attr('name', 'lemak[' + j + ']');
                $(el).find('.kandungan_air').attr('name', 'kandungan_air[' + j + ']');
                $(el).find('.otot').attr('name', 'otot[' + j + ']');
                $(el).find('.tulang').attr('name', 'tulang[' + j + ']');
                $(el).find('.kalori').attr('name', 'kalori[' + j + ']');
                $(el).find('.keterangan').attr('name', 'keterangan[' + j + ']');

                $('.karyawan_id').select2();
            });
        }

        $('#tambahitem').click(function(e) {
            var data = `     <tr>
                                  <td>1</td>
                                <td><input type="date" class="form-control tgl_cek"  name="tgl_cek[]"></td>
                                <td><select class="form-control select2 karyawan_id" style="width:100%" name="karyawan_id[]">
                                <option value="">Pilih Karyawan</option>
                                        @foreach($karyawan as $k)
                                        <option value="{{$k->id}}">{{$k->nama}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <div class=" input-group mb-3">
                                        <input type="text" class="form-control" name="tinggi[]" readonly id="tinggi">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Cm</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control berat" name="berat[]" id="berat">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                    <small id="status_bmi" class="form-text text-muted"></small>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control lemak" name="lemak[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">gram</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control kandungan_air" name="kandungan_air[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control otot" name="otot[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control tulang" name="tulang[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kg</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control kalori" name="kalori[]">
                                        <div class="input-group-append">
                                            <span class="input-group-text">kkal</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group mb-3">
                                        <textarea type="text" class="form-control keterangan" name="keterangan[]"></textarea>
                                </td>
                                <td>
                                <button type="button" class="btn btn-danger karyawan-img-small" style="border-radius:50%;" id="closetable"><i class="fas fa-times-circle"></i></button> 
                                                                   </td>
                            </tr>`;
            $('#tabel_berat tr:last').after(data);
            numberRows($("#tabel_berat"));
        });
        $('#tabel_berat').on('click', '#closetable', function(e) {
            $(this).closest('tr').remove();
            numberRows($("#tabel_berat"));
        });

    })
</script>
@endsection