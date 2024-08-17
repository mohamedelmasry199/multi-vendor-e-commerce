<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!--begin::Head-->
<head>
    <base href="../../../" />
    <title>{{ __('auth.metronic_admin_sign_in') }}</title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">{{ __('auth.admin_sign_in') }}</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">{{ __('auth.social_campaigns') }}</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Login options-->
                            <div class="row g-3 mb-9">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!--begin::Google link=-->
                                    <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/google-icon.svg') }}" class="h-15px me-3" />{{ __('auth.sign_in_with_google') }}
                                    </a>
                                    <!--end::Google link=-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!--begin::Apple link=-->
                                    <a href="#" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/apple-black.svg') }}" class="theme-light-show h-15px me-3" />
                                        <img alt="Logo" src="{{ asset('assets/media/svg/brand-logos/apple-black-dark.svg') }}" class="theme-dark-show h-15px me-3" />{{ __('auth.sign_in_with_apple') }}
                                    </a>
                                    <!--end::Apple link=-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Login options-->
                            <!--begin::Separator-->
                            <div class="separator separator-content my-14">
                                <span class="w-125px text-gray-500 fw-semibold fs-7">{{ __('auth.or_with_email') }}</span>
                            </div>
                            <!--end::Separator-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="text" placeholder="{{ __('auth.email') }}" name="email" autocomplete="off" class="form-control bg-transparent" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                <!--end::Email-->
                            </div>
                            <!--end::Input group=-->
                            <div class="fv-row mb-3">
                                <!--begin::Password-->
                                <input type="password" placeholder="{{ __('auth.password') }}" name="password" autocomplete="off" class="form-control bg-transparent" />
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <!--end::Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                                <div></div>
                                <!--begin::Link-->
                                <a href="{{ route('admin.password.request') }}" class="link-primary">{{ __('auth.forgot_password') }}</a>
                                <!--end::Link-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
                                    <span class="indicator-label">{{ __('sign in') }}</span>
                                    <span class="indicator-progress">{{ __('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                            <!--end::Submit button-->

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
                    <a href="{{ url('../../demo1/dist/index.html') }}" class="mb-0 mb-lg-12">
                        <img alt="Logo" src="{{ asset('assets/media/logos/custom-1.png') }}" class="h-60px h-lg-75px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20" src="{{ asset('assets/media/misc/auth-screens.png') }}" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Fast, Efficient and Productive</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-white fs-base text-center">In this kind of post,
                        <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the blogger</a> introduces a person they’ve interviewed
                        <br /> and provides some background information about
                        <a href="#" class="opacity-75-hover text-warning fw-bold me-1">the interviewee</a> and their
                        <br /> work following this is a transcript of the interview.
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script>
        "use strict";

        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var KTSigninGeneral = function() {
            var t, e, i;
            return {
                init: function() {
                    t = document.querySelector("#kt_sign_in_form"),
                    e = document.querySelector("#kt_sign_in_submit"),
                    i = FormValidation.formValidation(t, {
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
                            },
                            password: {
                                validators: {
                                    notEmpty: {
                                        message: "{{ __('The password is required') }}"
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row" })
                        }
                    }),
                    e.addEventListener("click", (function(n) {
                        n.preventDefault(),
                        i.validate().then((function(i) {
                            if (i == "Valid") {
                                e.setAttribute("data-kt-indicator", "on"),
                                e.disabled = !0;

                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('admin.login') }}",
                                    data: {
                                        email: t.querySelector('[name="email"]').value,
                                        password: t.querySelector('[name="password"]').value
                                    },
                                    success: function(data) {
                                        if (data.status == 'success') {
                                            setTimeout((function() {
                                                e.removeAttribute("data-kt-indicator"),
                                                e.disabled = !1,
                                                Swal.fire({
                                                    text: data.message,
                                                    icon: "success",
                                                    timer: 1000,
                                                    showCancelButton: false,
                                                    showConfirmButton: false
                                                }).then((result) => {
                                                    if (result.dismiss === Swal.DismissReason.timer) {
                                                        window.location.href = data.redirect;
                                                    }
                                                })

                                            }), 2000);
                                        } else {
                                            e.removeAttribute("data-kt-indicator"),
                                            e.disabled = !1,
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
                                    },
                                    error: function(data) {
                                        e.removeAttribute("data-kt-indicator"),
                                        e.disabled = !1,
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
                                })
                            } else {
                                Swal.fire({
                                    text: "{{ __('Sorry, looks like there are some errors detected, please try again.') }}",
                                    icon: "error",
                                    buttonsStyling: !1,
                                    confirmButtonText: "{{ __('Ok, got it!') }}",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                })
                            }
                        }))
                    }))
                }
            }
        }();
        KTUtil.onDOMContentLoaded((function() {
            KTSigninGeneral.init()
        }));
        </script>

</body>
{{-- end::Body --}}
</html>
