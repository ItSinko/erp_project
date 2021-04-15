<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" style="text-align:center;">
                    <h6>Mengapa anda ingin menghapus data ini?</h6>
                </div>
                <form id="deleteform" action="" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <div class="col-sm-3">
                            <div class="icheck-danger d-inline">
                                <input type="radio" id="revisi" name="keterangan_log" value="revisi" checked>
                                <label for="revisi">
                                    Revisi
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="icheck-danger d-inline">
                                <input type="radio" id="salah_input" name="keterangan_log" value="salah_input">
                                <label for="salah_input">
                                    Salah Input
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="icheck-danger d-inline">
                                <input type="radio" id="pembatalan" name="keterangan_log" value="pembatalan">
                                <label for="pembatalan">
                                    Pembatalan
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer col-12" style="margin-bottom: 2%;">
                        <span>
                            <button type="button" class="btn btn-block btn-info batalsk" data-dismiss="modal" id="batalhapussk" style="width:30%;float:left;">Batal</button>
                        </span>
                        <span>
                            <button type="submit" class="btn btn-block btn-danger" id="hapussk" style="width:30%;float:right;">Hapus</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>