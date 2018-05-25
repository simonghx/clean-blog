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
            <tr class="row mx-1">
                <th class="col-md-2">#</th>
                <th class="col-md-8">Titre post</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($posts as $post)
            <tr class="row mx-1">
                <td class="col-md-2">{{$posts ->perPage()*($posts->currentPage()-1)+$loop->iteration}}</td>
                <td class="col-md-8">{{$post->titre}}</td>
                <td class="col-md-2"><a class="btn btn-light" href="{{route('posts.show', ['post'=>$post->id])}}" role="button">Voir</a></td>
            </tr>
           
            @endforeach
        </tbody>
    </table>
    {{ $posts->links() }}
@stop