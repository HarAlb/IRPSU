@extends('layouts.app')

@section('content')
<div class="col-md-8 mx-auto">
    <form action="{{ route('drugs.destroy' , $item->id) }}" method="post" class="text-right">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger my-2">Delete</button>
    </form>
    <form action="{{ route('drugs.update',  $item->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="exampleInputEmail1">Drug Name</label>
            <input name="drug_name" type="text" class="form-control {{ $errors->has('drug_name') ? 'is-invalid' : '' }}" id="drug-name" aria-describedby="nameErrors"
                placeholder="" value="{{ old('drug_name', $item->name) }}">
            @if($errors->has('drug_name'))
                <small class="form-text text-danger">{{ $errors->first('drug_name') }}</small>
            @endif
        </div>
        <div class="form-group">
                <label for="exampleInputEmail1">Substances</label>
            <select id="selectPicker" class="select-multiple w-100 has-error" name="substance[]" multiple="multiple">
                <?php $subs = \App\Models\Substance::select('id' , 'name')->get(); ?>
                @foreach($subs as $i => $sub)
                    <?php $selected = $item->substances->where('id' , $sub->id)->first() ? 'selected="selected"': ''  ?>
                    <option value="{{ $sub->id }}" {{ $selected }}>{{ $sub->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Primary Substance</label>
            <select class="select-multiple w-100 has-error" name="primary">
                <option></option>
                @foreach($subs as $i => $sub)
                    <?php $selected = $item->substances->where('id' , $sub->id)->first() && !$item->substances->where('id' , $sub->id)->first()->visible ? 'selected="selected"': ''  ?>
                    <option value="{{ $sub->id }}" {{ $selected }}>{{ $sub->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary my-2">Update</button>
    </form>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('/js/script.js') }}"></script>
@endsection