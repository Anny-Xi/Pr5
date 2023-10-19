@extends('layouts.app')

@section('content')


<div class="container">

    <h2 class="text-center">Cubes</h2>

{{--    Here comes a search engine and a filter--}}


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
                <td>{{ $cube->cube_image }}</td>
                <td>
{{--                    <a href = '{{ route('cubes.edit', $cubes->id)}}' class="btn btn-success">EDIT</a>--}}
                    <form action="{{ route('cubes.destroy', $cube->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <td><button onclick="location.href='{{ route('cubes.create') }}'">
            Add cube</button></td>


</div>
@endsection

