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

                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Cube name</th>
                                <th>Description</th>
                                <th>Level</th>
                                <th>Image</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($cubes as $cube)
                                <tr>
                                    <td>{{ $cube->name }}</td>
                                    <td>{{ $cube->description }}</td>
                                    <td>
                                        @foreach($tags as $tag)
                                            @if($tag->id==$cube->tag_id)
                                                {{$tag->name}}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td><img src="{{ Storage::url($cube->cube_image) }}" class="w-25"
                                             alt="image for cube {{ $cube->name }}">
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <td>
                            <a href='{{ route('cubes.create') }}' class="btn btn-success text-uppercase">Add cube</a>
                        </td>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

