

@if ($items->cid->count() > 0)
    @foreach ($items->cid as $items)
        @if ($loop->first)
          <li><strong>{{ $items->position['position'] }}</strong></li>
        @endif
        <li>
        <form action="{{route('edit.edit', $items->id)}}" method="GET"> 
          {{ csrf_field() }}
          <button type="submit" class="link">"{{ $items->name }}; from: {{$items->start_work}}"; {{ $items->salary }}$</button>
        </form>

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
