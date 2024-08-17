@extends('admin.app')
@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ __('Admins List') }}</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-muted text-hover-primary">{{ __('Home') }}</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->

                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">{{ __('Admins') }}</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">

                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                            rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" id="search-user" class="form-control form-control-solid w-250px ps-14"
                                    placeholder="{{ __('Search user') }}" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <!--begin::Card toolbar-->
                        <div class="card-toolbar">
                            <!--begin::Toolbar-->
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <!--begin::Filter-->
                            <!--begin::Filter-->
<!-- Filter Button -->
<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    <span class="svg-icon svg-icon-2">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor"/>
        </svg>
    </span>
    {{ __('Filter') }}
</button>

<!-- Filter Menu -->
<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
    <div class="px-7 py-5">
        <div class="fs-5 text-dark fw-bold">{{ __('Filter Options') }}</div>
    </div>
    <div class="separator border-gray-200"></div>
    <form id="filterForm" action="{{ route('admin.admins.filter') }}" method="GET">
        <div class="px-7 py-5">
            <div class="mb-10">
                <label class="form-label fs-6 fw-semibold">{{ __('Status') }}:</label>
                <select class="form-select form-select-solid fw-bold" name="status" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                    <option></option>
                    <option value="active">{{ __('Active') }}</option>
                    <option value="not_active">{{ __('Not active') }}</option>
                </select>
            </div>

            <div class="mb-10">
                <label class="form-label fs-6 fw-semibold">{{ __('Country') }}:</label>
                <select id="country" name="country" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                    <option></option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name_ar }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-10">
                <label class="form-label fs-6 fw-semibold">{{ __('City') }}:</label>
                <select id="city" name="city" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true">
                    <option></option>
                </select>
            </div>

            <div class="d-flex justify-content-end">
                <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true">Reset</button>
                <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" id="applyFilterBtn">Apply</button>
            </div>
        </div>
    </form>
</div>

