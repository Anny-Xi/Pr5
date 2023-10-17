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
        @foreach ($cubes as $cubes)
            <tr>
                <td>{{ $cubes->id }}</td>
                <td>{{ $cubes->name }}</td>
                <td>{{ $cubes->description }}</td>
                <td>{{ $cubes->cube_image }}</td>
{{--                <td>--}}
{{--                              <a href = '/recipes/delete/{{ $cubes->id }}'>Delete</a>--}}
{{--                    <form action="{{ route('recipes.destroy', $cubes->id) }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button type="submit">DELETE</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
    <td><button onclick="location.href='{{ route('cubes.create') }}'">
            Add cube</button></td>


</div>
@endsection

