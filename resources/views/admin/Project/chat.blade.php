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
        <li class="breadcrumb-item text-gray-500">تفاصيل المشروع</li>
        <!--end::Item-->
    </ul>
    <!--end::Breadcrumb-->
@endsection

@section('content')
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Navbar-->
            <!--end::Navbar-->
            <div class="card mb-6 mb-xl-9">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                        <!--begin::Image-->
                        <div class="d-flex flex-center flex-shrink-0 bg-light rounded w-100px h-100px w-lg-150px h-lg-150px me-7 mb-4">
                            <img class="mw-50px mw-lg-75px" src="{{ URL::asset('admin/assets/media/svg/brand-logos/volicity-9.svg')}}" alt="image" />
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
                                <!--begin::Actions-->
                                @if($level->auto_complete != 1 && $level->percent != $level->progress && Auth::user()->jop_type != 1 )
                                    <div class="d-flex mb-4">
                                        <a href="#" data-id="{{$level->id}}"  class="btn CompleteLevel btn-sm btn-danger me-3">اكتمال نسبة المرحلة</a>
                                    </div>
                            @endif
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
                                    @if(Auth::user()->userGroup->is_financial == 1 )
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
                                    @endif
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
                                <a class="nav-link text-active-primary me-6 active" href="{{url('Chat-level',$level->id)}}">المحادثات الفورية
                                    @if(\App\Models\UserChatPermission::where('reciever_id',Auth::user()->id)->where('is_read',0)->where('type',0)->where('level_id',$level->id)->count() > 0)
                                        <img class="bi bi-person-bounding-box fs-2x text-info" src="{{asset('images/giphy.gif')}}" style="    max-width: 41px;">
                                    @endif

                                </a>
                            </li>
                            <!--end::Nav item-->
                        </ul>
                        <!--end::Nav links-->
                    </div>
                    <!--end::Nav wrapper-->
                </div>
            </div>

            <!--begin::Row-->
            <div class="row g-6 g-xl-9 mb-6 mb-xl-9">
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Sidebar-->
                    <!--end::Sidebar-->
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid ms-lg-12 ms-xl-10">
                        <!--begin::Messenger-->
                        <div class="card" id="">
                            <!--begin::Card header-->
                            <div class="card-header" id="kt_chat_messenger_header">
                                <!--begin::Title-->
                                <div class="card-title">
                                    <!--begin::User-->
                                    <div class="d-flex justify-content-center flex-column me-3">
                                        <a href="{{url('project_details',$level->project->id)}}" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">{{$level->project->name}}</a>
                                        <a href="{{url('level_Details',$level->id)}}" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">{{$level->title}}</a>

                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body" id="">
                                <!--begin::Messages-->
                                <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto scroll scroll-pull"  id="msg-list" style="overflow:scroll!important; height:400px!important;" data-mobile-height="350">
                                    <!--begin::Message(in)-->
                                    @foreach($chat as $Message)
                                        @if($Message->type == 0 && $Message->sender_id == Auth::user()->id)
                                             <div class="d-flex justify-content-start mb-10">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column align-items-start">
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center mb-2">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{ URL::asset('admin/assets/media/avatars/150-15.jpg')}}" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Details-->
                                                <div class="ms-3">
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{$Message->sender_name}}</a>
                                                    <span class="text-muted fs-7 mb-1">{{\Carbon\Carbon::parse($Message->created_at)->diffForHumans()}}</span>
                                                </div>
                                                <!--end::Details-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Text-->
                                            <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">{{$Message->message}}</div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                         @else
                                             <div class="d-flex justify-content-end mb-10">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-column align-items-end">
                                            <!--begin::User-->
                                            <div class="d-flex align-items-center mb-2">
                                                <!--begin::Details-->
                                                <div class="me-3">
                                                    <span class="text-muted fs-7 mb-1">{{\Carbon\Carbon::parse($Message->created_at)->diffForHumans()}}</span>
                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">{{$Message->sender_name}} @if($Message->type == 1)
                                                            (العميل )
                                                            @endif
                                                    </a>
                                                </div>
                                                <!--end::Details-->
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-35px symbol-circle">
                                                    <img alt="Pic" src="{{ URL::asset('admin/assets/media/avatars/150-15.jpg')}}" />
                                                </div>
                                                <!--end::Avatar-->
                                            </div>
                                            <!--end::User-->
                                            <!--begin::Text-->
                                            <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text">
                                                {{$Message->message}}

                                            @if($Message->file != null)
                                               <a href="http://alkhalilsys.com/images/{{$Message->file}}" target="_blank"> <img  alt="Pic" style="width:80px" src="{{ URL::asset('images/file.png')}}" /> </a>
                                                @endif
                                            </div>
                                            <!--end::Text-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                     @endif
                                @endforeach
                                    <div id="newChat">

                                    </div>

                                    <!--end::Message(out)-->
                                    <!--begin::Message(in)-->
                                    <!--end::Message(out)-->
                                </div>
                                <!--end::Messages-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer pt-4" id="kt_chat_messenger_footer">
                                <!--begin::Input-->
                                <textarea class="form-control form-control-flush mb-3" id="message" rows="1" data-kt-element="input" placeholder="اكتب الرسالة"></textarea>
                                <!--end::Input-->
                                <!--begin:Toolbar-->
                                <div class="d-flex flex-stack">
                                    <!--begin::Send-->
                                    <button class="btn btn-primary" id="send" type="button" data-kt-element="send">ارسال</button>
                                    <!--end::Send-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Card footer-->
                        </div>
                        <!--end::Messenger-->
                    </div>
                    <!--end::Content-->
                </div>
            </div>
            <!--end:Row-->

        </div>
        <!--end::Post-->
    </div>
