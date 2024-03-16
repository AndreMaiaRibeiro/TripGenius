@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Restaurants') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Rating</th>
                                <th>Nr. of Reviews</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($placesDTOList as $place)
                                <tr>
                                    <td>{{ $place->getName() }}</td>
                                    <td>{{ $place->getBusinessStatus() }}</td>
                                    <td>{{ $place->getRating() }} </td>
                                    <td>{{ $place->getUserRatingTotal() }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection
