@extends('admin.app')
@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('Account Overview') }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{ __('Account') }}</li>
                    <!--end::Item-->
                </ul>
                <!--end::Breadcrumb-->
            </div>
            <!--end::Page title-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img src="{{ $user->image }}" alt="image" />
                                <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="{{ route('admin.profile.index') }}" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $user->name }}</a>
                                        <a href="#">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                    <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="currentColor" />
                                                    <path d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->

                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                </div>
            </div>
            <!--end::Navbar-->
            <!--begin::details View-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bold m-0">{{ __('Profile Details') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_settings_profile_details" class="collapse show">
                    <!--begin::Form-->
                    <div id="kt_account_profile_details" class="collapse show">
                        <form id="kt_account_profile_details_form" class="form" method="POST" action="{{  route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                                @method('PATCH')
                            <div class="card-body border-top p-9">
                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Image') }}</label>
                                    <div class="col-lg-8">
                                        <div class="image-input image-input-outline fv-row" data-kt-image-input="true" style="background-image: url('{{ asset('media/avatars/blank.png') }}')">
                                            <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ isset($user) ? asset($user->image) : asset('media/avatars/blank.png') }}')"></div>
                                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change avatar') }}">
                                                    <i class="bi bi-pencil-fill fs-7"></i>
                                                    <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                    <input type="hidden" name="avatar_remove" />
                                                </label>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="{{ __('Cancel avatar') }}">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="{{ __('Remove avatar') }}">
                                                    <i class="bi bi-x fs-2"></i>
                                                </span>
                                        </div>
                                        <div class="form-text">{{ __('Allowed file types: png, jpg, jpeg.') }}</div>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full Name') }}</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Full Name') }}" value="{{ isset($user) ? $user->name : old('name') }}" />
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Email') }}</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Email') }}" value="{{ isset($user) ? $user->email : old('email') }}" />
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Phone') }}</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="phone" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Phone') }}" value="{{ isset($user) ? $user->phone : old('phone') }}" />
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Country') }}</label>
                                    <div class="col-lg-8 fv-row">

                                            <select id="country" name="country" class="form-control form-control-lg form-control-solid">
                                                @if(isset($user) && $user->country)
                                                    <option value="{{ $user->country->id }}">{{ $user->country->name_ar }}</option>
                                                @else
                                                    <option value="">{{ __('Select Country') }}</option>
                                                @endif
                                                @foreach($countries as $country)
                                                    @if(!isset($user) || $user->country_id != $country->id)
                                                        <option value="{{ $country->id }}">{{ $country->name_ar }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                    </div>
                                </div>

                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('City') }}</label>
                                    <div class="col-lg-8 fv-row">
                                            <select id="city" name="city" class="form-control form-control-lg form-control-solid">
                                                @if(isset($user) && $user->city)
                                                    <option value="{{ $user->city->id }}">{{ $user->city->name_ar }}</option>
                                                @else
                                                    <option value="">{{ __('Select City') }}</option>
                                                @endif
                                            </select>
                                    </div>
                                </div>


                                <div class="row mb-6">
                                    <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Address') }}</label>
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Address') }}" value="{{ isset($user) ? $user->address : old('address') }}"  />
                                    </div>
                                </div>

                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Password') }}</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="password" name="password" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Password') }}" value="" />
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Password Confirmation') }}</label>
                                        <div class="col-lg-8 fv-row">
                                            <input type="password" name="password_confirmation" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Password Confirmation') }}" value="" />
                                        </div>
                                    </div>
                            </div>
                        </div>

                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                        <span class="indicator-label">{{ __('Save') }}</span>
                                        <span class="indicator-progress">{{ __('Please wait') }}...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
     <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
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

        var selectedCountryID = $('#country').val();
        var selectedCityID = "{{ isset($user) ? $user->city_id : null }}";
        if (selectedCountryID) {
            loadCities(selectedCountryID, selectedCityID);
        }
    });

        </script>
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
                                        message: "{{ __('Full Name is required') }}"
                                    }
                                }
                            },
                            email: {
                                validators: {
                                    notEmpty: {
                                        message: "{{ __('Email is required') }}"
                                    },
                                    emailAddress: {
                                        message: "{{ __('The value is not a valid email address') }}"
                                    }
                                }
                            },
                            phone: {
                                validators: {
                                    notEmpty: {
                                        message: "{{ __('Phone is required') }}"
                                    }
                                }
                            },
                            country: {
                                validators: {
                                    notEmpty: {
                                        message: "{{ __('Country is required') }}"
                                    }
                                }
                            },
                            city: {
                                validators: {
                                    notEmpty: {
                                        message: "{{ __('City is required') }}"
                                    }
                                }
                            },
                            address: {
                                validators: {
                                    notEmpty: {
                                        message: "{{ __('Address is required') }}"
                                    }
                                }
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: "{{ __('Password is required') }}"
                                    }
                                }
                            },
                            password_confirmation: {
                                validators: {
                                    notEmpty: {
                                        message: "{{ __('Confirm Password is required') }}"
                                    },
                                    identical: {
                                        compare: function() {
                                            return form.querySelector('[name="password"]').value;
                                        },
                                        message: "{{ __('The password and its confirm are not the same') }}"
                                    }
                                }
                            }
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
