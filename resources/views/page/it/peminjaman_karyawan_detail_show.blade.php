<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h2>Penugasan</h2>
                    <table id="detaildata" class="table table-hover styled-table-small table-striped table-item" style="width:100%;">
                        <thead style="text-align: center;">
                            <!-- <tr>
                                <th colspan="20">
                                    <a href="{{route('peminjaman.karyawan.create')}}" style="color: white;"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 200px;"><i class="fas fa-plus"></i> &nbsp; Tambah</i></button></a>
                                </th>
                            </tr> -->
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody style="text-align: center;">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


@section('adminlte_js')
<script>
    $(function() {
        $('#detaildata').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('peminjaman.karyawan.detail.show', ['id' => $id]) }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, {
                    data: 'karyawan_id',
                    name: 'karyawan_id'
                },
                {
                    data: 'keterangan',
                    name: 'keterangan'
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
    });
</script>
@stop