@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Search Bars') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('bars.search') }}">
                        @csrf
                        @include('forms\places')
                        @yield('places.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
