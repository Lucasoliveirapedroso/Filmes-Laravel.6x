@extends('admin.layouts.app')

@section('title', 'Detalhes do Filmes')
    
@section('content')
    <h1>Filme {{$movie->name}}</h1>
    
    <ul>
        <li><Strong>Nome: </Strong>{{ $movie ->name }}</li>
        <li><Strong>Sinopse: </Strong>{{ $movie ->sinopse }}</li>
    </ul>
    <form action="{{route('movies.destroy', $movie->id)}}" method="post">
    
        @csrf
        @method('DELETE')

        <button type="submit" class="btn btn-danger">Deletar o filme: {{ $movie ->name }}</button>

    </form>

    <a href="{{ route ('movies.index') }}" class="btn btn-primary"> Voltar</a>

@endsection