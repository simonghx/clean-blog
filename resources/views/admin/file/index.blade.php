@extends('adminlte::page')

@section('title', 'Admin files')

@section('content_header')
    <h1>Gestion des fichiers</h1>
@stop

@section('content')
    <div class="box">
      <div class="box-header">
        <h3>Importer un fichier</h3>
      </div>
      <div class="box-body">
        <form action="">
          <div class="form-group">
            <label for=""></label>
            <input type="file" class="form-control-file" name="" id="" placeholder="">
          </div>
        </form>
          <button type="submit" class="btn btn-success" href="{{route('files.store')}}" role="button">Importer</button>
      </div>
    </div>
    <table class="table table-striped table-dark">
        <thead>
            <tr class="row mx-1">
                <th class="col-md-2">#</th>
                <th class="col-md-4">Titre du fichier</th>
                <th class="col-md-4">Utilisateur</th>
                <th class="col-md-2">Action</th>
            </tr>
        </thead>
        <tbody>
          
            <tr class="row mx-1">
                <td class="col-md-2"></td>
                <td class="col-md-4"></td>
                <td class="col-md-4"></td>
                <td class="col-md-2">
                    
                    <a class="btn btn-light" href="" role="button">Voir</a>
                    
                </td>
            </tr>
           
          
        </tbody>
    </table>
   
@stop