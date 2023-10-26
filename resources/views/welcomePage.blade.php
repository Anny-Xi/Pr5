@extends('layouts.app')


@section('title', 'Home')

@section('content')

    <div class="card">
        @if(session('message'))
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card-body">
            <h1>Welkom bij Rubiks Cub pagina </h1>
            <h1>Vandaag is {{$todayDate}}</h1>
        </div>
    </div>
@endsection




