@extends('pages.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Google autocomplete</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="streetaddress">Street address</label>
                            <input type="text" class="form-control ui-widget autocomplete-google" id="street_address_1">
                        </div>

                        <div class="form-group">
                            <label for="streetaddress2">Street address 2</label>
                            <input type="text" class="form-control" id="street_address_2">
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" id="city">
                        </div>

                        <div class="form-group">
                            <label for="state">State</label>
                            <input type="text" class="form-control" id="state">
                        </div>

                        <div class="form-group">
                            <label for="postcode">Postcode</label>
                            <input type="text" class="form-control" id="postcode">
                        </div>

                        <div class="form-group">
                            <label for="country">Country</label>
                            <input type="text" class="form-control" id="country">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $(".autocomplete-google").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: '/placeid',
                    type: 'GET',
                    dataType: "json",
                    data: {
                        inputData: request.term,
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
        });
    });
</script>
@endsection