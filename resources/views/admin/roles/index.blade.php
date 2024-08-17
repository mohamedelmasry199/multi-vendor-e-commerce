<link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- Include Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
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
										<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ __('Roles List') }}</h1>
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
											<li class="breadcrumb-item text-muted">{{ __('User Management') }}</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item">
												<span class="bullet bg-gray-400 w-5px h-2px"></span>
											</li>
											<!--end::Item-->
											<!--begin::Item-->
											<li class="breadcrumb-item text-muted">{{ __('Roles') }}</li>
											<!--end::Item-->
										</ul>
										<!--end::Breadcrumb-->
									</div>
									<!--end::Page title-->
									<!--begin::Actions-->

{{-- first --}}
									<!--end::Actions-->
								</div>
								<!--end::Toolbar container-->
							</div>
							<!--end::Toolbar-->
							<!--begin::Content-->
							<div id="kt_app_content" class="app-content flex-column-fluid">
								<!--begin::Content container-->
                                <div id="kt_app_content_container" class="app-container container-xxl">
                                    <!--begin::Row-->
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                                        @foreach($roles as $role)
                                        <!--begin::Col-->
                                        <div class="col-md-4">
                                            <!--begin::Card-->
                                            <div class="card card-flush h-md-100">
                                                <!--begin::Card header-->
                                                <div class="card-header">
                                                    <!--begin::Card title-->
                                                    <div class="card-title">
                                                        <h2>{{ $role->name }}</h2>
                                                    </div>
                                                    <!--end::Card title-->
                                                </div>
                                                <!--end::Card header-->
                                                <!--begin::Card body-->
                                                <div class="card-body pt-1">
                                                    <!--begin::Users-->
                                                    <div class="fw-bold text-gray-600 mb-5">{{ __('Total users with this role:') }} {{ $role->users->count() }}</div>
                                                    <!--end::Users-->
                                                    <!--begin::Permissions-->
                                                    <div class="d-flex flex-column text-gray-600">
                                                        @foreach($role->permissions->take(5) as $permission)
                                                        <div class="d-flex align-items-center py-2">
                                                            <span class="bullet bg-primary me-3"></span>{{ $permission->name }}
                                                        </div>
                                                        @endforeach
                                                        @if($role->permissions->count() > 5)
                                                        <div class='d-flex align-items-center py-2'>
                                                            <span class='bullet bg-primary me-3'></span>
                                                            <em>{{ __('and') }} {{ $role->permissions->count() - 5 }} {{ __('more...') }}</em>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <!--end::Permissions-->
                                                </div>
                                                <!--end::Card body-->
                                                <!--begin::Card footer-->
                                                <div class="card-footer flex-wrap pt-0">
                                                    <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-light btn-active-primary my-1 me-2">{{ __('View Role') }}</a>
                                                    <button type="button" class="btn btn-light btn-active-light-primary my-1" data-bs-toggle="modal" data-bs-target="#kt_modal_update_role_{{ $role->id }}">{{ __('Edit Role') }}</button>
                                                </div>
                                                <!--end::Card footer-->
                                            </div>
                                            <!--end::Card-->
                                        </div>
                                        <!--end::Col-->

                                        <!--begin::Modal - Update role-->
                                        <div class="modal fade" id="kt_modal_update_role_{{ $role->id }}" tabindex="-1" aria-hidden="true">
                                            <!--begin::Modal dialog-->
                                            <div class="modal-dialog modal-dialog-centered mw-750px">
                                                <!--begin::Modal content-->
                                                <div class="modal-content">
                                                    <!--begin::Modal header-->
                                                    <div class="modal-header">
                                                        <!--begin::Modal title-->
                                                        <h2 class="fw-bold">{{ __('Update Role') }}</h2>
                                                        <!--end::Modal title-->
                                                        <!--begin::Close-->
                                                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                            <span class="svg-icon svg-icon-1">
                                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>
                                                    <!--end::Modal header-->
                                                    <!--begin::Modal body-->
                                                    <div class="modal-body scroll-y mx-5 my-7">
                                                        <!--begin::Form-->
                                                        <form id="kt_modal_update_role_form_{{ $role->id }}" class="form" action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <!--begin::Scroll-->
                                                            <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_role_header" data-kt-scroll-wrappers="#kt_modal_update_role_scroll" data-kt-scroll-offset="300px">
                                                                <!--begin::Input group-->
                                                                <div class="fv-row mb-10">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-5 fw-bold form-label mb-2">
                                                                        <span class="required">{{ __('Role name') }}</span>
                                                                    </label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name" value="{{ $role->name }}" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Permissions-->
                                                                <div class="fv-row">
                                                                    <!--begin::Label-->
                                                                    <label class="fs-5 fw-bold form-label mb-2">{{ __('Role Permissions') }}</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Table wrapper-->
                                                                    <div class="table-responsive">
                                                                        <!--begin::Table-->
                                                                        <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                                            <!--begin::Table body-->
                                                                            <tbody class="text-gray-600 fw-semibold">
                                                                                @foreach($permissions as $permission)
                                                                                <tr>
                                                                                    <!--begin::Label-->
                                                                                    <td class="text-gray-800">{{ $permission->name }}</td>
                                                                                    <!--end::Label-->
                                                                                    <!--begin::Options-->
                                                                                    <td>
                                                                                        <!--begin::Wrapper-->
                                                                                        <div class="d-flex">
                                                                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }} />
                                                                                                <span class="form-check-label">{{ __('Assign') }}</span>
                                                                                            </label>
                                                                                        </div>
                                                                                        <!--end::Wrapper-->
                                                                                    </td>
                                                                                    <!--end::Options-->
                                                                                </tr>
                                                                                @endforeach
                                                                            </tbody>
                                                                            <!--end::Table body-->
                                                                        </table>
                                                                        <!--end::Table-->
                                                                    </div>
                                                                    <!--end::Table wrapper-->
                                                                </div>
                                                                <!--end::Permissions-->
                                                            </div>
                                                            <!--end::Scroll-->
                                                            <!--begin::Actions-->
                                                            <div class="text-center pt-15">
                                                                <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">{{ __('Discard') }}</button>
                                                                <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                                                    <span class="indicator-label">{{ __('Submit') }}</span>
                                                                    <span class="indicator-progress">{{ __('Please wait...') }}
                                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                </button>
                                                            </div>
                                                            <!--end::Actions-->
                                                        </form>
                                                        <!--end::Form-->
                                                    </div>
                                                    <!--end::Modal body-->
                                                </div>
                                                <!--end::Modal content-->
                                            </div>
                                            <!--end::Modal dialog-->
                                        </div>
                                        <!--end::Modal - Update role-->
                                        @endforeach

                                        <!--begin::Add new card-->
                                        <div class="col-md-4">
                                            <!--begin::Card-->
                                            <div class="card h-md-100">
                                                <!--begin::Card body-->
                                                <div class="card-body d-flex flex-center">
                                                    <!--begin::Button-->
                                                    <button type="button" class="btn btn-clear d-flex flex-column flex-center" data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                                        <!--begin::Illustration-->
                                                        <img src="assets/media/illustrations/sketchy-1/4.png" alt="" class="mw-100 mh-150px mb-7" />
                                                        <!--end::Illustration-->
                                                        <!--begin::Label-->
                                                        <div class="fw-bold fs-3 text-gray-600 text-hover-primary">{{ __('Add New Role') }}</div>
                                                        <!--end::Label-->
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                                <!--end::Card body-->
                                            </div>
                                            <!--end::Card-->
                                        </div>
                                        <!--end::Add new card-->
                                    </div>
                                    <!--end::Row-->

                                    <!--begin::Modals-->
                                    <!--begin::Modal - Add role-->
                                    <div class="modal fade" id="kt_modal_add_role" tabindex="-1" aria-hidden="true">
                                        <!--begin::Modal dialog-->
                                        <div class="modal-dialog modal-dialog-centered mw-750px">
                                            <!--begin::Modal content-->
                                            <div class="modal-content">
                                                <!--begin::Modal header-->
                                                <div class="modal-header">
                                                    <!--begin::Modal title-->
                                                    <h2 class="fw-bold">Add a Role</h2>
                                                    <!--end::Modal title-->
                                                    <!--begin::Close-->
                                                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                                        <span class="svg-icon svg-icon-1">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                    </div>
                                                    <!--end::Close-->
                                                </div>
                                                <!--end::Modal header-->
                                                <!--begin::Modal body-->
                                                <div class="modal-body scroll-y mx-5 my-7">
                                                    <!--begin::Form-->
                                                    <form id="kt_modal_add_role_form" class="form" action="{{ route('admin.roles.store') }}" method="POST">
                                                        @csrf
                                                        <!--begin::Scroll-->
                                                        <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_role_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_role_header" data-kt-scroll-wrappers="#kt_modal_add_role_scroll" data-kt-scroll-offset="300px">
                                                            <!--begin::Input group-->
                                                            <div class="fv-row mb-10">
                                                                <!--begin::Label-->
                                                                <label class="fs-5 fw-bold form-label mb-2">
                                                                    <span class="required">{{ __('Role name') }}</span>
                                                                </label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input class="form-control form-control-solid" placeholder="{{ __('Enter a role name') }}" name="role_name" />
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Input group-->
                                                            <!--begin::Permissions-->
                                                            <div class="fv-row">
                                                                <!--begin::Label-->
                                                                <label class="fs-5 fw-bold form-label mb-2">{{ __('Role Permissions') }}</label>
                                                                <!--end::Label-->
                                                                <!--begin::Table wrapper-->
                                                                <div class="table-responsive">
                                                                    <!--begin::Table-->
                                                                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                                                                        <!--begin::Table body-->
                                                                        <tbody class="text-gray-600 fw-semibold">
                                                                            @foreach($permissions as $permission)
                                                                            <tr>
                                                                                <!--begin::Label-->
                                                                                <td class="text-gray-800">{{ $permission->name }}</td>
                                                                                <!--end::Label-->
                                                                                <!--begin::Options-->
                                                                                <td>
                                                                                    <!--begin::Wrapper-->
                                                                                    <div class="d-flex">
                                                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->name }}" />
                                                                                            <span class="form-check-label">{{ __('Assign') }}</span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <!--end::Wrapper-->
                                                                                </td>
                                                                                <!--end::Options-->
                                                                            </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                        <!--end::Table body-->
                                                                    </table>
                                                                    <!--end::Table-->
                                                                </div>
                                                                <!--end::Table wrapper-->
                                                            </div>
                                                            <!--end::Permissions-->
                                                        </div>
                                                        <!--end::Scroll-->
                                                        <!--begin::Actions-->
                                                        <div class="text-center pt-15">
                                                            <button type="reset" class="btn btn-light me-3" data-kt-roles-modal-action="cancel">{{ __('Discard') }}</button>
                                                            <button type="submit" class="btn btn-primary" data-kt-roles-modal-action="submit">
                                                                <span class="indicator-label">{{ __('Submit') }}</span>
                                                                <span class="indicator-progress">{{ __('Please wait...') }}
                                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                        <!--end::Actions-->
                                                    </form>
                                                    <!--end::Form-->
                                                </div>
                                                <!--end::Modal body-->
                                            </div>
                                            <!--end::Modal content-->
                                        </div>
                                        <!--end::Modal dialog-->
                                    </div>
                                    <!--end::Modal - Add role-->
                                    <!--end::Modals-->
                                </div>
								<!--end::Content container-->
							</div>
							<!--end::Content-->
						</div>
						<!--end::Content wrapper-->

		<!--end::App-->

        @endsection
