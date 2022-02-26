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
    <h1 class="d-flex text-dark fw-bolder my-1 fs-3">تقارير المهام و الانجازية</h1>
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
        <li class="breadcrumb-item text-gray-500">تقارير المهام و الانجازية</li>
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

                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-4 gy-5" id="users_table">
                        <!--begin::Table head-->
                        <thead>
                        <!--begin::Table row-->

                        <tr class="text-start text-muted fw-bolder fs-5 text-uppercase gs-0">


                            <th class="min-w-125px">م</th>
                            <th class="min-w-125px">العنوان</th>
                            <th class="min-w-125px">الوصف</th>
                            <th class="min-w-125px">اسم المشروع</th>
                            <th class="min-w-125px">التاريخ</th>
                            <th class="min-w-125px">اسم الموظف</th>

                        </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->


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
                    <form id="" class="" action="{{url('explan')}}" method="get">

                        <!--begin::Scroll-->
                        <div class="d-flex flex-column scroll-y me-n7 pe-7"
                             id="kt_modal_add_user_scroll" data-kt-scroll="true"
                             data-kt-scroll-activate="{default: false, lg: true}"
                             data-kt-scroll-max-height="auto"
                             data-kt-scroll-dependencies="#kt_modal_add_user_header"
                             data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
                             data-kt-scroll-offset="300px">


                            <!--end::Input group-->
                            <!--begin::Input group-->

                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">المشروع:</label>

                                <select name="project_id" class="form-select form-select-lg form-select-solid" data-control="select2"
                                        data-dropdown-parent="#kt_modal_filter" data-placeholder="اختـر..." data-allow-clear="false" >
                                    <option></option>
                                    @foreach(\App\Models\Project::orderBy('name','asc')->get() as $project)
                                        <option value="{{$project->id}}">{{$project->name}}</option>
                                    @endforeach
                                </select>


                            </div>
                            <!--begin::Input group-->
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">من تاريخ:</label>

                                <input type="date" class="form-control" name="archive_from">

                            </div>
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">الى تاريخ:</label>
                                <input type="date" class="form-control" name="archive_to">
                            </div>

                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">الموظف:</label>

                                <select name="emp_id" id="emp_id" class="form-control">
                                    <option value="">الكل</option>
                                    @foreach(\App\Models\User::all() as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>


                            </div>

                            <!--end::Input group-->

                        </div>
                        <!--end::Scroll-->
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">ألغاء
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
                ajax: {
                    url: '{{ route('explan.datatable.data') }}',
                    data: {
                        @if(Request::get('archive_from'))
                        archive_from: "{!! Request::get('archive_from') !!}"
                        ,
                        @endif
                            @if(Request::get('archive_to'))
                        archive_to: "{!! Request::get('archive_to') !!}"
                        ,
                        @endif
                            @if(Request::get('project_id'))
                        project_id: "{!! Request::get('project_id') !!}"
                        ,
                        @endif  @if(Request::get('emp_id'))
                        emp_id: "{!! Request::get('emp_id') !!}"

                        @endif

                    }
                },
                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "searchable": false, "orderable": true},
                    {data: 'title', name: 'title', "searchable": true, "orderable": true},
                    {data: 'comments', name: 'comments', "searchable": true, "orderable": true},
                    {data: 'project', name: 'project', "searchable": true, "orderable": true},
                    {data: 'date', name: 'date', "searchable": true, "orderable": true},
                    {data: 'employee', name: 'employee', "searchable": true, "orderable": true},


                ]
            });
            $.ajax({
                url: "{{ URL::to('/explan-button')}}",
                success: function (data) {
                    $('.add_button').append(data);
                },
                dataType: 'html'
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

