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
                <form action="{{route('posts.update', ['post'=>$post->id])}}" method="post" enctype="multipart/form-data">
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
                    @if($post->image != null)
                        <div class="col-md-3">
                            <img class="img-fluid" src="{{Storage::disk('images')->url($post->image)}}" alt="">
                            <p>{{Storage::disk('images')->size($post->image)}}</p>
                            <hr>
                        </div>
                    @endif
                    <div class="custom-file"  data-bsfileupload>
                        <label class="custom-file-label" for="customFile">Uploader une autre image</label>
                        <input name="image" type="file" class="custom-file-input" id="customFile">
                    </div>
                </div>
                  </div>
                  <button type="submit" class="btn btn-warning">Enregistrer</button>
                  <a name="" id="" class="btn btn-danger" href="{{route('posts.show', ['post'=>$post->id])}}" role="button">Cancel</a>
                </form>
            </div>
        </div>
    </div>

@stop

@push('js')
<script src="{{asset('js/lib/bstrp-change-file-input-value.js')}}"></script>
@endpush