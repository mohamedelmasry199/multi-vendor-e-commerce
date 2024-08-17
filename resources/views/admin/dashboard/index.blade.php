<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Include Chart.js from a CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@php
    $colors = [
        '#FF6384',
        '#36A2EB',
        '#FFCE56',
        '#4BC0C0',
        '#9966FF',
        '#FF9F40',
        '#FF6F61',
        '#6B5B95',
        '#88B04B',
        '#F7CAC9'
    ];
@endphp

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
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('eCommerce Dashboard') }}</h1>
                <!--end::Title-->
                <!--begin::Breadcrumb-->
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <!--begin::Item-->

                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-400 w-5px h-2px"></span>
                    </li>
                    <!--end::Item-->
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">{{ __('Dashboard') }}</li>
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
            {{-- <form method="GET" action="{{ route('admin.dashboard') }}">
                <div class="row g-5 g-xl-10 mb-xl-10">
                    <div class="col-md-3">
                        <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                    </div>
                </div>
            </form> --}}
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-category-table-toolbar="base">
                       <!--begin::Filter-->
<div class="d-flex align-items-center">
    <!-- Filter Button -->
    <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
        <span class="svg-icon svg-icon-2">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="currentColor" />
            </svg>
        </span>
        {{ __('Filter') }}
    </button>

    <!-- Filter Menu -->
    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px p-5" data-kt-menu="true">
        <div class="px-7 py-5">
            <div class="fs-5 text-dark fw-bold">{{ __('Filter Options') }}</div>
        </div>
        <div class="separator border-gray-200"></div>
        <form method="GET" action="{{ route('admin.dashboard') }}">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                </div>
                <div class="col-12 d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--end::Filter-->



                            <!--begin::Export-->




                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->

                        <!--end::Modal - Add task-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->

                <!--end::Card body-->
            </div>
            <!--begin::Row-->
            <div class="row g-5 g-xl-10 mb-xl-10">
                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ number_format($totalSales, 2) }}</span>
                                    {{-- <span class="badge badge-light-success fs-base">
                                        <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        2.2%
                                    </span> --}}
                                </div>
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">{{ __('Expected Earnings') }}</span>
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-4 d-flex align-items-center">
                            <div class="d-flex flex-center me-5 pt-2">
                                <canvas id="salesChart" style="width: 80px; height: 80px"></canvas>
                            </div>
                            <div class="d-flex flex-column content-justify-center w-100">
                                @foreach($topCategories as $category)
                                    <div class="d-flex fs-6 fw-semibold align-items-center {{ !$loop->last ? 'my-3' : '' }}">
                                        <div class="bullet w-8px h-6px rounded-2 {{ $loop->first ? 'bg-danger' : 'bg-primary' }} me-3"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">{{ $category->category_name }}</div>
                                        <div class="fw-bolder text-gray-700 text-xxl-end">${{ number_format($category->total_sales, 2) }}</div>
                                    </div>
                                @endforeach
                                @if($otherTotalSales > 0)
                                    <div class="d-flex fs-6 fw-semibold align-items-center">
                                        <div class="bullet w-8px h-6px rounded-2 me-3" style="background-color: #E4E6EF"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">{{ __('Others') }}</div>
                                        <div class="fw-bolder text-gray-700 text-xxl-end">${{ number_format($otherTotalSales, 2) }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>



                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ number_format($totalSales, 2) }}</span>
                                    {{-- <span class="badge badge-light-success fs-base">
                                        <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                            <!-- SVG Icon Here -->
                                        </span>
                                        2.2%
                                    </span> --}}
                                </div>
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">{{ __('Best-Selling Products') }}</span>
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-4 d-flex align-items-center">
                            <div class="d-flex flex-center me-5 pt-2">
                                <canvas id="bestSellingChart" style="width: 80px; height: 80px"></canvas>
                            </div>
                            <div class="d-flex flex-column content-justify-center w-100 flex-grow-1">
                                @foreach($bestSellingProducts as $product)
                                    <div class="d-flex product-item align-items-center {{ !$loop->last ? 'my-3' : '' }}">
                                        <div class="bullet me-3" style="background-color: {{ $colors[$loop->index % count($colors)] }}"></div>
                                        <div class="text-gray-500 flex-grow-1 me-4">{{ $product['name'] }}</div>
                                        <div class="fw-bolder text-gray-700 text-xxl-end">${{ number_format($product['total_sales'], 2) }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>





                    <!--end::Card widget 4-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                    <!--begin::Card widget 6-->
                    <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Currency-->
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">$</span>
                                    <!--end::Currency-->
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ number_format($averageDailySales, 2) }}</span>
                                    <!--end::Amount-->
                                    <!--begin::Badge-->
                                    <span class="badge badge-light-success fs-base">
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                        <span class="svg-icon svg-icon-5 svg-icon-success ms-n1">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->2.6%</span>
                                    <!--end::Badge-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">{{ __('Average Daily Sales') }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex align-items-end px-0 pb-0">
                            <div id="kt_card_widget_6_chart" class="w-100" style="height: 80px"
                                 data-sales='@json(array_values($salesData))'
                                 data-labels='@json(array_keys($salesData))'></div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 6-->
                    <div class="card card-flush h-md-50 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">{{ $totalUsers }}</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">{{ __('Users') }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex flex-column justify-content-end pe-0">
                            <!--begin::Title-->
                            <!--end::Title-->
                            <!--begin::Statistics-->
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-gray-600">{{ __('Categories') }} :</span>
                                <span class="text-gray-800 fw-bold me-3">{{ $totalCategories }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-gray-600">{{ __('Products') }} :</span>
                                <span class="text-gray-800 fw-bold me-3">{{ $totalProducts }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-gray-600">{{ __('Orders') }} :</span>
                                <span class="text-gray-800 fw-bold me-3">{{ $totalOrders }}</span>
                            </div>
                            <!--end::Statistics-->
                        </div>
                        <!--end::Card body-->
                    </div>

                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                    <div class="card card-flush overflow-hidden h-md-100">
                        <!--begin::Header-->
                        <div class="card-header py-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-dark">{{ __('Sales This Month') }}</span>
                                <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ __('Users from all channels') }}</span>
                            </h3>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                            <!--begin::Statistics-->
                            <div class="px-9 mb-5">
                                <!--begin::Statistics-->
                                <div class="d-flex mb-2">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1">$</span>
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">{{ number_format($salesThisMonth, 2) }}</span>
                                </div>
                                <!--end::Statistics-->
                                <!--begin::Description-->
                                {{-- <span class="fs-6 fw-semibold text-gray-400">Another $48,346 to Goal</span> --}}
                                <!--end::Description-->
                            </div>
                            <!--end::Statistics-->
                            <!--begin::Chart-->
                            <div id="kt_charts_widget_3" class="min-h-auto ps-4 pe-6" style="height: 300px"
                                 data-sales="{{ json_encode(array_values($salesData)) }}"
                                 data-labels="{{ json_encode(array_keys($salesData)) }}">
                            </div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

        <!--begin::Row for latest 5 orders, users, products-->
