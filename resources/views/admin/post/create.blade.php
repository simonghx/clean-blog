@extends('adminlte::page')

@section('title', 'Create Post')

@section('content_header')
    <h1>Création d'un Post</h1>
@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="box">
            
            <div class="box-body">
                <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}"> 
                  <div class="form-group">
                    <label for="titre">Titre</label>
                    @if($errors->has('titre'))
                    <div class="text-danger">{{$errors->first('titre')}}</div>
                    @endif
                  <input type="text" name="titre" id="titre" class="form-control {{$errors->has('titre')?'border-danger':''}}" placeholder="Le titre du post" value="{{old('titre')}}">
                </div>
                <div class="form-group">
                    <label for="">Contenu du post</label>
                    @if($errors->has('contenu'))
                    {{-- @foreach($errors->get('contenu') as $error) --}}
                <div class="text-danger">{{$errors->first('contenu')}}</div>
                {{-- @endforeach --}}
                @endif
                <textarea class="form-control {{$errors->has('contenu')?'border-danger':''}}" name="contenu" id="contenu" rows="3">{{old('contenu')}}</textarea>
                </div>
                
                <div class="form-group">
                    <img src="" alt="">
                    @if($errors->has('image'))
                        @foreach($errors->get('image') as $error)
                        <div class="text-danger">{{$error}}</div>
                        @endforeach
                    @endif
                    <div class="custom-file"  data-bsfileupload>
                        <label class="custom-file-label" for="customFile">Uploader une image</label>
                        <input name="image" type="file" class="custom-file-input" id="customFile">
                    </div>
                    
                </div>
                  <button type="submit" class="btn btn-warning">Créer</button>
                    <a name="" id="" class="btn btn-danger" href="{{route('posts.index')}}" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
<script src="{{asset('js/lib/bstrp-change-file-input-value.js')}}"></script>
@endpush