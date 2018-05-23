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
                <form action="{{route('posts.store')}}" method="post">
                @csrf
                  <div class="form-group">
                    <label for="">Titre</label>
                  <input type="text" name="titre" id="titre" class="form-control" placeholder="Le titre du post" value="">
                    <div class="form-group">
                      <label for="">Contenu du post</label>
                      <textarea class="form-control" name="contenu" id="contenu" rows="3"></textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-warning">Créer</button>
                </form>
            </div>
        </div>
    </div>

@stop