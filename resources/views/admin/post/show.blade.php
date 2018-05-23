@extends('adminlte::page')

@section('title', 'Post')

@section('content_header')
    <h1>Post unique</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h1>{{$post->titre}}</h1>
            </div>
            <div class="box-body">
                <p>{{$post->contenu}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3>Action</h3>
            </div>
            <div class="box-body">
                <a class="btn btn-warning text-white" href="{{route('posts.edit', ['post'=>$post->id])}}" role="button">Editer</a>
                <form class="d-inline" action="{{route('posts.destroy', ['post'=>$post->id])}}" method="post">
                @csrf
                @method('DELETE')
                    <button class="btn btn-danger" href="#" type="submit">Supprimer</button>
                </form>
                
            </div>
        </div>
    </div>
</div>
@stop