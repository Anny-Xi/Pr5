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

            @foreach($tags as $tag)
                <a href='{{ route('home', $tag->id)}}' class="btn btn-primary mr-5">View cube on {{$tag->name}}</a>
            @endforeach

            @guest
                @if(!$cubes)
                @endif
            @else
                <div class="d-flex flex-row">
                    @foreach ($cubes as $cube)
                        <div class="card mt-5 mr-20" style="width: 18rem;">
                            <img class="card-img-top" src="{{ Storage::url($cube->cube_image) }}"
                                 alt="image for a cube">
                            <div class="card-body">
                                <h5 class="card-title">{{$cube->name}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">@foreach($tags as $tag)
                                        @if($tag->id==$cube->tag_id)
                                            {{$tag->name}}
                                        @endif
                                    @endforeach</h6>
                                <p class="card-text">{{$cube->description}}</p>
                            </div>
                        </div>

                    @endforeach
                </div>
            @endguest


        </div>

    </div>
@endsection




