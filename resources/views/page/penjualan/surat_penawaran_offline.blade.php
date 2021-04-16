<div class="card">
  <div class="card-body">
    <table id="tabel" class="table table-hover styled-table table-striped" border="0" style="table-layout: fixed; width: 100%">
      <thead style="text-align: center;">
        <tr>
          <th style="width:9.3%">
            <img src="assets/image/logo/spa.png" alt="Girl in a jacket" width="60" height="60">
          </th>
          <th style="width: 80%">
            <h1>PT. SINKO PRIMA ALLOY</h1>
          </th>
          <th style="width: 50%">
            <h6>Jl. Tambak Osowilangon No 61<br>
              Pergudangan Osowilangon Permai<br>
              SURABAYA -NDONESIA<br>
              Telp : 62 - 31 - 7482816, 7492882<br>
              Fax : 62 - 31 - 7482865<br>
              Email : sinkoprima@gmail.com<br>
            </h6>
          </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="3">
            <hr style="border: 2px solid">
            <hr>
          </td>
        </tr>
    </table>

    <table id="tabel" class="table table-hover styled-table table-striped" border="0" style="table-layout: fixed; width: 100%">
      <thead style="text-align: left;">
        <tr>
          <td style="width:5%">No</td>
          <td style="width:30%">: 055/Penawaran/IX/SPA/2018</td>
          <td style="width:25%" rowspan="5">Kepada Yth. <br>{{$penawaran_offline->offline->distributor->nama}}<br>{{$penawaran_offline->offline->distributor->alamat}}</td>
        </tr>
        <tr>
          <td style="width:9.3%">Lampiran</td>
          <td style="width:9.3%">: 1 Lbr</td>

        </tr>
        <tr>
          <td style="width:9.3%">Perihal</td>
          <td style="width:9.3%">: Penawaran Harga</td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td></td>
        </tr>
      </thead>
    </table>
    <table id="tabel" class="table table-hover styled-table table-striped" border="0" style="table-layout: fixed; width: 100%">
      <thead style="text-align: left;">
        <tr>
          <td>Dengan Hormat,</td>
        </tr>
        <tr>
          <td>{{$penawaran_offline->deskripsi}}
          </td>
        </tr>
        <tr>
          <td style="height:3%"></td>
        </tr>
      </thead>
    </table>
    <table id="tabel" class="table table-hover styled-table table-striped" border="1" style="border-collapse: collapse; table-layout: fixed; width: 100%">
      <thead style="text-align: center;">

        <tr>
          <td style="width:5%"><b>No</b></td>
          <td><b>Nama Barang</b></td>
          <td><b>Harga/unit</b></td>
          <td style="width:13%"><b>Quantity</b></td>
          <td><b>Jumlah</b></td>
        </tr>
        @foreach ($detail_offline as $do)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$do->produk->nama}}</td>
          <td>Rp. {{number_format($do->harga)}}</td>
          <td>{{$do->jumlah}} unit</td>
          <td>Rp. {{number_format(($do->harga)*($do->jumlah))}}</td>
        </tr>
        @endforeach

      </thead>
    </table>
    <table id="tabel" class="table table-hover styled-table table-striped" border="0" style="table-layout: fixed; width: 100%">
      <thead style="text-align: left;">
        <tr>
          <td colspan="2"><u>Keterangan :</u></td>
        </tr>
        <tr>
          <td>1.</td>
          <td style="width:95%">Barang Ready Stock.</td>
        </tr>
        <tr>
          <td>2.</td>
          <td style="width:95%">Penawaran harga ini berlaku selama 1 Minggu (terhitung : {{$penawaran_offline->tgl_surat}})</td>
        </tr>
        <tr>
          <td>3.</td>
          <td style="width:95%">Harga belum termasuk PPN 10 %</td>
        </tr>
        <tr>
          <td>4.</td>
          <td style="width:95%">Ongkos kirim ditanggung pembeli jika pengiriman ke luar kota</td>
        </tr>
        <tr>
          <td style="height:1%"></td>
        </tr>
        <tr>
          <td style="width:95%" colspan="2">Demikian surat penawaran kami, semoga kerjasamanya yang baik tetap terjalin, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</td>
        </tr>
      </thead>
    </table>
    <table id="tabel" class="table table-hover styled-table table-striped" border="0" style="table-layout: fixed; width: 100%">
      <thead style="text-align: left;">
        <tr>
          <td style="height:3%"></td>
        </tr>
        <tr>
          <td>Surabaya, {{ date('d-M-Y', strtotime($penawaran_offline->tgl_surat))}}</td>
        </tr>
        <tr>
          <td>Hormat Kami,</td>
        </tr>
        <tr>
          <td style="height:3%"></td>
        </tr>
        <tr>
          <td><u>({{$penawaran_offline->karyawan->nama}})</u></td>
        </tr>
        <tr>
          <td>Direktur</td>
        </tr>
      </thead>
    </table>
  </div>
</div>
</div>
</div>