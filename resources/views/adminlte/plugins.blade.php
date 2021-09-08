@foreach(config('adminlte.plugins') as $pluginName => $plugin)
@if($type == 'css' && !empty($plugin['css']))
@foreach($plugin['css'] as $file)
<link rel="stylesheet" href="{{ asset($file) }}">
@endforeach
@endif
@if($type == 'js' && !empty($plugin['js']))
@foreach($plugin['js'] as $file)
<script src="{{ asset($file) }}"></script>
@endforeach
@endif
@endforeach