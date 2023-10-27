@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="card">

            <h2 class="card-header">Cubes</h2>

            {{--    Here comes a search engine and a filter--}}

            @if(session('message'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Cube ID</th>
                        <th>Cube name</th>
                        <th>Description</th>
                        <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($cubes as $cube)
                        <tr>
                            <td>{{ $cube->id }}</td>
                            <td>{{ $cube->name }}</td>
                            <td>{{ $cube->description }}</td>
                            <td><img src="{{ Storage::url($cube->cube_image) }}" class="w-25"
                                     alt="image for cube {{ $cube->name }}">
                            </td>


                            @guest
                                @if(Route::has('login') && Route::has('register'))
                                @endif
                            @else
                                <td>
                                    <a href='{{ route('cubes.edit', $cube->id)}}' class="btn btn-success">EDIT</a>
                                </td>
                                <td>
                                    <a href='{{ route('cubes.editImage', $cube->id)}}' class="btn btn-primary">EDIT IMAGE</a>
                                </td>
                                <td>
                                    <form action="{{ route('cubes.destroy', $cube->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            @endguest
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <td>
                    <button onclick="location.href='{{ route('cubes.create') }}'">
                        Add cube
                    </button>
                </td>

            </div>
        </div>
    </div>
@endsection

