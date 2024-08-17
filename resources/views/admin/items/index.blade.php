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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('Items') }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        <a href="{{ route('admin.items.index') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
                    </li>
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
                            <input type="text" id="search-item" class="form-control form-control-solid w-250px ps-14"
                                placeholder="{{ __('Search item') }}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-item-table-toolbar="base">

                        <!--begin::Filter-->
                   <div class="d-flex align-items-center">
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
                  <form id="filterForm" action="{{ route('admin.items.filter') }}" method="GET">
                      <div class="px-7 py-5">
                          <div class="mb-10">
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="offers_filter" name="offers_filter">
                                  <label class="form-check-label" for="offers_filter">
                                      {{ __('Items with Offers') }}
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="no_offers_filter" name="no_offers_filter">
                                  <label class="form-check-label" for="no_offers_filter">
                                      {{ __('Items without Offers') }}
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="deleted_filter" name="deleted_filter">
                                  <label class="form-check-label" for="deleted_filter">
                                      {{ __('Deleted Items') }}
                                  </label>
                              </div>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="not_deleted_filter" name="not_deleted_filter">
                                  <label class="form-check-label" for="not_deleted_filter">
                                      {{ __('Not Deleted Items') }}
                                  </label>
                              </div>

                              <div class="mb-10 mt-5">
                                  <label for="price_filter" class="form-label">{{ __('Price Filter') }}</label>
                                  <select id="price_filter" name="price_filter" class="form-select">
                                      <option value="">{{ __('Select Price Filter') }}</option>
                                      <option value="equal">{{ __('Equal To') }}</option>
                                      <option value="greater">{{ __('Greater Than or Equal To') }}</option>
                                      <option value="less">{{ __('Less Than') }}</option>
                                  </select>
                                  <input type="number" id="price_value" name="price_value" class="form-control mt-2" placeholder="{{ __('Enter Price') }}">
                              </div>
                          </div>

                          <div class="d-flex justify-content-end">
                              <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true">{{ __('Reset') }}</button>
                              <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true" id="applyFilterBtn">{{ __('Apply') }}</button>
                          </div>
                      </div>
                  </form>
              </div>
        </div>
<!--end::Filter-->



                      <!--begin::Export-->

                            <!--begin::Export Button-->
<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#exportModal">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
    <span class="svg-icon svg-icon-2">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M10 18H14V13H19L12 4L5 13H10V18Z" fill="black"/>
        </svg>
    </span>
    <!--end::Svg Icon-->{{ __('Export') }}
</button>
<!--end::Export Button-->

<!--begin::Modal-->
<div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Export Confirmation') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to export?') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                <button type="button" class="btn btn-primary" id="confirmExportButton">{{ __('Export') }}</button>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('confirmExportButton').addEventListener('click', function() {
        fetch('{{ route('admin.items.export') }}')
            .then(response => {
                if (response.ok) {
                    return response.blob();
                } else {
                    throw new Error('Export failed');
                }
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = 'items_data.csv';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);

                Swal.fire({
                    icon: 'success',
                    title: '{{ __("Export Successful") }}',
                    text: '{{ __("Your data has been exported successfully.") }}'
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("Export Failed") }}',
                    text: error.message
                });
            });
    });
</script>
<!--end::Modal-->
                     <!--end::Export-->

                            <button type="button" class="btn btn-primary"
                                onclick="window.location='{{ route('admin.items.create') }}';">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                            transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ __('Add Item') }}
                            </button>
                        </div>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                   <!--begin::Table-->
<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_items">
        <!-- Table Head -->
        <thead>
            <!-- Table Row -->
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                <th class="w-10px pe-2">
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                            data-kt-check-target="#kt_table_items .form-check-input"
                            value="1" />
                    </div>
                </th>
                <th class="min-w-125px">{{ __('Item') }}</th>
                <th class="min-w-100px">{{ __('Category') }}</th>
                <th class="min-w-100px">{{ __('Price Before Offer') }}</th>
                <th class="min-w-100px">{{ __('Price After Offer') }}</th>
                <th class="min-w-100px">{{ __('Status') }}</th>
                <th class="text-end min-w-100px">{{ __('Actions') }}</th>
            </tr>
        </thead>
        <!-- Table Body -->
        <tbody class="text-gray-600 fw-semibold">
            @foreach ($items as $item)
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td class="d-flex align-items-center">
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="{{ route('admin.items.show', ['item' => $item->id]) }}">
                                <div class="symbol-label">
                                    <img src="{{ $item->getImgPath('main_image') }}" alt="{{ $item->name_en }}"
                                        class="w-100" />
                                </div>
                            </a>
                        </div>
                        <div class="d-flex flex-column">
                            <a href="{{ route('admin.items.show', ['item' => $item->id]) }}"
                                class="text-gray-800 text-hover-primary mb-1">{{ $item->name_en }}</a>
                            <span>{{ $item->name_ar }}</span>
                        </div>
                    </td>
                    <td>{{ $item->category->name_ar ?? '' }}</td>
                    <td>{{ $item->price_before_offer }}</td>
                    <td>{{ $item->price_after_offer }}</td>
                    <td>
                        @if ($item->deleted_at)
                            <div class="badge badge-light-warning fw-bolder">{{ __('Inactive') }}</div>
                        @else
                            <div class="badge badge-light-success fw-bolder">{{ __('Active') }}</div>
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
                                <a href="{{ route('admin.items.edit', ['item' => $item->id]) }}"
                                    class="menu-link px-3">{{ __('Edit') }}</a>
                            </div>
                            {{-- <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3 delete_alert"
                                    data-id="{{ $item->id }}">{{ __('Delete') }}</a>
                            </div> --}}
                            <div class="menu-item px-3">
                                @if ($item->deleted_at)
                                    <a href="#" class="menu-link px-3 active_alert"
                                        data-value="active"
                                        data-id="{{ $item->id }}">{{ __('Enable') }}</a>
                                @else
                                    <a href="#" class="menu-link px-3 active_alert"
                                        data-value="not_active"
                                        data-id="{{ $item->id }}">{{ __('Disable') }}</a>
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
    {{ $items->links('admin.partials.paginate') }}
