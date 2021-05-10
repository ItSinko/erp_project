@extends('page.dokumen_spa.layout.app')

@section('content')
<div class="row">
  <div class="section">
    <div class="col m1 hide-on-med-and-down">
      @include('page.dokumen_spa.layout.sidebar')
    </div>
    <div class="col m11 s12">
      <div class="row">
        <h3 class="flow-text"><i class="material-icons">folder</i> Upload Document
          <a href="/dc/documents/create" class="btn waves-effect waves-light right tooltipped" data-position="left" data-delay="50" data-tooltip="Upload New Document"><i class="material-icons">file_upload</i> New</a>
        </h3>
        <div class="divider"></div>
      </div>
      <div class="row">
        <div class="col m8 s12">
          {!! Form::open(['action' => 'digidocu\DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'class' => 'col s12']) !!}
          {{ csrf_field() }}
          <div class="card hoverable">
            <div class="card-content">
              <div class="input-field">
                <i class="material-icons prefix">folder</i>
                {{ Form::text('name','',['class' => 'validate', 'id' => 'name']) }}
                <label for="name">File Name</label>
                @if ($errors->has('name'))
                <span class="red-text"><strong>{{ $errors->first('name') }}</strong></span>
                @endif
              </div>
              <br>
              <div class="input-field">
                <i class="material-icons prefix">description</i>
                {{ Form::text('description','',['class' => 'validate', 'id' => 'description']) }}
                <label for="description">Description</label>
                @if ($errors->has('description'))
                <span class="red-text"><strong>{{ $errors->first('description') }}</strong></span>
                @endif
              </div>
              <br>
              <div class="input-field">
                <i class="material-icons prefix">class</i>
                {{ Form::select('folder',$data,null,['id' => 'folder', 'placeholder' => 'Pilih folder..']) }}

                <label for="category">Folder</label>
                @if ($errors->has('category'))
                <span class="red-text"><strong>{{ $errors->first('category') }}</strong></span>
                @endif
              </div>
              <br>
              <div class="file-field input-field">
                <div class="btn white">
                  <span class="black-text">Choose File (Max: 50MB)</span>
                  {{ Form::file('file') }}
                  @if ($errors->has('file'))
                  <span class="red-text"><strong>{{ $errors->first('file') }}</strong></span>
                  @endif
                </div>
                <div class="file-path-wrapper">
                  <input class="file-path validate" type="text">
                </div>
              </div>
              <br>
              <div class="input-field">
                <p class="center">
                  {{ Form::submit('Save',['class' => 'btn-large waves-effect waves-light']) }}
                </p>
              </div>
            </div>
          </div>
          {!! Form::close() !!}
        </div>
        <div class="col m4 hide-on-med-and-down">
          <div class="card-panel teal">
            <h4>Info</h4>
            <p>
            <ul>
              <li>Silahkan upload dokumen Anda dan isi form sesuai kebutuhan Anda.</li>
            </ul>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection