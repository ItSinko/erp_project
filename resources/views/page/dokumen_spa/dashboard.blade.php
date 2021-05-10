@extends('page.dokumen_spa.layout.app')

@section('content')
<!-- Admin Dashboard -->
<div class="container">
  <div class="row">
    <div class="col s12">
      <h3 class="flow-text"><i class="material-icons">settings</i> Dashboard</h3>
      <div class="divider"></div>
    </div>
    <div class="section">
      <a href="/dc/dep_doc">
        <div class="col m8 s6">
          <div class="card hoverable indigo lighten-1 white-text">
            <div class="card-content">
              <p class="center"><i class="large material-icons">folder</i></p>
              <h4 class="center-align flow-text">Documents</h4>
            </div>
          </div>
        </div>
      </a>
      <a href="/users">
        <div class="col m4 s6">
          <div class="card hoverable indigo lighten-1 white-text">
            <div class="card-content">
              <p class="center"><i class="large material-icons">person</i></p>
              <h4 class="center-align flow-text">Users</h4>
            </div>
          </div>
        </div>
      </a>
      <a href="/departments">
        <div class="col m4 s6">
          <div class="card hoverable indigo lighten-1 white-text">
            <div class="card-content">
              <p class="center"><i class="large material-icons">group</i></p>
              <h4 class="center-align flow-text">Departments</h4>
            </div>
          </div>
        </div>
      </a>
      <a href="/roles">
        <div class="col m4 s6">
          <div class="card hoverable indigo lighten-1 white-text">
            <div class="card-content">
              <p class="center"><i class="large material-icons">assignment_ind</i></p>
              <h4 class="center-align flow-text">Roles &amp; Permissions</h4>
            </div>
          </div>
        </div>
      </a>
      <a href="/logs">
        <div class="col m4 s6">
          <div class="card hoverable indigo lighten-1 white-text">
            <div class="card-content">
              <p class="center"><i class="large material-icons">view_list</i></p>
              <h4 class="center-align flow-text">Logs</h4>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
</div>
@endsection