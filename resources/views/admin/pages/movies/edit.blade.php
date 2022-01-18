@extends('admin.layouts.app')

@section('title', "Editar Filme  {$movie->name}")
    
@section('content')
    <h1>Editar Filme {{ $movie->name }}</h1>

    <form action="{{ route ('movies.update', $movie->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        
        @include('admin.pages.movies._partials.form')

    </form>
    
@endsection