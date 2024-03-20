@section('places.form')
    <div class="row mb-3">
        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
        <div class="col-md-6">
            <input id="address" type="text" class="form-control" name="address" autofocus>
        </div>
    </div>
    <div class="row mb-3">
        <label for="region" class="col-md-4 col-form-label text-md-end">{{ __('Region') }}</label>
        <div class="col-md-6">
            <input id="region" type="text" class="form-control" name="region">
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
@endsection
