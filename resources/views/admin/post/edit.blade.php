@extends('adminlte::page')

@section('title', 'Edit Post')

@section('content_header')
    <h1>Edit du Post</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box">
            
            <div class="box-body">
                <form action="{{route('posts.update', ['post'=>$post->id])}}" method="post">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show my-3">
                     
                      @foreach ($errors->all() as $error)
                      <strong>{{ $error }}</strong>
                      @endforeach
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    
                  </div>
                @endif
                  <div class="form-group">
                    <label for="">Titre</label>
                  <input type="text" name="titre" id="titre" class="form-control" placeholder="Le titre du post" value="{{$post->titre}}">
                    <div class="form-group">
                      <label for="">Contenu du post</label>
                      <textarea class="form-control" name="contenu" id="contenu" rows="3">{{$post->contenu}}</textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-warning">Enregistrer</button>
                </form>
            </div>
        </div>
    </div>

@stop