    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        // Autocomplete for country search
        $("#country_search").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('admin.countries.autocomplete') }}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#country_search').val(ui.item.label);
                $('#country_id').val(ui.item.value);

                var countryID = ui.item.value;
                if (countryID) {
                    $.ajax({
                        url: "{{ route('admin.countries.cities') }}", // Update the route to fetch cities
                        type: "POST",
                        dataType: "json",
                        data: {
                            country_id: countryID
                        },
                        success: function(data) {
                            $('#city').empty(); // Clear existing options
                            $('#city').append('<option value="">Select City</option>');
                            $.each(data, function(key, value) {
                                $('#city').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                        }
                    });
                } else {
                    $('#city').empty();
                    $('#city').append('<option value="">Select City</option>');
                }

                return false;
            }
        });
    });

