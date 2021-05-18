@extends('page.dokumen_spa.layout.app')

@section('content')
<style>
  .card-content2 {
    padding: 10px 7px;
  }

  /* --- for right click menu --- */
  *,
  *::before,
  *::after {
    box-sizing: border-box;
  }

  .task i {
    color: orange;
    font-size: 35px;
  }

  /* context-menu */
  .context-menu {
    padding: 0 5px;
    margin: 0;
    background: #f7f7f7;
    font-size: 15px;
    display: none;
    position: absolute;
    z-index: 10;
    box-shadow: 0 4px 5px 0 rgba(0, 0, 0, 0.14), 0 1px 10px 0 rgba(0, 0, 0, 0.12), 0 2px 4px -1px rgba(0, 0, 0, 0.3);
  }

  .context-menu--active {
    display: block;
  }

  .context-menu_items {
    margin: 0;
  }

  .context-menu_item {
    border-bottom: 1px solid #ddd;
    padding: 12px 30px;
  }

  .context-menu_item:last-child {
    border-bottom: none;
  }

  .context-menu_item:hover {
    background: #fff;
  }

  .context-menu_item i {
    margin: 0;
    padding: 0;
  }

  .context-menu_item p {
    display: inline;
    margin-left: 10px;
  }

  .unshow {
    display: none;
  }

  form {
    display: inline;
  }
</style>
<div class="row">
  <div class="section">
    <div class="col m1 hide-on-med-and-down">
      @include('page.dokumen_spa.layout.sidebar')
    </div>
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">folder</i>
          @if (isset($title))
          {{ $title }}
          @else
          Dokumen
          @endif
          <button class="btn red waves-effect waves-light right tooltipped delete_all" data-url="{{ url('documentsDeleteMulti') }}" data-position="left" data-delay="50" data-tooltip="Delete Selected Documents"><i class="material-icons">delete</i></button>
          <a href="/dc/documents/create" class="btn waves-effect waves-light right tooltipped" data-position="left" data-delay="50" data-tooltip="Upload New Document"><i class="material-icons">file_upload</i></a>
          <a href="#modal-add">
            <button class="btn green waves-effect waves-light right tooltipped" data-position="left" data-delay="50" data-tooltip="Tambah folder">
              <i class="material-icons">add</i>
            </button>
          </a>
          <div id="modal-add" class="modal modal-fixed-footer">
            <div class="modal-content">
              <h4>Tambah Folder</h4>
              <p>
                Fitur tambah folder
              </p>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">OK</a>
            </div>
          </div>
        </h3>
        <div class="divider"></div>
      </div>
      <div class="card z-depth-2">
        <div class="card-content">
          <div class="row">
            @foreach($folder as $d)
            <div class="col m2 s6">
              <div class="card hoverable indigo lighten-5 task">
                @php
                $pos = strrpos($d, '/');
                $name = substr($d, $pos);

                $arr_query = preg_split('#/#', $d);
                $query = http_build_query($arr_query);
                @endphp
                <a href="/dc/documents?{{ $query }}">
                  <div class="card-content2 center">
                    <i class="material-icons">folder_open</i>
                    <h6>{{ $name }}</h6>
                  </div>
                </a>
              </div>
            </div>
            @endforeach
            @foreach($docs as $doc)
            <div class="col m2 s6" id="tr_{{$doc->id}}">
              <div class="card hoverable indigo lighten-5 task" data-id="{{ $doc->id }}">
                <input type="checkbox" class="filled-in sub_chk" id="chk_{{$doc->id}}" data-id="{{$doc->id}}">
                <label for="chk_{{$doc->id}}"></label>
                <a href="/dc/documents/{{ $doc->id }}">
                  <div class="card-content2 center">
                    @if(strpos($doc->mimetype, "image") !== false)
                    <i class="material-icons">image</i>
                    @elseif(strpos($doc->mimetype, "video") !== false)
                    <i class="material-icons">ondemand_video</i>
                    @elseif(strpos($doc->mimetype, "audio") !== false)
                    <i class="material-icons">music_video</i>
                    @elseif(strpos($doc->mimetype,"text") !== false)
                    <i class="material-icons">description</i>
                    @elseif(strpos($doc->mimetype,"application/pdf") !== false)
                    <i class="material-icons">picture_as_pdf</i>
                    @elseif(strpos($doc->mimetype, "application/vnd.openxmlformats-officedocument") !== false)
                    <i class="material-icons">library_books</i>
                    @else
                    <i class="material-icons">folder_open</i>
                    @endif
                    <h6>{{ $doc->name }}</h6>
                    <p>{{ $doc->filesize }}</p>
                  </div>
                </a>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- right click menu -->
<div id="context-menu" class="context-menu">
  <ul class="context-menu_items">
    <li class="context-menu_item">
      <a href="documents/open/15" class="context-menu_link" data-action="Open">
        <i class="material-icons">open_with</i>
        <p>Open</p>
      </a>
    </li>
    <li class="context-menu_item">
      <a href="#" class="context-menu_link" data-action="Share">
        <i class="material-icons">share</i>
        <p>Share</p>
      </a>
    </li>
    <li class="context-menu_item">
      <a href="dc/documents/15/edit" class="context-menu_link" data-action="Edit">
        <i class="material-icons">edit</i>
        <p>Edit</p>
      </a>
    </li>
    <li class="context-menu_item">
      <a href="/dc/documents/" class="context-menu_link" data-action="Delete" id="right-delete">
        <i class="material-icons">delete</i>
        <p>Delete</p>
      </a>
    </li>
  </ul>
</div>
@endsection