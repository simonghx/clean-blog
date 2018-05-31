@extends('adminlte::page')

@section('title', 'Post')

@section('content_header')
    <h1>Post unique</h1>
@stop

@section('content')
<a name="" id="" class="btn btn-primary mb-4" href="{{route('posts.index')}}" role="button">Retour</a>
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h1>{{$post->titre}}</h1>
            </div>
            <div class="box-body">
                <img src="{{Storage::disk('images')->url($post->image)}}" alt="">
                <p>{{Storage::disk('images')->size($post->image)}}</p>
                <hr>
                <p>{{$post->contenu}}</p>
            </div>
            <div class="box-footer">
                <h4>Auteur du post : {{$post->user->name}}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3>Actions</h3>
            </div>
            <div class="box-body">
                @can('update', $post)
                <a class="btn btn-warning text-white" href="{{route('posts.edit', ['post'=>$post->id])}}" role="button">@lang('general.edit')</a>
                @endcan
                <form class="d-inline" action="{{route('posts.destroy', ['post'=>$post->id])}}" method="post">
                @csrf
                @method('DELETE')
                     @can('delete', $post)
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                    @endcan
                </form>
                
            </div>
        </div>
    </div>
</div>
@stop