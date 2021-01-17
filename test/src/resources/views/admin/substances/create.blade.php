@extends('layouts.app')

@section('content')
<div class="col-md-8 mx-auto">
    <form action="{{ route('substances.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="substanceName">Substance Name</label>
            <input name="substance_name" type="text" class="form-control {{ $errors->has('substance_name') ? 'is-invalid' : '' }}" id="substanceName" aria-describedby="nameErrors"
                placeholder="" value="{{ old('substance_name', '') }}">
            @if($errors->has('substance_name'))
                <small class="form-text text-danger">{{ $errors->first('substance_name') }}</small>
            @endif
        </div>
        <div class="form-check">
            <input class="form-check-input position-static" type="checkbox" id="visibleCheckBox" name="visible" value="1" checked aria-label="Visible">
            <label for="visibleCheckBox">Visible</label>
        </div>
        <button type="submit" class="btn btn-success my-2">Create</button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/script.js') }}"></script>
@endsection