@extends('admin.app')
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <div id="kt_content_container" class="container">
            <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                    <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                        <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                            @if(isset($user))
                                @if(Route::currentRouteName() == 'admin.admins.edit')
                                    {{ __('Edit Admin') }}
                                @else
                                    {{ __('Show Admin') }}
                                @endif
                            @else
                                {{ __('Create Admin') }}
                            @endif
                        </h1>
                        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                            <li class="breadcrumb-item text-muted">
                                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">{{ __('Dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item">
                                <span class="bullet bg-gray-400 w-5px h-2px"></span>
                            </li>
                            <li class="breadcrumb-item text-muted">{{ __('Admins') }}</li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center gap-2 gap-lg-3">
                        <a href="{{ route('admin.admins.index') }}" class="btn btn-primary">{{ __('View Admins') }}</a>
                    </div>
                </div>
            </div>

            <div class="card mb-5 mb-xxl-10">


                <div id="kt_account_profile_details" class="collapse show">
                    <form id="kt_account_profile_details_form" data-route="{{ Route::currentRouteName() }}" class="form" method="POST" action="{{ isset($user) ? (Route::currentRouteName() == 'admin.admins.edit' ? route('admin.admins.update', $user->id) : '#') : route('admin.admins.store') }}" enctype="multipart/form-data">
                        @csrf
                        @if(isset($user) && Route::currentRouteName() == 'admin.admins.edit')
                            @method('PUT')
                        @endif
                        <div class="card-body border-top p-9">
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Image') }}</label>
                                <div class="col-lg-8">
                                    <div class="image-input image-input-outline fv-row" data-kt-image-input="true" style="background-image: url('{{ asset('media/avatars/blank.png') }}')">
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ isset($user) ? asset($user->image) : asset('media/avatars/blank.png') }}')"></div>
                                        @if(Route::currentRouteName() != 'admin.admins.show')
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
                                        @endif
                                    </div>
                                    <div class="form-text">{{ __('Allowed file types: png, jpg, jpeg.') }}</div>
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Full Name') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="name" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Full Name') }}" value="{{ isset($user) ? $user->name : old('name') }}" {{ Route::currentRouteName() == 'admin.admins.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Email') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="email" name="email" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Email') }}" value="{{ isset($user) ? $user->email : old('email') }}" {{ Route::currentRouteName() == 'admin.admins.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Phone') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="phone" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Phone') }}" value="{{ isset($user) ? $user->phone : old('phone') }}" {{ Route::currentRouteName() == 'admin.admins.show' ? 'readonly' : '' }} />
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Country') }}</label>
                                <div class="col-lg-8 fv-row">
                                    @if(Route::currentRouteName() == 'admin.admins.show')
                                        <input type="hidden" name="country" value="{{ $user->country->id }}">
                                        <select id="country" name="country_disabled" class="form-control form-control-lg form-control-solid" disabled>
                                            <option value="{{ $user->country->id }}">{{ $user->country->name_ar }}</option>
                                        </select>
                                    @else
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
                                    @endif
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('City') }}</label>
                                <div class="col-lg-8 fv-row">
                                    @if(Route::currentRouteName() == 'admin.admins.show')
                                        <input type="hidden" name="city" value="{{ $user->city->id }}">
                                        <select id="city" name="city_disabled" class="form-control form-control-lg form-control-solid" disabled>
                                            <option value="">{{ $user->city->name_ar }}</option>
                                        </select>
                                    @else
                                        <select id="city" name="city" class="form-control form-control-lg form-control-solid">
                                            @if(isset($user) && $user->city)
                                                <option value="{{ $user->city->id }}">{{ $user->city->name_ar }}</option>
                                            @else
                                                <option value="">{{ __('Select City') }}</option>
                                            @endif
                                        </select>
                                    @endif
                                </div>
                            </div>


                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Address') }}</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" name="address" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Address') }}" value="{{ isset($user) ? $user->address : old('address') }}" {{ Route::currentRouteName() == 'admin.admins.show' ? 'readonly' : '' }} />
                                </div>
                            </div>
                            <div class="row mb-6">
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Role') }}</label>
                                <div class="col-lg-8 fv-row">
                                    @if(Route::currentRouteName() == 'admin.admins.show')
                                        @if(count($user->getRoleNames()) > 0)
                                            <input type="hidden" name="role" value="{{ $user->getRoleNames()[0] }}">
                                            <select id="role" name="role_disabled" class="form-control form-control-lg form-control-solid" disabled>
                                                <option value="{{ $user->getRoleNames()[0] }}">{{ $user->getRoleNames()[0] }}</option>
                                            </select>
                                        @else
                                            <select id="role" name="role_disabled" class="form-control form-control-lg form-control-solid" disabled>
                                                <option value="">{{ __('No Role Assigned') }}</option>
                                            </select>
                                        @endif
                                    @else

                                    <select id="role" name="role" class="form-control form-control-lg form-control-solid">
                                        <option value="">{{ __('Select Role') }}</option>
                                        @if(Route::currentRouteName() !== 'admin.admins.create')
                                            @if(isset($user) && count($user->getRoleNames()) > 0)
                                                <option value="{{ $user->getRoleNames()[0] }}" selected>{{ $user->getRoleNames()[0] }}</option>
                                            @endif
                                        @endif

                                        @foreach($roles as $role)
                                            @if(!isset($user) || count($user->getRoleNames()) == 0 || $user->getRoleNames()[0] != $role->name)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>


                                    @endif
                                </div>
                            </div>





                            @if(Route::currentRouteName() == 'admin.admins.create' || Route::currentRouteName() == 'admin.admins.edit')
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


                            @endif
                        </div>

                        @if(Route::currentRouteName() != 'admin.admins.show')
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

    $('#role').select2({
                placeholder: '{{ __("Select Role") }}',
                allowClear: true
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
                var currentRoute = form.getAttribute('data-route');

var isUpdate = currentRoute === 'admin.admins.edit';
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
                            validators: isUpdate ? {} : {
                                notEmpty: {
                                    message: "{{ __('Password is required') }}"
                                },
                                stringLength: {
                                    min: 8,
                                    message: "{{ __('Password must be at least 8 characters') }}"
                                }
                            }
                        },
                        password_confirmation: {
                            validators: isUpdate ? {} : {
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
