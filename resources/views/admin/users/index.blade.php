@extends('adminlte::page')

@section('title', 'Admin users')

@section('content_header')
    <h1>Gestion des utilisateurs</h1>
@stop

@section('content')
    <div class="container">
        <div class="text-right">
        <a name="" id="" class="btn btn-success mb-4" href="{{route('users.create')}}" role="button">Ajouter un utilisateur</a>
        </div>
    </div>
    <table class="table table-striped table-dark">
        <thead>
            <tr class="">
                <th >#</th>
                <th >Nom</th>
                <th >Mail</th>
                <th >Rôle</th>
                <th >Nbr de posts</th>
                <th >Action</th>
            </tr>
        </thead>
        <tbody>
          
            @foreach($users as $user)
            <tr class="">
                {{-- <td >{{$posts ->perPage()*($posts->currentPage()-1)+$loop->iteration}}</td> --}}
                <td >{{$loop->iteration}}</td>
                <td >{{$user->name}}</td>
                <td >{{$user->email}}</td>
                <td >{{$user->role->slug}}</td>
                <td >{{count($user->posts)}}</td>
                <td >
                    <a class="btn btn-light" href="{{route('users.show', ['user' => $user->id])}}" role="button">Voir</a>
                </td>
            </tr>
           
            @endforeach
        </tbody>
    </table>
    {{-- {{ $posts->links() }} --}}
@stop