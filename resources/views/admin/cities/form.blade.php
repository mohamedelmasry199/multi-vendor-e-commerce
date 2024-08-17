@extends('admin.app')

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            @if(isset($city))
                                @if(Route::currentRouteName() == 'admin.cities.edit')
                                    {{ __('Edit Cities') }}
                                @else
                                    {{ __('Show Cities') }}
                                @endif
                            @else
                                {{ __('Create Cities') }}
                            @endif
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.cities.index') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">{{ __('Cities') }}</li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="{{ route('admin.cities.index') }}" class="btn btn-primary">{{ __('View Cities') }}</a>
                    </div>
                </div>
            </div>

            <div class="card mb-5 mb-xxl-10">


                <div id="kt_account_profile_details" class="collapse show">
                    <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ isset($city) ? (Route::currentRouteName() == 'admin.cities.edit' ? route('admin.cities.update', $city->id) : '#') : route('admin.cities.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($city) && Route::currentRouteName() == 'admin.cities.edit')
                            @method('PUT')
                        @endif
                        <div class="card-body border-top p-9">

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name(AR)') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="name_ar" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Name(AR)') }}" value="{{ isset($city) ? $city->name_ar : old('name_ar') }}" {{ Route::currentRouteName() == 'admin.cities.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name(EN)') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="name_en" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Name(EN)') }}" value="{{ isset($city) ? $city->name_en : old('name_en') }}" {{ Route::currentRouteName() == 'admin.cities.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Country') }}</label>
                                <div class="col-lg-8 fv-row">
                                    @if(Route::currentRouteName() == 'admin.cities.show')
                                        <input type="hidden" name="country_id" value="{{ $city->country->id }}">
                                        <select id="country" name="country_disabled" class="form-control form-control-lg form-control-solid" disabled>
                                            <option value="{{ $city->country->id }}">{{ $city->country->name_ar }}</option>
                                        </select>
                                    @else
                                        <select id="country" name="country_id" class="form-control form-control-lg form-control-solid">
                                            @if(isset($city) && $city->country)
                                                <option value="{{ $city->country->id }}">{{ $city->country->name_ar }}</option>
                                            @else
                                                <option value="">{{ __('Select Country') }}</option>
                                            @endif
                                            @foreach($countries as $country)
                                                @if(!isset($city) || $city->country_id != $country->id)
                                                    <option value="{{ $country->id }}">{{ $country->name_ar }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                            </div>

                        </div>

                        @if(Route::currentRouteName() != 'admin.cities.show')
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                    <span class="indicator-label">{{ __('Save') }}</span>
                                    <span class="indicator-progress">{{ __('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
    <script>
        "use strict";
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var KTAccountSettingsProfileDetails = function() {
    var form, submitButton, formData;

    return {
        init: function() {
            form = document.getElementById("kt_account_profile_details_form");
            submitButton = document.querySelector("#kt_account_profile_details_submit");

            if (form && submitButton) {
                FormValidation.formValidation(form, {
                    fields: {
                        name_ar: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Name is required') }}"
                                }
                            }
                        },
                        name_en: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Name(EN) is required') }}"
                                }
                            }
                        },
                    },

                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                }).on('core.form.valid', function() {
                    submitButton.setAttribute("data-kt-indicator", "on");
                    submitButton.disabled = true;

                    formData = new FormData(form);
                    $.ajax({
                        type: "POST",
                        url: form.action,
                        data: formData,
                        processData: false,
                        contentType: false,
                        mimeType: "multipart/form-data",
                        dataType: 'json',
                        success: function(data){
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;
                            if(data.status_code == 200) {
                                Swal.fire({
                                    text: data.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function(e){
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    text: data.message,
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn font-weight-bold btn-light-primary"
                                    }
                                });
                            }
                        },
                        error: function(data){
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;
                            Swal.fire({
                                text: "{{ __('Sorry, looks like there are some errors detected, please try again.') }}",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "{{ __('Ok, got it!') }}",
                                customClass: {
                                    confirmButton: "btn font-weight-bold btn-light-primary"
                                }
                            });
                        }
                    });
                });
            }
        }
    };
}();

KTUtil.onDOMContentLoaded(function() {
    KTAccountSettingsProfileDetails.init();
});
</script>
<script type="text/javascript">
    $(document).ready(function() {
        function loadCities(countryID, selectedCityID = null) {
            if (countryID) {
                $.ajax({
                    url: '{{ route("admin.getCities", "") }}/' + countryID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var cities = $('#city');
                        cities.empty();
                        cities.append('<option value="">{{ __('Select City') }}</option>');
                        $.each(data, function(key, value) {
                            let selected = selectedCityID == key ? 'selected' : '';
                            cities.append('<option value="'+ key +'" ' + selected + '>'+ value +'</option>');
                        });
                        cities.trigger('change');
                    }
                });
            } else {
                $('#city').empty();
                $('#city').append('<option value="">{{ __('Select City') }}</option>');
                $('#city').trigger('change');
            }
        }

        $('#country').select2({
            placeholder: "{{ __('Select Country') }}"
        }).on('change', function() {
            var countryID = $(this).val();
            loadCities(countryID);
        });

        $('#city').select2({
            placeholder: "{{ __('Select City') }}"
        });

        $('select[data-kt-select2=true]').select2({
            allowClear: true,
            placeholder: function() {
                $(this).data('placeholder');
            }
        });

        var selectedCountryID = $('#country').val();
        var selectedCityID = "{{ isset($city) ? $city->city_id : null }}";
        if (selectedCountryID) {
            loadCities(selectedCountryID, selectedCityID);
        }
    });
    </script>
