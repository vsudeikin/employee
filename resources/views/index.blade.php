@extends('layouts.index')

@section('content')

<div class="container">
    <ul class="ul-treefree ul-dropfree">
        @each('list', $list, 'items')
    </ul>
</div>

@endsection