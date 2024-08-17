<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->
<head>
    <base href="{{ asset('') }}" />
    <title>{{ __('auth.metronic_admin_reset_password') }}</title>
    <meta charset="utf-8" />
    <meta name="description" content="{{ __('auth.metronic_description') }}" />
    <meta name="keywords" content="{{ __('auth.metronic_keywords') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="{{ __('auth.og_locale') }}" />
    <meta property="og:type" content="{{ __('auth.og_type') }}" />
    <meta property="og:title" content="{{ __('auth.metronic_og_title') }}" />
    <meta property="og:url" content="{{ __('auth.metronic_og_url') }}" />
    <meta property="og:site_name" content="{{ __('auth.metronic_site_name') }}" />
    <link rel="canonical" href="{{ __('auth.metronic_canonical') }}" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "{{ __('auth.default_theme_mode') }}";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "{{ __('auth.system') }}") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "{{ __('auth.dark') }}" : "{{ __('auth.light') }}";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Password reset -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_password_reset_form" method="POST">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-10">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">{{ __('auth.admin_reset_password') }}</h1>
                                <!--end::Title-->
                                <!--begin::Link-->
                                <div class="text-gray-500 fw-semibold fs-6">{{ __('auth.enter_email_reset') }}</div>
                                <!--end::Link-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="email" placeholder="{{ __('auth.email') }}" name="email" autocomplete="off" class="form-control bg-transparent" required />
                                <!--end::Email-->
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <!--begin::Actions-->
                            <div class="d-flex flex-wrap justify-content-center pb-lg-0">
                                <button type="button" id="kt_password_reset_submit" class="btn btn-lg btn-primary fw-bolder me-4">
                                    <span class="indicator-label">{{ __('Submit') }}</span>
                                    <span class="indicator-progress">{{ __('Please wait') }}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <a href="{{ route('admin.login') }}" class="btn btn-lg btn-light-primary fw-bolder">{{ __('Cancel') }}</a>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
                <!--begin::Footer-->
                <div class="d-flex flex-center flex-wrap px-5">
                    <!--begin::Links-->
                    <div class="d-flex fw-semibold text-primary fs-base">
                        <a href="{{ asset('pages/team.html') }}" class="px-5" target="_blank">{{ __('auth.terms') }}</a>
                        <a href="{{ asset('pages/pricing/column.html') }}" class="px-5" target="_blank">{{ __('auth.plans') }}</a>
                        <a href="{{ asset('pages/contact.html') }}" class="px-5" target="_blank">{{ __('auth.contact_us') }}</a>
                    </div>
                    <!--end::Links-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('assets/media/misc/auth-bg.png') }})">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->
                    <a href="{{ route('admin.dashboard') }}" class="mb-0 mb-lg-12">
                        <img alt="Logo" src="{{ asset('assets/media/logos/custom-1.png') }}" class="h-60px h-lg-75px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('assets/media/misc/auth-screens.png') }}" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">{{ __('auth.fast_efficient_productive') }}</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-white fs-base text-center">{{ __('auth.introduce_blogger') }}
                        <a href="#" class="opacity-75-hover text-warning fw-bold me-1">{{ __('auth.the_interviewee') }}</a>{{ __('auth.transcript_interview') }}</div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Password reset-->
    </div>
    <!--end::Root-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script>
   "use strict";

$.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
});

var KTPasswordResetGeneral = function() {
    var form, submitButton, validator;

    return {
        init: function() {
            form = document.querySelector("#kt_password_reset_form");
            submitButton = document.querySelector("#kt_password_reset_submit");

            validator = FormValidation.formValidation(form, {
                fields: {
                    email: {
                        validators: {
                            notEmpty: {
                                message: "{{ __('Email address is required') }}"
                            },
                            emailAddress: {
                                message: "{{ __('The value is not a valid email address') }}"
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: ".fv-row",
                        eleInvalidClass: "",
                        eleValidClass: ""
                    })
                }
            });

            submitButton.addEventListener("click", function(event) {
                event.preventDefault();

                validator.validate().then(function(status) {
                    if (status === "Valid") {
                        var formData = new FormData(form);

                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = true;

                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.password.email') }}",
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: 'json',
                            success: function(data) {
                                console.log(data, data.status_code);
                                if (data.status_code === 200) {
                                    setTimeout(function() {
                                        submitButton.removeAttribute("data-kt-indicator");
                                        submitButton.disabled = false;

                                        Swal.fire({
                                            text: "{{ __('auth.Password reset link sent! Check your email.') }}",
                                            icon: "success",
                                            buttonsStyling: false,
                                            confirmButtonText: "{{ __('auth.Ok, got it!') }}",
                                            customClass: {
                                                confirmButton: "btn btn-primary"
                                            }
                                        }).then(function(result) {
                                            form.querySelector('[name="email"]').value = "";
                                            if (result.isConfirmed) {
                                                window.location.replace(data.direction);
                                            }
                                        });
                                    }, 1500);
                                }
                            },
                            error: function(xhr) {
                                handleErrorResponse("{{ __('Sorry, looks like there are some errors detected, please try again.') }}");
                            }
                        });
                    } else {
                        Swal.fire({
                            text: "{{ __('Sorry, looks like there are some errors detected, please try again.') }}",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "{{ __('Ok, got it!') }}",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            });
        }
    };

    function handleErrorResponse(message) {
        submitButton.removeAttribute("data-kt-indicator");
        submitButton.disabled = false;

        Swal.fire({
            text: message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "{{ __('Ok, got it!') }}",
            customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary"
            }
        });
    }

}();

KTUtil.onDOMContentLoaded(function() {
    KTPasswordResetGeneral.init();
});
</script>

</body>
<!--end::Body-->
</html>
