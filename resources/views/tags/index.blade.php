@extends('layouts.app')

@section('content')


    <div class="container">

        <h2 class="text-center">Tag for cubes</h2>


        @if(session('success'))
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>tag ID</th>
                <th>Tag</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
{{--                        <a href = '{{ route('tags.edit', $tag->id)}}' class="btn btn-success">EDIT</a>--}}
                        <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <td><button onclick="location.href='{{ route('tags.create') }}'">
                Add cube</button></td>


    </div>
@endsection

