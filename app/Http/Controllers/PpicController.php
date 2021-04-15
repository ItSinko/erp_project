<?php

namespace App\Http\Controllers;

use App\Event;
use App\Produk;
use Illuminate\Http\Request;

class PPICController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $date = Event::toBase()->get();
        $date = json_encode($date);
        return view('page.ppic.jadwal_produksi', ['date' => $date]);
    }

    public function ppic()
    {
        $list = Produk::toBase()->get();
        return view("ppic.form_ppic", compact('list'));
    }

    public function calendar_create(Request $request)
    {
        $data = [
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
        ];
        Event::create($data);
    }

    public function calendar_delete(Request $request)
    {
        Event::destroy($request->id);
    }

    public function test()
    {
        $list = Event::toBase()->get();
        return json_encode($list);
    }
}
