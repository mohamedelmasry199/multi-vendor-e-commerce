@extends('admin.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit Static Page</h5>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container">
                <div class="card card-custom">
                    <div class="card-header">
                        <h3 class="card-title">Edit Page</h3>
                    </div>
                    <form id="staticPageForm" method="POST" action="{{ route('admin.static_pages.update', $page->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="english-tab" data-toggle="tab" href="#english" role="tab" aria-controls="english" aria-selected="true">English</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="arabic-tab" data-toggle="tab" href="#arabic" role="tab" aria-controls="arabic" aria-selected="false">Arabic</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-5" id="myTabContent">
                                <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="english-tab">
                                    <div class="form-group">
                                        <label for="title_en">Title (EN)</label>
                                        <input type="text" class="form-control" id="title_en" name="title_en" value="{{ $page->title_en }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content_en">Content (EN)</label>
                                        <textarea class="form-control" id="editor_en" name="content_en" rows="10" required>{{ $page->content_en }}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="arabic" role="tabpanel" aria-labelledby="arabic-tab">
                                    <div class="form-group">
                                        <label for="title_ar">Title (AR)</label>
                                        <input type="text" class="form-control" id="title_ar" name="title_ar" value="{{ $page->title_ar }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="content_ar">Content (AR)</label>
                                        <textarea class="form-control" id="editor_ar" name="content_ar" rows="10" required>{{ $page->content_ar }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor_en'))
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#editor_ar'))
            .catch(error => {
                console.error(error);
            });

        $(document).ready(function () {
            $('#staticPageForm').validate({
                rules: {
                    title_en: {
                        required: true,
                        maxlength: 255
                    },
                    content_en: {
                        required: true
                    },
                    title_ar: {
                        required: true,
                        maxlength: 255
                    },
                    content_ar: {
                        required: true
                    }
                },
                messages: {
                    title_en: {
                        required: "Please enter the English title",
                        maxlength: "The English title cannot exceed 255 characters"
                    },
                    content_en: {
                        required: "Please enter the English content"
                    },
                    title_ar: {
                        required: "Please enter the Arabic title",
                        maxlength: "The Arabic title cannot exceed 255 characters"
                    },
                    content_ar: {
                        required: "Please enter the Arabic content"
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
