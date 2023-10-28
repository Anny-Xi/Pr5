@extends('layouts.app')

@section('title', 'Tags')

@section('content')

    <div class="container">

        <div class="card">
            <h2 class="card-header">Tag for cubes</h2>


            @if(session('message'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        {{--                        <th>Tag ID</th>--}}
                        <th>Tag name</th>
                        <th>Tag description</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $tag->name }}</td>
                            <td>{{ $tag->description }}</td>
                            @if(Auth::check() && Auth::user()->role)
                                <td>
                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                            @endif

                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <a href='{{ route('tags.create') }}' class="btn btn-success text-uppercase">Add tag</a>
            </div>
        </div>
    </div>
@endsection

