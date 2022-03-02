@extends('admin.layouts.master')

@section('css')
    <link href="{{ URL::asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('admin/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('style')
    <style>
        .pac-container { z-index: 100000 !important; }
    </style>
@endsection

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder my-1 fs-3">المشاريع حسب الموظف</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-600">
            <a href="{{ url('/') }}" class="text-gray-600 text-hover-primary">لوحة القيادة</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-500">التقرير والاحصائيات</li>
        <li class="breadcrumb-item text-gray-500">المشاريع حسب الموظف</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Stats-->
            <div class="row mb-5 g-lg-12">
                <div class="col-lg-12 col-xxl-12">
                    <!--begin::Card-->
                    <div class="card h-100">
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Wrapper-->
                            <div class="row fv-row">

                                <div class="col-5">

                                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_filter">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                                        <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none">
                                        <path
                                            d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                            fill="black"/>
                                    </svg>
                                    </span>
                                        <!--end::Svg Icon-->اختر الموظف
                                    </button>
                                </div>

                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
            </div>
            <!--end::Stats-->

            <!--begin::Row-->
            <div class="row g-5 g-lg-10">
                <!--begin::Col-->
                @inject('contract','App\Models\Contract')

                @foreach($data as $project)
                    @if($project->confirm_date > \Carbon\Carbon::now()->format('Y-m-d'))
                        <div class="col-md-6 col-xl-4">
                            <!--begin::Card-->
                            <a  style="border:3px solid #bf1e2e !important" class="card border-hover-primary">
                                <!--begin::Card header-->

                                <div class="card-header border-0 pt-9">
                                    <!--begin::Card Title-->
                                    <div class="card-title m-0">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px w-50px bg-light">
                                            <img src="{{ URL::asset('admin/assets/logo.png')}}" alt="image" class="p-3" />
                                        </div>

                                        @if($project->is_created != 0)
                                            <i style="margin: 5px 15px 5px 5px" class="bi bi-person-bounding-box fs-2x text-info" data-bs-toggle="tooltip" data-bs-placement="top" title="تم اضافة المرحلة يدويا "></i>
                                    @endif
                                    <!--end::Avatar-->
                                    </div>
                                    <!--end::Car Title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">

                                        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">@if( $project->projectContract && $contract->find($project->projectContract->contract_id)){{$contract->find($project->projectContract->contract_id)->title}} @endif</span>
                                        @if(Auth::user()->userGroup->is_delete == 1)
                                            <span  data-id="{{$project->id}}" style="margin: 10px" class="DeleteProject badge badge-light-danger fw-bolder me-auto px-4 py-3"> <i class="bi bi-trash fs-2x text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف المشروع"></i></span>
                                        @endif

                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end:: Card header-->
                                <!--begin:: Card body-->
                                <div class="card-body p-9">
                                    <!--begin::Name-->
                                    <div class="fs-3 fw-bolder text-dark">{{$project->name}}  ( لم يتم بدا المشروع بعد) </div>
                                    <!--end::Name-->
                                    <!--begin::Description-->
                                    <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">{{$project->client->name}}</p>
                                    <!--end::Description-->
                                    <!--begin::Progress-->
                                    <div class="flex-grow-1">
                                        <div class="mixed-widget-4-chart{{$project->id}}" data-kt-chart-color="primary" style="height: 200px"></div>
                                    </div>
                                    <!--end::Progress-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap mb-5">
                                        <!--begin::Due-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                            <div class="fs-6 text-gray-800 fw-bolder">{{$project->confirm_date}}</div>
                                            <div class="fw-bold text-gray-400">تاريخ بداية العقد</div>
                                        </div>
                                        <!--end::Due-->
                                        <!--begin::Budget-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                            @inject('ProjectLevels','App\Models\ProjectLevels')
                                            <?php
                                            $sum = $ProjectLevels->where('project_id',$project->id)->sum('progress_time');
                                            ?>
                                            <div class="fs-6 text-gray-800 fw-bolder">{{\Carbon\Carbon::parse($project->confirm_date)->addDays($sum)->format('Y-m-d')}}</div>
                                            <div class="fw-bold text-gray-400">تاريخ التسليم المتوقع
                                            </div>
                                        </div>
                                        <!--end::Budget-->
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Users-->
                                    <div class="symbol-group symbol-hover">
                                        <!--begin::User-->
                                        @if(count($project->assginUsers) > 0)
                                            @foreach($project->assginUsers as $emp)
                                                @if(isset($emp->image))
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{$emp->name}}">
                                                        <img alt="Pic" src="{{$emp-image}}" />
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{$emp->name}}">
                                                        <img alt="Pic" src="{{ URL::asset('admin/assets/media/avatars/150-2.jpg')}}" />
                                                    </div>
                                                @endif
                                            @endforeach
                                        @else
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="">
                                                <div style=" height: 35px"></div>
                                            </div>
                                    @endif
                                    <!--begin::User-->
                                        <!--begin::User-->

                                        <!--begin::User-->
                                    </div>
                                    <!--end::Users-->
                                </div>
                                <!--end:: Card body-->
                            </a>
                            <!--end::Card-->
                        </div>

                    @else
                        <div class="col-md-6 col-xl-4">
                            <!--begin::Card-->
                            <div  class="card border-hover-primary">
                                <!--begin::Card header-->

                                <div class="card-header border-0 pt-9">
                                    <!--begin::Card Title-->
                                    <div class="card-title m-0">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-50px w-50px bg-light">
                                            <img src="{{ URL::asset('admin/assets/logo.png')}}" alt="image" class="p-3" />
                                        </div>


                                        @if($project->is_created != 0)
                                            <i style="margin: 5px 15px 5px 5px" class="bi bi-person-bounding-box fs-2x text-info" data-bs-toggle="tooltip" data-bs-placement="top" title="تم اضافة المرحلة يدويا "></i>
                                        @endif
                                        @if(\App\Models\UserChatPermission::where('reciever_id',Auth::user()->id)->where('is_read',0)->where('type',0)->where('project_id',$project->id)->count() > 0)
                                            <img class="bi bi-person-bounding-box fs-2x text-info" src="{{asset('images/giphy.gif')}}" style="    max-width: 41px;">
                                    @endif
                                    <!--end::Avatar-->
                                    </div>
                                    <!--end::Car Title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <span class="badge badge-light-primary fw-bolder me-auto px-4 py-3">@if( $project->projectContract && $contract->find($project->projectContract->contract_id)){{$contract->find($project->projectContract->contract_id)->title}} @endif</span>
                                        @if(Auth::user()->userGroup->is_delete == 1)
                                            <span  data-id="{{$project->id}}" style="margin: 10px" class="DeleteProject badge badge-light-danger fw-bolder me-auto px-4 py-3"> <i class="bi bi-trash fs-2x text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="حذف المشروع"></i></span>
                                        @endif

                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end:: Card header-->
                                <!--begin:: Card body-->
                                <a href="{{url('project_details',$project->id)}}/{{$user_id}}" class="card border-hover-primary">
                                    <div class="card-body p-9">
                                        <!--begin::Name-->

                                        <div class="fs-3 fw-bolder text-dark">{{$project->name}}</div>
                                        <!--end::Name-->
                                        <!--begin::Description-->
                                        <p class="text-gray-400 fw-bold fs-5 mt-1 mb-7">{{$project->client->name}}</p>
                                        <!--end::Description-->
                                        <!--begin::Progress-->
                                        <div class="flex-grow-1">
                                            <div class="mixed-widget-4-chart{{$project->id}}" data-kt-chart-color="primary" style="height: 200px"></div>
                                        </div>
                                        <!--end::Progress-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap mb-5">
                                            <!--begin::Due-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                                <div class="fs-6 text-gray-800 fw-bolder">{{$project->confirm_date}}</div>
                                                <div class="fw-bold text-gray-400">تاريخ بداية العقد</div>
                                            </div>
                                            <!--end::Due-->
                                            <!--begin::Budget-->
                                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                                @inject('ProjectLevels','App\Models\ProjectLevels')
                                                <?php
                                                $sum = $ProjectLevels->where('project_id',$project->id)->sum('progress_time');
                                                ?>
                                                <div class="fs-6 text-gray-800 fw-bolder">{{\Carbon\Carbon::parse($project->confirm_date)->addDays($sum)->format('Y-m-d')}}</div>
                                                <div class="fw-bold text-gray-400">تاريخ التسليم المتوقع
                                                </div>
                                            </div>
                                            <!--end::Budget-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Users-->
                                        <div class="symbol-group symbol-hover">
                                            <!--begin::User-->
                                            @if(count($project->assginUsers) > 0)
                                                @foreach($project->assginUsers as $emp)
                                                    @if(isset($emp->image))
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{$emp->name}}">
                                                            <img alt="Pic" src="{{$emp-image}}" />
                                                        </div>
                                                    @else
                                                        <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{$emp->name}}">
                                                            <img alt="Pic" src="{{ URL::asset('admin/assets/media/avatars/150-2.jpg')}}" />
                                                        </div>

                                                    @endif
                                                @endforeach
                                            @else
                                                <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="">
                                                    <div style=" height: 35px"></div>
                                                </div>
                                        @endif
                                        <!--begin::User-->
                                            <!--begin::User-->

                                            <!--begin::User-->
                                        </div>
                                        <!--end::Users-->
                                    </div>
                                </a>

                                <!--end:: Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                @endif
                <!--end::Col-->


            @endforeach
            <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Pagination-->
            <div class="d-flex flex-stack flex-wrap pt-10">
                <!--begin::Pages-->
                <ul class="pagination">
                    @if(count($data) > 0)
                    @php
                        $paginator =$data->appends(request()->input())->links()->paginator;
                            if ($paginator->currentPage() < 2 ){
                                        $link = $paginator->currentPage();
                            }else{
                                 $link = $paginator->currentPage() -1;
                            }
                            if($paginator->currentPage() == $paginator->lastPage()){
                                       $last_links = $paginator->currentPage();
                            }else{
                                       $last_links = $paginator->currentPage() +1;

                            }
                    @endphp

                    @if ($paginator->lastPage() > 1)
                        <ul class="pagination">
                            <li class="{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }} page-item">
                                <a class="page-link" href="{{ $paginator->url(1) }}">الاول </a>
                            </li>
                            @for ($i = $link; $i <= $last_links; $i++)
                                <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }} page-item">
                                    <a class="page-link" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                            <li class="{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }} page-item">
                                <a class="page-link"
                                   href="{{ $paginator->url($paginator->lastPage()) }}">الاخير</a>
                            </li>
                        </ul>
                @endif

                    @endif
                <!--end::Pages-->
                </ul>
            </div>
            <!--end::Pagination-->

        </div>
        <!--end::Post-->
    </div>


    <div class="modal fade" id="kt_modal_filter" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">اعدادات الفلتر</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                         data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none">
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
                    <form id="" class="form" method="get">
                    @csrf
                    <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7"
                             id="kt_modal_add_user_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_add_user_header"
                             data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                             data-kt-scroll-offset="300px">

                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">الموظفيين</label>
                                <select name="user_id" class="form-select  form-control form-select-lg form-select-solid" data-placeholder="اختر الموظف ..." data-allow-clear="true" data-hide-search="true">
                                    <option value="">اختر</option>
                                    @inject('Users','App\Models\User')
                                    @foreach($Users->where('jop_type',1)->get() as $User)
                                        <option value="{{$User->id}}">{{$User->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--end::Input group-->

                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">إلغاء
                            </button>
                            <button type="submit" class="btn btn-primary"
                                    data-kt-users-modal-action="submit">
                                <span class="indicator-label">بحث</span>
                                <span class="indicator-progress">برجاء الانتظار
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
    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">اضافة جديده</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                         data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                         viewBox="0 0 24 24" fill="none">
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
                    <form id="" class="form" method="post" action="{{url('store-project')}}">
                    @csrf
                    <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7"
                             id="kt_modal_add_user_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_add_user_header"
                             data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                             data-kt-scroll-offset="300px">

                            <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">اسم المشروع</label>
                                <input type="text" class="form-control form-control-lg form-control-solid"
                                       name="name" placeholder="" value="" autocomplete="nope" required/>
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">اسم العميل</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                @inject('clients','App\Models\Client')
                                <select name="client_id" class="form-select form-select-lg form-select-solid" data-control="select2"
                                        data-dropdown-parent="#kt_modal_add_user" data-placeholder="اختـر..." data-allow-clear="true" >
                                    <option></option>
                                    @foreach($clients->orderBy('name','asc')->get() as $client)
                                        <option value="{{$client->id}}">{{$client->name}}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>

                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="form-label required">حـدد البلـد</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="country" id="country" onchange="myFunction()" onclick="myFunction()" class="form-select form-select-lg form-select-solid" data-placeholder="اختـر..." data-allow-clear="true" data-hide-search="true">
                                    <option value="داخل المملكة العربية السعودية">داخل المملكة العربية السعودية</option>
                                    <option value="خارج المملكة العربية السعودية">خارج المملكة العربية السعودية</option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-7" id="state">
                                <!--begin::Label-->
                                <label class="form-label required">اختـر المدينـة</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="state" class="form-select form-select-lg form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_user" data-placeholder="اختـر..." data-allow-clear="true" >
                                    <option></option>
                                    @foreach (\App\Models\State::get() as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->

                            <div class="fv-row mb-10">
                                <!--begin::Label-->
                                <label class="form-label required">حـدد نوع المشروع</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="project_type" class="form-select form-select-lg form-select-solid" data-control="select2" data-dropdown-parent="#kt_modal_add_user" data-placeholder="اختـر..." data-allow-clear="true">
                                    <option value="فيلا سكنية">فيلا سكنية</option>
                                    <option value="شاليه">شاليه</option>
                                    <option value="عمارة سكنية">عمارة سكنية</option>
                                    <option value="مدرسة">مدرسة</option>
                                    <option value="مكتب">مكتب</option>
                                    <option value="مطعم">مطعم</option>
                                    <option value="فندق">فندق</option>
                                    <option value="مسجد">مسجد</option>
                                    <option value="شركة">شركة</option>
                                    <option value="أخرى">أخرى</option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center form-label required mb-3">مساحة المشروع
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Provide your team size to help us setup your billing"></i></label>
                                <!--end::Label-->
                                <!--begin::Row-->
                                <div class="row mb-2" data-kt-buttons="true">
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label class="btn btn-outline btn-outline-dashed btn-outline-default w-100 p-4 active">
                                            <input type="radio" class="btn-check" name="area" checked="checked" value="اكبر من 250 م" />
                                            <span class="fw-bolder fs-3">اكبر من 250 م</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label class="btn btn-outline btn-outline-dashed btn-outline-default w-100 p-4">
                                            <input type="radio" class="btn-check" name="area" value="اكبر من 500 م" />
                                            <span class="fw-bolder fs-3">اكبر من 500 م</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Option-->
                                        <label class="btn btn-outline btn-outline-dashed btn-outline-default w-100 p-4">
                                            <input type="radio" class="btn-check" name="area" value="اكبر من 1000 م" />
                                            <span class="fw-bolder fs-3">اكبر من 1000 م</span>
                                        </label>
                                        <!--end::Option-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Hint-->
                                <div class="form-text">اختر الخدمة التي تناسبك</div>
                                <!--end::Hint-->
                            </div>


                            <!--end::Input group-->  <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">تاريخ التفعيل</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="date" name="confirm_date"
                                       class="form-control form-control-solid mb-3 mb-lg-0"
                                       required/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">نوع العقد</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="contract_id" class="form-control" >
                                    @inject('Contracts','App\Models\Contract')
                                    @foreach($Contracts->where('id','!=',1)->get() as $con)
                                        <option value="{{$con->id}}">
                                            {{$con->title}}
                                        </option>
                                    @endforeach
                                </select>
                                <!--end::Input-->
                            </div>
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">نوع الموقع</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select name="address_type" id="address_type"class="form-control" >
                                    <option value="1">اختيار من الخريطة </option>
                                    <option value="0">اضافة لينك </option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <div id="map">
                                <h3 class="mb-7">
                                    <span class="fw-bolder required">اختار الموقع</span>
                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Please select a subscription"></i>
                                </h3>
                                <!--end::Label-->
                                <!--begin::Scroll-->
                                <div class="scroll-y mh-300px me-n7 pe-7">
                                    <input type="text" id="search_input" placeholder=" أبحث  بالمكان او اضغط على الخريطه" />
                                    <input type="hidden" id="information"  />
                                    <div id="us1" style="width: 100%; height: 400px;"></div>
                                    <?php
                                    $lat = !empty(old('lat')) ? old('lat') : '24.69670448385797';
                                    $lng = !empty(old('lng')) ? old('lng') : '46.690517596875';
                                    ?>

                                    <input type="hidden" id="lat" name="lat" required value="{{$lat}}">
                                    <input type="hidden" id="lng" name="lng"  required value="{{$lng}}">
                                    <!--begin::Product-->
                                    <!--end::Input group-->
                                </div>
                            </div>
                            <div class="fv-row mb-7" id="link" style="display:none">
                                <!--begin::Label-->
                                <label class="required fw-bold fs-6 mb-2">رابط الموقع</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input name="address_link" class="form-control" type="text" >
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3"
                                    data-bs-dismiss="modal">إلغاء
                            </button>
                            <button type="submit" class="btn btn-primary"
                                    data-kt-users-modal-action="submit">
                                <span class="indicator-label">حفظ</span>
                                <span class="indicator-progress">برجاء الانتظار
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

@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script type="text/javascript"
            src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyAIcQUxj9rT_a3_5GhMp-i6xVqMrtasqws&language=ar'></script>
    <script src="{{asset('admin/locationpicker.jquery.js')}}"></script>
    <script>
        $('.form-select').select2(
            {
                dropdownParent: $('#kt_modal_filter')

            }
        );
        $('.DeleteProject').on('click',function () {
            var id =  $(this).data('id');

            if (id) {
                Swal.fire({
                    title: "هل انت متاكد من حذف المشروع",
                    text: "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#f64e60",
                    confirmButtonText: "نعم",
                    cancelButtonText: "لا",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then(function (result) {
                    if (result.value) {
                        $.ajax({
                            url: '{{url("DeleteProject")}}',
                            type: "get",
                            data: {'id': id},
                            dataType: "JSON",
                            success: function (data) {
                                if (data.message == "Success") {
                                    Swal.fire("نجح", "تمت حذف المشروع بنجاح", "success");
                                    setTimeout(reload, 3000)
                                    function reload() {
                                        location.reload();
                                    }
                                } else {
                                    Swal.fire("عفوا! ", "حدث خطأ", "error");
                                }
                            },
                            fail: function (xhrerrorThrown) {
                                Swal.fire("عفوا! ", "حدث خطأ", "error");

                            }
                        });
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire("عفوا!", "تم الغاء العملية", "error");


                    }
                });
            }

        })
        const myLatLng = { lat: -25.363, lng: 131.044 };

        $('#us1').locationpicker({
            location: {
                latitude: {{$lat}},
                longitude: {{$lng}}
            },
            position:myLatLng,
            radius: 300,
            markerIcon: "{{asset('admin/map-marker-2-xl.png')}}",
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#lng'),
                // radiusInput: $('#us2-radius'),
                // locationNameInput: $('#address'),
            }

        });
        if (document.getElementById('us1')) {
            var content;
            var latitude = {{!empty($data->lat) ? $data->lat: '24.69670448385797'}};
            var longitude = {{!empty($data->lng) ? $data->lng: '46.690517596875'}};
            var map;
            var marker;
            navigator.geolocation.getCurrentPosition(loadMap);

            function loadMap(location) {
                if (location.coords) {
                    latitude = location.coords.latitude;
                    longitude = location.coords.longitude;
                }
                var myLatlng = new google.maps.LatLng(latitude, longitude);
                var mapOptions = {
                    zoom: 8,
                    center: myLatlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,

                };
                map = new google.maps.Map(document.getElementById("us1"), mapOptions);

                content = document.getElementById('information');
                google.maps.event.addListener(map, 'click', function(e) {
                    placeMarker(e.latLng);
                });

                var input = document.getElementById('search_input');
                map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                var searchBox = new google.maps.places.SearchBox(input);

                google.maps.event.addListener(searchBox, 'places_changed', function() {
                    var places = searchBox.getPlaces();
                    placeMarker(places[0].geometry.location);
                });

                marker = new google.maps.Marker({
                    map: map
                });
            }
        }
        function placeMarker(location) {
            marker.setPosition(location);
            map.panTo(location);
            //map.setCenter(location)
            content.innerHTML = "Lat: " + location.lat() + " / Long: " + location.lng();
            $("#lat").val(location.lat());
            $("#lng").val(location.lng());
            google.maps.event.addListener(marker, 'click', function(e) {
                new google.maps.InfoWindow({
                    content: "Lat: " + location.lat() + " / Long: " + location.lng()
                }).open(map,marker);

            });
        }


    </script>
    <script>
        $('#address_type').on('change , click',function () {
            if($(this).val() == 1){
                document.getElementById("map").style.display = "block";
                document.getElementById("link").style.display = "none";

            }else{
                document.getElementById("map").style.display = "none";
                document.getElementById("link").style.display = "block";

            }
        })
    </script>
    {{--    <script src="{{ URL::asset('admin/assets/js/custom/widgets.js')}}"></script>--}}
    @foreach($data as $project)
        <script>
            (function () {
                var e = document.querySelectorAll(".mixed-widget-4-chart{{$project->id}}");

                [].slice.call(e).map(function (e) {
                    var t = parseInt(KTUtil.css(e, "height"));
                    if (e) {
                        var a = e.getAttribute("data-kt-chart-color"),
                            o = KTUtil.getCssVariableValue("--bs-" + a),
                            s = KTUtil.getCssVariableValue("--bs-light-" + a),
                            r = KTUtil.getCssVariableValue("--bs-gray-700");
                        new ApexCharts(e, {
                            series: [{{$project->progress}}],
                            chart: { fontFamily: "inherit", height: t, type: "radialBar" },
                            plotOptions: {
                                radialBar: {
                                    hollow: { margin: 0, size: "65%" },
                                    dataLabels: {
                                        showOn: "always",
                                        name: { show: !1, fontWeight: "700" },
                                        value: {
                                            color: r,
                                            fontSize: "30px",
                                            fontWeight: "700",
                                            offsetY: 12,
                                            show: !0,
                                            formatter: function (e) {
                                                return {{$project->progress}} + "%";
                                            },
                                        },
                                    },
                                    track: { background: s, strokeWidth: "100%" },
                                },
                            },
                            colors: [o],
                            stroke: { lineCap: "round" },
                            labels: ["Progress"],
                        }).render();
                    }
                });
            })()

        </script>
    @endforeach


    <script type="text/javascript">
        $(function () {
            var table = $('#users_table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                aaSorting: [],
                "dom": "<'card-header border-0 p-0 pt-6'<'card-title' <'d-flex align-items-center position-relative my-1'f> r> <'card-toolbar' <'d-flex justify-content-end add_button'B> r>>  <'row'l r> <''t><'row'<'col-md-5 col-sm-12'i><'col-md-7 col-sm-12'p>>", // horizobtal scrollable datatable
                lengthMenu: [[10, 25, 50, 100, 250, -1], [10, 25, 50, 100, 250, "الكل"]],
                "language": {
                    search: '<i class="fa fa-eye" aria-hidden="true"></i>',
                    searchPlaceholder: 'بحث سريع',
                    "url": "{{ url('admin/assets/ar.json') }}"
                },
                buttons: [
                    {extend: 'print', className: 'btn btn-light-primary me-3', text: '<i class="bi bi-printer-fill fs-2x"></i>'},
                    // {extend: 'pdf', className: 'btn btn-raised btn-danger', text: 'PDF'},
                    {extend: 'excel', className: 'btn btn-light-primary me-3', text: '<i class="bi bi-file-earmark-spreadsheet-fill fs-2x"></i>'},
                    // {extend: 'colvis', className: 'btn secondary', text: 'إظهار / إخفاء الأعمدة '}

                ],
                ajax: {
                    url: '{{ route('employee.datatable.data') }}',
                    data: {
                        @if(Request::get('users_group'))
                        users_group: "{{ Request::get('users_group') }}"
                        ,
                        @endif
                            @if(Request::get('jop_type'))
                        jop_type:"{{Request::get('jop_type') }}"
                        @endif
                    }
                },
                columns: [
                    {data: 'checkbox', name: 'checkbox', "searchable": false, "orderable": false},
                    {data: 'name', name: 'name', "searchable": true, "orderable": true},
                    {data: 'jop_type', name: 'jop_type', "searchable": true, "orderable": true},
                    {data: 'users_group', name: 'users_group', "searchable": true, "orderable": true},
                    {data: 'is_active', name: 'is_active', "searchable": true, "orderable": true},
                    {data: 'actions', name: 'actions', "searchable": false, "orderable": false},

                ]
            });

            $.ajax({
                url: "{{ URL::to('/add-button')}}",
                success: function (data) { $('.add_button').append(data); },
                dataType: 'html'
            });

            $("#kt_daterangepicker_1").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format("YYYY"),10)
                }, function(start, end, label) {
                    var years = moment().diff(start, "years");
                    alert("You are " + years + " years old!");
                }
            );

            $("#kt_daterangepicker_2").daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    minYear: 1901,
                    maxYear: parseInt(moment().format("YYYY"),10)
                }, function(start, end, label) {
                    var years = moment().diff(start, "years");
                    alert("You are " + years + " years old!");
                }
            );
        });
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
    <pre style="height:400px">
<script>
      // Class definition
      var KTnoUiSliderDemos = function() {



          var demo3 = function() {
              // init slider
              var slider = document.getElementById('kt_nouislider_3');

              noUiSlider.create(slider, {
                  start: [0, 100],
                  connect: true,
                  direction: 'rtl',
                  tooltips: [true, wNumb({ decimals: 0 })],
                  range: {
                      'min': [0],
                      'max': 100
                  }
              });


              // init slider input
              var sliderInput0 = document.getElementById('kt_nouislider_3_input');
              var sliderInput1 = document.getElementById('kt_nouislider_3.1_input');
              var sliderInputs = [sliderInput1, sliderInput0];

              slider.noUiSlider.on('update', function( values, handle ) {
                  sliderInputs[handle].value = values[handle];
              });
          }



          // Modal demo


          return {
              // public functions
              init: function() {
                  demo3();

              }
          };
      }();

      jQuery(document).ready(function() {
          KTnoUiSliderDemos.init();
      });
</script>
@endsection

