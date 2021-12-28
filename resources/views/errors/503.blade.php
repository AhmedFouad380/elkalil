@extends('admin.layouts.master-without-nav')

@section('css')
@endsection

@section('breadcrumb')
@endsection

@section('content')
<div class="d-flex flex-column flex-center flex-column-fluid p-10">
    <!--begin::Illustration-->
    <img src="{{asset('admin/assets/media/illustrations/sketchy-1/18.png')}}" alt="" class="mw-100 mb-10 h-lg-450px" />
    <!--end::Illustration-->
    <!--begin::Message-->
    <h1 class="fw-bold mb-10" style="color: #A3A3C7">عفوا هناك خطأ ما !</h1>
    <!--end::Message-->
    <!--begin::Link-->
    <a href="javascript:;" onclick="goBack()" class="btn btn-danger">للرجوع للرئيسية</a>
    <!--end::Link-->
</div>
@endsection

@section('script')
    <script src="{{asset('admin/assets/js/custom/authentication/sign-in/general.js')}}"></script>
    <script>
        function goBack() {
          window.history.back();
        }
        </script>
@endsection


