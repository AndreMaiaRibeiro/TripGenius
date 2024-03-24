@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row">
            @foreach($countryNamesFromImages as $countryName => $imagePath)
                <div class="col-3 my-2">
                    <a href="{{ route('country.select', ['countryName' => $countryName, 'id' => $countryName]) }}" id="{{ $countryName }}">
                        <img src="{{ $imagePath }}" class="img-fluid" alt="{{ $countryName }}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
