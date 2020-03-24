@extends('layouts.app')

@section('content')

    <h1>Test</h1>
    <div class="form-group col-sm-3 {{ $errors->has('company_id') ? ' has-error' : '' }}">
        <label>Dodávateľ</label>
        <select name="company_id" class="form-control" required id="exampleSelect1">
            <option value="" selected disabled >Vybrať dodávateľa</option>
            @foreach(\App\Models\Contact::all() as $company)

            @endforeach
        </select>
    </div>

    @endsection
