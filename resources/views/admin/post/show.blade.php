@extends('adminlte::page')

@section('title', 'Post')

@section('content_header')
    <h1>Post unique</h1>
@stop

@section('content')
   <h1>{{$post->titre}}</h1>
   <p>{{$post->contenu}}</p>
@stop