
@extends('admin.app')

@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        @if(isset($item))
                            @if(Route::currentRouteName() == 'admin.items.edit')
                                {{ __('Edit Items') }}
                            @else
                                {{ __('Show Items') }}
                            @endif
                        @else
                            {{ __('Create Items') }}
                        @endif
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('admin.items.index') }}" class="text-muted text-hover-primary">{{ __('Home') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ __('Create Items') }}</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('admin.items.index') }}" class="btn btn-primary">{{ __('View Items') }}</a>
                </div>
            </div>
        </div>

        <div class="card mb-5 mb-xxl-10">
            <div id="kt_account_profile_details" class="collapse show">
                <form id="kt_account_profile_details_form" class="form" method="POST" action="{{ isset($item) ? (Route::currentRouteName() == 'admin.items.edit' ? route('admin.items.update', $item->id) : '#') : route('admin.items.store') }}" enctype="multipart/form-data">
                    @csrf
                    @if(isset($item) && Route::currentRouteName() == 'admin.items.edit')
                        @method('PUT')
                    @endif
                    <div class="card-body border-top p-9">
                        <!-- Image -->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Main Image') }}</label>
                            <div class="col-lg-8">
                                <div class="image-input image-input-outline fv-row" data-kt-image-input="true" style="background-image: url('{{ asset('media/avatars/blank.png') }}')">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ isset($item) ? asset($item->getImgPath('main_image')) : asset('media/avatars/blank.png') }}')"></div>
                                    @if(Route::currentRouteName() != 'admin.items.show')
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="{{ __('Change avatar') }}">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="main_image" accept=".png, .jpg, .jpeg" />
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

                        <!-- Name (AR) -->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name(AR)') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_ar" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Name(AR)') }}" value="{{ isset($item) ? $item->name_ar : old('name_ar') }}" {{ Route::currentRouteName() == 'admin.items.show' ? 'readonly' : '' }} />
                            </div>
                        </div>

                        <!-- Name (EN) -->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Name(EN)') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="name_en" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Name(EN)') }}" value="{{ isset($item) ? $item->name_en : old('name_en') }}" {{ Route::currentRouteName() == 'admin.items.show' ? 'readonly' : '' }} />
                            </div>
                        </div>

                        <!-- Description (AR) -->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Description(AR)') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="description_ar" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Description(AR)') }}" value="{{ isset($item) ? $item->description_ar : old('description_ar') }}" {{ Route::currentRouteName() == 'admin.items.show' ? 'readonly' : '' }} />
                            </div>
                        </div>

                        <!-- Description (EN) -->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Description(EN)') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="description_en" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Description(EN)') }}" value="{{ isset($item) ? $item->description_en : old('description_en') }}" {{ Route::currentRouteName() == 'admin.items.show' ? 'readonly' : '' }} />
                            </div>
                        </div>

                        <!-- Price (Before Offer) -->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">{{ __('Price(before offer)') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="price_before_offer" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Price(before offer)') }}" value="{{ isset($item) ? $item->price_before_offer : old('price_before_offer') }}" {{ Route::currentRouteName() == 'admin.items.show' ? 'readonly' : '' }} />
                            </div>
                        </div>

                        <!-- Price (After Offer) -->
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Price(after offer)') }}</label>
                            <div class="col-lg-8 fv-row">
                                <input type="text" name="price_after_offer" class="form-control form-control-lg form-control-solid" placeholder="{{ __('Price(after offer)') }}" value="{{ isset($item) ? $item->price_after_offer : old('price_after_offer') }}" {{ Route::currentRouteName() == 'admin.items.show' ? 'readonly' : '' }} />
                            </div>
                        </div>
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Images') }}</label>
                            <div class="col-lg-8 fv-row">
                                @if(Route::currentRouteName() != 'admin.items.show')
                                    <input type="file" name="images[]" id="file-input" class="form-control form-control-lg form-control-solid" multiple>
                                @endif
                                <div id="preview-container" class="mt-4 row">
                                    @if(isset($item) && is_array($item->images))
                                        @foreach($item->getImgPaths('images') as $image)
                                            <div class="col-3 mb-3 existing-image">
                                                <div class="card">
                                                    <div class="card-body p-0 position-relative">
                                                        <img src="{{ asset($image) }}" class="w-100 h-100 object-fit-cover" style="aspect-ratio: 1/1;">
                                                        @if(Route::currentRouteName() != 'admin.items.show')
                                                            <button type="button" class="btn btn-sm btn-danger delete position-absolute top-0 end-0 m-1 p-1" style="width: 30px; height: 30px; border-radius: 50%; font-size: 12px;">
                                                                <i class="bi bi-x fs-1"></i>
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                                <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>

                        <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const inputFile = document.querySelector("#file-input");
                            const previewContainer = document.getElementById('preview-container');
                            let allImages = new DataTransfer();

                            if (inputFile) {
                                inputFile.addEventListener('change', (e) => {
                                    const files = [...e.target.files];
                                    files.forEach((file) => {
                                        if (!isValidImage(file)) {
                                            alert("Invalid file type. Please select an image.");
                                            return;
                                        }
                                        addImageFile(file);
                                    });
                                });

                                const addImageFile = (img) => {
                                    allImages.items.add(img);
                                    let reader = new FileReader();
                                    reader.readAsDataURL(img);
                                    reader.onloadend = () => {
                                        let imgSrc = reader.result;
                                        let imageElement = document.createElement("div");
                                        imageElement.classList.add('col-3', 'mb-3', 'new-image');
                                        imageElement.innerHTML = `
                                            <div class="card">
                                                <div class="card-body p-0 position-relative">
                                                    <img src="${imgSrc}" class="w-100 h-100 object-fit-cover" style="aspect-ratio: 1/1;">
                                                    <button type="button" class="btn btn-sm btn-danger delete position-absolute top-0 end-0 m-1 p-1" style="width: 30px; height: 30px; border-radius: 50%; font-size: 12px;">
                                                        <i class="bi bi-x fs-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        `;
                                        previewContainer.appendChild(imageElement);
                                        inputFile.files = allImages.files;
                                        imageElement.querySelector('.delete').addEventListener('click', function() {
                                            const imgIndex = Array.from(allImages.files).indexOf(img);
                                            allImages.items.remove(imgIndex);
                                            inputFile.files = allImages.files;
                                            imageElement.remove();
                                        });
                                    };
                                    reader.onerror = (error) => {
                                        console.error("Error reading file:", error);
                                    };
                                };

                                previewContainer.querySelectorAll('.existing-image .delete').forEach(button => {
                                    button.addEventListener('click', function() {
                                        const imageElement = button.closest('.existing-image');
                                        const imagePath = imageElement.querySelector('input[name="existing_images[]"]').value;
                                        document.querySelector(`input[name="existing_images[]"][value="${imagePath}"]`).remove();
                                        imageElement.remove();
                                        const deletedImageInput = document.createElement('input');
                                        deletedImageInput.type = 'hidden';
                                        deletedImageInput.name = 'deleted_images[]';
                                        deletedImageInput.value = imagePath;
                                        document.querySelector('form').appendChild(deletedImageInput);
                                    });
                                });
                            }
                        });

                        function isValidImage(file) {
                            const allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
                            return allowedMimeTypes.includes(file.type);
                        }
                        </script>



