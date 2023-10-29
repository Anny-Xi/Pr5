@extends('layouts.app')

@section('title', 'Cubes')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-20">

                <div class="card">

                    <h2 class="card-header">Cubes</h2>

                    @if(session('message'))
                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <form action="{{ route('cubes.index') }}" method="GET" role="search">
                            <b>Search for cube by name or description</b>
                            {{ csrf_field() }}
                            <div class="input-group">
                                <input type="text" class="form-control" name="search"
                                       placeholder="Type in the name">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-default">
                                        <span class="glyphicon glyphicon-search">
                                        </span>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <a href='{{ route('cubes.create') }}' class="btn btn-success text-uppercase mt-3">Add cube</a>


                        <div class="row">
                            @foreach ($cubes as $cube)
                                <div class="card mt-3 mx-auto w-25">
                                    <img class="card-img-top w-100" src="{{ Storage::url($cube->cube_image) }}"
                                         alt="image for a cube">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$cube->name}}</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">@foreach($tags as $tag)
                                                @if($tag->id==$cube->tag_id)
                                                    {{$tag->name}}
                                                @endif
                                            @endforeach</h6>
                                        <p class="card-text">{{$cube->description}}</p>
                                        <a href='{{ route('cubes.showDetails', $cube->id)}}'
                                           class="btn btn-primary">VIEW DETAILS</a>
                                    </div>
                                </div>

                            @endforeach
                        </div>


                        <td>
                        </td>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

