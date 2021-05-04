<?php

namespace App\Http\Controllers\dc_controller;

use App\dc_model\Document;
use App\Produk;
use App\Http\Controllers\dc_controller\AppBaseController;
use Illuminate\Http\Request;

class DocumentController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $documents = Document::all();
        return view('page.document_control.documents.index', compact('documents'));
    }

    public function create()
    {
        $tags = $this->tagRepository->all();
        $customFields = $this->customFieldRepository->getForModel('documents');
        return view('page.document_control.documents.create', compact('tags', 'customFields'));
    }

    public function eng(){
        $data = Produk::select('nama')->get();
        return view('page.document_control.document_eng.index', compact('data'));
    }
}
