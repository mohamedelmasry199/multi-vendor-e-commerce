<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
    .product-image {
        width: 50px;
        height: 50px;
        object-fit: cover;
        border-radius: 4px;
    }

    </style>

@extends('admin.app')

@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        @if(isset($category))
                            @if(Route::currentRouteName() == 'admin.orders.edit')
                                {{ __('Edit Orders') }}
                            @else
                                {{ __('Show Orders') }}
                            @endif
                        @else
                            {{ __('Create Orders') }}
                        @endif
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.orders.index') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ __('Create Orders') }}</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">{{ __('View Orders') }}</a>
                </div>
            </div>
        </div>
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        <form id="kt_account_profile_details_form" class="form d-flex flex-column flex-lg-row" method="POST" action="{{ isset($order) ? route('admin.orders.update', $order->id) : route('admin.orders.store') }}">
            @csrf
            @if(isset($order))
                @method('PUT')
            @endif
            <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ __('Order Details') }}</h2>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-10">
                            <div class="fv-row">
                                <label class="form-label">{{ __('Order ID') }}</label>
                                <div class="fw-bold fs-3">#{{ isset($order) ? $order->id : __('New') }}</div>
                            </div>
                            <div class="fv-row">
                                <label class="required form-label">{{ __('Payment Method') }}</label>
                                <select class="form-control form-control-lg form-control-solid" name="payment_method" {{ Route::currentRouteName() == 'admin.orders.show' ? 'disabled' : '' }}>
                                    <option></option>
                                    <option value="cash" {{ isset($order) && $order->payment_method == 'cash' ? 'selected' : '' }}>{{ __('Cash') }}</option>
                                    <option value="credit_card" {{ isset($order) && $order->payment_method == 'credit_card' ? 'selected' : '' }}>{{ __('Credit Card') }}</option>
                                    <option value="paypal" {{ isset($order) && $order->payment_method == 'paypal' ? 'selected' : '' }}>{{ __('Paypal') }}</option>
                                </select>
                                <div class="text-muted fs-7">{{ __('Set the payment method of the order.') }}</div>
                            </div>
                            <div class="fv-row">
                                <label class="required form-label">{{ __('Order Date') }}</label>
                                <input id="order-date" name="created_at" placeholder="{{ __('Select a date') }}" class="form-control form-control-lg form-control-solid" value="{{ isset($order) ? $order->created_at->format('Y-m-d') : now()->format('Y-m-d') }}" {{ Route::currentRouteName() == 'admin.orders.show' ? 'disabled' : '' }}/>
                                <div class="text-muted fs-7">{{ __('Set the date of the order to process.') }}</div>
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    flatpickr("#order-date", {
                                        dateFormat: "Y-m-d",
                                        enableTime: false,
                                        disableMobile: true
                                    });
                                });
                            </script>

<div class="fv-row">
    <label class="required form-label">{{ __('Order Status') }}</label>
    <select name="status" class="form-control form-control-lg form-control-solid" {{ Route::currentRouteName() == 'admin.orders.show' ? 'disabled' : '' }}>
        @php
            $statuses = ['pending', 'approved', 'done', 'canceled'];
            $currentStatus = isset($order) ? $order->status : old('status');
        @endphp
        @foreach($statuses as $status)
            <option value="{{ $status }}" {{ $currentStatus == $status ? 'selected' : '' }}>
                {{ ucfirst($status) }}
            </option>
        @endforeach
    </select>
