@extends('layouts.app')
@section('content')
<div class="col-md-10 text-center">
    <h1>Statistics</h1>
    <div class="d-flex justify-content-center">
        <div class="ml-1 mr-1 bg-primary text-white rounded p-3">
            <h2 class="mb-0">Users {{ $users }}</h2>
        </div>
        <div class="ml-1 mr-1 bg-primary text-white rounded p-3">
            <h2 class="mb-0">Substances {{ $substances }}</h2>
        </div>
        <div class="ml-1 mr-1 bg-primary text-white rounded p-3">
            <h2 class="mb-0">Drugs {{ $drugs }}</h2>
        </div>
        <div></div>
    </div>
</div>
@endsection