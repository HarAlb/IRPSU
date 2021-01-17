@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Search</h2>
                </div>
                <div class="card-body">
                    <form class="form-inline" action="">
                        <div class="form-group flex-fill">
                            <label for="inputPassword2" class="sr-only">Search</label>
                            <select id="selectPicker" class="select-multiple w-100 has-error" name="substance[]"
                                multiple="multiple">
                                <?php $subs = \App\Models\Substance::select('id' , 'name')->where('visible' , 1)->get(); ?>
                                @foreach($subs as $i => $sub)
                                <?php $selected = in_array($sub->id , (\Request::get('substance')?:[])) ? 'selected="selected"' : '' ?>
                                <option value="{{ $sub->id }}" {{ $selected }}>{{ $sub->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>

                    <div class="my-5">
                        @foreach($drugs as $i => $drug)
                        <div class="">
                            <h2> {{ $drug->name }}</h2>
                            <ul class="reltions my-2">
                                @foreach($drug->substancesNotPrimary as $i => $substance)
                                <li>{{ $substance->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    <div>
                        @if($message)
                            {{ $message }}
                        @endif
                        @if($drugs)
                            {{ $drugs->links("pagination::bootstrap-4") }}
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('/js/script.js') }}"></script>
@endsection