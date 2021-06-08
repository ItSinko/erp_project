@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 id="page_header" class="m-0 text-dark">PPIC BOM</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="input-group col-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="input">Search</label>
                    </div>
                    <select class="select2" id="input">
                        <option selected>Choose...</option>
                        @foreach ($detail_produk as $d)
                        <optgroup label="{{ $d->nama }}">
                            @foreach ($produk_bom as $b)
                            @if ($d->id == $b->detail_produk_id)
                            <option value="{{ $b->id }}">versi {{ $b->versi }}</option>
                            @endif
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body" id="table" style="display: none;">
                <table class="table table-bordered">
                    <thead>
                        <tr style="text-align: center;">
                            <th>#</th>
                            <th style="width: 50%">Nama</th>
                            <th>Jumlah</th>
                            <th>Stok</th>
                            <th>Pemotongan</th>
                            <th>Sisa</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('adminlte_js')
<script src="{{ asset('vendor/bootbox/bootbox.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#input").change(function() {
            var value = $("#input").val();
            $('#table').hide();
            $('tbody').html('');
            $('tfoot').html('');
            $('#table').show(1000);

            if (value == "Choose...") $("#card").html("");
            else {
                console.log(value);
                $.ajax({
                    url: "/ppic/get_bom/" + value,
                    success: function(result) {
                        var_result = result;
                        console.log(result);
                        var data = $('tbody')

                        console.log(result.length);
                        for (var j = 0; j < result.length - 1; j++) {
                            var pemotongan = parseInt(result[j].jumlah) * parseInt(var_result[var_result.length - 1]);
                            var sisa = parseInt(result[j].stok) - pemotongan;
                            var child;
                            if (sisa == 0) {
                                child = `
                                <tr style="background: yellow;">
                                    <td>` + j + 1 + `</td>
                                    <td>` + result[j].nama + `</td>
                                    <td>` + result[j].jumlah + `</td>
                                    <td>` + result[j].stok + `</td>
                                    <td>` + pemotongan + `</td>
                                    <td>` + sisa + `</td>
                                </tr>
                            `;
                            } else {
                                child = `
                                <tr>
                                    <td>` + j + 1 + `</td>
                                    <td>` + result[j].nama + `</td>
                                    <td>` + result[j].jumlah + `</td>
                                    <td>` + result[j].stok + `</td>
                                    <td>` + pemotongan + `</td>
                                    <td>` + sisa + `</td>
                                </tr>
                            `;
                            }
                            data.append(child);
                        }
                        var last_child = `
                                <tr>
                                    <th colspan="5">Jumlah Maksimum Produksi</th>
                                    <th>` + var_result[var_result.length - 1] + `</th>
                                </tr>
                        `;

                        $('tfoot').html(last_child);

                        $("#bom_table").DataTable({
                            lengthMenu: [
                                [-1, 10, 50],
                                ['all', 10, 50]
                            ]
                        });
                    },
                    error: function(xhr, status, error) {
                        $('#card').html('BOM tidak ditemukan')
                        bootbox.alert({
                            centerVertical: true,
                            message: "BOM tidak ditemukan",
                        });
                    }
                });
            }
        });
    })
</script>
@stop