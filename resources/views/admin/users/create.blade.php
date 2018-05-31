@extends('adminlte::page')

@section('title', 'Create User')

@section('content_header')
    <h1>Ajout d'un utilisateur</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box">
            
            <div class="box-body">
                <form action="{{route('users.store')}}" method="post">
                @csrf

                  <div class="form-group">
                    <label for="">Nom</label>
                    @if($errors->has('name'))
                    <div class="text-danger">{{$errors->first('name')}}</div>
                    @endif
                  <input type="text" name="name" id="" class="form-control {{$errors->has('name')?'border-danger':''}}" placeholder="Le nom de l'utilisateur" value="{{old('name')}}">
                    <div class="form-group">
                      <label for="">Email de l'utilisateur</label>
                      @if($errors->has('email'))
                      {{-- @foreach($errors->get('email') as $error) --}}
                    <div class="text-danger">{{$errors->first('email')}}</div>
                    {{-- @endforeach --}}
                    @endif
                    <input class="form-control {{$errors->has('email')?'border-danger':''}}" type="text" name="email" id="" placeholder="L'email de l'utilisateur" value="{{old('email')}}">
                    </div>
                    @foreach($roles as $role)
                    <div class="form-check">
                      
                      <label class="form-check-label">
                      <input type="radio" class="form-check-input" name="role_id" id="" value="{{$role->id}}">
                        {{$role->name}}
                      </label>
                      
                    </div>
                    @endforeach
                    
                  </div>
                  <button type="submit" class="btn btn-warning">Ajouter</button>
                    <a name="" id="" class="btn btn-danger" href="{{route('users.index')}}" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@stop