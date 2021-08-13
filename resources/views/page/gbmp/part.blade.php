@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <div class='table-responsive'>
          <h2>Daftar Part</h2>
          <table id="tabel" class="table table-hover styled-table table-striped">
            <thead style="text-align: center;">
              <tr>
                <th colspan="12">
                  <a href="/kesehatan/tambah" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                </th>
              </tr>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Satuan</th>
                <th>Layout</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody style="text-align: center;">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@section('adminlte_js')
<script>
  $(function() {
    var tabel = $('#tabel').DataTable({
      processing: true,
      serverSide: true,
      language: {
        processing: '<i class="fa fa-spinner fa-spin"></i> Tunggu Sebentar'
      },
      ajax: 'gbmp/daftar_part/data',
      columns: [{
          data: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'id'
        },
        {
          data: 'kode'
        },
        {
          data: 'nama'
        },
        {
          data: 'jumlah'
        },
        {
          data: 'satuan'
        },
        {
          data: 'layout'
        },
        {
          data: 'status'
        }
      ]
    });

    // $('#tabel > tbody').on('click', '#berat', function() {
    //   var rows = tabel.rows($(this).parents('tr')).data();
    //   $('.data_detail_head').html(
    //     rows[0]['karyawan']['nama']
    //   );
    //   $('input[id="tinggi"]').val(rows[0]['tinggi']);

    //   var value1 = $('.modal-body input[id=berat]').val();
    //   var value2 = rows[0]['tinggi'];

    //   var sum = value1 / ((value2 / 100) * (value2 / 100))
    //   $('#bmi').val(sum.toFixed(2));
    //   if (sum >= 30) {
    //     $('#status_bmi').text('Kegemukan (Obesitas)');
    //   } else if (sum >= 25 || sum >= 29.9) {
    //     $('#status_bmi').text('Kelebihan Berat Badan');
    //   } else if (sum >= 18.5 || sum >= 24.9) {
    //     $('#status_bmi').text('Normal (Ideal)');
    //   } else {
    //     $('#status_bmi').text('Kekurangan Berat Badan');
    //   }

    //   $('#berat_mod').modal('show');
    // })
  });
</script>
@endsection