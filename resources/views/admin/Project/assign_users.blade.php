@extends('admin.layouts.master')

@section('css')
    <link href="{{ URL::asset('admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ URL::asset('admin/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('style')
@endsection

@section('breadcrumb')
    <h1 class="d-flex text-dark fw-bolder my-1 fs-3">تفاصيل المشروع</h1>
    <!--end::Title-->
    <!--begin::Breadcrumb-->
    <ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-600">
            <a href="{{ url('/') }}" class="text-gray-600 text-hover-primary">لوحة القيادة</a>
        </li>
        <!--end::Item-->
        <li class="breadcrumb-item text-gray-600">
            <a href="{{ url('/projects') }}" class="text-gray-600 text-hover-primary">المشاريع</a>
        </li>
        <!--begin::Item-->
        <li class="breadcrumb-item text-gray-500">مشرفي المرحلة </li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Navbar-->
            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <!--begin::Image-->
                        <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                            <img class="mw-50px mw-lg-75px" src="{{ URL::asset('admin/assets/media/svg/construction.png')}}" alt="image" />
                        </div>
                        <!--end::Image-->
                        <!--begin::Wrapper-->
                        <div class="flex-grow-1">
                            <!--begin::Head-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::Details-->
                                <div class="d-flex flex-column">
                                    <!--begin::Status-->
                                    <div class="d-flex align-items-center mb-1">
                                        <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-3">{{$data->name}}</a>
                                        @inject('Contract','App\Models\Contract')
                                        <span class="badge badge-light-success me-auto">{{$Contract->findOrFail($data->projectContract->contract_id)->title}} </span>
                                    </div>
                                    <!--end::Status-->
                                    <!--begin::Description-->
                                    <div class="d-flex flex-wrap fw-bold mb-4 fs-5 text-gray-400">{{$data->client->name}}</div>
                                    <!--end::Description-->
                                </div>
                                <!--end::Details-->
                                @if(Auth::user()->jop_type != 1 )
                                <!--begin::Actions--> <div class="d-flex mb-4">
                                    <button type="button" class="btn btn-sm btn-danger me-3" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_user">
                                        اضافة مشرف
                                    </button>
                                </div>
                                @endif
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
                                                <form id="" class="form" method="post" action="{{url('assgin_new_user')}}">
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
                                                        <input type="hidden" value="{{$data->id}}" name="project_id">
                                                        <input type="hidden" value="{{$level->id}}" name="level_id">
                                                        <div class="fv-row mb-7">
                                                            <!--begin::Label-->
                                                            <label class="required fw-bold fs-6 mb-2">الموظف </label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <?php
                                                            $is_assgin = $level->assginUsers->pluck('id')->toArray();
                                                            ?>
                                                            <select class="form-control" name="emp_id">
                                                                @inject('Users','App\Models\User')
                                                                @foreach($Users->where('jop_type','!=',3)->get() as  $User)
                                                                    @if(!in_array($User->id,$is_assgin))
                                                                      <option value="{{$User->id}}">{{$User->name}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                            <!--end::Input-->
                                                        </div>

                                                    </div>
                                                    <!--end::Scroll-->
                                                    <!--begin::Actions-->
                                                    <div class="text-center pt-15">
                                                        <button type="reset" class="btn btn-light me-3"
                                                                data-bs-dismiss="modal">ألغاء
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


                                <!--end::Actions-->
                            </div>
                            <!--end::Head-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap justify-content-start">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <div class="fs-4 fw-bolder">{{$data->confirm_date}}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">تاريخ بداية العقد</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            @inject('ProjectLevels','App\Models\ProjectLevels')
                                            <?php
                                            $sum = $ProjectLevels->where('project_id',$data->id)->sum('progress_time');
                                            ?>
                                            <div class="fs-6 text-gray-800 fw-bolder">{{\Carbon\Carbon::parse($data->confirm_date)->addDays($sum)->format('Y-m-d')}}</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">تاريخ التسليم المتوقع</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                    <!--begin::Stat-->
                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                        <!--begin::Number-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                            <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                                                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                                            </svg>
                                        </span>
                                            <!--end::Svg Icon-->

                                            <div class="fs-4 fw-bolder" data-kt-countup="true" data-kt-countup-value="@if(isset($data->projectPaid)){{$data->projectPaid->paid}}@else 0 @endif" data-kt-countup-prefix="SAR">0</div>
                                        </div>
                                        <!--end::Number-->
                                        <!--begin::Label-->
                                        <div class="fw-bold fs-6 text-gray-400">اجمالي مبلغ التعاقد</div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Stat-->
                                </div>
                                <!--end::Stats-->
                                <!--begin::Users-->
                                <div class="symbol-group symbol-hover mb-3">
                                    <!--begin::User-->
                                    @if(count($data->assginUsers) > 0)
                                        @foreach($data->assginUsers as $emp)
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

                                <!--end::User-->
                                    <!--begin::All users-->
                                    <a href="{{url('projectEmployes',$data->id)}}" class="symbol symbol-35px symbol-circle" >
                                        <span class="symbol-label bg-dark text-inverse-dark fs-8 fw-bolder" data-bs-toggle="tooltip" data-bs-trigger="hover" title="رؤية العاملين على المشروع">+</span>
                                    </a>

                                    <!--end::All users-->
                                </div>
                                <!--end::Users-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Details-->
                    <div class="separator"></div>
                    <!--begin::Nav wrapper-->
                    <div class="d-flex overflow-auto h-55px">
                        <!--begin::Nav links-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                            <!--begin::Nav item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6 " href="{{url('project_details',$data->id)}}">مراحل المشروع</a>
                            </li>
                            <!--end::Nav item-->

                            <!--end::Nav item-->
                            <!--begin::Nav item-->

                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6" href="{{url('projectFiles',$data->id)}}">ملفات المشروع</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6" href="{{url('projectExplan',$data->id)}}">الشروحات</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            {{--                        <li class="nav-item">--}}
                            {{--                            <a class="nav-link text-active-primary me-6" href="#">الاعدادات</a>--}}
                            {{--                        </li>--}}
                            <li class="nav-item">
                                <a class="nav-link text-active-primary me-6" href="#">المحادثات</a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--end::Nav links-->
                    </div>
                    <!--end::Nav wrapper-->
                </div>
            </div>

            <!--end::Navbar-->

            <!--begin::Row-->
            <div class="row g-6 g-xl-9">
                <!--begin::Col-->
                @if(count($level->assginUsers) > 0)
                    @foreach($level->assginUsers as $emp)

                        <div class="col-md-4 col-xxl-3">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                    <!--begin::Avatar-->

                                    @if(isset($emp->image))
                                        <div class="symbol symbol-65px symbol-circle mb-5">
                                            <img alt="{{$emp->name}}" src="{{$emp-image}}" />
                                        </div>
                                    @else
                                        <div class="symbol symbol-65px symbol-circle mb-5">
                                            <img src="{{ URL::asset('admin/assets/media//avatars/150-4.jpg')}}" alt="{{$emp->name}}" />
                                        </div>
                                @endif
                                <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">{{$emp->name}}</a>
                                    <!--end::Name-->
                                    <br>
                                    <!--begin::Position-->
                                    @if(Auth::user()->jop_type != 1 )
                                        <a class="delete-user" data-id="{{$level->id}}" data-emp_id="{{$emp->id}}" data-project="{{$data->id}}">     <div class="fw-bold text-danger text-danger-400 mb-6 "  > حذف الموظف  </div> </a>
                                    @endif
                                <!--end::Position-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                @endforeach
            @endif
            <!--end::Col-->
            </div>
            <!--end::Row-->

        </div>
        <!--end::Post-->
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script src="{{ URL::asset('admin/assets/js/custom/widgets.js')}}"></script>

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
                        users_group: {{ Request::get('users_group') }}
                        ,
                        @endif
                            @if(Request::get('jop_type'))
                        jop_type:{{Request::get('jop_type') }}
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

        $(".delete-user").on("click", function () {
            var level_id =$(this).data('id')
            var project_id =$(this).data('project')
            var emp_id =$(this).data('emp_id')
            if (emp_id) {
                Swal.fire({
                    title: "هل انت متاكد من حذف الموظف",
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
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: '{{url("remove_assign_user")}}',
                            type: "get",
                            data: {'level_id': level_id,'project_id':project_id,'emp_id':emp_id},
                            dataType: "JSON",
                            success: function (data) {
                                if (data.message == "Success") {
                                    Swal.fire("نجح", "تم الغاء ", "success");

                                    setTimeout(reload, 3000)
                                    function reload() {
location.reload();
                                    }
                                } else {
                                    Swal.fire("عفوا! ", "حدث خطأ", "error");
                                    $('#kt_modal_confirmProject').modal('hide');

                                }
                            },
                            fail: function (xhrerrorThrown) {
                                Swal.fire("عفوا! ", "حدث خطأ", "error");
                                $('#kt_modal_confirmProject').modal('hide');

                            }
                        });
                        // result.dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire("عفوا!", "تم الغاء العملية", "error");
                        $('#kt_modal_confirmProject').modal('hide');


                    }
                });
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

