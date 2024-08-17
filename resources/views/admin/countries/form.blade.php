@extends('admin.app')

@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            @if(isset($country))
                                @if(Route::currentRouteName() == 'admin.countries.edit')
                                    {{ __('Edit Countries') }}
                                @else
                                    {{ __('Show Countries') }}
                                @endif
                            @else
                                {{ __('Create Countries') }}
                            @endif
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('admin.countries.index') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">{{ __('Countries') }}</li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="{{ route('admin.countries.index') }}" class="btn btn-primary">{{ __('View Countries') }}</a>
                    </div>
                </div>
            </div>

            <div class="card mb-5 mb-xxl-10">


                <div id="kt_account_profile_details" class="collapse show">
                    <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ isset($country) ? (Route::currentRouteName() == 'admin.countries.edit' ? route('admin.countries.update', $country->id) : '#') : route('admin.countries.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($country) && Route::currentRouteName() == 'admin.countries.edit')
                            @method('PUT')
                        @endif
                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Flag') }}</label>
                                <div class="col-lg-8">
                                    <div class="image-input image-input-outline fv-row" data-kt-image-input="true" style="background-image: url('{{ asset('media/avatars/blank.png') }}')">
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ isset($country) ? asset($country->getImgPath('flag')) : asset('media/avatars/blank.png') }}')"></div>
                                        @if(Route::currentRouteName() != 'admin.countries.show')
                                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change avatar') }}">
                                                <i class="bi bi-pencil-fill fs-7"></i>
                                                <input type="file" name="flag" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="avatar_remove" />
                                            </label>
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{ __('Cancel avatar') }}">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{ __('Remove avatar') }}">
                                                <i class="bi bi-x fs-2"></i>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-text">{{ __('Allowed file types: jpeg, png, jpg, gif, svg.') }}</div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name(AR)') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="name_ar" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Name(AR)') }}" value="{{ isset($country) ? $country->name_ar : old('name_ar') }}" {{ Route::currentRouteName() == 'admin.countries.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name(EN)') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="name_en" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Name(EN)') }}" value="{{ isset($country) ? $country->name_en : old('name_en') }}" {{ Route::currentRouteName() == 'admin.countries.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Code') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="code" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Code') }}" value="{{ isset($country) ? $country->code : old('code') }}" {{ Route::currentRouteName() == 'admin.countries.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                        </div>

                        @if(Route::currentRouteName() != 'admin.countries.show')
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
                        code: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Code is required') }}"
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
