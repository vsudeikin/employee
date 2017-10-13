@extends('layouts.index')

@section('content')
<div class="row">
<div class="col" style="height: 100px"></div>    
</div>

<div class="row">
  <div class="col"></div>
  <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12" style="background-color: #f3f3f3">
    <div class="container">
        <form action="{{ route('edit.store') }} " method="post" enctype="multipart/form-data"> 

          <div class="form-group col">
            <label for="nameInput">Name:</label>
            <input type="text" name="name" class="form-control" value="{{$name or old('name') }} ">
            <input type="hidden" name="id" value="{{$id}}">
            @if ($errors->has('name'))
              <span class="help-block">
                {{ $errors->first('name') }}
              </span>
             @endif
          </div>

          <div class="container">
            <div class="row">

              <div class="form-group col">
                <label for="salary">Salary:</label>
                <input name="salary" id="salary" class="form-control" value="{{$salary or old('salary')}}">
                @if ($errors->has('salary'))
                  <span class="help-block">
                    {{ $errors->first('salary') }}
                  </span>
                @endif
              </div>  

              <div class="form-group col">
                <label for="boss">Boss: {{$bossName}}</label>
                <select class="custom-select form-control" id="boss" name="pid">
                @foreach ($bosses as $boss)
                  <option value="{{ $boss->id }}">{{ $boss->name }}</option>
                @endforeach
                </select>
                @if ($errors->has('pid'))
                  <span class="help-block">
                    {{ $errors->first('pid') }}
                  </span>
                @endif
              </div>

              <div class="form-group col">
                <label for="position">Position:</label>
                <input id="position" disabled="true" class="form-control" value="{{$position_id}}">
              </div>

              <div class="form-group col">
                <label for="work">Start work:</label>
                <input id="work" disabled="true" class="form-control" value="{{$work}}">
              </div>

            </div>    
          </div>

            @isset($img)
              <div class="form-group">
                <label for="imageOld">Image:</label>
                <img src="/img/{{$path}}/{{ $img or ''}}" alt="{{$name or ''}}" id="imageOld">
              </div> 
            
          
            <div class="form-group">
              <label for="imageS">New image:</label>
              <input type="file" id="imageS" name="img" class="filestyle" data-text="Выбрать" data-buttonBefore="true" accept="image/jpeg,image/png,image/gif,image/jpg" >
              @if ($errors->has('img'))
                <span class="help-block">
                  <strong>{{ $errors->first('img') }}</strong>
                </span>
              @endif
            </div> 
            @endisset 

            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$id or ''}}">
            <input type="hidden" name="img_old" value="{{$img or ''}}">
          
            <div class="form-group">  
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>

        </form>
        
        @if ($cid == 0)
        <form action="{{ route('edit.destroy', $id) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('DELETE') }}
          <button type="submit" class="btn btn-danger">Delete person</button>
        </form>
        @endif
    </div>
  </div>
  <div class="col"></div>
</div>

@endsection