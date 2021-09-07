@extends('adminlte.master')

@section('body')
<table id="gudang_table" class="table table-hover styled-table table-striped">
    <thead style="text-align: center;">
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
@stop

@section('master_js')
<script>
    $.ajax({
        type: "GET",
        url: "/api/example-data",
        dataType: 'json',
        success: function(obj) {
            $("#gudang_table").DataTable({
                pageLength: 100,
                data: obj,
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'a'
                    },
                    {
                        data: 'b'
                    },
                ]
            })
        }
    })
</script>
@stop