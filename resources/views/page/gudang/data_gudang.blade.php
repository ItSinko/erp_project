@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="gudang_table">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Unit</th>
                            <th>Nama</th>
                            <th>Layout</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        <tr>
                            <td>{{ $d->part_id }}</td>
                            <td>{{ $d->klasifikasi }}</td>
                            <td>{{ $d->nama }}</td>
                            <td>{{ $d->layout }}</td>
                            <td>{{ $d->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Kode</th>
                            <th>Unit</th>
                            <th>Nama</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('adminlte_js')
<script>
    var table = $("#gudang_table").DataTable({
        lengthMenu: [
            [10, 100, -1],
            [10, 100, 'all']
        ]
    });

    buildSelect(table);
    table.on('draw', function() {
        buildSelect(table);
    });

    function buildSelect(table) {
        table.columns([0, 1, 2]).every(function() {
            var column = table.column(this, {
                search: 'applied'
            });
            var select = $('<select class="form-control" style="width: 100%;">')
                .appendTo($(column.footer()).empty())
                .on('change', function() {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );

                    column
                        .search(val ? '^' + val + '$' : '', true, false)
                        .draw();
                });

            select.append('<option value=""></option>');
            column.data().unique().sort().each(function(d, j) {
                select.append('<option value="' + d + '">' + d + '</option>');
            });

            // The rebuild will clear the exisiting select, so it needs to be repopulated
            var currSearch = column.search();
            if (currSearch) {
                select.val(currSearch.substring(1, currSearch.length - 1));
            }
        });
    }
</script>
@stop