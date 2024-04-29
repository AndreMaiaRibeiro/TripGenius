@section('places.form')
    <div class="row mb-3">
        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('City') }}</label>
        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" autofocus>
        </div>
    </div>

    <div class="row mb-3">
        <label for="radius" class="col-md-4 col-form-label text-md-end">{{ __('Radius') }}</label>
        <div class="col-md-6">
            <input id="radius" type="text" class="form-control" name="radius">
        </div>
    </div>

    <div class="row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Search') }}
            </button>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_KEY')}}&libraries=places" async defer></script>

    <script>
        window.onload = function() {
            initAutocomplete();
        };

        function initAutocomplete() {
            const addressInput = document.getElementById('address');
            const options = {
                types: ['(cities)'],
                componentRestrictions: {country: "{{ Session::get('sessionCountry') }}"}
            };

            const autocomplete = new google.maps.places.Autocomplete(addressInput, options);
            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                console.log(place);
            });
        }
    </script>
@endsection
