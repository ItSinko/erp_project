<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifikasi;
use Carbon\Carbon;

class NotifikasiController extends Controller
{
    public function show_all($id)
    {
        $s = Notifikasi::where('notifikasis.penerima_id', $id)
        ->orWhere('notifikasis.pengirim_id', $id)
        ->leftJoin('users as u1', 'notifikasis.penerima_id', '=', 'u1.id')
        ->leftJoin('users as u2', 'notifikasis.pengirim_id', '=', 'u2.id')
        ->get();

        return $s;
    }

    public function show_all_not_read($id)
    {
        $s = Notifikasi::where([
                ['penerima_id', '=', $id],
                ['read_at', '=', NULL]
            ])
            ->leftJoin('users as u1', 'notifikasis.penerima_id', '=', 'u1.id')
            ->leftJoin('users as u2', 'notifikasis.pengirim_id', '=', 'u2.id')
            ->select('notifikasis.id as id', 
                     'notifikasis.judul as judul', 
                     'notifikasis.pesan as pesan', 
                     'u2.nama as nama_pengirim', 
                     'notifikasis.halaman_url as halaman_url')
            ->orderBy('notifikasis.id', 'desc')
            ->limit(10)
            ->get();

        return $s;
    }

    public function create($judul, $pesan, $pengirim_id, $penerima_id, $halaman_url)
    {
        $c = Notifikasi::create([
                'judul' => $judul,
                'pesan' => $pesan,
                'pengirim_id' => $pengirim_id,
                'penerima_id' => $penerima_id,
                'halaman_url' => $halaman_url,
                'read_at' => NULL
             ]);
        
        return $c;
    }

    public function update($id)
    {
        $u = Notifikasi::where('id', 1)
            ->update(['read_at' => Carbon::now()->toDateTimeString()]);
        return $u;
    }
}
