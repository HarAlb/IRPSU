@extends('layouts.app')

@section('content')
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Substance</h1>
            <a href="{{ route('substances.create') }}" class="btn btn-success">Create</a>
        </div>
        <div class="d-flex flex-column">
            @foreach($substances as $i => $substance)
            <div class="position-relative bg-white rounded px-2 my-1">
                <h3 class="mb-0"><a class="{{ $substance->visible ? '' : 'text-muted' }}" href="{{ route('substances.edit' , $substance->id) }}">{{ $substance->name }}</a></h3>
            </div>
            @endforeach
            <div>
                {{ $substances->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>    
@endsection