</div>

                            <div class="fv-row">
                                <label class="required form-label">{{ __('Price') }}</label>
                                <input type="text" name="price" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Price') }}" value="{{ isset($order) ? $order->price : old('price') }}" {{ Route::currentRouteName() == 'admin.orders.show' ? 'disabled' : '' }} />
                            </div>
                            <div class="fv-row">
                                <label class="required form-label">{{ __('Taxes') }}</label>
                                <input type="text" name="taxes" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Taxes') }}" value="{{ isset($order) ? $order->taxes : old('taxes') }}" {{ Route::currentRouteName() == 'admin.orders.show' ? 'disabled' : '' }} />
                            </div>
                            <div class="fv-row">
                                <label class="required form-label">{{ __('Commission') }}</label>
                                <input type="text" name="commission" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Commission') }}" value="{{ isset($order) ? $order->commission : old('commission') }}" {{ Route::currentRouteName() == 'admin.orders.show' ? 'disabled' : '' }} />
                            </div>
                            <div class="fv-row">
                                <label class="required form-label">{{ __('Total Price') }}</label>
                                <input type="text" name="total_price" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Total Price') }}" value="{{ isset($order) ? $order->total_price : old('total_price') }}" {{ Route::currentRouteName() == 'admin.orders.show' ? 'disabled' : '' }} />
                            </div>
                            <div class="fv-row">
                                <label class="required form-label">{{ __('User') }}</label>
                                @if(Route::currentRouteName() == 'admin.orders.show')
                                    <input type="hidden" name="user_id" value="{{ @$order->user->id }}">
                                    <select id="user" name="user_disabled" class="form-control form-control-lg form-control-solid" disabled>
                                        <option value="{{ @$order->user->id }}">{{ @$order->user->name }}</option>
                                    </select>
                                @else
                                    <select id="user" name="user_id" class="form-control form-control-lg form-control-solid">
                                        @if(isset($order) && $order->user)
                                            <option value="{{ $order->user->id }}">{{ $order->user->name }}</option>
                                        @endif
                                    </select>
                                    <input type="text" id="user-search" class="form-control form-control-lg form-control-solid mt-2" placeholder="{{ __('Search User') }}">
                                    <div id="user-search-results" class="list-group mt-2"></div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                <div class="card card-flush py-4">
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{ __('Select Products') }}</h2>
                        </div>
                    </div>
                    <div class="card card-flush py-4">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Total Price') }}</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="kt_ecommerce_edit_order_total_price">{{ $order->price }}</div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-10">
                            <div>
                                <label class="form-label">{{ __('Add products to this order') }}</label>
                                <div class="row row-cols-1 row-cols-xl-3 row-cols-md-2 border border-dashed rounded pt-3 pb-1 px-2 mb-5 mh-300px overflow-scroll" id="kt_ecommerce_edit_order_selected_products">
                                    @if(isset($order))
                                    @foreach($order->orderItems as $orderItem)
                                        <div class="col my-2 order-product" data-product-id="{{ $orderItem->product_id }}">
                                            <div class="d-flex align-items-center border border-dashed p-3 rounded bg-white">
                                                <div class="ms-5">
                                                    <a href="{{ route('admin.items.show',['item'=>$orderItem->product_id]) }}" class="symbol symbol-50px" onclick="showProductDetails({{ $orderItem->id }})">
                                                        <span class="symbol-label" style="background-image:url('{{ $orderItem->product->getImgPath('main_image') }}');"></span>
                                                    </a>
                                                    <a href="{{ route('admin.items.show',['item'=>$orderItem->product_id]) }}" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{ $orderItem->product->name_ar }}</a>
                                                    <div class="fw-semibold fs-7">{{ __('Price') }}: $<span class="product-price">{{ $orderItem->price }}</span></div>
                                                    <div class="text-muted fs-7">{{ __('SKU') }}: {{ $orderItem->id }}</div>
                                                    <div class="mt-2">
                                                        <input type="hidden" name="products[{{ $orderItem->id }}][id]" value="{{ $orderItem->product_id }}">
                                                        <input type="hidden" name="products[{{ $orderItem->id }}][price]" value="{{ $orderItem->price }}">
                                                        <input type="number" name="products[{{ $orderItem->id }}][quantity]" class="form-control product-quantity" value="{{ $orderItem->quantity }}" min="1" {{ Route::currentRouteName() == 'admin.orders.show' ? 'disabled' : '' }}/>
                                                    </div>
                                                    @if(Route::currentRouteName() != 'admin.orders.show')
                                                    <button type="button" class="btn btn-sm btn-danger mt-2 remove-product">{{ __('Remove') }}</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                </div>
                            </div>
                            @if(Route::currentRouteName() != 'admin.orders.show')
                            <div>
                                <label class="form-label">{{ __('Available products') }}</label>
                                <input type="text" id="product-search" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Search Product') }}">
                                <div id="product-search-results" class="list-group mt-2"></div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @if(Route::currentRouteName() != 'admin.orders.show')
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                        <span class="indicator-label">{{ __('Save Changes') }}</span>
                        <span class="indicator-progress">{{ __('Please wait') }}...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                @endif
            </div>
        </form>
    </div>
