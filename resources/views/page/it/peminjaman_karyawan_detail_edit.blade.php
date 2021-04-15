<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-12">
                <form id="create-inventory" method="POST" action="{{route('peminjaman.karyawan.detail.update', ['id' => $id, 'karyawan_id' => $karyawan_id])}}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    @if(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-check"></i></strong> {{session()->get('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @elseif(session()->has('error') || count($errors))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-times"></i></strong> Gagal menambahkan data
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif


                    <div class="card">
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-horizontal">
                                            <div class="form-group row">
                                                <label for="nama_user" class="col-sm-4 col-form-label" style="text-align:right;">Nama Karyawan</label>
                                                <div class="col-sm-8">
                                                    <label class="col-form-label">{{$s->nama}}</label>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="keterangan" class="col-sm-4 col-form-label" style="text-align:right;">Keterangan</label>
                                                <div class="col-sm-8">
                                                    <textarea class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="keterangan">{{old('keterangan', $s->pivot->keterangan)}}</textarea>
                                                    <span id="keterangan-message" role="alert"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <span class="float-left"><button class="btn btn-danger rounded-pill" id=""><i class="fas fa-times"></i>&nbsp;Batal</button></span>
                            <span class="float-right"><button type="submit" class="btn btn-warning rounded-pill" id="button_ubah"><i class="fas fa-edit"></i>&nbsp;Simpan Perubahan</button></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>