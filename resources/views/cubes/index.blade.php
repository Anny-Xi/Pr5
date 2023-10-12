@extends('layouts.app')

@section('content')


<div class="container">

    <h2 class="text-center">Cubes</h2>

{{--    Here comes a search engine and a filter--}}


    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Cube name</th>
            <th>Difficulty</th>
            <th>Year</th>
            <th>Image</th>
        </tr>
        </thead>
        <tbody>
{{--        @foreach ($recipes as $recipes)--}}
{{--            <tr>--}}
{{--                <td>{{ $recipes->name }}</td>--}}
{{--                <td>{{ $recipes->origin }}</td>--}}
{{--                <td>{{ $recipes->ingredients }}</td>--}}
{{--                <td>{{ $recipes->instructions }}</td>--}}
{{--                <td>--}}
{{--                    --}}{{--          <a href = '/recipes/delete/{{ $recipes->id }}'>Delete</a>--}}
{{--                    <form action="{{ route('recipes.destroy', $recipes->id) }}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('DELETE')--}}
{{--                        <button type="submit">DELETE</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        </tbody>
    </table>
    <td><button onclick="location.href='{{ route('cubes.create') }}'">
            Add cube</button></td>


</div>
@endsection

