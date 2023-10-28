@extends('layouts.app')

@section('title', 'Users List')

@section('content')


<div class="container">

    <div class="card">

    <h2 class="card-header">User list</h2>

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
                        <th>User ID</th>
                        <th>User name</th>
                        <th>User email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($user as $info)
                        <tr>
                            <td>{{ $info->id }}</td>
                            <td>{{ $info->name }}</td>
                            <td>{{ $info->email }}</td>


                            @guest
                                @if(!Auth::check())
                                @endif
                            @else
                                <td>
                                    <form action="{{ route('users.destroy', $info->id) }}" method="POST">
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
                <th>There is in totaal  {{$user->count()}} users</th>
        </div>


    </div>

</div>
@endsection

