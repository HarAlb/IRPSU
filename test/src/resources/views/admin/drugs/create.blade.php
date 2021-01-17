@extends('layouts.app')

@section('content')
<div class="col-md-8 mx-auto">
    <form action="{{ route('drugs.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="drugName">Drug Name</label>
            <input name="drug_name" type="text" class="form-control {{ $errors->has('drug_name') ? 'is-invalid' : '' }}" id="drugName" aria-describedby="nameErrors"
                placeholder="" value="{{ old('drug_name', '') }}">
            @if($errors->has('drug_name'))
                <small class="form-text text-danger">{{ $errors->first('drug_name') }}</small>
            @endif
        </div>
        <div class="form-group">
                <label for="selectPicker">Substances</label>
            <select id="selectPicker" class="select-multiple w-100 has-error" name="substance[]" multiple="multiple">
                <?php $subs = \App\Models\Substance::select('id' , 'name')->get(); ?>
                @foreach($subs as $i => $sub)
                    <?php $selected = in_array($sub->id , old('substance' , [])) ? 'selected="selected"' : '' ?>
                    <option value="{{ $sub->id }}" {{ $selected }}>{{ $sub->name }}</option>
                @endforeach
            </select>
            @if($errors->has('substance'))
                <small class="form-text text-danger">{{ $errors->first('substance') }}</small>
            @endif
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Primary Substance</label>
            <select class="select-multiple w-100 has-error" name="primary">
                <option></option>
                @foreach($subs as $i => $sub)
                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success my-2">Create</button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/script.js') }}"></script>
@endsection