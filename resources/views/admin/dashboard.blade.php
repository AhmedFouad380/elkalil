@extends('admin.layouts.master') 

@section('css')
    <link href="{{asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('breadcrumb')
<h1 class="d-flex text-dark fw-bolder my-1 fs-3">لوحة القيادة</h1>
@endsection

@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::Row-->
        <div class="row g-5 g-lg-10">
            <!--begin::Col-->
            <div class="col-xl-4 mb-xl-10 mb-5">
                <!--begin::Mixed Widget 19-->
                <div class="card h-md-100">
                    <!--begin::Beader-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bolder fs-3 mb-1">Weekly Sales Stats</span>
                            <span class="text-muted fw-bold fs-7">890,344 Sales</span>
                        </h3>
                        <div class="card-toolbar">
                            <!--begin::Menu-->
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61a08bb64c6aa">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Menu separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Menu separator-->
                                <!--begin::Form-->
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-bold">Status:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div>
                                            <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61a08bb64c6aa" data-allow-clear="true">
                                                <option></option>
                                                <option value="1">Approved</option>
                                                <option value="2">Pending</option>
                                                <option value="2">In Process</option>
                                                <option value="2">Rejected</option>
                                            </select>
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-bold">Member Type:</label>
                                        <!--end::Label-->
                                        <!--begin::Options-->
                                        <div class="d-flex">
                                            <!--begin::Options-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" type="checkbox" value="1" />
                                                <span class="form-check-label">Author</span>
                                            </label>
                                            <!--end::Options-->
                                            <!--begin::Options-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                                <span class="form-check-label">Customer</span>
                                            </label>
                                            <!--end::Options-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fw-bold">Notifications:</label>
                                        <!--end::Label-->
                                        <!--begin::Switch-->
                                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                                            <label class="form-check-label">Enabled</label>
                                        </div>
                                        <!--end::Switch-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Form-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Body-->
                    <div class="card-body p-0 d-flex flex-column">
                        <!--begin::Items-->
                        <div class="card-px pt-5 pb-10 flex-grow-1">
                            <!--begin::Item-->
                            <div class="d-flex align-items-sm-center mb-7">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label">
                                        <img src="{{asset('admin/assets/media/svg/brand-logos/plurk.svg')}}" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <div class="flex-grow-1 me-2">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Top Authors</a>
                                        <span class="text-muted fw-bold d-block fs-7">Mark, Rowling, Esther</span>
                                    </div>
                                    <span class="badge badge-light fw-bolder my-2">+82$</span>
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-sm-center mb-7">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label">
                                        <img src="{{asset('admin/assets/media/svg/brand-logos/telegram.svg')}}" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <div class="flex-grow-1 me-2">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">Popular Authors</a>
                                        <span class="text-muted fw-bold d-block fs-7">Randy, Steve, Mike</span>
                                    </div>
                                    <span class="badge badge-light fw-bolder my-2">+280$</span>
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-sm-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-50px me-5">
                                    <span class="symbol-label">
                                        <img src="{{asset('admin/assets/media/svg/brand-logos/vimeo.svg')}}" class="h-50 align-self-center" alt="" />
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Section-->
                                <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                    <div class="flex-grow-1 me-2">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-6 fw-bolder">New Users</a>
                                        <span class="text-muted fw-bold d-block fs-7">John, Pat, Jimmy</span>
                                    </div>
                                    <span class="badge badge-light fw-bolder my-2">+4500$</span>
                                </div>
                                <!--end::Section-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                        <!--begin::Chart-->
                        <div id="kt_charts_mixed_widget_19_chart" class="card-rounded-bottom" style="height: 150px"></div>
                        <!--end::Chart-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 19-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-4 mb-5">
                <!--begin::Row-->
                <div class="row g-5 g-lg-10">
                    <!--begin::Col-->
                    <div class="col-lg-6 mb-5 mb-lg-10">
                        <!--begin::Tiles Widget 5-->
                        <a href="#" class="card bg-primary h-150px">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column justify-content-between">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-2hx ms-n1 flex-grow-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                        <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="d-flex flex-column">
                                    <div class="text-white fw-bolder fs-1 mb-0 mt-5">3,900</div>
                                    <div class="text-white fw-bold fs-6">Author Sales</div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Tiles Widget 5-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-6 mb-5 mb-lg-10">
                        <!--begin: Statistics Widget 6-->
                        <a href="#" class="card bg-body h-150px">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column py-6 px-6">
                                <div class="d-flex flex-column flex-grow-1 mb-5">
                                    <span class="text-gray-500 fw-bold me-2 fs-7">Author Stats</span>
                                    <span class="fw-bolder fs-1 text-gray-900">4.9M</span>
                                </div>
                                <div class="progress h-7px bg-info bg-opacity-25">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </a>
                        <!--end: Statistics Widget 6-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-5 g-lg-10">
                    <!--begin::Col-->
                    <div class="col-lg-6 mb-5 mb-lg-10">
                        <!--begin::Tiles Widget 1-->
                        <div class="card h-150px bgi-no-repeat bgi-size-cover h-150px" style="background-image:url({{asset('admin/assets/media/stock/600x600/img-12.jpg')}})">
                            <!--begin::Body-->
                            <div class="card-body p-6">
                                <!--begin::Title-->
                                <a href="#" class="text-black text-hover-primary fw-bolder fs-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Properties</a>
                                <!--end::Title-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Tiles Widget 1-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-lg-6 mb-5 mb-lg-10">
                        <!--begin::Tiles Widget 5-->
                        <a href="#" class="card bg-danger h-150px">
                            <!--begin::Body-->
                            <div class="card-body d-flex flex-column justify-content-between">
                                <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-2hx ms-n1 flex-grow-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black" />
                                        <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="d-flex flex-column">
                                    <div class="text-white fw-bolder fs-1 mb-0 mt-5">75%</div>
                                    <div class="text-white fw-bold fs-6">Success Rate</div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Tiles Widget 5-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Engage widget 4-->
                <a href="#" class="card bgi-no-repeat h-150px mb-5 mb-lg-10" style="background-color: #4AB58E; background-position: calc(100% + 1rem) bottom; background-size: 25% auto; background-image:url({{asset('admin/assets/media/svg/humans/custom-1.svg')}})">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column align-items-start justify-content-center">
                        <h3 class="text-white fw-bolder mb-3">30% Off Themes</h3>
                        <p class="text-white fs-7">Get your discounted themes of the month
                        <br />No hassle, no worries, no fuss
                        <br />Instant rewards, everyday</p>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Engage widget 4-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-4 mb-xl-10 mb-5">
                <!--begin::Mixed Widget 1-->
                <div class="card h-md-100">
                    <!--begin::Body-->
                    <div class="card-body p-0">
                        <!--begin::Header-->
                        <div class="px-9 pt-7 card-rounded h-275px w-100 bg-info">
                            <!--begin::Heading-->
                            <div class="d-flex flex-stack">
                                <h3 class="m-0 text-white fw-bolder fs-3">Sales Summary</h3>
                                <div class="ms-1">
                                    <!--begin::Menu-->
                                    <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color-primary border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                    <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                    <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </button>
                                    <!--begin::Menu 3-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                        <!--begin::Heading-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Create Invoice</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link flex-stack px-3">Create Payment
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i></a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Generate Bill</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
                                            <a href="#" class="menu-link px-3">
                                                <span class="menu-title">Subscription</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Plans</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Billing</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Statements</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3">
                                                        <!--begin::Switch-->
                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                            <!--begin::Input-->
                                                            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                                            <!--end::Input-->
                                                            <!--end::Label-->
                                                            <span class="form-check-label text-muted fs-6">Recuring</span>
                                                            <!--end::Label-->
                                                        </label>
                                                        <!--end::Switch-->
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3 my-1">
                                            <a href="#" class="menu-link px-3">Settings</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu 3-->
                                    <!--end::Menu-->
                                </div>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Balance-->
                            <div class="d-flex text-center flex-column text-white pt-8">
                                <span class="fw-bold fs-7">You Balance</span>
                                <span class="fw-bolder fs-2x pt-1">$37,562.00</span>
                            </div>
                            <!--end::Balance-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Items-->
                        <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px">
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45px w-40px me-5">
                                    <span class="symbol-label bg-lighten">
                                        <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="black" />
                                                <path d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Description-->
                                <div class="d-flex align-items-center flex-wrap w-100">
                                    <!--begin::Title-->
                                    <div class="mb-1 pe-3 flex-grow-1">
                                        <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Sales</a>
                                        <div class="text-gray-400 fw-bold fs-7">100 Regions</div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Label-->
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bolder fs-5 text-gray-800 pe-1">$2,5b</div>
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                        <span class="svg-icon svg-icon-5 svg-icon-success ms-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45px w-40px me-5">
                                    <span class="symbol-label bg-lighten">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Description-->
                                <div class="d-flex align-items-center flex-wrap w-100">
                                    <!--begin::Title-->
                                    <div class="mb-1 pe-3 flex-grow-1">
                                        <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Revenue</a>
                                        <div class="text-gray-400 fw-bold fs-7">Quarter 2/3</div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Label-->
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bolder fs-5 text-gray-800 pe-1">$1,7b</div>
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                        <span class="svg-icon svg-icon-5 svg-icon-danger ms-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                                                <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-6">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45px w-40px me-5">
                                    <span class="symbol-label bg-lighten">
                                        <!--begin::Svg Icon | path: icons/duotune/electronics/elc005.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M15 19H7C5.9 19 5 18.1 5 17V7C5 5.9 5.9 5 7 5H15C16.1 5 17 5.9 17 7V17C17 18.1 16.1 19 15 19Z" fill="black" />
                                                <path d="M8.5 2H13.4C14 2 14.5 2.4 14.6 3L14.9 5H6.89999L7.2 3C7.4 2.4 7.9 2 8.5 2ZM7.3 21C7.4 21.6 7.9 22 8.5 22H13.4C14 22 14.5 21.6 14.6 21L14.9 19H6.89999L7.3 21ZM18.3 10.2C18.5 9.39995 18.5 8.49995 18.3 7.69995C18.2 7.29995 17.8 6.90002 17.3 6.90002H17V10.9H17.3C17.8 11 18.2 10.7 18.3 10.2Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Description-->
                                <div class="d-flex align-items-center flex-wrap w-100">
                                    <!--begin::Title-->
                                    <div class="mb-1 pe-3 flex-grow-1">
                                        <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Growth</a>
                                        <div class="text-gray-400 fw-bold fs-7">80% Rate</div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Label-->
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bolder fs-5 text-gray-800 pe-1">$8,8m</div>
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                        <span class="svg-icon svg-icon-5 svg-icon-success ms-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Item-->
                            <!--begin::Item-->
                            <div class="d-flex align-items-center">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-45px w-40px me-5">
                                    <span class="symbol-label bg-lighten">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z" fill="black" />
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                </div>
                                <!--end::Symbol-->
                                <!--begin::Description-->
                                <div class="d-flex align-items-center flex-wrap w-100">
                                    <!--begin::Title-->
                                    <div class="mb-1 pe-3 flex-grow-1">
                                        <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bolder">Dispute</a>
                                        <div class="text-gray-400 fw-bold fs-7">3090 Refunds</div>
                                    </div>
                                    <!--end::Title-->
                                    <!--begin::Label-->
                                    <div class="d-flex align-items-center">
                                        <div class="fw-bolder fs-5 text-gray-800 pe-1">$270m</div>
                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                        <span class="svg-icon svg-icon-5 svg-icon-danger ms-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="black" />
                                                <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end::Item-->
                        </div>
                        <!--end::Items-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Mixed Widget 1-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                        <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">500M$</div>
                        <div class="fw-bold text-gray-400">SAP UI Progress</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
                                <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
                                <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">+3000</div>
                        <div class="fw-bold text-gray-100">New Customers</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
                                <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-white fw-bolder fs-2 mb-2 mt-5">$50,000</div>
                        <div class="fw-bold text-white">Milestone Reached</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
            <div class="col-xl-3">
                <!--begin::Statistics Widget 5-->
                <a href="#" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                        <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black" />
                                <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-white fw-bolder fs-2 mb-2 mt-5">$50,000</div>
                        <div class="fw-bold text-white">Milestone Reached</div>
                    </div>
                    <!--end::Body-->
                </a>
                <!--end::Statistics Widget 5-->
            </div>
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
            <div class="col-xl-4">
                <!--begin: Statistics Widget 6-->
                <div class="card bg-light-success card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body my-3">
                        <a href="#" class="card-title fw-bolder text-success fs-5 mb-3 d-block">Project Progress</a>
                        <div class="py-1">
                            <span class="text-dark fs-1 fw-bolder me-2">50%</span>
                            <span class="fw-bold text-muted fs-7">Avarage</span>
                        </div>
                        <div class="progress h-7px bg-success bg-opacity-50 mt-7">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--end:: Body-->
                </div>
                <!--end: Statistics Widget 6-->
            </div>
            <div class="col-xl-4">
                <!--begin: Statistics Widget 6-->
                <div class="card bg-light-warning card-xl-stretch mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body my-3">
                        <a href="#" class="card-title fw-bolder text-warning fs-5 mb-3 d-block">Company Finance</a>
                        <div class="py-1">
                            <span class="text-dark fs-1 fw-bolder me-2">15%</span>
                            <span class="fw-bold text-muted fs-7">48k Goal</span>
                        </div>
                        <div class="progress h-7px bg-warning bg-opacity-50 mt-7">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 15%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--end:: Body-->
                </div>
                <!--end: Statistics Widget 6-->
            </div>
            <div class="col-xl-4">
                <!--begin: Statistics Widget 6-->
                <div class="card bg-light-primary card-xl-stretch mb-5 mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body my-3">
                        <a href="#" class="card-title fw-bolder text-primary fs-5 mb-3 d-block">Marketing Analysis</a>
                        <div class="py-1">
                            <span class="text-dark fs-1 fw-bolder me-2">76%</span>
                            <span class="fw-bold text-muted fs-7">400k Impressions</span>
                        </div>
                        <div class="progress h-7px bg-primary bg-opacity-50 mt-7">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 76%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!--end:: Body-->
                </div>
                <!--end: Statistics Widget 6-->
            </div>
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row g-5 g-xl-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <!--begin::Mixed Widget 14-->
                <div class="card card-xxl-stretch mb-5 mb-xl-8" style="background-color: #F7D9E3">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column mb-7">
                            <!--begin::Title-->
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Summary</a>
                            <!--end::Title-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Row-->
                        <div class="row g-0">
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-9 me-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs043.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 8H8L12 4H19C19.6 4 20.2 4.39999 20.5 4.89999L22 8ZM3.5 19.1C3.8 19.7 4.4 20 5 20H12L16 16H2L3.5 19.1ZM19.1 20.5C19.7 20.2 20 19.6 20 19V12L16 8V22L19.1 20.5ZM4.9 3.5C4.3 3.8 4 4.4 4 5V12L8 16V2L4.9 3.5Z" fill="black" />
                                                    <path d="M22 8L20 12L16 8H22ZM8 16L4 12L2 16H8ZM16 16L12 20L16 22V16ZM8 8L12 4L8 2V8Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$50K</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Sales</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-9 ms-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs046.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M8 22C7.4 22 7 21.6 7 21V9C7 8.4 7.4 8 8 8C8.6 8 9 8.4 9 9V21C9 21.6 8.6 22 8 22Z" fill="black" />
                                                    <path opacity="0.3" d="M4 15C3.4 15 3 14.6 3 14V6C3 5.4 3.4 5 4 5C4.6 5 5 5.4 5 6V14C5 14.6 4.6 15 4 15ZM13 19V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V19C11 19.6 11.4 20 12 20C12.6 20 13 19.6 13 19ZM17 16V5C17 4.4 16.6 4 16 4C15.4 4 15 4.4 15 5V16C15 16.6 15.4 17 16 17C16.6 17 17 16.6 17 16ZM21 18V10C21 9.4 20.6 9 20 9C19.4 9 19 9.4 19 10V18C19 18.6 19.4 19 20 19C20.6 19 21 18.6 21 18Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$4,5K</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Revenue</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center me-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs022.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M11.425 7.325C12.925 5.825 15.225 5.825 16.725 7.325C18.225 8.825 18.225 11.125 16.725 12.625C15.225 14.125 12.925 14.125 11.425 12.625C9.92501 11.225 9.92501 8.825 11.425 7.325ZM8.42501 4.325C5.32501 7.425 5.32501 12.525 8.42501 15.625C11.525 18.725 16.625 18.725 19.725 15.625C22.825 12.525 22.825 7.425 19.725 4.325C16.525 1.225 11.525 1.225 8.42501 4.325Z" fill="black" />
                                                    <path d="M11.325 17.525C10.025 18.025 8.425 17.725 7.325 16.725C5.825 15.225 5.825 12.925 7.325 11.425C8.825 9.92498 11.125 9.92498 12.625 11.425C13.225 12.025 13.625 12.925 13.725 13.725C14.825 13.825 15.925 13.525 16.725 12.625C17.125 12.225 17.425 11.825 17.525 11.325C17.125 10.225 16.525 9.22498 15.625 8.42498C12.525 5.32498 7.425 5.32498 4.325 8.42498C1.225 11.525 1.225 16.625 4.325 19.725C7.425 22.825 12.525 22.825 15.625 19.725C16.325 19.025 16.925 18.225 17.225 17.325C15.425 18.125 13.225 18.225 11.325 17.525Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">40</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Tasks</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center ms-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs045.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M2 11.7127L10 14.1127L22 11.7127L14 9.31274L2 11.7127Z" fill="black" />
                                                    <path opacity="0.3" d="M20.9 7.91274L2 11.7127V6.81275C2 6.11275 2.50001 5.61274 3.10001 5.51274L20.6 2.01274C21.3 1.91274 22 2.41273 22 3.11273V6.61273C22 7.21273 21.5 7.81274 20.9 7.91274ZM22 16.6127V11.7127L3.10001 15.5127C2.50001 15.6127 2 16.2127 2 16.8127V20.3127C2 21.0127 2.69999 21.6128 3.39999 21.4128L20.9 17.9128C21.5 17.8128 22 17.2127 22 16.6127Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$5.8M</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Sales</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
                <!--end::Mixed Widget 14-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-4">
                <!--begin::Mixed Widget 14-->
                <div class="card card-xxl-stretch mb-5 mb-xl-8" style="background-color: #CBF0F4">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column mb-7">
                            <!--begin::Title-->
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Summary</a>
                            <!--end::Title-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Row-->
                        <div class="row g-0">
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-9 me-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs043.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 8H8L12 4H19C19.6 4 20.2 4.39999 20.5 4.89999L22 8ZM3.5 19.1C3.8 19.7 4.4 20 5 20H12L16 16H2L3.5 19.1ZM19.1 20.5C19.7 20.2 20 19.6 20 19V12L16 8V22L19.1 20.5ZM4.9 3.5C4.3 3.8 4 4.4 4 5V12L8 16V2L4.9 3.5Z" fill="black" />
                                                    <path d="M22 8L20 12L16 8H22ZM8 16L4 12L2 16H8ZM16 16L12 20L16 22V16ZM8 8L12 4L8 2V8Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$50K</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Sales</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-9 ms-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs046.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M8 22C7.4 22 7 21.6 7 21V9C7 8.4 7.4 8 8 8C8.6 8 9 8.4 9 9V21C9 21.6 8.6 22 8 22Z" fill="black" />
                                                    <path opacity="0.3" d="M4 15C3.4 15 3 14.6 3 14V6C3 5.4 3.4 5 4 5C4.6 5 5 5.4 5 6V14C5 14.6 4.6 15 4 15ZM13 19V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V19C11 19.6 11.4 20 12 20C12.6 20 13 19.6 13 19ZM17 16V5C17 4.4 16.6 4 16 4C15.4 4 15 4.4 15 5V16C15 16.6 15.4 17 16 17C16.6 17 17 16.6 17 16ZM21 18V10C21 9.4 20.6 9 20 9C19.4 9 19 9.4 19 10V18C19 18.6 19.4 19 20 19C20.6 19 21 18.6 21 18Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$4,5K</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Revenue</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center me-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs022.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M11.425 7.325C12.925 5.825 15.225 5.825 16.725 7.325C18.225 8.825 18.225 11.125 16.725 12.625C15.225 14.125 12.925 14.125 11.425 12.625C9.92501 11.225 9.92501 8.825 11.425 7.325ZM8.42501 4.325C5.32501 7.425 5.32501 12.525 8.42501 15.625C11.525 18.725 16.625 18.725 19.725 15.625C22.825 12.525 22.825 7.425 19.725 4.325C16.525 1.225 11.525 1.225 8.42501 4.325Z" fill="black" />
                                                    <path d="M11.325 17.525C10.025 18.025 8.425 17.725 7.325 16.725C5.825 15.225 5.825 12.925 7.325 11.425C8.825 9.92498 11.125 9.92498 12.625 11.425C13.225 12.025 13.625 12.925 13.725 13.725C14.825 13.825 15.925 13.525 16.725 12.625C17.125 12.225 17.425 11.825 17.525 11.325C17.125 10.225 16.525 9.22498 15.625 8.42498C12.525 5.32498 7.425 5.32498 4.325 8.42498C1.225 11.525 1.225 16.625 4.325 19.725C7.425 22.825 12.525 22.825 15.625 19.725C16.325 19.025 16.925 18.225 17.225 17.325C15.425 18.125 13.225 18.225 11.325 17.525Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">40</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Tasks</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center ms-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs045.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M2 11.7127L10 14.1127L22 11.7127L14 9.31274L2 11.7127Z" fill="black" />
                                                    <path opacity="0.3" d="M20.9 7.91274L2 11.7127V6.81275C2 6.11275 2.50001 5.61274 3.10001 5.51274L20.6 2.01274C21.3 1.91274 22 2.41273 22 3.11273V6.61273C22 7.21273 21.5 7.81274 20.9 7.91274ZM22 16.6127V11.7127L3.10001 15.5127C2.50001 15.6127 2 16.2127 2 16.8127V20.3127C2 21.0127 2.69999 21.6128 3.39999 21.4128L20.9 17.9128C21.5 17.8128 22 17.2127 22 16.6127Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$5.8M</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Sales</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
                <!--end::Mixed Widget 14-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-4">
                <!--begin::Mixed Widget 14-->
                <div class="card card-xxl-stretch mb-5 mb-xl-8" style="background-color: #CBD4F4">
                    <!--begin::Body-->
                    <div class="card-body d-flex flex-column">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column mb-7">
                            <!--begin::Title-->
                            <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">Summary</a>
                            <!--end::Title-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Row-->
                        <div class="row g-0">
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-9 me-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs043.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 8H8L12 4H19C19.6 4 20.2 4.39999 20.5 4.89999L22 8ZM3.5 19.1C3.8 19.7 4.4 20 5 20H12L16 16H2L3.5 19.1ZM19.1 20.5C19.7 20.2 20 19.6 20 19V12L16 8V22L19.1 20.5ZM4.9 3.5C4.3 3.8 4 4.4 4 5V12L8 16V2L4.9 3.5Z" fill="black" />
                                                    <path d="M22 8L20 12L16 8H22ZM8 16L4 12L2 16H8ZM16 16L12 20L16 22V16ZM8 8L12 4L8 2V8Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$50K</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Sales</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center mb-9 ms-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs046.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M8 22C7.4 22 7 21.6 7 21V9C7 8.4 7.4 8 8 8C8.6 8 9 8.4 9 9V21C9 21.6 8.6 22 8 22Z" fill="black" />
                                                    <path opacity="0.3" d="M4 15C3.4 15 3 14.6 3 14V6C3 5.4 3.4 5 4 5C4.6 5 5 5.4 5 6V14C5 14.6 4.6 15 4 15ZM13 19V3C13 2.4 12.6 2 12 2C11.4 2 11 2.4 11 3V19C11 19.6 11.4 20 12 20C12.6 20 13 19.6 13 19ZM17 16V5C17 4.4 16.6 4 16 4C15.4 4 15 4.4 15 5V16C15 16.6 15.4 17 16 17C16.6 17 17 16.6 17 16ZM21 18V10C21 9.4 20.6 9 20 9C19.4 9 19 9.4 19 10V18C19 18.6 19.4 19 20 19C20.6 19 21 18.6 21 18Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$4,5K</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Revenue</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center me-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs022.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M11.425 7.325C12.925 5.825 15.225 5.825 16.725 7.325C18.225 8.825 18.225 11.125 16.725 12.625C15.225 14.125 12.925 14.125 11.425 12.625C9.92501 11.225 9.92501 8.825 11.425 7.325ZM8.42501 4.325C5.32501 7.425 5.32501 12.525 8.42501 15.625C11.525 18.725 16.625 18.725 19.725 15.625C22.825 12.525 22.825 7.425 19.725 4.325C16.525 1.225 11.525 1.225 8.42501 4.325Z" fill="black" />
                                                    <path d="M11.325 17.525C10.025 18.025 8.425 17.725 7.325 16.725C5.825 15.225 5.825 12.925 7.325 11.425C8.825 9.92498 11.125 9.92498 12.625 11.425C13.225 12.025 13.625 12.925 13.725 13.725C14.825 13.825 15.925 13.525 16.725 12.625C17.125 12.225 17.425 11.825 17.525 11.325C17.125 10.225 16.525 9.22498 15.625 8.42498C12.525 5.32498 7.425 5.32498 4.325 8.42498C1.225 11.525 1.225 16.625 4.325 19.725C7.425 22.825 12.525 22.825 15.625 19.725C16.325 19.025 16.925 18.225 17.225 17.325C15.425 18.125 13.225 18.225 11.325 17.525Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">40</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Tasks</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <div class="d-flex align-items-center ms-2">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-white bg-opacity-50">
                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs045.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-dark">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M2 11.7127L10 14.1127L22 11.7127L14 9.31274L2 11.7127Z" fill="black" />
                                                    <path opacity="0.3" d="M20.9 7.91274L2 11.7127V6.81275C2 6.11275 2.50001 5.61274 3.10001 5.51274L20.6 2.01274C21.3 1.91274 22 2.41273 22 3.11273V6.61273C22 7.21273 21.5 7.81274 20.9 7.91274ZM22 16.6127V11.7127L3.10001 15.5127C2.50001 15.6127 2 16.2127 2 16.8127V20.3127C2 21.0127 2.69999 21.6128 3.39999 21.4128L20.9 17.9128C21.5 17.8128 22 17.2127 22 16.6127Z" fill="black" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </div>
                                    </div>
                                    <!--end::Symbol-->
                                    <!--begin::Title-->
                                    <div>
                                        <div class="fs-5 text-dark fw-bolder lh-1">$5.8M</div>
                                        <div class="fs-7 text-gray-600 fw-bold">Sales</div>
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                </div>
                <!--end::Mixed Widget 14-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Calendar Widget 1-->
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder text-dark">My Calendar</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Preview monthly events</span>
                </h3>
                <div class="card-toolbar">
                    <a href="../../demo16/dist/apps/calendar.html" class="btn btn-primary">Manage Calendar</a>
                </div>
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Calendar-->
                <div id="kt_calendar_widget_1"></div>
                <!--end::Calendar-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Calendar Widget 1-->

    </div>
    <!--end::Post-->
</div>
@endsection

@section('script')
    <script src="{{asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-app.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-project/type.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-project/budget.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-project/settings.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-project/team.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-project/targets.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-project/files.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-project/complete.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom/modals/create-project/main.js')}}"></script>
@endsection

