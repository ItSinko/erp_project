@extends('layouts.base')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Bill of Material</h1>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="input-group col-6">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="input">Search</label>
                    </div>
                    <select class="custom-select" id="input">
                        <option selected>Choose...</option>
                        @foreach ($list as $li)
                        <option value="{{ $li->id }}">{{ $li->nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body">
                <span id="card">Nothing</span>
            </div>
        </div>
    </section>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#input").change(function() {
            var value = $("#input").val();
            // alert(value);
            if (value == "Choose...") $("#card").html("");
            else {
                $.ajax({
                    url: "/get_bom",
                    data: {
                        value: value
                    },
                    success: function(result) {
                        $("#card").html(result);
                        $("#bom_table").DataTable({
                            lengthMenu: [
                                [-1, 10, 50],
                                ['all', 10, 50]
                            ]
                        });
                    },
                    error: function(xhr, status, error) {
                        alert("status: " + status + "\nerror: " + error);
                    }
                });
            }
        });
    })
</script>
@endpush