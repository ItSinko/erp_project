@extends('adminlte.page')

@section('title', 'Beta Version')

@section('adminlte_css')
<style>
    .flex-container {
        display: flex;
        flex-wrap: wrap;
    }

    .flex-container>div {
        background-color: #f1f1f1;
        width: 15%;
        margin: 13px;
    }

    .card-subtitle {
        margin-bottom: 0;
    }

    #myInput {
        padding: 20px;
        margin-top: -6px;
        border: 0;
        border-radius: 0;
        background: #f1f1f1;
    }
</style>
@stop

@section('content_header')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Purchase Order</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active">Purchase Order</li>
                </ol>
            </div>
        </div>
    </div>
</section>
@stop

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-lg-12">
                        <span class="btn-group  float-right" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-outline-info active" id="tablebtn"><i class="fas fa-list"></i></button>
                            <button type="button" class="btn btn-outline-info" id="gridbtn"><i class="fas fa-th"></i></button>
                        </span>
                        <span class="dropdown float-right" id="filter" style="margin-right:5px;">
                            <button class=" btn btn-outline-info dropdown-toggle" type="button" id="dropdownFilter" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Filter
                            </button>
                            <ul id="filter_dd" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownFilter">
                                <li><a class="dropdown-item jenis_po semua" id="jenis_po" name="jenis_po">Semua</a></li>
                                <li><a class="dropdown-item jenis_po po_online" id="jenis_po" name="jenis_po">PO Online</a></li>
                                <li><a class="dropdown-item jenis_po po_offline" id="jenis_po" name="jenis_po">PO Offline</a></li>
                            </ul>
                        </span>
                        <span class="dropdown float-right" id="status" style="margin-right:5px;" hidden>
                            <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownStatus" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Status
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownStatus">
                                <a class="dropdown-item status" href="#" id="status" name="status" value="semua">Diproses</a>
                                <a class="dropdown-item status" href="#" id="status" name="status" value="online">Selesai</a>
                            </div>
                        </span>
                    </div>
                </div>
                <div class="row tabledisp">
                    <div class="col-lg-12">
                        <table class="table table-striped" id="example2">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Distributor</th>
                                    <th>No PO</th>
                                    <th>Tanggal PO</th>
                                    <th>Jenis Penjualan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="row griddisp" hidden>
                    <div class="col-lg-12">
                        <div class="flex-container gridview">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop

@section('adminlte_js')
<script>
    $(function() {
        tableview("semua");
        gridview("semua");

        function tableview(status) {
            $('#example2').DataTable({
                destroy: true,
                processing: true,
                serverSide: false,
                ajax: "/purchase_order/table/show/" + status,
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox'
                    },
                    {
                        data: 'cust',
                        name: 'cust'
                    },
                    {
                        data: 'no_po',
                        name: 'no_po'
                    },
                    {
                        data: 'tgl_po',
                        name: 'tgl_po'
                    },
                    {
                        data: 'jenis_po',
                        name: 'jenis_po'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi'
                    },
                ]
            });
        }

        $('#filter_dd').on('click', "#jenis_po", function(e) {
            e.preventDefault();
            var status = "";

            if ($(this).hasClass('semua')) {
                status = "semua";
            } else if ($(this).hasClass('po_online')) {
                status = "online";

            } else if ($(this).hasClass('po_offline')) {
                status = "offline";
            }

            tableview(status);
            gridview(status);
        });

        function gridview(status) {
            $('.gridview').html("");
            $.ajax({
                url: "/purchase_order/grid/show/" + status,
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    var datas = "";
                    $.each(data, function(key, value) {
                        var ket = "";
                        if (value.keterangan != null) {
                            ket = String(value.keterangan).substring(0, 50);
                        } else if (value.keterangan == null) {
                            ket = "<i>Tidak Tersedia</i>";
                        }

                        datas += '<div class="card">' +
                            '<img class="card-img-top" src="https://picsum.photos/300/300.jpg" alt="Card image cap">' +
                            '<div class="card-body">' +
                            '<h5 class="card-title">' + value.no_po + '</h5>' +
                            '<p class="card-text text-muted">';
                        if (value.customer != undefined) {
                            datas += '<small class="light-green-text">Online</small>';
                        } else if (value.distributor != undefined) {
                            datas += '<small class="purple-text">Offline</small>';
                        }
                        datas += ' - <small>' + value.tgl_po + '</small></p>' +
                            '<p class="card-text"><small>' +
                            ket +
                            '</small></p>' +
                            '</div>' +
                            '<div class="card-footer">' +
                            '<a href="#" class="card-link"><i class="fas fa-pencil-alt" ></i></a>' +
                            '<a href="#" class="card-link"><i class="fas fa-trash"></i></a>' +
                            '</div>' +
                            '</div>';
                    });
                    $('.gridview').append(datas);
                },
            })
        }

        $('#tablebtn').on('click', function() {
            $('.tabledisp').removeAttr('hidden');
            $('.griddisp').attr('hidden', true);
            $('#tablebtn').addClass('active');
            $('#gridbtn').removeClass('active');
        });

        $('#gridbtn').on('click', function() {
            $('.tabledisp').attr('hidden', true);
            $('.griddisp').removeAttr('hidden');
            $('#tablebtn').removeClass('active');
            $('#gridbtn').addClass('active');
        });
    });
</script>
@stop