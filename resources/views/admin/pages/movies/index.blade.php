@extends('admin.layouts.app')

@section('title', 'Filmes ') 

    
@section('content')

    <h1>Exibindo Filmes</h1>

    <a href="{{ route ('movies.create') }}" class="btn btn-outline-primary"> Cadastrar</a>

    <form action="{{ route ('movies.search') }}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Pesquisar" class="form-control" value="{{ $filters['filter'] ?? ''}}">
        <button input="submit" class="btn btn-info">Pesquisar</button>
    </form>

    <hr>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th width='250'>Sinopse</th>
                <th width='150'>Ações</th>
                <th width='150'>Imagem</th>
            </tr>
        </thead>
        @foreach ($movies as $movie)
            <tr>
                <td>{{ $movie->name}}</td>
                <td>{{ $movie->sinopse}}</td>
                <td>
                    <a href="{{ route('movies.edit', $movie->id )}}">Editar</a>
                    <a href="{{ route('movies.show', $movie->id )}}">Deletar</a>                
                </td>
                <td>
                    @if ($movie->image)
                        <img src="{{ url("storage/{$movie->image}") }}" alt="{{$movie->image}}" style="max-width: 100px">
                    @endif
                </td>
            </tr>
        
        @endforeach
    </table>

    @if (isset($filters))
        {!! $movies->appends($filters)->links() !!}   
    @else
        {!! $movies->links() !!}        
    @endif
    

@endsection