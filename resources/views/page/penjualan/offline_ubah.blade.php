@extends('adminlte.page')

@section('title', 'Beta Version')

@section('content_header')
<h1 class="m-0 text-dark">Dashboard</h1>
@stop
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-12">
      <form method="post" action="/penjualan_offline/aksi_ubah/{{$offline->id}}">
        {{ csrf_field() }}
        {{method_field('PUT')}}
        <div class="card">
          <div class="card-header bg-success">
            <div class="card-title"><i class="fas fa-plus-circle"></i>&nbsp;Ubah</div>
          </div>
          <div class="card-body">
            <div class="col-lg-12">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-horizontal">
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">ID Order</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control" name="order_id" value="{{$offline->order_id}}" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label" style="text-align:right;">Customer</label>
                      <div class="col-sm-4">
                        <select class="form-control select2 @error('customer_id') is-invalid @enderror" name="customer_id">
                          <option value="{{$offline->customer_id}}">{{$offline->distributor->nama}}</option>
                          @foreach ($distributor as $d)
                          <option value="{{$d->id}}">{{$d->nama}}</option>
                          @endforeach
                        </select>
                        @if($errors->has('customer_id'))
                        <div class="text-danger">
                          {{ $errors->first('customer_id')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Status</label>
                      <div class="col-sm-4">
                        <select class="form-control @error('status') is-invalid @enderror select2" name="status">
                          <option value="{{$offline->status}}">{{$offline->status}}</option>
                          <option value="Lunas">Lunas</option>
                          <option value="Proses">Proses</option>
                          <option value="Batal">Batal</option>
                        </select>
                        @if($errors->has('status'))
                        <div class="text-danger">
                          {{ $errors->first('status')}}
                        </div>
                        @endif
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Metode Pembayaran</label>
                      <div class="col-sm-4">
                        <select class="form-control @error('bayar') is-invalid @enderror select2" name="bayar">
                          <option value="{{$offline->bayar}}">{{$offline->bayar}}</option>
                          <option value="Transfer">Transfer</option>
                          <option value="Tunai">Tunai</option>
                        </select>
                        @if($errors->has('status'))
                        <div class="text-danger">
                          {{ $errors->first('status')}}
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <span class="float-left"><a class="btn btn-danger rounded-pill" href="/penjualan_offline/"><i class="fas fa-times"></i>&nbsp;Batal</a></span>
            <span class="float-right"><button class="btn btn-success rounded-pill" id="button_tambah"><i class="fas fa-plus"></i>&nbsp;Ubah Data</button></span>
          </div>
        </div>
    </div>
    </form>
  </div>
</div>
@stop