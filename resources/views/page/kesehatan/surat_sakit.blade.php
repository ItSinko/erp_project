<!DOCTYPE html>

<head>
  <title>
    Surat Sakit - {{$karyawan_sakit->karyawan->nama}}
  </title>
</head>

<body>
  <div class="card">
    <div class="card-body">
      <img src="assets/image/logo/surat_sakit.png" height="120">
      <table id="tabel" class="table table-hover styled-table table-striped" border="0" style="table-layout: fixed; width: 100%; border-collapse: collapse; ">
        <thead style="text-align: center;">
          <tr>
            <th colspan="3">
              <u>SURAT KETERANGAN ISTIRAHAT</u><br>Nomor:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/{{$carbon->format('m')}}/ KESKER-SINKO/ {{$carbon->year}}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align: center;" colspan="3">
              Yang bertanda tangan di bawah ini, dokter pelayanan kesehatan kerja menerangkan Bahwa :
            </td>
          </tr>
          <tr>
            <td style="text-align: right; width:20%">
              Nama
            </td>
            <td style="width:1%;text-align: right; ">:</td>
            <td style="text-align: left;">
              &nbsp;&nbsp;&nbsp;{{$karyawan_sakit->karyawan->nama}}
            </td>
          </tr>
          <tr>
            <td style="text-align: right; width:20%">
              Jenis Kelamin
            </td>
            <td style="width:1%;text-align: right; ">:</td>
            <td style="text-align: left;">
              &nbsp;&nbsp;
              @if($karyawan_sakit->karyawan->kelamin != 'L')
              Perempuan
              @else
              Laki laki
              @endif
            </td>
          </tr>
          <tr>
            <td style="text-align: right; width:20%">
              Umur
            </td>
            <td style="width:1%;text-align: right; ">:</td>
            <td style="text-align: left;">
              &nbsp;&nbsp;&nbsp;{{$umur}} Tahun
            </td>
          </tr>
          <tr>
            <td style="text-align: right; width:20%">
              Alamat
            </td>
            <td style="width:1%;text-align: right; ">:</td>
            <td style="text-align: left;">
              &nbsp;&nbsp;&nbsp;-
            </td>
          </tr>
          <tr>
            <td colspan="3" style="text-align: center;">
              <br>
              Bahwa yang bersangkutan benar – benar berobat pada pelayanan kesehatan. Terhitung tanggal :
              s/d . Demikian surat ini di berikan untuk dapat di pergunakan mestinya.
            </td>
          </tr>
          <tr>
            <td colspan="2" style="text-align: center;">
            </td>
            <td style="text-align:right"><br>Dokter yang memeriksa<br><br><br>dr.Didik Agung Wibowo., M.KKK<br>SKP :5/70/AS.02.02/VI/2021</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>