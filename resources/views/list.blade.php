

@if ($items->cid->count() > 0)
    @foreach ($items->cid as $items)
        <li>{{ $items->name}} {{ $items->position_id }}
          @if ($items->cid->count() > 0)
            <ul class="ul-drop">                   
            @include('list', $items)
            </li>
            </ul>
          @else  
            @include('list', $items)
            </li>
          @endif  
    @endforeach
@endif
