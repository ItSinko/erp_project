<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\BppbController;
use App\Bppb;
use App\DivisiInventory;
use App\HasilPerakitan;
use Carbon\Carbon;

class GetController extends Controller
{
    protected $KategoriProdukController;
    protected $ProdukController;
    protected $BppbController;
    protected $NotifikasiController;
    protected $HasilPerakitanController;

    public function __construct(
        KategoriProdukController $KategoriProdukController,
        ProdukController $ProdukController,
        BppbController $BppbController,
        NotifikasiController $NotifikasiController,
        HasilPerakitanController $HasilPerakitanController
    ) {
        $this->KategoriProdukController = $KategoriProdukController;
        $this->ProdukController = $ProdukController;
        $this->BppbController = $BppbController;
        $this->NotifikasiController = $NotifikasiController;
        $this->HasilPerakitanController = $HasilPerakitanController;
    }

    public function get_kategori_produk($kelompok_produk_id)
    {
        $s = $this->KategoriProdukController->show_by_kelompok($kelompok_produk_id);
        echo json_encode($s);
    }

    public function get_kategori_by_produk($produk_id)
    {
        $s = $this->KategoriProdukController->show_by_produk($produk_id);
        echo json_encode($s);
    }

    public function get_tipe_produk_exist($tipe)
    {
        $s = $this->ProdukController->show_tipe_exist($tipe);
        echo json_encode($s);
    }

    public function get_detail_produk_id($produk_id)
    {
        $s = $this->ProdukController->show($produk_id);
        echo json_encode($s);
    }

    public function get_produk_by_kelompok($kelompok_produk_id)
    {
        $s = $this->ProdukController->show_by_kelompok($kelompok_produk_id);
        echo json_encode($s);
    }

    public function get_produk_by_kategori($kategori_id)
    {
        $s = $this->ProdukController->show_by_kategori($kategori_id);
        echo json_encode($s);
    }

    public function get_bppb_produk_count_by_year($tahun, $produk_id)
    {

        $c = $this->BppbController->count_produk_by_year($produk_id, $tahun);
        echo json_encode($c);

        //echo json_encode($c);
    }

    public function get_all_unread_notification($user_id)
    {
        $s = $this->NotifikasiController->show_all_not_read($user_id);
        echo json_encode($s);
    }

    public function get_bppb($bppb_id)
    {
        $s = $this->BppbController->show($bppb_id);
        echo json_encode($s);
    }

    public function get_no_seri_exist($tipe)
    {
        $s = $this->HasilPerakitanController->show_no_seri_exist($tipe);
        echo json_encode($s);
    }

    public function get_kode_perakitan_exist_not_in_id($bppb, $id, $no_seri)
    {
        $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb) {
            $q->where('bppb_id', $bppb);
        })
            ->where('no_seri', $no_seri)
            ->whereNotIn('id', [$id])
            ->count();

        echo json_encode($s);
    }

    public function get_kode_perakitan_exist_not_in($bppb, $no_seri)
    {
        $s = HasilPerakitan::whereHas('Perakitan', function ($q) use ($bppb) {
            $q->where('bppb_id', $bppb);
        })
            ->where('no_seri', $no_seri)
            ->count();

        echo json_encode($s);
    }

    public function get_no_seri_perakitan_not_in($id, $no_seri)
    {
        $no_seri = HasilPerakitan::where('perakitan_id', '=', $id)
            ->whereNotIn('id', [$no_seri])
            ->select('id', 'no_seri')
            ->get();

        echo json_encode($no_seri);
    }

    public function form_template()
    {
        return view('it.template_form');
    }

    public function dashboard_template()
    {
        return view('it.template_dashboard');
    }

    public function table_template()
    {
        return view('it.template_table');
    }

    public function inventory_nilai_penyusutan($harga_perolehan, $jumlah, $masa_manfaat)
    {
        return (($harga_perolehan * $jumlah) / ($masa_manfaat * 12));
    }

    public function inventory_akum_nilai_penyusutan($harga_perolehan, $jumlah, $masa_manfaat, $tanggal_perolehan)
    {
        $date = Carbon::parse($tanggal_perolehan);
        $now = Carbon::now();
        $jumlah_bulan = $date->diffInDays($now);
        return (($harga_perolehan * $jumlah) / (($masa_manfaat * 12) * ($jumlah_bulan * 1)));
    }

    public function inventory_nilai_sisa_buku($harga_perolehan, $jumlah, $masa_manfaat, $tanggal_perolehan)
    {
        return ($harga_perolehan - ($this->inventory_akum_nilai_penyusutan($harga_perolehan, $jumlah, $masa_manfaat, $tanggal_perolehan)));
    }

    public function inventory_kode_exist($kode)
    {
        $s = DivisiInventory::where('kode', '=', $kode)->count();
        return $s;
    }
}
