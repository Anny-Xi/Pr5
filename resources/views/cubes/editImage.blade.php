@extends('layouts.app')


@section('title', 'Edit Cube')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update your cube') }}</div>
                    @if(session('message'))
                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('cubes.updateImage', $cube->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="description"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Image') }}</label>
                                <div class="col-md-6">
                                    <img src="{{ Storage::url($cube->cube_image) }}" class="w-25"
                                         alt="image for cube {{ $cube->name }}">
                                    <input id="description" type="file"
                                           class="form-control @error('image') is-invalid @enderror" name="image"
                                           value="{{ Storage::url($cube->cube_image) }}">

                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update the cube') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection




