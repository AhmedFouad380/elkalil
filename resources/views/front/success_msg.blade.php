@extends('admin.layouts.master-without-nav') 

@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl mt-10">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">
        <!--begin::About card-->
        <div class="card">
            <!--begin::Body-->
            <div class="card-body p-lg-17">
                <!--begin::About-->
                <div class="mb-18">
                    <!--begin::Wrapper-->
                    <div class="mb-10">
                        <!--begin::Top-->
                        <div class="text-center mb-15">
                            <!--begin::Title-->
                            <i class="bi bi-check fs-5x text-success"></i>
                            
                            <h3 class="fs-2hx text-dark mb-5">تم تلقي طلبكم بنجاح</h3>
                            <!--end::Title-->
                            <!--begin::Text-->
                            <div class="fs-5 text-muted fw-bold">نشكركم على ثقتكم بنا ... وسيتم التواصل معكم في اقرب وقت</div>
                            <!--end::Text-->
                        </div>
                        <!--end::Top-->

                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::About-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::About card-->
    </div>
    <!--end::Post-->
</div>
@endsection

@section('script')

<script>
    function pageRedirect() {
            window.location.replace("https://dashboard.alkhalilsys.com/");
        }      
        setTimeout("pageRedirect()", 2000);
</script>
@endsection