</div>

    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('product-search');
        const searchResults = document.getElementById('product-search-results');
        const selectedProductsContainer = document.getElementById('kt_ecommerce_edit_order_selected_products');
        const totalPriceElement = document.getElementById('kt_ecommerce_edit_order_total_price');
        const totalPriceFormElement = document.querySelector('input[name="total_price"]');
        const priceInput = document.querySelector('input[name="price"]');
        const commissionInput = document.querySelector('input[name="commission"]');
        const taxInput = document.querySelector('input[name="taxes"]');
        const baseUrl = "{{ route('admin.items.show', ['item' => '__ITEM_ID__']) }}";

        searchInput.addEventListener('keyup', function () {
            const query = searchInput.value;
            if (query.length > 0) {
                fetch("{{ route('admin.products.search') }}?query=" + query)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        data.forEach(product => {
                            const productPrice = product.price_after_offer ? product.price_after_offer : product.price_before_offer;
                            const productItem = `
                                <div class="col my-2 available-product" data-product-id="${product.id}">
                                    <div class="d-flex align-items-center border border-dashed p-3 rounded bg-white">
                                        <a href="${baseUrl.replace('__ITEM_ID__', product.id)}" class="symbol symbol-50px">
                                            <span class="symbol-label" style="background-image: url('${product.image_url}');"></span>
                                        </a>
                                        <div class="ms-5">
                                            <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold">${product.name}</a>
                                            <div class="fw-semibold fs-7">Price: $<span class="product-price">${productPrice}</span></div>
                                            <div class="mt-2">
                                                <input class="form-check-input add-product-checkbox" type="checkbox" value="${product.id}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            searchResults.insertAdjacentHTML('beforeend', productItem);
                        });

                        document.querySelectorAll('.add-product-checkbox').forEach(checkbox => {
                            checkbox.addEventListener('change', function () {
                                const productId = this.value;
                                const productElement = this.closest('.available-product');
                                const productName = productElement.querySelector('.text-hover-primary').innerText;
                                const productPrice = parseFloat(productElement.querySelector('.product-price').innerText);
                                const productImage = productElement.querySelector('.symbol-label').style.backgroundImage.slice(5, -2);

                                if (this.checked) {
                                    addProductToSelectedList(productId, productName, productPrice, productImage);
                                } else {
                                    decrementProductQuantity(productId);
                                }
                                updatePrices();
                            });
                        });
                    });
            }
        });

        function addProductToSelectedList(productId, productName, productPrice, productImage) {
            const existingProduct = selectedProductsContainer.querySelector(`.order-product[data-product-id="${productId}"]`);
            if (existingProduct) {
                const quantityInput = existingProduct.querySelector('.product-quantity');
                quantityInput.value = parseInt(quantityInput.value) + 1;
                quantityInput.dispatchEvent(new Event('input'));
            } else {
                const newProduct = document.createElement('div');
                newProduct.classList.add('col', 'my-2', 'order-product');
                newProduct.setAttribute('data-product-id', productId);
                newProduct.innerHTML = `
                    <div class="d-flex align-items-center border border-dashed p-3 rounded bg-white">
                        <div class="ms-5">
                            <a href="${baseUrl.replace('__ITEM_ID__', productId)}" class="symbol symbol-50px" onclick="showProductDetails(${productId})">
                                <span class="symbol-label" style="background-image: url('${productImage}');"></span>
                            </a>
                            <a href="${baseUrl.replace('__ITEM_ID__', productId)}" class="text-gray-800 text-hover-primary fs-5 fw-bold">${productName}</a>
                            <div class="fw-semibold fs-7">Price: $<span class="product-price">${productPrice.toFixed(2)}</span></div>
                            <div class="mt-2">
                                <input type="number" name="products[${productId}][quantity]" class="form-control product-quantity" value="1" min="1">
                                <input type="hidden" name="products[${productId}][id]" value="${productId}">
                                <input type="hidden" name="products[${productId}][price]" value="${productPrice}">
                            </div>
                            <button type="button" class="btn btn-sm btn-danger mt-2 remove-product">Remove</button>
                        </div>
                    </div>
                `;

                selectedProductsContainer.appendChild(newProduct);

                newProduct.querySelector('.remove-product').addEventListener('click', function () {
                    removeProductFromSelectedList(productId);
                    updatePrices();
                });

                newProduct.querySelector('.product-quantity').addEventListener('input', function () {
                    updatePrices();
                });
            }
        }

        function decrementProductQuantity(productId) {
            const productDiv = selectedProductsContainer.querySelector(`.order-product[data-product-id="${productId}"]`);
            if (productDiv) {
                const quantityInput = productDiv.querySelector('.product-quantity');
                if (parseInt(quantityInput.value) > 1) {
                    quantityInput.value = parseInt(quantityInput.value) - 1;
                    quantityInput.dispatchEvent(new Event('input'));
                } else {
                    selectedProductsContainer.removeChild(productDiv);
                }
            }
        }

        function removeProductFromSelectedList(productId) {
            const productDiv = selectedProductsContainer.querySelector(`.order-product[data-product-id="${productId}"]`);
            if (productDiv) {
                selectedProductsContainer.removeChild(productDiv);
            }
        }

        function updatePrices() {
            let totalProductPrice = 0;
            selectedProductsContainer.querySelectorAll('.order-product').forEach(productDiv => {
                const price = parseFloat(productDiv.querySelector('.product-price').innerText);
                const quantity = parseInt(productDiv.querySelector('.product-quantity').value);
                totalProductPrice += price * quantity;
            });
            totalPriceElement.innerText = totalProductPrice.toFixed(2);
            priceInput.value = totalProductPrice.toFixed(2);
            updateTotalFormPrice();
        }

        function updateTotalFormPrice() {
            const commission = parseFloat(commissionInput.value) || 0;
            const tax = parseFloat(taxInput.value) || 0;
            const basePrice = parseFloat(priceInput.value) || 0;

            const overallTotal = basePrice + commission + tax;
            totalPriceFormElement.value = overallTotal.toFixed(2);
        }

        selectedProductsContainer.querySelectorAll('.order-product').forEach(productDiv => {
            const quantityInput = productDiv.querySelector('.product-quantity');
            const removeButton = productDiv.querySelector('.remove-product');

            quantityInput.addEventListener('input', function () {
                updatePrices();
            });

            removeButton.addEventListener('click', function () {
                const productId = productDiv.getAttribute('data-product-id');
                removeProductFromSelectedList(productId);
                updatePrices();
            });
        });

        commissionInput.addEventListener('input', updateTotalFormPrice);
        taxInput.addEventListener('input', updateTotalFormPrice);
    });
    </script>
@endsection




<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

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
                        price: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Price is required') }}"
                                }
                            }
                        },
                        created_at: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Order date is required') }}"
                                }
                            }
                        },
                        payment_method: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Payment method is required') }}"
                                }
                            }
                        },
                        status: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Status is required') }}"
                                }
                            }
                        },
                        user_id: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('User is required') }}"
                                }
                            }
                        },
                        taxes: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Taxes is required') }}"
                                }
                            }
                        },
                        commission: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('commission is required') }}"
                                },
                            }
                        },
                        total_price: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Total price is required') }}"
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('product-search');
        const searchResults = document.getElementById('product-search-results');
        const selectedProductsContainer = document.getElementById('selected-products');

        searchInput.addEventListener('keyup', function () {
            const query = searchInput.value;
            if (query.length > 2) {
                fetch(`{{ route('admin.products.search') }}?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        searchResults.innerHTML = '';
                        data.forEach(product => {
                            const productItem = `
                                <div class="product-item" data-product-id="${product.id}">
                                    <input type="checkbox" class="add-product-checkbox" value="${product.id}">
                                    <span>${product.name} - $${product.price}</span>
                                </div>
                            `;
                            searchResults.insertAdjacentHTML('beforeend', productItem);
                        });

                        document.querySelectorAll('.add-product-checkbox').forEach(checkbox => {
                            checkbox.addEventListener('change', function () {
                                const productId = this.value;
                                const productName = this.nextElementSibling.textContent;
                                if (this.checked) {
                                    const newProduct = `
                                        <div class="order-product" data-product-id="${productId}">
                                            <span>${productName}</span>
                                            <input type="number" name="products[${productId}]" value="1" min="1" class="form-control quantity-input" />
                                            <button type="button" class="btn btn-danger remove-product">Remove</button>
                                        </div>
                                    `;
                                    selectedProductsContainer.insertAdjacentHTML('beforeend', newProduct);
                                    selectedProductsContainer.querySelector('.order-product:last-child .remove-product').addEventListener('click', function () {
                                        this.closest('.order-product').remove();
                                        document.querySelector(`.add-product-checkbox[value="${productId}"]`).checked = false;
                                    });
                                } else {
                                    document.querySelector(`.order-product[data-product-id="${productId}"]`).remove();
                                }
                            });
                        });
                    });
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const userSearchInput = document.getElementById('user-search');
        const userSearchResults = document.getElementById('user-search-results');
        const userSelect = document.getElementById('user');

        userSearchInput.addEventListener('keyup', function () {
            const query = userSearchInput.value;
            if (query.length > 0) {
                fetch(`{{ route('admin.users.liveSearch') }}?query=${encodeURIComponent(query)}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        userSearchResults.innerHTML = '';
                        data.forEach(user => {
                            const userItem = document.createElement('button');
                            userItem.classList.add('list-group-item', 'list-group-item-action');
                            userItem.setAttribute('data-user-id', user.id);
                            userItem.setAttribute('data-user-name', user.name);
                            userItem.textContent = user.name;

                            userSearchResults.appendChild(userItem);
                        });

                        document.querySelectorAll('.list-group-item').forEach(item => {
                            item.addEventListener('click', function () {
                                const userId = this.getAttribute('data-user-id');
                                const userName = this.getAttribute('data-user-name');

                                const option = new Option(userName, userId, true, true);
                                userSelect.options.length = 0; // Clear the existing options
                                userSelect.add(option);

                                userSearchResults.innerHTML = ''; // Clear the search results
                                userSearchInput.value = ''; // Clear the search input
                            });
                        });
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);
                    });
            } else {
                userSearchResults.innerHTML = ''; // Clear the search results if the input is empty
            }
        });
    });
</script>
