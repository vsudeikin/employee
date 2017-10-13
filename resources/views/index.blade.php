@extends('layouts.index')

@section('content')

<div class="container">
    <ul class="ul-treefree ul-dropfree">
        <li><strong>Director</strong></li>
        <li>{{ $list->first()->name }}
            <ul class="ul-drop">
                @each('list', $list, 'items')
            </ul>    
        </li>
    </ul>
</div>

@endsection