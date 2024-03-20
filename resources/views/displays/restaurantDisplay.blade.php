@extends('layouts.app')

@section('content')

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">{{ __('Restaurants') }}</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead class="thead-light">
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
                                    <td>{{ $place->getBusinessStatus()}}</td>
                                    <td>{{ $place->getRating() }} <i class="fas fa-star text-warning"></i></td>
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

@endsection

@push('styles')
    <style>
        .badge-success {
            background-color: #28a745;
        }
        .badge-secondary {
            background-color: #6c757d;
        }
        .fas.fa-star {
            color: #ffc107;
        }
    </style>
@endpush
