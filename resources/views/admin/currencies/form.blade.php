@extends('admin.app')

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            @if(isset($currency))
                                @if(Route::currentRouteName() == 'admin.currencies.edit')
                                    {{ __('Edit Currencies') }}
                                @else
                                    {{ __('Show Currencies') }}
                                @endif
                            @else
                                {{ __('Create Currencies') }}
                            @endif
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.currencies.index') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">{{ __('Currencies') }}</li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="{{ route('admin.currencies.index') }}" class="btn btn-primary">{{ __('View Currencies') }}</a>
                    </div>
                </div>
            </div>

            <div class="card mb-5 mb-xxl-10">


                <div id="kt_account_profile_details" class="collapse show">
                    <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ isset($currency) ? (Route::currentRouteName() == 'admin.currencies.edit' ? route('admin.currencies.update', $currency->id) : '#') : route('admin.currencies.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($currency) && Route::currentRouteName() == 'admin.currencies.edit')
                            @method('PUT')
                        @endif
                        <div class="card-body border-top p-9">


                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name(AR)') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="name_ar" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Name(AR)') }}" value="{{ isset($currency) ? $currency->name_ar : old('name_ar') }}" {{ Route::currentRouteName() == 'admin.currencies.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name(EN)') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="name_en" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Name(EN)') }}" value="{{ isset($currency) ? $currency->name_en : old('name_en') }}" {{ Route::currentRouteName() == 'admin.currencies.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Dollar Rate') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="dollar_rate" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Dollar Rate') }}" value="{{ isset($currency) ? $currency->dollar_rate : old('dollar_rate') }}" {{ Route::currentRouteName() == 'admin.currencies.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Main') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <select name="is_main" class="form-control form-control-lg form-control-solid" {{ Route::currentRouteName() == 'admin.currencies.show' ? 'disabled' : '' }}>
                                        <option value="0" {{ (isset($currency) && $currency->is_main == '0') ? 'selected' : '' }}>{{ __('No') }}</option>
                                        <option value="1" {{ (isset($currency) && $currency->is_main == '1') ? 'selected' : '' }}>{{ __('Yes') }}</option>
                                    </select>
                                </div>
                            </div>


                        </div>

                        @if(Route::currentRouteName() != 'admin.currencies.show')
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
                        name: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Name is required') }}"
                                }
                            }
                        },
                        dollar_rate: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Dollar rate is required') }}"
                                }
                            }
                        },
                        is_main: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('required') }}"
                                },
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
