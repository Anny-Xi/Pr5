@extends('layouts.app')

@section('content')


<div class="container">

    <div class="card">

    <h2 class="card-header">Your profile</h2>


    @if(session('success'))
        <div class="alert alert-{{ session('status') }} alert-dismissible fade show mt-3" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close btn-danger" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <div class="card-body">

        </div>


    </div>

</div>
@endsection

