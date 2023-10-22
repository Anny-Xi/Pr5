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
                <th>Tag ID</th>
                <th>Tag name</th>
                <th>Tag description</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->description }}</td>
                    @guest
                        @if(Route::has('login') && Route::has('register'))
                        @endif
                    @else
                        <td>
                            {{--                        <a href = '{{ route('tags.edit', $tag->id)}}' class="btn btn-success">EDIT</a>--}}
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
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
            <button onclick="location.href='{{ route('tags.create') }}'">
                Add tag
            </button>
        </td>


    </div>
@endsection

