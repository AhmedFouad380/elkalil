<div class="dt-buttons flex-wrap">
<!--begin::Filter-->
<button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
data-kt-menu-placement="bottom-end">
<!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
<span class="svg-icon svg-icon-2">
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
    fill="none">
    <path
        d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
        fill="black"/>
</svg>
</span>
<!--end::Svg Icon-->الفلتر
</button>
<!--begin::Menu 1-->
<div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
<!--begin::Header-->
<div class="px-7 py-5">
<div class="fs-5 text-dark fw-bolder">اعدادات الفلتر</div>
</div>
<!--end::Header-->
<!--begin::Separator-->
<div class="separator border-gray-200"></div>
<!--end::Separator-->
<!--begin::Content-->
<div class="px-7 py-5" data-kt-user-table-filter="form">
<form action="{{url('employee_setting')}}" method="get">
    <!--begin::Input group-->
    <div class="mb-10">
        <label class="form-label fs-6 fw-bold">الصلاحيات:</label>
        <select class="form-select form-select-solid fw-bolder"
                data-kt-select2="true"
                data-placeholder="اختر" data-allow-clear="true"
                data-kt-user-table-filter="role" data-hide-search="true"
                name="users_group">
            <option></option>
            @foreach(\App\Models\UserGroup::all() as $user_group)
                <option @if(old('users_group') == $user_group->id) selected @endif
                value="{{$user_group->id}}">{{$user_group->title}}</option>
            @endforeach
        </select>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-10">
        <label class="form-label fs-6 fw-bold">صلاحية قائمة المشروعات :</label>
        <select class="form-select form-select-solid fw-bolder"
                data-kt-select2="true"
                data-placeholder="اختر" data-allow-clear="true"
                data-kt-user-table-filter="two-step" data-hide-search="true"
                name="jop_type">
            <option></option>
            <option @if(old('jop_type') == 1) selected @endif value="1">مشروع محدد
            </option>
            <option @if(old('jop_type') == 2) selected @endif value="2">فرع محدد
            </option>
            <option @if(old('jop_type') == 3) selected @endif value="3">كل الفروع
            </option>

        </select>
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="d-flex justify-content-end">
        <button type="reset"
                class="btn btn-light btn-active-light-primary fw-bold me-2 px-6"
                data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">اغلاق
        </button>
        <button type="submit" class="btn btn-primary fw-bold px-6"
                data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">بحث
        </button>
    </div>
    <!--end::Actions-->
</form>
</div>
<!--end::Content-->
</div>
<!--end::Menu 1-->
<!--end::Filter-->
<!--begin::Add user-->
<button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
data-bs-target="#kt_modal_add_user">
<i class="bi bi-plus-circle-fill fs-2x"></i>
</button>

<!--end::Add user-->
<button id="delete" class="btn btn-light-danger me-3 font-weight-bolder">
    <i class="bi bi-trash-fill fs-2x"></i>

</button>
 </div>

<script>
    $("#delete").on("click", function () {
        var dataList = [];
        $("input:checkbox:checked").each(function (index) {
            dataList.push($(this).val())
        })
        console.log(dataList);
        if (dataList.length > 0) {
            Swal.fire({
                title: "تحذير.هل انت متأكد؟!",
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
                        url: '{{url("delete-user")}}',
                        type: "get",
                        data: {'id': dataList, _token: CSRF_TOKEN},
                        dataType: "JSON",
                        success: function (data) {
                            if (data.message == "Success") {
                                $("input:checkbox:checked").parents("tr").remove();
                                Swal.fire("نجاح", "تم الحذف بنجاح", "success");
                                // location.reload();
                            } else {
                                Swal.fire("نأسف", "حدث خطأ ما اثناء الحذف", "error");
                            }
                        },
                        fail: function (xhrerrorThrown) {
                            Swal.fire("نأسف", "حدث خطأ ما اثناء الحذف", "error");
                        }
                    });
                    // result.dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                } else if (result.dismiss === 'cancel') {
                    Swal.fire("ألغاء", "تم الالغاء", "error");
                }
            });
        }
    });
</script>
