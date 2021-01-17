@extends('layouts.app')

@section('content')
    <div class="w-75 mx-auto">
        <div class="d-flex justify-content-between">
            <h1> {{ $item->name }}</h1>
            <span>{{ $item->created_at }}</span>
        </div>
        <ul class="reltions my-2">
            @foreach($item->$with_relation as $i => $substance)
                <li>{{ $substance->name }}</li>
            @endforeach
        </ul>
        @if($relations)
            <div class="d-flex justify-content-between my-4">
                @foreach($relations as $i => $relation)
                    <div>
                        <h5><a href="{{ route('drugs.show' , $relation->id) }}">{{ $relation->name }}</a></h5>
                        <ul class="mb-0">
                            @foreach($relation->$with_relation as $k => $substance)
                                <li>
                                    <small>{{ $substance->name }}</small>
                                </li>
                            @endforeach 
                        </ul>
                    </div>
                @endforeach
            </div>
        @else
            <h4>No Realtions to show</h4>
        @endif
    </div>
@endsection