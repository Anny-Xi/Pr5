@extends('layouts.app')

@section('title', 'User profile')

@section('content')

    <div class="container">

        <div class="card">

            <h2 class="card-header">Your profile</h2>


            @if(session('message'))
                <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                    <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card-body">
                @foreach ($user as $info)

                    <H3 class="text-capitalize ">Name: {{$info->name}}</H3>
                    <H3 class="card-text">Email: {{$info->email}}</H3>

                    <a href='{{ route('users.edit', $info->id)}}' class="btn btn-success text-uppercase mb-3">edit your
                        profile</a>
                @endforeach

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
                            <td>
                                <img src="{{ Storage::url($cube->cube_image) }}" class="w-25"
                                     alt="image for cube {{ $cube->name }}">
                            </td>
                            <td>
                                <form action="{{ route('enable', $cube->id) }}" method="POST">
                                    @csrf
                                    @if ($cube->is_enable )
                                        <button type="submit" class="btn btn-danger btn-sm">Disable</button>
                                    @else
                                        <button type="submit" class="btn btn-primary btn-sm">Enable</button>
                                    @endif

                                </form>
                            </td>
                            <td>


                            @if(!Auth::check())

                            @else
                                <td>
                                    <a href='{{ route('cubes.edit', $cube->id)}}'
                                       class="btn btn-success">EDIT</a>
                                </td>
                                <td>
                                    <a href='{{ route('cubes.editImage', $cube->id)}}' class="btn btn-primary">EDIT
                                        IMAGE</a>
                                </td>
                                <td>
                                    <form action="{{ route('cubes.destroy', $cube->id) }}" method="POST">
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
                @if(!Auth::user()->role)
                    <th>You have create {{$cubes->count()}} cubes</th>
                @endif
                @if(Auth::user()->role)
                    <th><h2>Users create {{$cubes->count()}} cubes</h2></th>
                @endif

            </div>


        </div>

    </div>
@endsection

