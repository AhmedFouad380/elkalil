@extends('admin.layouts.master')

@section('css')
    <link href="{{asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder my-1 fs-3">لوحة القيادة</h1>
@endsection

@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Row-->
            @if(Auth::user()->jop_type != 1 )
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10 mb-5">
                    <!--begin::Mixed Widget 2-->
                    <div class="card card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Header-->
                        <div class="card-header border-0 bg-primary py-5">
                            <h3 class="card-title fw-bolder text-white"> الايرادات و المصروفات </h3>
                            <div class="card-toolbar">
                                <!--begin::Menu-->

                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <!--begin::Chart-->
                            <div class="mixed-widget-2-chart card-rounded-bottom bg-primary" data-kt-color="primary"
                                 style="height: 200px"></div>
                            <!--end::Chart-->
                            <!--begin::Stats-->
                            <div class="card-p mt-n20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
                                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                                  fill="black"/>
                                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
                                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-warning fw-bold fs-6">سندات القبض</a>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
                                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                                  fill="black"/>
                                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
                                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-primary fw-bold fs-6">سندات الصرف</a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                  fill="black"/>
                                            <path
                                                d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                fill="black"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-danger fw-bold fs-6 mt-2">المطالبة المالية </a>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col bg-light-success px-6 py-8 rounded-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                               viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                  fill="black"/>
                                            <path
                                                d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                fill="black"/>
                                        </svg>
                                    </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-success fw-bold fs-6 mt-2">كشف حساب عميل </a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 2-->
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

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <path
                                                d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z"
                                                fill="black"/>
                                            <path opacity="0.3"
                                                  d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z"
                                                  fill="black"/>
                                        </svg>
                                </span>
                                    <!--end::Svg Icon-->
                                    <div class="d-flex flex-column">
                                        @inject('Inbox','App\Models\inbox')
                                        <div class="text-white fw-bolder fs-1 mb-0 mt-5">{{$Inbox->count()}}</div>
                                        <div class="text-white fw-bold fs-6">البريد الوارد</div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Tiles Widget 5-->
                        </div>
                        <div class="col-lg-6 mb-5 mb-lg-10">
                            <!--begin::Tiles Widget 5-->
                            <a href="{{url('Requests')}}" class="card bg-dark h-150px">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-white svg-icon-2hx ms-n1 flex-grow-1">

                                                                                 <svg xmlns="http://www.w3.org/2000/svg"
                                                                                      width="24" height="24"
                                                                                      viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3"
                                                  d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                  fill="black"/>
                                            <path
                                                d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                fill="black"/>
                                        </svg>

                                </span>
                                    <!--end::Svg Icon-->
                                    <div class="d-flex flex-column">
                                        @inject('Project','App\Models\Project')
                                        <div
                                            class="text-white fw-bolder fs-1 mb-0 mt-5">{{$Project->where('is_accepted',2)->count()}}</div>
                                        <div class="text-white  fs-6" style="font-size: 12px!important">طالبات العملاء
                                            الجدد
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Tiles Widget 5-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <!--end::Col-->
                    </div>
                    <div class="row g-5 g-lg-10">
                        <!--begin::Col-->
                        <div class="col-lg-6 mb-5 mb-lg-10">
                            <!--begin::Tiles Widget 5-->
                            <a href="#" class="card bg-danger  h-150px">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-white svg-icon-2hx ms-n1 flex-grow-1">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                             viewBox="0 0 24 24" fill="none">
                                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
                                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                                  fill="black"/>
                                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
                                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
                                        </svg>
                                </span>
                                    <!--end::Svg Icon-->
                                    <div class="d-flex flex-column">
                                        @inject('Project','App\Models\Project')
                                        <div
                                            class="text-white fw-bolder fs-1 mb-0 mt-5">{{$Project->where('confirm',1)->where('progress','!=',100)->count()}}</div>
                                        <div class="text-white  fs-6" style="font-size: 12px!important"> التعاقدات و
                                            المتابعه
                                        </div>
                                        <div class="text-white  fs-6" style="font-size: 10px!important"> المشاريع
                                            المفعلة
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Tiles Widget 5-->
                        </div>
                        <div class="col-lg-6 mb-5 mb-lg-10">
                            <!--begin::Tiles Widget 5-->
                            <a href="#" class="card bg-success h-150px">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-white svg-icon-2hx ms-n1 flex-grow-1">

                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                             viewBox="0 0 24 24" fill="none">
                                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"/>
                                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5"
                                                  fill="black"/>
                                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"/>
                                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"/>
                                        </svg>

                                </span>
                                    <!--end::Svg Icon-->
                                    <div class="d-flex flex-column">
                                        @inject('Project','App\Models\Project')
                                        <div
                                            class="text-white fw-bolder fs-1 mb-0 mt-5">{{$Project->where('confirm',0)->count()}}</div>
                                        <div class="text-white  fs-6" style="font-size: 12px!important"> التعاقدات و
                                            المتابعه
                                        </div>
                                        <div class="text-white  fs-6" style="font-size: 10px!important"> المشاريع غير
                                            المفعلة
                                        </div>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Tiles Widget 5-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <!--end::Row-->
                    <!--begin::Engage widget 4-->
                    <a href="#" class="card bgi-no-repeat h-150px mb-5 mb-lg-10"
                       style="background-color: #4AB58E; background-position: calc(100% + 1rem) bottom; background-size: 25% auto; ">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column align-items-start justify-content-center">
                            <h3 class="text-white fw-bolder mb-3">{{$Project->where('is_archive',1)->count()   }} </h3>
                            <h3 class="text-white fw-bolder mb-3">ارشيف المشاريع </h3>
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
                                    <div class="card-toolbar">
                                        <!--begin::Menu-->
                                        <button type="button"
                                                class="btn btn-sm btn-light btn-color-primary btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                            <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"/>
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                                            <!--end::Svg Icon-->
                                        </button>
                                        <!--begin::Menu 1-->
                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px"
                                             data-kt-menu="true" id="kt_menu_61a08bf50cf89">
                                            <!--begin::Header-->
                                            <form>
                                                <div class="px-7 py-5">
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
                                                        <label class="form-label fw-bold">من </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div>
                                                            <input type="date" id="to" class="form-control">
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="mb-10">
                                                        <!--begin::Label-->
                                                        <label class="form-label fw-bold">الى </label>
                                                        <!--end::Label-->
                                                        <!--begin::Input-->
                                                        <div>
                                                            <input type="date" id="from" class="form-control">
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>

                                                    <!--end::Input group-->
                                                    <!--begin::Actions-->
                                                    <div class="d-flex justify-content-end">
                                                        <button type="reset"
                                                                class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                                data-kt-menu-dismiss="true">الغاء
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                                id="getMoney" data-kt-menu-dismiss="true">بحث
                                                        </button>
                                                    </div>
                                                    <!--end::Actions-->
                                                </div>
                                            </form>

                                            <!--end::Form-->
                                        </div>
                                        <!--end::Menu 1-->
                                        <!--end::Menu-->
                                    </div>

                                </div>
                                <!--end::Heading-->
                                <!--begin::Balance-->
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold "
                                          style="font-size: 20px; ">اجمالي دخل المشاريع حسب العقود  </span>
                                </div>

                                <!--end::Balance-->
                            </div>
                            <!--end::Header-->
                            <!--begin::Items-->
                            <div id="MoneyData"
                                 class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1"
                                 style="margin-top: -100px">
                                <!--begin::Item-->
                                <div class="d-flex text-center flex-column text-white pt-8">
                                    <span class="fw-bold fs-7" style="color:#000">اجمالي دخل المشاريع  </span>
                                    @inject('income','App\Models\Income')
                                    <span class="fw-bolder fs-2x pt-1"
                                          style="color:#000">{{$income->sum('amount')}} ر.س</span>
                                </div>
                            @inject('contracts','App\Models\Contract')
                            @inject('ProjectContract','App\Models\ProjectContract')
                            <!--end::Item-->
                                <!--begin::Item-->
                                @foreach($contracts->where('id','!=',1)->get() as $Contract)
                                    <div class="d-flex align-items-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-45px w-40px me-5">
                                    <span class="symbol-label bg-lighten">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                      d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z"
                                                      fill="black"/>
                                                <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"/>
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
                                                <a href="#"
                                                   class="fs-5 text-gray-800 text-hover-primary fw-bolder">{{$Contract->title}}</a>
                                                <div class="text-gray-400 fw-bold fs-7">
                                                    ( {{$ProjectContract->where('contract_id','!=',1)->where('contract_id',$Contract->id)->count() }}
                                                    )
                                                </div>
                                            </div>
                                            <!--end::Title-->
                                            <!--begin::Label-->
                                            <div class="d-flex align-items-center">
                                                <div
                                                    class="fw-bolder fs-5 text-gray-800 pe-1">{{$ProjectContract->where('contract_id',$Contract->id)->join('incomes','incomes.project_id','project_contract.project_id','left')->sum('amount')}}</div>
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                <span class="svg-icon svg-icon-5 svg-icon-success ms-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1"
                                                      transform="rotate(90 13 6)" fill="black"/>
                                                <path
                                                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                    fill="black"/>
                                            </svg>
                                        </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Description-->
                                    </div>
                            @endforeach

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
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Mixed Widget 6-->
                    <div class="card card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Beader-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">ملخص المشاريع حسب المراحل</span>
                                <span class="text-muted fw-bold fs-7" id="contractName">{{$contract->title}}</span>
                            </h3>
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button type="button"
                                        class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"/>
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 1-->
                                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                     id="kt_menu_61a08bf50cf89">
                                    <!--begin::Header-->
                                    <form>
                                        <div class="px-7 py-5">
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
                                                <label class="form-label fw-bold">انواع العقود </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div>
                                                    <select id="idContract" class="form-select form-select-solid"
                                                            data-kt-select2="true" data-placeholder="Select option"
                                                            data-allow-clear="true">
                                                        @inject('contracts','App\Models\Contract')
                                                        @foreach($contracts->where('id','!=',1)->get() as $cont)
                                                            <option @if($cont->id == $contract->id) selected
                                                                    @endif value="{{$cont->id}}"> {{$cont->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
                                                <button type="reset"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-menu-dismiss="true">الغاء
                                                </button>
                                                <button type="button" class="btn btn-sm btn-primary" id="getLevel"
                                                        data-kt-menu-dismiss="true">بحث
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </div>
                                    </form>

                                    <!--end::Form-->
                                </div>
                                <!--end::Menu 1-->
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0 d-flex flex-column">
                            <!--begin::Stats-->
                            <div class="card-px pt-5 pb-10 flex-grow-1">
                                <!--begin::Row-->
                                <div class="row g-0 mt-5 mb-10" id="items">
                                    @inject('levels','App\Models\Level')
                                    @inject('ProjectLevels','App\Models\ProjectLevels')
                                    @foreach($levels->where('contract_id',$contract->id)->where('percent','!=',0)->get() as $key => $level)
                                        <div class="col-2" style="margin-bottom: 30px">
                                            <div class="d-flex align-items-center me-2">
                                                <div class="symbol symbol-50px me-3">
                                                    <div class="symbol-label bg-light-danger">
                                                <span class="svg-icon svg-icon-1 svg-icon-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                              d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                              fill="black"/>
                                                        <path
                                                            d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                            fill="black"/>
                                                    </svg>
                                                </span>
                                                    </div>
                                                </div>
                                                <?php

                                                $countProjectLevels = $ProjectLevels->where('level_id',$level->id)->where('auto_complete','!=',1)->get();
                                                $count = 0;
                                                foreach ($countProjectLevels as $b) {
                                                    if($b->percent != $b->progress){
                                                        $count++;
                                                    }
                                                }

                                                ?>
                                                <div>
                                                    <div class="fs-4 text-dark fw-bolder">{{$count}}</div>
                                                    <div class="fs-7 text-muted fw-bold">{{$level->title}}</div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                @endforeach
                                <!--begin::Col-->
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                            <!--begin::Chart-->
                            <div class="mixed-widget-6-chart card-rounded-bottom" data-kt-chart-color="danger"
                                 style="height: 150px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 6-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-12">
                    <!--begin::Mixed Widget 6-->
                    <div class="card card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Beader-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bolder fs-3 mb-1">ملخص المشاريع حسب المناطق</span>
                            </h3>

                            <button type="button"
                                    class="btn btn-sm btn-light btn-color-primary btn-active-light-primary"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                         viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"/>
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000"
                                                  opacity="0.3"/>
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                 id="kt_menu_project_state">
                                <!--begin::Header-->
                                <form id="project_state">
                                    <div class="px-7 py-5">
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
                                            <label class="form-label fw-bold">من </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <input type="date" id="project_from" class="form-control">
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bold">الى </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div>
                                                <input type="date" id="project_to" class="form-control">
                                            </div>
                                            <!--end::Input-->
                                        </div>

                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="d-flex justify-content-end">
                                            <button type="reset"
                                                    class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                    data-kt-menu-dismiss="true">الغاء
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-primary">بحث</button>
                                        </div>
                                        <!--end::Actions-->
                                    </div>
                                </form>

                                <!--end::Form-->
                            </div>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0 d-flex flex-column">
                            <!--begin::Stats-->
                            <div class="card-px pt-5 pb-10 flex-grow-1">
                                <!--begin::Row-->
                                <div class="row g-0 mt-5 mb-10" id="items2">
                                    @inject('Project','App\Models\Project')
                                    @inject('State','App\Models\State')
                                    @foreach($State->all() as $key => $data)
                                        <div class="col-2" style="margin-bottom: 30px">
                                            <div class="d-flex align-items-center me-2">
                                                <div class="symbol symbol-50px me-3">
                                                    <div class="symbol-label bg-light-danger">
                                                <span class="svg-icon svg-icon-1 svg-icon-danger">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                         viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                              d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                              fill="black"/>
                                                        <path
                                                            d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                            fill="black"/>
                                                    </svg>
                                                </span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div
                                                        class="fs-4 text-dark fw-bolder">{{$Project->where('state',$data->id)->count()}}</div>
                                                    <div class="fs-7 text-muted fw-bold">{{$data->title}}</div>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                @endforeach
                                <!--begin::Col-->
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                            <!--begin::Chart-->
                        {{--                        <div class="mixed-widget-6-chart card-rounded-bottom" data-kt-chart-color="danger" style="height: 150px"></div>--}}
                        <!--end::Chart-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 6-->
                </div>
                <!--end::Col-->
            </div>
            @endif

            <!--begin::Calendar Widget 1-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">My Calendar</span>
                        {{--                    <span class="text-muted mt-1 fw-bold fs-7">Preview monthly events</span>--}}
                    </h3>
                    <div class="card-toolbar">
                        <a href="#" class="btn btn-light-primary" data-bs-toggle="modal"
                           data-bs-target="#kt_modal_new_card">انشاء حدث</a>

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
    <div class="modal fade" id="kt_modal_new_card" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2>اضافة حدث</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                          transform="rotate(-45 6 17.3137)" fill="black"/>
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                          transform="rotate(45 7.41422 6)" fill="black"/>
                                </svg>
                            </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <!--begin::Form-->
                    <form action="{{url('store_event')}}" method="post">

                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label> العنوان</label>
                                <input type="text" name="title" class="form-control">

                            </div>
                            <div class="form-group">
                                <label> التاريخ</label>
                                <input type="date" name="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label> الوقت</label>
                                <input type="time" name="time" class="form-control">
                            </div>
                            <div class="form-group">
                                <label> الوصف</label>
                                <textarea name="description" class="form-control" rows="6"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">الغاء
                            </button>
                            <button type="submit" class="btn btn-primary">حفظ</button>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                [
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>


@endsection

@section('script')
    <script src="{{asset('admin/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
    {{--   <script src="{{asset('admin/assets/js/custom/widgets.js')}}"></script>--}}
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
    <script>

        $("#getMoney").click(function () {
            var to = $('#to').val();
            var from = $('#from').val();

            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "GET",
                url: "{{url('getMoney')}}",
                data: {"to": to, "from": from},
                success: function (data) {
                    $("#MoneyData").html(data)
                }
            })

        })
        $(document).ready(function () {
            $("#project_state").submit(function (e) {
                e.preventDefault();

                var project_to = $('#project_to').val();
                var project_from = $('#project_from').val();

                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: "GET",
                    url: "{{url('projectState')}}",
                    data: {"project_to": project_to, "project_from": project_from},
                    success: function (data) {
                        $("#items2").html(data)
                        $('#kt_menu_project_state').hide();

                    }
                })

            })
        });

        $("#getLevel").click(function () {
            var id = $('#idContract').val();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "GET",
                url: "{{url('Get_Levels')}}",
                data: {"id": id},
                success: function (data) {
                    $("#items").html(data)
                    $('#kt_menu_61a08bf50cf89').hide();
                }
            })

            $.ajax({
                type: "GET",
                url: "{{url('contractName')}}",
                data: {"id": id},
                success: function (data) {
                    $("#contractName").html(data)
                }
            })
        })
    </script>
    <script>
        (function () {
            var e,
                t,
                a,
                o = document.querySelectorAll(".mixed-widget-2-chart"),
                s = KTUtil.getCssVariableValue("--bs-gray-500"),
                r = KTUtil.getCssVariableValue("--bs-gray-200");
            [].slice.call(o).map(function (o) {
                (a = parseInt(KTUtil.css(o, "height"))),
                    (e = KTUtil.getCssVariableValue("--bs-" + o.getAttribute("data-kt-color"))),
                    (t = KTUtil.colorDarken(e, 15)),
                    new ApexCharts(o, {
                        @inject('project','App\Models\Project')
                            @inject('income','App\Models\Income')
                            @inject('Outcome','App\Models\Outcome')
                        @php
                            $max = 5;
                        $max2 = 5;
                        @endphp
                        series: [{
                            name: " سندات القبض ", data:
                                [
                                    @for($x = 1 ; $x <= 12 ;$x++)
                                    {{$income->whereYear('created_at',date('Y'))->whereMonth('created_at',$x)->count()}},
                                    @php
                                        if($income->whereYear('created_at',date('Y'))->whereMonth('created_at',$x)->count() > $max2){
                                        $max2 = $Outcome->whereYear('created_at',date('Y'))->whereMonth('created_at',$x)->count();
                                        }
                                    @endphp
                                    @endfor
                                ]
                        },
                            {
                                name: " سندات الصرف ", data:
                                    [
                                        @for($x = 1 ; $x <= 12 ;$x++)
                                        {{$Outcome->whereYear('created_at',date('Y'))->whereMonth('created_at',$x)->count()}},
                                        @php
                                        if($Outcome->whereYear('created_at',date('Y'))->whereMonth('created_at',$x)->count() > $max){
                                        $max = $Outcome->whereYear('created_at',date('Y'))->whereMonth('created_at',$x)->count();
                                        }
                                        @endphp
                                        @endfor
                                    ]
                            },
                        ],
                        chart: {
                            fontFamily: "inherit",
                            type: "area",
                            height: a,
                            toolbar: {show: !1},
                            zoom: {enabled: !1},
                            sparkline: {enabled: !0},
                            dropShadow: {
                                enabled: !0,
                                enabledOnSeries: void 0,
                                top: 5,
                                left: 0,
                                blur: 3,
                                color: t,
                                opacity: 0.5
                            },
                        },
                        plotOptions: {},
                        legend: {show: !1},
                        dataLabels: {enabled: !1},
                        fill: {type: "solid", opacity: 0},
                        stroke: {curve: "smooth", show: !0, width: 3, colors: [t]},
                        xaxis: {
                            categories: ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو ", "يوليو", "اغسطس", "سبتمير ", "أكتوبر", "نوفمبر", "ديسمبر"
                            ],
                            axisBorder: {show: !1},
                            axisTicks: {show: !1},
                            labels: {show: !1, style: {colors: s, fontSize: "12px"}},
                        },
                        @php
                        if($max > $max2 ){
                        $big = $max;
                        }else{
                        $big = $max2;
                        }
                        @endphp
                        yaxis: {min: 0, max: {{$big}}, labels: {show: !1, style: {colors: s, fontSize: "12px"}}},
                        states: {
                            normal: {filter: {type: "none", value: 0}},
                            hover: {filter: {type: "none", value: 0}},
                            active: {allowMultipleDataPointsSelection: !1, filter: {type: "none", value: 0}}
                        },
                        tooltip: {
                            style: {fontSize: "12px"},
                            y: {
                                formatter: function (e) {
                                    return "" + e + " ";
                                },
                            },
                            marker: {show: !1},
                        },
                        colors: ["transparent"],
                        markers: {colors: [e], strokeColor: [t], strokeWidth: 3},
                    }).render();
            });
        })()

    </script>
    <script>
        (function () {
            var e = document.getElementById("kt_charts_widget_3_chart"),
                t = (parseInt(KTUtil.css(e, "height")), KTUtil.getCssVariableValue("--bs-gray-500")),
                a = KTUtil.getCssVariableValue("--bs-gray-200"),
                o = KTUtil.getCssVariableValue("--bs-info"),
                s = KTUtil.getCssVariableValue("--bs-light-info");
            e &&
            new ApexCharts(e, {
                series: [{
                    name: "",
                    data: [
                        @for($x = 1 ; $x <= 12 ;$x++)
                        {{$project->whereYear('accept_date',date('Y'))->whereMonth('accept_date',$x)->count()}},
                        @endfor
                    ]
                }],
                chart: {fontFamily: "inherit", type: "area", height: 350, toolbar: {show: !1}},
                plotOptions: {},
                legend: {show: !1},
                dataLabels: {enabled: !1},
                fill: {type: "solid", opacity: 1},
                stroke: {curve: "smooth", show: !0, width: 3, colors: [o]},
                xaxis: {
                    categories: ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو ", "يوليو", "اغسطس", "سبتمير ", "أكتوبر", "نوفمبر", "ديسمبر"
                    ],
                    axisBorder: {show: !1},
                    axisTicks: {show: !1},
                    labels: {style: {colors: t, fontSize: "12px"}},
                    crosshairs: {position: "front", stroke: {color: o, width: 1, dashArray: 3}},
                    tooltip: {enabled: !0, formatter: void 0, offsetY: 0, style: {fontSize: "12px"}},
                },
                yaxis: {labels: {style: {colors: t, fontSize: "12px"}}},
                states: {
                    normal: {filter: {type: "none", value: 0}},
                    hover: {filter: {type: "none", value: 0}},
                    active: {allowMultipleDataPointsSelection: !1, filter: {type: "none", value: 0}}
                },
                tooltip: {
                    style: {fontSize: "12px"},
                    y: {
                        formatter: function (e) {
                            return "" + e + "";
                        },
                    },
                },
                colors: [s],
                grid: {borderColor: a, strokeDashArray: 4, yaxis: {lines: {show: !0}}},
                markers: {strokeColor: o, strokeWidth: 3},
            }).render();
        })()

    </script>
    <script>
        (function () {
            var e = document.querySelectorAll(".mixed-widget-6-chart");
            [].slice.call(e).map(function (e) {
                var t = parseInt(KTUtil.css(e, "height"));
                if (e) {
                    var a = e.getAttribute("data-kt-chart-color"),
                        o = KTUtil.getCssVariableValue("--bs-gray-800"),
                        s = KTUtil.getCssVariableValue("--bs-gray-300"),
                        r = KTUtil.getCssVariableValue("--bs-" + a),
                        i = KTUtil.getCssVariableValue("--bs-light-" + a);
                    new ApexCharts(e, {
                        series: [
                                @inject('Project','App\Models\Project')
                            {
                                name: "اجمالي المشاريع التي تم تفعيلها ", data: [
                                    @for($x = 1; $x <= 12 ; $x++)
                                    @if($x == 12 )
                                    {{$Project->whereYear('confirm_date',date('Y'))->whereMonth('confirm_date',$x)->count()}}
                                    @else
                                    {{$Project->whereYear('confirm_date',date('Y'))->whereMonth('confirm_date',$x)->count()}},
                                    @endif
                                    @endfor
                                ]
                            }
                        ],


                        chart: {
                            fontFamily: "inherit",
                            type: "area",
                            height: t,
                            toolbar: {show: !1},
                            zoom: {enabled: !1},
                            sparkline: {enabled: !0}
                        },
                        plotOptions: {},
                        legend: {show: !1},
                        dataLabels: {enabled: !1},
                        fill: {type: "solid", opacity: 1},
                        stroke: {curve: "smooth", show: !0, width: 3, colors: [r]},
                        xaxis: {
                            categories: ["يناير", "فبراير", "مارس", "ابريل", "مايو", "يونيو ", "يوليو", "اغسطس", "سبتمير ", "أكتوبر", "نوفمبر", "ديسمبر"
                            ],
                            axisBorder: {show: !1},
                            axisTicks: {show: !1},
                            labels: {show: !1, style: {colors: o, fontSize: "12px"}},
                            crosshairs: {show: !1, position: "front", stroke: {color: s, width: 1, dashArray: 3}},
                            tooltip: {enabled: !0, formatter: void 0, offsetY: 0, style: {fontSize: "12px"}},
                        },
                        yaxis: {min: 0, max: 200, labels: {show: !1, style: {colors: o, fontSize: "12px"}}},
                        states: {
                            normal: {filter: {type: "none", value: 0}},
                            hover: {filter: {type: "none", value: 0}},
                            active: {allowMultipleDataPointsSelection: !1, filter: {type: "none", value: 0}}
                        },
                        tooltip: {
                            style: {fontSize: "12px"},
                            y: {
                                formatter: function (e) {
                                    return "" + e + " ";
                                },
                            },
                        },
                        colors: [i],
                        markers: {colors: [i], strokeColor: [r], strokeWidth: 3},
                    }).render();
                }
            });
        })()
    </script>
    <script>
        (function () {
            if ("undefined" != typeof FullCalendar && document.querySelector("#kt_calendar_widget_1")) {
                var e = moment().startOf("day"),
                    t = e.format("YYYY-MM"),
                    a = e.clone().subtract(1, "day").format("YYYY-MM-DD"),
                    o = e.format("YYYY-MM-DD"),
                    s = e.clone().add(1, "day").format("YYYY-MM-DD"),
                    r = document.getElementById("kt_calendar_widget_1");
                new FullCalendar.Calendar(r, {
                    headerToolbar: {
                        left: "prev,next today ",
                        center: "title,description",
                        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                    },
                    height: 800,
                    contentHeight: 780,
                    aspectRatio: 3,
                    nowIndicator: !0,
                    now: o + "T09:25:00",
                    views: {
                        dayGridMonth: {buttonText: "شهر"},
                        timeGridWeek: {buttonText: "اسبوع"},
                        timeGridDay: {buttonText: "يوم"},
                        listMonth: {buttonText: 'قائمة'}
                        ,
                        today: {buttonText: 'اليوم'}
                    },
                    initialView: "dayGridMonth",
                    initialDate: o,
                    // editable: !0,
                    dayMaxEvents: !0,
                    navLinks: !0,
                    events: [
                            @inject('events','App\Models\Events')
                            @foreach($events->where('user_id',Auth::user()->id)->get() as $event)
                        {
                            title: '{{$event->title}}',
                            start: '{{$event->date}} {{$event->time}}',
                            description: '{{$event->description}}',
                            className: "fc-event-danger fc-event-solid-warning"
                        },
                        @endforeach

                    ],

                }).render();
            }
        })();
    </script>

    <?php
    $message = session()->get("message");
    ?>

    @if( session()->has("message"))
        <script>
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "preventDuplicates": false,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            toastr.success("نجاح", "{{$message}}");
        </script>

    @endif

@endsection

