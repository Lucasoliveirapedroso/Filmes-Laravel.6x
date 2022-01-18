@extends('admin.layouts.app')

@section('title', 'Cadastrar novo filme')

@section('content')

    <h1>Cadastrar novo filme</h1>

    <form action="{{ route ('movies.store') }}" method="post" enctype="multipart/form-data">

        @include('admin.pages.movies._partials.form')

    </form>
    
@endsection