<div class="row mb-6">
    <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Category') }}</label>
    <div class="col-lg-8 fv-row">
        <select id="category-select" name="category_id" class="form-select form-select-lg form-select-solid" {{ Route::currentRouteName() == 'admin.items.show' ? 'disabled' : '' }} required>
            <option value="">{{ __('Select Category') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ isset($item) && $item->category_id == $category->id ? 'selected' : '' }}>{{ $category->name_ar }}</option>
            @endforeach
        </select>
    </div>
</div>
<div id="subcategories-container"></div>


                        @if(Route::currentRouteName() != 'admin.items.show')
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                    <span class="indicator-label">{{ __('Save') }}</span>
                                    <span class="indicator-progress">{{ __('Please wait') }}...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.full.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#category-select').select2({
            placeholder: "{{ __('Select Category') }}",
            allowClear: true
        });

        function fetchChildren(parentId, container) {
            $.ajax({
                url: '{{ url("admin/categories/children") }}/' + parentId,
                method: 'GET',
                success: function(data) {
                    if (data.length > 0) {
                        let selectHtml = `<div class="row mb-6">
                            <label class="col-lg-4 col-form-label fw-bold fs-6">{{ __('Subcategory') }}</label>
                            <div class="col-lg-8 fv-row">
                                <select class="form-select form-select-lg form-select-solid subcategory-select">
                                    <option value="">{{ __('Select Subcategory') }}</option>`;

                        data.forEach(function(category) {
                            selectHtml += `<option value="${category.id}">${category.name_ar}</option>`;
                        });

                        selectHtml += `</select>
                            </div>
                        </div>`;

                        $(container).append(selectHtml);
                        $('.subcategory-select').select2({
                            placeholder: "{{ __('Select Subcategory') }}",
                            allowClear: true
                        });
                    }
                }
            });
        }

        function updateCategoryName() {
            $('#category-select').attr('name', 'category_id');
            $('#subcategories-container select').each(function() {
                $(this).removeAttr('name');
            });
            $('#subcategories-container select:last').attr('name', 'category_id');
        }

        $('#category-select').on('change', function() {
            let selectedId = $(this).val();
            $('#subcategories-container').empty();
            $(this).attr('name', 'category_id');

            if (selectedId) {
                fetchChildren(selectedId, '#subcategories-container');
            }
        });

        $('#subcategories-container').on('change', 'select', function() {
            let selectedId = $(this).val();
            $(this).parent().parent().nextAll().remove();

            if (selectedId) {
                fetchChildren(selectedId, '#subcategories-container');
            }

            updateCategoryName();
        });

        updateCategoryName();
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
                        description_ar: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Description(AR) is required') }}"
                                },
                            }
                        },
                        description_en: {
                            validators: {
                                notEmpty: {
                                    message: "{{ __('Description(EN) is required') }}"
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
