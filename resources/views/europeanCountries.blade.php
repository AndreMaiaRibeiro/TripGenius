@extends('layouts.app')

@section('content')
    <div class="container-fluid p-5">
        <div class="row">
            @foreach($imagePaths as $path)
                @php
                    $countryName = basename($path, '-flag.svg');
                @endphp
                <div class="col-3 my-2">
                    <a href="{{ route('country.select', ['countryName' => $countryName]) }}">
                        <img src="{{ asset($path) }}" class="img-fluid" alt="{{ $countryName }} Flag">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        .img-flag {
            width: 250px;
            height: 166px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .col-3 {
                padding: 0.5rem;
            }
        }
    </style>
@endpush
