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
    <h1 class="d-flex text-dark fw-bolder my-1 fs-3">تقرير المدفوعات من العملاء</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-600">
            <a href="{{ url('/') }}" class="text-gray-600 text-hover-primary">لوحة القيادة</a>
        </li>
        <!--end::Item-->
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-500">التقارير والاحصائيات</li>
        <li class="breadcrumb-item text-gray-500">تقرير المدفوعات من العملاء</li>
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
                <div class="col-xl-12 mb-5" style="">
                    <!--begin::Row-->
                    <div class="row     ">
                        <div class="col-md-2"></div>
                        <!--begin::Col-->
                        <div class="col-lg-4 mb-5 mb-lg-10">
                            <!--begin: Statistics Widget 6-->
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div class="w-md-300px d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-dark mb-5 fw-boldest">اجمالي المدفوع</h1>
                                        <!--end::Title-->
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="fs-3x fw-bolder text-primary" id="paid_down">{{$total_paid}}</span>
                                            <span class="mb-2 text-primary">ريال</span>
                                        </div>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Heading-->
                                </div>
                                <!--end::Option-->
                            </div>

                            <!--end: Statistics Widget 6-->
                        </div>
                        <div class="col-lg-4 mb-5 mb-lg-10">
                            <!--begin: Statistics Widget 6-->
                            <div class="d-flex h-100 align-items-center">
                                <!--begin::Option-->
                                <div class="w-md-300px d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                    <!--begin::Heading-->
                                    <div class="mb-7 text-center">
                                        <!--begin::Title-->
                                        <h1 class="text-dark mb-5 fw-boldest">اجمالي المتبقى</h1>
                                        <!--end::Title-->
                                        <!--begin::Price-->
                                        <div class="text-center">
                                            <span class="fs-3x fw-bolder text-primary" id="paid_down">{{$total_remain}}</span>
                                            <span class="mb-2 text-primary">ريال</span>
                                        </div>
                                        <!--end::Price-->
                                    </div>
                                    <!--end::Heading-->
                                </div>
                                <!--end::Option-->
                            </div>

                            <!--end: Statistics Widget 6-->
                        </div>
                        <div class="col-md-2"></div>

                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                </div>
                <!--begin::Card body-->
                <div class="card-body pt-0">

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-4 gy-5" id="users_table">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->

                        <tr class="text-start text-muted fw-bolder fs-5 text-uppercase gs-0">


                            <th class="min-w-125px">م</th>
                            <th class="min-w-125px">اسم المشروع</th>
                            <th class="min-w-125px">اجمالى المشروع</th>
                            <th class="min-w-125px">اجمالى المدفوع</th>
                            <th class="min-w-125px">اجمالى المتبقى</th>

                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                        @foreach($term_list as $key=>$row)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$row['project_name']}}</td>
                                <td>{{$row['total']}}</td>
                                <td>{{$row['paid']}}</td>
                                <td>{{$row['remain']}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
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

    <script type="text/javascript">
        $(function () {
            var table = $('#users_table').DataTable({
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
                    {
                        extend: 'colvis',
                        className: 'btn btn-light-primary me-3',
                        text: ' <i class="bi bi-eye-fill fs-2x"></i>إظهار / إخفاء الأعمدة '
                    }
                    ,
                    {
                        extend: 'print',
                        className: 'btn btn-light-primary me-3',
                        text: '<i class="bi bi-printer-fill fs-2x"></i>'
                    },
                    // {extend: 'pdf', className: 'btn btn-raised btn-danger', text: 'PDF'},
                    {
                        extend: 'excel',
                        className: 'btn btn-light-primary me-3',
                        text: '<i class="bi bi-file-earmark-spreadsheet-fill fs-2x"></i>'
                    }

                ],

            });

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

