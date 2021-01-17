@extends('layouts.app')

@section('content')
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Drugs</h1>
            <a href="{{ route('drugs.create') }}" class="btn btn-success">Create</a>
        </div>
        <div class="d-flex flex-column">
            @foreach($drugs as $i => $drug)
            <div class="position-relative bg-white rounded px-2 my-1">
                <h3 class="mb-0"><a href="{{ route('drugs.edit' , $drug->id) }}">{{ $drug->name }}</a></h3>
                <div class="substance-list">
                    @foreach($drug->substances as $index => $substance)
                        <span class="pl-2 pr-2 position-relative">{{ $substance->name }}</span>
                    @endforeach
                </div>

                <div class="position-absolute buttons-group d-flex justify-content-between">
                    <a href="{{ route('drugs.edit' , $drug->id) }}" class="pr-1 pl-1">
                        <i class="fas fa-pen"></i>
                    </a>
                </div>
            </div>
            @endforeach
            <div>
                {{ $drugs->links("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>    
@endsection