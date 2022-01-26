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
    <h1 class="d-flex text-dark fw-bolder my-1 fs-3">كشف حساب مصروفات المشروع</h1>
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
        <li class="breadcrumb-item text-gray-500">كشف حساب مصروفات المشروع</li>
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
                            <th class="min-w-125px">التاريخ</th>
                            <th class="min-w-125px">بيان</th>
                            <th class="min-w-125px">مدين</th>
                            <th class="min-w-125px">دائن</th>

                          </tr>
                        <!--end::Table row-->
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        @if(isset($Project))
                        <tfoot>
                        <tr style="color:red!important;">
                            <td colspan="2" >اجمالي المدين : {{$Project->projectPaid->paid}}</td>
                            <td colspan="2" >اجمالي الدائن : {{$data->sum('amount') +  $Project->projectPaid->paid_down}} </td>
                            <td colspan="2" >الرصيد المتبقى  : {{$Project->projectPaid->paid - ( $data->sum('amount')  +  $Project->projectPaid->paid_down ) }}</td>
                        </tr>
                        </tfoot>
                        @endif
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

        // table.row.add( /* array or object */).draw();


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

                ]
                @if(isset($Project))
                ,
                ajax: {
                    url: '{{ route('client.search.datatable') }}',
                    data: {
                        @if(Request::get('from'))
                        from: "{!! Request::get('from') !!}"
                        ,
                        @endif
                            @if(Request::get('to'))
                        to: "{!! Request::get('to') !!}"
                        ,
                        @endif
                            @if(Request::get('project_id'))
                        project_id: "{!! Request::get('project_id') !!}"
                        ,
                        @endif

                    }
                },
                columns: [

                    {data: 'DT_RowIndex', name: 'DT_RowIndex', "searchable": false, "orderable": true},
                    {data: 'created_at', name: 'created_at', "searchable": true, "orderable": true},
                    {data: 'details', name: 'details', "searchable": true, "orderable": true},
                    {data: 'project_name', name: 'project_name', "searchable": true, "orderable": true},
                    {data: 'daen', name: 'dean', "searchable": true, "orderable": true},
                    {data: 'amount', name: 'amount', "searchable": true, "orderable": true},


                ]
                @endif
            });
            $.ajax({
                url: "{{ URL::to('/client_search-button')}}",
                success: function (data) {
                    $('.add_button').append(data);
                },
                dataType: 'html'
            });
            // or using tr

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

