@extends('layouts.app')


@section('title', 'Cube Details')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card mt-3 mx-auto">
                    <div class="card-header">{{ __('Detail over cube') }}{{$cube->name}}</div>
                    @if(session('message'))
                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card-body">
                        <img class="card-img-top w-25 mb-5" src="{{ Storage::url($cube->cube_image) }}"
                             alt="image for a cube">
                        <h5 class="card-title"><b>Name cube: </b>{{$cube->name}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            {{$cube->tag->name}}
                        </h6>
                        <h6 class="card-subtitle mb-2 text-muted">
                            Create by:
                            @if(!$cube->user_id)
                                Unknown user
                            @else
                                {{$cube->user->name}}
                            @endif
                        </h6>
                        <p class="card-text">Description: {{$cube->description}}</p>

                        @if(!Auth::check() || Auth::user()->id!==$cube->user_id)

                        @else
                            <a href='{{ route('cubes.edit', $cube->id)}}'
                               class="btn btn-success mr-10 mb-3">EDIT</a>
                            <a href='{{ route('cubes.editImage', $cube->id)}}' class="btn btn-primary mr-10 mb-3 ">EDIT
                                IMAGE</a>
                            <form action="{{ route('cubes.destroy', $cube->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger mx-auto">DELETE</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