<!--end::Menu 1-->
<!--end::Filter-->

                                <!--begin::Export-->

                                <!--begin::Export Button-->
                                <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                    data-bs-target="#exportModal">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                                    <!--end::Svg Icon-->{{ __('Export') }}
                                </button>
                                <!--end::Export Button-->

                                <!--begin::Modal-->
                                <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ __('Export Confirmation') }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{ __('Are you sure you want to export?') }}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                                <button type="button" class="btn btn-primary"
                                                    id="confirmExportButton">{{ __('Export') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Export-->

                                <button type="button" class="btn btn-primary"
                                    onclick="window.location='{{ route('admin.admins.create') }}';">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2"
                                                rx="1" transform="rotate(-90 11.364 20.364)"
                                                fill="currentColor" />
                                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    {{ __('Add Admin') }}
                                </button>

                                <!--end::Add user-->
                            </div>
                            <!--end::Toolbar-->
                            <!--begin::Group actions-->

                            <!--end::Modal - Add task-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
                                <!-- Table Head -->
                                <thead>
                                    <!-- Table Row -->
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                    data-kt-check-target="#kt_table_users .form-check-input"
                                                    value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-125px">{{ __('Admin') }}</th>
                                        <th class="min-w-100px">{{ __('Phone') }}</th>
                                        <th class="min-w-100px">{{ __('Country') }}</th>
                                        <th class="min-w-100px">{{ __('City') }}</th>
                                        <th class="min-w-100px">{{ __('Address') }}</th>
                                        <th class="min-w-100px">{{ __('Status') }}</th>
                                        <th class="min-w-100px">{{ __('Role') }}</th>
                                        <th class="text-end min-w-100px">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <!-- Table Body -->
                                <tbody class="text-gray-600 fw-semibold">
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" />
                                                </div>
                                            </td>
                                            <td class="d-flex align-items-center">
                                                <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                    <a href="{{ route('admin.admins.show', ['admin' => $user->id]) }}">
                                                        <div class="symbol-label">
                                                            <img src="{{ $user->image }}" alt="{{ $user->name }}"
                                                                class="w-100" />
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="{{ route('admin.admins.show', ['admin' => $user->id]) }}"
                                                        class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                                    <span>{{ $user->email }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->country->name_ar ?? '' }}</td>
                                            <td>{{ $user->city->name_ar ?? '' }}</td>
                                            <td>{{ $user->address }}</td>

                                            <td>
                                                @if ($user->status == 'active')
                                                    <div class="badge badge-light-success fw-bolder">{{ __('Active') }}
                                                    </div>
                                                @elseif($user->status !== 'active')
                                                    <div class="badge badge-light-warning fw-bolder">
                                                        {{ __('Not Active') }}</div>
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($user->getRoleNames()))
                                                  @foreach($user->getRoleNames() as $v)
                                                     <label class="badge badge-secondary text-dark">{{ $v }}</label>
                                                  @endforeach
                                                @endif
                                              </td>
                                            <td class="text-end">
                                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                                    data-kt-menu-trigger="click"
                                                    data-kt-menu-placement="bottom-end">{{ __('Actions') }}
                                                    <span class="svg-icon svg-icon-5 m-0">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                </a>
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('admin.admins.edit', ['admin' => $user->id]) }}"
                                                            class="menu-link px-3">{{ __('Edit') }}</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 delete_alert"
                                                            data-id="{{ $user->id }}">{{ __('Delete') }}</a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        @if ($user->status == 'active')
                                                            <a href="#" class="menu-link px-3 active_alert"
                                                                data-value="not_active"
                                                                data-id="{{ $user->id }}">{{ __('Disable') }}</a>
                                                        @else
                                                            <a href="#" class="menu-link px-3 active_alert"
                                                                data-value="active"
                                                                data-id="{{ $user->id }}">{{ __('Enable') }}</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <ul class="pagination pagination-circle" id="pagination">
                            {{ $users->links('admin.partials.paginate') }}
                        </ul>


                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    $('select[data-kt-select2=true]').select2({
        allowClear: true,
        placeholder: function() {
            $(this).data('placeholder');
        }
    });

    var selectedCountryID = $('#country').val();
    var selectedCityID = "{{ isset($user) ? $user->city_id : null }}";
    if (selectedCountryID) {
        loadCities(selectedCountryID, selectedCityID);
    }
});
</script>

    <script type="text/javascript">
        $(document).ready(function() {
            function fetchUsers(keyword, page = 1) {
                $.ajax({
                    url: '{{ route('admin.admins.search') }}?page=' + page,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        keyword: keyword
                    },
                    success: function(response) {
                        var tableBody = $('#kt_table_users tbody');
                        tableBody.empty();
                        $.each(response.users.data, function(index, admin) {
                            var roleLabel = '';
                        if (admin.roles && admin.roles.length > 0) {
                            roleLabel = '<label class="badge badge-secondary text-dark">' + admin.roles[0].name + '</label>';
                        }

                            var statusText = admin.status == 'active' ? '{{ __('Active') }}' :
                                '{{ __('Not Active') }}';
                            var statusClass = admin.status == 'active' ? 'badge-light-success' :
                                'badge-light-warning';
                            var enableDisableAction = admin.status == "active" ?
                                '<a href="#" class="menu-link px-3 active_alert" data-value="not_active" data-id="' +
                                admin.id + '">{{ __('Disable') }}</a>' :
                                '<a href="#" class="menu-link px-3 active_alert" data-value="active" data-id="' +
                                admin.id + '">{{ __('Enable') }}</a>';
                            var row = '<tr>' +
                                '<td><div class="form-check form-check-sm form-check-custom form-check-solid"><input class="form-check-input" type="checkbox" value="1" /></div></td>' +
                                '<td class="d-flex align-items-center">' +
                                '<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">' +
                                '<a href="/admin/admins/' + admin.id + '">' +
                                '<div class="symbol-label">' +
                                '<img src="' + admin.image + '" alt="' + admin.name +
                                '" class="w-100" />' +
                                '</div></a></div>' +
                                '<div class="d-flex flex-column">' +
                                '<a href="/admin/admins/' + admin.id +
                                '" class="text-gray-800 text-hover-primary mb-1">' + admin.name +
                                '</a>' +
                                '<span>' + admin.email + '</span></div></td>' +
                                '<td>' + admin.phone + '</td>' +
                                '<td>' + (admin.city ? admin.city.country.name_ar : '') +
                                '</td>' +
                                '<td><div class="badge badge-light fw-bold">' + (admin.city ?
                                    admin.city.name_ar : '') + '</div></td>' +
                                '<td>' + admin.address + '</td>' +
                                '<td><div class="badge ' + statusClass + ' fw-bolder">' +
                                statusText + '</div></td>' +
                                '<td>' + roleLabel + '</td>' +
                                '<td class="text-end"><a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('Actions') }}' +
                                '<span class="svg-icon svg-icon-5 m-0"><!-- SVG icon here --></span></a>' +
                                '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">' +
                                '<div class="menu-item px-3"><a href="/admin/admins/' + admin.id +
                                '/edit" class="menu-link px-3">{{ __('Edit') }}</a></div>' +
                                '<div class="menu-item px-3"><a href="#" class="menu-link px-3 delete_alert" data-id="' +
                                admin.id + '">{{ __('Delete') }}</a></div>' +
                                '<div class="menu-item px-3">' + enableDisableAction +
                                '</div>' +
                                '</div></td></tr>';
                            tableBody.append(row);
                        });

                        $('#pagination').html(response.links);
                        KTMenu.createInstances();
                    }
                });
            }

            $('#search-user').on('keyup', function() {
                var keyword = $(this).val();
                fetchUsers(keyword);
            });

            $(document).on('click', '#pagination a', function(event) {
                event.preventDefault();
                var keyword = $('#search-user').val();
                var page = $(this).attr('href').split('page=')[1];
                fetchUsers(keyword, page);
            });
        });
    </script>
    <script>
        "use strict"
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.delete_alert', function(e) {
            e.preventDefault();

            var user_id = $(this).data('id');
            Swal.fire({
                text: "{{ __('Are you sure to delete this item ?') }}",
                icon: "warning",
                buttonsStyling: false,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes') }}",
                cancelButtonText: "{{ __('No') }}",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-danger"
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ url('admin/admins') }}/" + user_id,
                        data: {
                            _method: 'DELETE',
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status_code == 200) {
                                location.reload();
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
                        error: function(data) {
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
                }
            })
        });
        $(document).ready(function() {
            $(document).on('click', '.active_alert', function() {
                event.preventDefault();

                var coupon_id = $(this).data('id');
                var value = $(this).data('value');

                Swal.fire({
                    text: "{{ __('Are you sure to change status this user ?') }}",
                    icon: "success",
                    buttonsStyling: !1,
                    showCloseButton: true,
                    showCancelButton: true,
                    confirmButtonText: "{{ __('Yes') }}",
                    cancelButtonText: "{{ __('No') }}",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-danger"
                    }
                }).then((function(e) {
                    if (e.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.active_admins') }}",
                            data: {
                                'id': coupon_id,
                                'value': value,
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.status_code == 200) {
                                    location.reload();
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
                            error: function(data) {
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
                    }
                }));
            });

        });
    </script>

    <script>
        document.getElementById('confirmExportButton').addEventListener('click', function() {
            window.location.href = '{{ route('admin.admins.export') }}';
        });
    </script>
@endsection
