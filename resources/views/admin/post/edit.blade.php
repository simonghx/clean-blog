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
                
                  <div class="form-group">
                  <label for="">Titre</label>
                  @if($errors->has('titre'))
                  <div class="text-danger">{{$errors->first('titre')}}</div>
                  @endif
                  <input type="text" name="titre" id="titre" class="form-control {{$errors->has('titre') ? 'border-danger':''}}" placeholder="Le titre du post" value="{{old('titre', $post->titre)}}">
                    <div class="form-group">
                      <label for="">Contenu du post</label>
                      @if($errors->has('contenu'))
                      <div class="text-danger">{{$errors->first('contenu')}}</div>
                      @endif
                      <textarea class="form-control {{$errors->has('contenu') ? 'border-danger':''}}" name="contenu" id="contenu" rows="10">{{ old('contenu',$post->contenu)}}</textarea>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-warning">Enregistrer</button>
                  <a name="" id="" class="btn btn-danger" href="{{route('posts.show', ['post'=>$post->id])}}" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@stop