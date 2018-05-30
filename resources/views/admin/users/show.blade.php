@extends('adminlte::page')

@section('title', 'User')

@section('content_header')
    <h1>Utilisateur unique</h1>
@stop

@section('content')
<a name="" id="" class="btn btn-primary mb-4" href="{{route('users.index')}}" role="button">Retour</a>
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3>{{$user->name}}</h3>
            </div>
            <div class="box-body">
                <h4>{{$user->email}}</h4>
                
            </div>
            <div class="box-footer">
              <h4>{{$user->role->slug}}</h4>
            </div>
            
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3>Actions</h3>
            </div>
            <div class="box-body">
                
                <a class="btn btn-warning text-white" href="{{route('users.edit', ['user'=>$user->id])}}" role="button">@lang('general.edit')</a>
               
                <form class="d-inline" action="{{route('users.destroy', ['user'=>$user->id])}}" method="post">
                @csrf
                @method('DELETE')
                    
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                    
                </form>
                
            </div>
        </div>
    </div>
</div>
<div class="row">
  <div class="col-md-8">
    <div class="box">
      <div class="box-header">
        <h3>Posts de l'utilisateur:</h3>
      </div>
      <div class="box-body">
        @foreach($user->posts as $post)
        <h4>{{$post->titre}}</h4>
        <p>{{$post->contenu}}</p>
        <p><strong>{{$post->created_at}}</strong></p>
        <hr>
        @endforeach
      </div>
    </div>
  </div>
</div>
@stop