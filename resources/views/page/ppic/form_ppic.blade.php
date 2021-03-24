@extends('layouts.base')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Form Order</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header row">
                <div class="input-group col-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Search</label>
                    </div>
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="show">...</span>
                    </div>
                    <select class="custom-select" id="count">
                        <option selected>Choose...</option>
                        @foreach ($list as $li)
                        <option value="{{ $li->id }}">{{ $li->nama }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <label class="input-group-text">Quantity</label>
                    </div>
                    <input type="number" class="form-control" id="quantity">

                    <button class="btn btn-info" id="order">Order</button>
                </div>
            </div>
            <div class="card-body" id="order_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Pesanan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <button class="btn btn-primary" id="send">kirim</button>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#count").change(function() {
            var value = $("#count").val();
            if (value == "Choose...") $("#show").html("...");
            else {
                $.ajax({
                    url: "/count_bom",
                    data: {
                        value: value
                    },
                    success: function(result) {
                        $("#show").html(result);

                    },
                    error: function(xhr, status, error) {
                        alert("status: " + status + "\nerror: " + error);
                    }
                });
            }
        });

        $("#order").click(function() {
            var quantity = Number($("#quantity").val());
            var stock = Number($("#show").html());

            if (quantity <= 0 || quantity > stock) {
                bootbox.alert({
                    message: "input not valid",
                    centerVertical: true
                })
            } else {
                var name = $("#count").children("option:selected").html();

                var row =
                    "<tr>" +
                    "<td>" + name + "</td>" +
                    "<td>" + quantity + "</td>" +
                    "<td>" + "<button id='delete' class='btn btn-danger'>Delete</button>" + "</td>";

                $("table").append(row);
                $("#send").show();
            }
        });

        $(document).on("click", "#delete", function() {
            $(this).parents("tr").remove();
            $row = $("tbody tr").length;
            if ($row <= 0) $("#send").hide();
        });

        $("#send").click(function(){
            $.ajax({
                url: "test",
                success: function(){
                    alert('success');
                },
                error: function(){
                    alert('error');
                }
            })
        })

        $("#send").hide();
    });
</script>
@endpush