<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserLog;

class UserLogController extends Controller
{
    public function create($user_id, $aksi_id, $tabel_aksi, $aksi, $keterangan)
    {
        $c = UserLog::create([
            'user_id' => $user_id, 
            'aksi_id' => $aksi_id, 
            'tabel_aksi' => $tabel_aksi, 
            'aksi' => $aksi, 
            'keterangan' => $keterangan
        ]);
        return $c;
    }
}
