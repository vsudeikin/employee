@extends('layouts.index')

@section('index')

<div class="container">

    <ul class="ul-treefree ul-dropfree">
        <li>Product manager
            <ul class="ul-drop">
                <li>Project manager
                    <ul class="ul-drop">
                        <li>Team lead
                            <ul class="ul-drop">
                                <li>Disigner</li>
                                <li>Frontend developer</li>
                                <li>Backend developer</li>
                            </ul>        
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
     </ul>

 </div>

@endsection