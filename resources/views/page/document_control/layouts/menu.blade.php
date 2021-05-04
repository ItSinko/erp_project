<li class="{{ Request::is('admin/home*') ? 'active' : '' }}">
    <a href="{!! route('dc.dashboard') !!}"><i class="fa fa-home"></i><span>Home</span></a>
</li>
<li class="{{ Request::is('dc/documents*') ? 'active' : '' }}">
    <a href="{!! route('documents.index') !!}"><i class="fa fa-file"></i><span>{{ucfirst(config('settings.document_label_plural'))}}</span></a>
</li>
@can('admin')
<li class="treeview {{ Request::is('admin/advanced*') ? 'active' : '' }}">
    <a href="#">
        <i class="fa fa-info-circle"></i>
        <span>Advanced Settings</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::is('admin/advanced/settings*') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-gear"></i><span>Settings</span></a>
        </li>
        <li class="{{ Request::is('admin/advanced/custom-fields*') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-file-text-o"></i><span>Custom Fields</span></a>
        </li>
        <li class="{{ Request::is('admin/advanced/file-types*') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-file-o"></i><span>{{ucfirst(config('settings.file_label_singular'))}} Types</span></a>
        </li>
    </ul>
</li>
@endif