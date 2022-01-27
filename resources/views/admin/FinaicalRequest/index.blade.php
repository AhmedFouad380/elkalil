@extends('admin.layouts.master')

@section('css')
    <link href="{{ URL::asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('admin/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('style')
    <style>
        @media (min-width: 992px) {
            .aside-me .content {
                padding-right: 30px;
            }
        }

        .select2-container .select2-selection--single .select2-selection__clear {
            padding-right: 355px;
        }
    </style>
@endsection

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder my-1 fs-3">ارشيف المشاريع</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-600">
            <a href="{{ url('/') }}" class="text-gray-600 text-hover-primary">لوحة القيادة</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-500">الحسابات المالية</li>
        <li class="breadcrumb-item text-gray-500">مطالبة مالية</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->


        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Card-->
            <div class="card">

                <!--begin::Card body-->
                <div class="card-body pt-0">

                    <div class="row g-5 g-lg-10">
                        <!--begin::Col-->
                        <div class="col-lg-4 mb-5 mb-lg-10">
                            <!--begin: Statistics Widget 6-->
                            <a href="#" class="card bg-body h-150px">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column py-6 px-6">
                                    <div class="d-flex flex-column flex-grow-1 mb-5">
                                        <span class="text-gray-500 fw-bold me-2 fs-7">اجمالي مبلغ التعاقد</span>
                                        <span class="fw-bolder fs-1 text-gray-900" id="paid">0</span>
                                    </div>

                                </div>
                                <!--end:: Body-->
                            </a>
                            <!--end: Statistics Widget 6-->
                        </div>
                        <div class="col-lg-4 mb-5 mb-lg-10">
                            <!--begin: Statistics Widget 6-->
                            <a href="#" class="card bg-body h-150px">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column py-6 px-6">
                                    <div class="d-flex flex-column flex-grow-1 mb-5">
                                        <span class="text-gray-500 fw-bold me-2 fs-7">اجمالي المدفوع</span>
                                        <span class="fw-bolder fs-1 text-gray-900" id="paid_down">0</span>
                                    </div>

                                </div>
                                <!--end:: Body-->
                            </a>
                            <!--end: Statistics Widget 6-->
                        </div>
                        <div class="col-lg-4 mb-5 mb-lg-10">
                            <!--begin: Statistics Widget 6-->
                            <a href="#" class="card bg-body h-150px">
                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column py-6 px-6">
                                    <div class="d-flex flex-column flex-grow-1 mb-5">
                                        <span class="text-gray-500 fw-bold me-2 fs-7">اجمالي المتبقى</span>
                                        <span class="fw-bolder fs-1 text-gray-900" id="paid_term">0</span>
                                    </div>

                                </div>
                                <!--end:: Body-->
                            </a>
                            <!--end: Statistics Widget 6-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form id="" class="form" method="post" action="{{url('financial-request')}}">
                        @csrf
                        <!--begin::Scroll-->
                            <div class="card-body border-top p-9">

                                <div class="fv-row mb-7 row">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2 col-3">المشروع</label>
                                    <!--end::Label-->
                                    <div class="col-6">
                                        <select name="project_id" id="project_id" class="form-control">
                                            <option value="">اختر المشروع</option>
                                            @foreach($projects as $project)
                                                <option value="{{$project->id}}">{{$project->name}}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>


                            </div>
                            <div id="send" style="display: none">
                                <div class="fv-row mb-7 row">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2 col-3">التفاصيل</label>
                                    <!--end::Label-->
                                    <div class="col-6">
                                            <textarea name="message" id="message" class="form-control" readonly>

                                            </textarea>

                                    </div>

                                </div>

                                <div class="fv-row mb-7 row">
                                    <!--begin::Label-->
                                    <label class="required fw-bold fs-6 mb-2 col-3"></label>
                                    <!--end::Label-->
                                    <div class="col-6">
                                        <label for="sms">رسالة نصية</label>
                                        <input type="radio" name="type" id="sms"
                                               class="h-20px w-20px " checked
                                               placeholder="رسالة نصية" value="1" required/>

                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <label for="inbox">البريد الوارد</label>
                                        <input type="radio" name="type" id="inbox"
                                               class="h-20px w-20px "
                                               placeholder="البريد الوارد" value="2" required/>
                                        &nbsp;
                                        &nbsp;
                                        &nbsp;
                                        <label for="both">الاثنين معآ</label>
                                        <input type="radio" name="type" id="both"
                                               class="h-20px w-20px "
                                               placeholder="الاثنين معآ" value="3" required/>


                                    </div>

                                </div>

                                <!--end::Scroll-->
                                <!--begin::Actions-->

                                <div class="card-footer d-flex justify-content-end py-6 px-9">
                                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">الغاء
                                    </button>
                                    <button type="submit" class="btn btn-primary"
                                            id="kt_account_profile_details_submit">حفظ
                                    </button>
                                </div>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>


    <script>
        $("#project_id").change(function () {
            var wahda = $(this).val();

            if (wahda != '') {
                $.get("{{ URL::to('/ProjectFinancial')}}" + '/' + wahda, function ($data) {
                    $("#paid").text($data.paid);
                    $("#paid_down").text($data.paid_down);
                    $("#paid_term").text($data.paid_term);
                    var Message = 'عزيزي العميل ، نرحب بكم في شركة الخليل ، , ونفيدكم بان قد صدر طلب دفعة مقدمة بمبلغ قيمته  '+ $data.paid_term +' ريال';
                    $("#message").text(Message);
                    $("#send").css("display", 'block');

                });
            } else {
                $("#paid").text(0);
                $("#paid_down").text(0);
                $("#paid_term").text(0);
                $("#send").css("display", 'none');
                $("#message").text("");
            }
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
@endsection

