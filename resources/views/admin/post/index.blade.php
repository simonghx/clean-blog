@extends('adminlte::page')

@section('title', 'Admin post')

@section('content_header')
    <h1>Gestion des posts</h1>
@stop

@section('content')
    <div class="container">
        <div class="text-right">
            <a name="" id="" class="btn btn-success mb-4" href="{{route('posts.create')}}" role="button">Créer un post</a>
        </div>
    </div>
    <table class="table table-striped table-dark">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre post</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$post->titre}}</td>
                <td><a class="btn btn-light" href="{{route('posts.show', ['post'=>$post->id])}}" role="button">Voir</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@stop