</ul>
<!--end::Table-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script>
    document.getElementById('confirmExportButton').addEventListener('click', function() {
        fetch('{{ route('admin.items.export') }}')
            .then(response => {
                if (response.ok) {
                    return response.blob();
                } else {
                    throw new Error('Export failed');
                }
            })
            .then(blob => {
                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.style.display = 'none';
                a.href = url;
                a.download = 'items_data.csv';
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);

                Swal.fire({
                    icon: 'success',
                    title: '{{ __("Export Successful") }}',
                    text: '{{ __("Your data has been exported successfully.") }}'
                }).then(() => {
                    location.reload();
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: '{{ __("Export Failed") }}',
                    text: error.message
                });
            });
    });
</script> --}}
<script>
    "use strict"
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.delete_alert', function(e) {
        e.preventDefault();

        var item_id = $(this).data('id');
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
                    url: "{{ url('admin/items') }}/" + item_id,
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
                            url: "{{ route('admin.active_items') }}",
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
<script type="text/javascript">
    $(document).ready(function() {
        function fetchItems(keyword, page = 1) {
            $.ajax({
                url: '{{ route('admin.items.search') }}?page=' + page,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    keyword: keyword
                },
                success: function(response) {
                    var tableBody = $('#kt_table_items tbody');
                    tableBody.empty();
                    $.each(response.items.data, function(index, item) {
                        var statusText = item.deleted_at == null ? '{{ __('Active') }}' : '{{ __('Inactive') }}';
                        var statusClass = item.deleted_at == null ? 'badge-light-success' : 'badge-light-warning';

                        var mainImagePath = item.main_image_path;

                        var row = '<tr>' +
                            '<td><div class="form-check form-check-sm form-check-custom form-check-solid"><input class="form-check-input" type="checkbox" value="1" /></div></td>' +
                            '<td class="d-flex align-items-center">' +
                            '<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">' +
                            '<a href="/admin/items/' + item.id + '">' +
                            '<div class="symbol-label">' +
                            '<img src="' + mainImagePath + '" alt="' + item.name_en + '" class="w-100" />' +
                            '</div></a></div>' +
                            '<div class="d-flex flex-column">' +
                            '<a href="/admin/items/' + item.id + '" class="text-gray-800 text-hover-primary mb-1">' + item.name_ar + '</a>' +
                            '<span>' + item.description_ar + '</span></div></td>' +
                            '<td>' + item.category.name_ar + '</td>' +
                            '<td>' + item.price_before_offer + '</td>' +
                            '<td>' + item.price_after_offer + '</td>' +
                            '<td><div class="badge ' + statusClass + ' fw-bolder">' + statusText + '</div></td>' +
                            '<td class="text-end"><a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('Actions') }}' +
                            '<span class="svg-icon svg-icon-5 m-0"><!-- SVG icon here --></span></a>' +
                            '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">' +
                            '<div class="menu-item px-3"><a href="/admin/items/' + item.id + '/edit" class="menu-link px-3">{{ __('Edit') }}</a></div>' +
                            '<div class="menu-item px-3"><a href="#" class="menu-link px-3 delete_alert" data-id="' + item.id + '">{{ __('Delete') }}</a></div>' +
                            '</div></td></tr>';
                        tableBody.append(row);
                    });

                    $('#pagination').html(response.links);
                    KTMenu.createInstances();
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }

        $('#search-item').on('keyup', function() {
            var keyword = $(this).val();
            fetchItems(keyword);
        });

        $(document).on('click', '#pagination a', function(event) {
            event.preventDefault();
            var keyword = $('#search-item').val();
            var page = $(this).attr('href').split('page=')[1];
            fetchItems(keyword, page);
        });
    });
</script>
