<li @if(isset($item['id'])) id="{{ $item['id'] }}" @endif class="nav-item">

    <a class="nav-link {{ $item['class'] }} @if(isset($item['shift'])) {{ $item['shift'] }} @endif" href="{{ $item['href'] }}" @if(isset($item['target'])) target="{{ $item['target'] }}" @endif {!! $item['data-compiled'] ?? '' !!} @if(isset($item['form']) && $item['form']==true) onclick="event.preventDefault(); document.getElementById('logout-form').submit();" @endif>

        <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
            isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
        }}"></i>
        <p></p>
        <p>
            {{ $item['text'] }}
            @if(isset($item['label']))
            <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                {{ $item['label'] }}
            </span>
            @endif
        </p>

    </a>

    @if(isset($item['form']) && $item['form']==true)
    <form id="logout-form" action="{{ $item['href'] }}" method="POST" class="d-none">
        @csrf
    </form>
    @endif

</li>