@endsection

@section('script')
    <script src="{{ URL::asset('admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
{{--    <script src="{{ URL::asset('admin/assets/js/custom/widgets.js')}}"></script>--}}
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>



    <script>
        var msgList = document.getElementById("msg-list");
        msgList.scrollTop = msgList.scrollHeight;

        $('#message').on("keydown",function(e){
            //do stuff here
            var message =$('#message').val()
            var level_id = {{$level->id}}
            if(message){
                var out = '<div class="d-flex justify-content-start mb-10">' +
                    '                                        <div class="d-flex flex-column align-items-start">' +
                    '                                            <div class="d-flex align-items-center mb-2">' +
                    '                                                <div class="symbol symbol-35px symbol-circle">' +
                    '                                                    <img alt="Pic" src="{{ URL::asset('admin/assets/media/avatars/150-15.jpg')}}" />' +
                    '                                                </div>' +
                    '                                                <div class="ms-3">' +
                    '                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{Auth::user()->name}}</a>' +
                    '                                                    <span class="text-muted fs-7 mb-1">{{\Carbon\Carbon::now()->diffForHumans()}}</span>' +
                    '                                                </div>' +
                    '                                            </div>' +
                    '                                            <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">'+ message +'</div>' +
                    '                                        </div>' +
                    '                                    </div>'
                $('#newChat').append(out);
                $('#message').val('');
                var msgList = document.getElementById("msg-list");
                msgList.scrollTop = msgList.scrollHeight;

                $.ajax({
                    type: "GET",
                    url: "{{url('StoreChat')}}",
                    data: {"level_id":level_id , "message":message},
                    success: function (data) {

                        console.log(data);
                    }

                })
            }
        });
        $('#send').on("click , change",function(e){
            //do stuff here
            var message =$('#message').val()
            var level_id = {{$level->id}}
            if(message){
                var out = '<div class="d-flex justify-content-start mb-10">' +
                    '                                        <div class="d-flex flex-column align-items-start">' +
                    '                                            <div class="d-flex align-items-center mb-2">' +
                    '                                                <div class="symbol symbol-35px symbol-circle">' +
                    '                                                    <img alt="Pic" src="{{ URL::asset('admin/assets/media/avatars/150-15.jpg')}}" />' +
                    '                                                </div>' +
                    '                                                <div class="ms-3">' +
                    '                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">{{Auth::user()->name}}</a>' +
                    '                                                    <span class="text-muted fs-7 mb-1">{{\Carbon\Carbon::now()->diffForHumans()}}</span>' +
                    '                                                </div>' +
                    '                                            </div>' +
                    '                                            <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">'+ message +'</div>' +
                    '                                        </div>' +
                    '                                    </div>'
                $('#newChat').append(out);
                $('#message').val('');
                var msgList = document.getElementById("msg-list");
                msgList.scrollTop = msgList.scrollHeight;

                $.ajax({
                    type: "GET",
                    url: "{{url('StoreChat')}}",
                    data: {"level_id":level_id , "message":message},
                    success: function (data) {

                        console.log(data);
                    }

                })
            }
        });

    </script>
    <script>

        var pusher = new Pusher('{{env("MIX_PUSHER_APP_KEY")}}', {
            cluster: '{{env("PUSHER_APP_CLUSTER")}}',
            encrypted: true
        });

        var channel = pusher.subscribe('MessageSent-channel-{{$level->id}}');
        channel.bind('App\\Events\\SendMessage', function(data) {
            if(data.level_id == {{$level->id}} &&  data.sender_name != "{{Auth::user()->name}}"  ){
                new Audio('https://https://assets.mixkit.co/sfx/preview/mixkit-bell-notification-933.mp3').play();
                var out = '                                   <div class="d-flex justify-content-end mb-10">' +
                    '                                        <!--begin::Wrapper--> ' +
                    '                                        <div class="d-flex flex-column align-items-end"> ' +
                    '                                            <!--begin::User--> ' +
                    '                                            <div class="d-flex align-items-center mb-2"> ' +
                    '                                                <!--begin::Details--> ' +
                    '                                                <div class="me-3"> ' +
                    '                                                    <span class="text-muted fs-7 mb-1">{{\Carbon\Carbon::now()->diffForHumans()}}</span> ' +
                    '                                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">'+ data.sender_name +
                    '                                                    </a> ' +
                    '                                                </div> ' +
                    '                                                <!--end::Details--> ' +
                    '                                                <!--begin::Avatar--> ' +
                    '                                                <div class="symbol symbol-35px symbol-circle"> ' +
                    '                                                    <img alt="Pic" src="{{ URL::asset('admin/assets/media/avatars/150-15.jpg')}}" /> ' +
                    '                                                </div> ' +
                    '                                                <!--end::Avatar--> ' +
                    '                                            </div> ' +
                    '                                            <!--end::User--> ' +
                    '                                            <!--begin::Text--> ' ;
                if(data.message !=  null) {
                    out += '                                            <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text"> ' +
                    '                                                ' + data.message;
                }
                    if(data.file !=  null){
                        out +=   '<a href="http://alkhalilsys.com/images/'+ data.file +'" target="_blank"> <img  alt="Pic" style="width:80px" src="{{ URL::asset('images/file.png')}}" /> </a>' ;
                    }
                   out +=  "                            </div> </div>  </div>" ;
                $('#newChat').append(out);
                var msgList = document.getElementById("msg-list");
                msgList.scrollTop = msgList.scrollHeight;

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

