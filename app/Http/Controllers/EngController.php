<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Produk;
use App\DokumenEng;
use App\Ecommerces;
use DirectoryIterator;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

class EngController extends Controller
{
    public function fileupload(Request $request)
    {
        if ($request->hasFile('file')) {

            // Upload path
            $destinationPath = 'files/';

            // Get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            // Valid extensions
            $validextensions = array("jpeg", "jpg", "png", "pdf");

            // Check extension
            if (in_array(strtolower($extension), $validextensions)) {

                // Rename file 
                $fileName = $request->file('file')->getClientOriginalName() . time() . '.' . $extension;
                // Uploading file to given path
                $request->file('file')->move($destinationPath, $fileName);
            }
        }
    }

    public function upload_file(Request $request)
    {
        $file = $request->file('file');
        $file->move('/document//' . $request->produk . '/' . $request->doc, $file->getClientOriginalName());
        return $file;
    }

    public function test()
    {
        $data = Produk::select('nama')->get();
        $dokumen = DokumenEng::all();
        return view('page.engineering.index', ['data' => $data, 'dokumen' => $dokumen]);
    }

    public function show_list($produk = null, $document = null)
    {
        // $list = Storage::disk('document')->put('dokumen/test/test2.txt', 'content');
        $result = Storage::disk('document')->files('/' . $produk . '/' . $document);
        $data = new Collection;
        for ($i = 0; $i < count($result); $i++) {
            $data->push([
                'nama' => basename($result[$i]),
                'link' => asset($result[$i]),
            ]);
        }
        // $data = Ecommerces::all();
        return datatables::of($data)->addIndexColumn()->make(true);
        // return $result;
    }

    // function DC SPA
    public function index()
    {
        $document = [];
        return view('page.engineering.home', compact('documents', 'activities', 'tagCounts', 'documentCounts', 'filesCounts'));
    }
}
