@extends('layouts.app')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    <h4>Add new record</h4>
    <a class="btn btn-primary" href="/drones/create">Click Here</a>
@else
    <div class="alert alert-danger" role="alert">
    {{ session('failed') }}
</div>
<a class="btn btn-primary" href="/drones/create">Click Here</a>
@endif

@endsection