<div class="row g-5 g-xl-10 mb-xl-10">
    <!-- Latest 5 Orders -->
    <div class="col-xl-4">
        <div class="card card-flush h-xl-100">
            <div class="card-header py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">{{ __('Latest Orders') }}</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ __('Latest 5 orders') }}</span>
                </h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 w-50px">{{ __('ID') }}</th>
                                <th class="p-0 min-w-150px">{{ __('Customer') }}</th>
                                <th class="p-0 min-w-90px">{{ __('Total') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestOrders as $order)
                                <tr>
                                    <td><a href="{{ route('admin.orders.show', $order->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $order->id }}</a></td>
                                    <td>
                                        @if($order->user)
                                            <a href="{{ route('admin.user.show', $order->user->id) }}" class="text-gray-800 text-hover-primary fw-bold">
                                                {{ $order->user->name }}
                                            </a>
                                        @else
                                            <span class="text-muted">{{ __('No User') }}</span>
                                        @endif
                                    </td>

                                    <td>${{ number_format($order->total_price, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest 5 Users -->
    <div class="col-xl-4">
        <div class="card card-flush h-xl-100">
            <div class="card-header py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">{{ __('New Users') }}</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ __('Latest 5 users') }}</span>
                </h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 min-w-50px">{{ __('ID') }}</th>
                                <th class="p-0 min-w-150px">{{ __('Name') }}</th>
                                <th class="p-0 min-w-150px">{{ __('Email') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestUsers as $user)
                                <tr>
                                    <td><a href="{{ route('admin.user.show', $user->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $user->id }}</a></td>
                                    <td><a href="{{ route('admin.user.show', $user->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $user->name }}</a></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest 5 Products -->
    <div class="col-xl-4">
        <div class="card card-flush h-xl-100">
            <div class="card-header py-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold text-dark">{{ __('New Products') }}</span>
                    <span class="text-gray-400 mt-1 fw-semibold fs-6">{{ __('Latest 5 products') }}</span>
                </h3>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                        <thead>
                            <tr class="fs-7 fw-bold text-gray-400 border-bottom-0">
                                <th class="p-0 min-w-80px">{{ __('ID') }}</th>
                                <th class="p-0 min-w-150px">{{ __('Name') }}</th>
                                <th class="p-0 min-w-90px">{{ __('Price') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestProducts as $product)
                                <tr>
                                    <td><a href="{{ route('admin.items.show', $product->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $product->id }}</a></td>
                                    <td><a href="{{ route('admin.items.show', $product->id) }}" class="text-gray-800 text-hover-primary fw-bold">{{ $product->name_ar }}</a></td>
                                    <td>${{ number_format($product->price_after_offer ? $product->price_after_offer : $product->price_before_offer, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Row-->
        </div>
</div>
<!--end::Content wrapper-->
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('salesChart').getContext('2d');
        var chartData = {
            labels: [
                @foreach($topCategories as $category)
                    "{{ $category->category_name }}",
                @endforeach
                @if($otherTotalSales > 0)
                    "{{ __('Others') }}"
                @endif
            ],
            datasets: [{
                data: [
                    @foreach($topCategories as $category)
                        {{ $category->total_sales }},
                    @endforeach
                    @if($otherTotalSales > 0)
                        {{ $otherTotalSales }}
                    @endif
                ],
                backgroundColor: [
                    @foreach($topCategories as $category)
                        "{{ $loop->first ? '#FF6384' : '#36A2EB' }}",
                    @endforeach
                    @if($otherTotalSales > 0)
                        "#E4E6EF"
                    @endif
                ]
            }]
        };

        var salesChart = new Chart(ctx, {
            type: 'doughnut',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('bestSellingChart').getContext('2d');

        // Define color palette
        var colors = @json($colors);

        // Generate the chart data
        var chartData = {
            labels: [
                @foreach($bestSellingProducts as $product)
                    "{{ $product['name'] }}",
                @endforeach
            ],
            datasets: [{
                data: [
                    @foreach($bestSellingProducts as $product)
                        {{ $product['total_sales'] }},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach($bestSellingProducts as $product)
                        "{{ $colors[$loop->index % count($colors)] }}",
                    @endforeach
                ]
            }]
        };

        var bestSellingChart = new Chart(ctx, {
            type: 'doughnut',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: true,
                aspectRatio: 1,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>

