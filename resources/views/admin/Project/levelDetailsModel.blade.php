<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<style>
    .dropify-wrapper{
        line-height: 46px!important;
    }

    * {
        margin: 0;
        padding: 0;
    }

    .loader {
        display: none;
        top: 50%;
        left: 50%;
        position: absolute;
        transform: translate(-50%, -50%);
        z-index:10000000;
    }

    .loading {
        border: 2px solid #ccc;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border-top-color: #1ecd97;
        border-left-color: #1ecd97;
        animation: spin 1s infinite ease-in;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }


</style>
<form class="px-10" novalidate="novalidate" id="kt_form2" method="post" action="{{url('AnswerLevelDetails')}}"
      enctype="multipart/form-data">
@csrf

<!--begin: Wizard Step 1-->
    <div class="mb-10">
        <label class="form-label fs-6 fw-bold" >السؤال</label>
        <input rows="5" class="form-control form-control-lg form-control-solid"value="{{$data->title}}">
    </div>
    @if( isset($data->date) & $data->date != '')
        <div class="mb-10">
            <label class="form-label fs-6 fw-bold" >التاريخ</label>
            <input rows="5" class="form-control form-control-lg form-control-solid"value="{{$data->date}}">
        </div>
    @endif
    <br>
    <input type="hidden" value="{{$data->id}}" name="id">
    @if($data->question_type == 1 )
        <div class="mb-10">
            <label class="form-label fs-6 fw-bold">الاجابة</label>
            <textarea rows="5" name="answer" class="form-control form-control-lg form-control-solid">{{$data->answer}}</textarea>
        </div>

    @elseif($data->question_type == 2 )
        <?php
        $a = str_replace('[', "" ,$data->values);
        $b = str_replace(']', "" ,$a);

        $answers = explode(',', $b);

        ?>
        <div class="mb-10">
            <label class="form-label fs-6 fw-bold">الاجابة</label>
            <select class="form-control " name="answer">
                @foreach($answers as $data1)
                    <option  @if($data1 == $data->answer ) selected @endif value="{{$data1}}">{{$data1}}</option>
                @endforeach
            </select>
        </div>

    @elseif($data->question_type == 3 )
        <div class="mb-10">
            <label>الاجابة</label>
            <br>
            <?php
            $a = str_replace('[', "" ,$data->values);
            $b = str_replace(']', "" ,$a);

            $answers = explode(',', $b);

            ?>
            @foreach($answers as $data1)
                <input value="{{$data1}}" @if(in_array($data1 ,$answers) ) checked  @endif type="checkbox" name="asnwer[]" class="form-check-input ">
                <label class="form-label fs-6 fw-bold">{{$data1}}</label>
                <br>
            @endforeach
        </div>
    @elseif($data->question_type == 4 )
        <div class="mb-10">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">صورة</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-8">
                <!--begin::Image input-->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title"></h4>
                            <div class="controls">
                                <input type="file" id="input-file-now" class="dropify"  name="img" data-default-file="" required data-validation-required-message="{{trans('word.This field is required')}}"/>
                            </div>
                        </div>
                    </div>
                    <!--end::Image input-->
                    <!--begin::Hint-->
                {{--                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>--}}
                <!--end::Hint-->
                </div>
                <!--end::Image input-->
                <!--begin::Hint-->
            {{--                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>--}}
            <!--end::Hint-->
            </div>
            <!--end::Col-->
        </div>


    @elseif($data->question_type == 5 )

        <div class="mb-10">
            <label class="">الاجابة</label>
            <select class="form-control form-control-lg form-control-solid " name="answer">
                @foreach($data->values as $data1)
                    <option   @if($data1 == $data->answer ) selected @endif  value="{{$data1}}">{{$data1}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-10">
            <label>الاجابة اخرى</label>
            <textarea rows="5" name="otherAnswer" class="form-control form-control-lg form-control-solid">{{$data->otherAnswer}}</textarea>
        </div>
    @endif

    @if($data->is_pdf == 1 )


        <div class="mb-10">
            <!--begin::Label-->
            <label class="col-lg-4 col-form-label fw-bold fs-6">المرفق </label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title"></h4>
                                <div class="controls">
                                    <span class="btn CompleteLevel btn-sm btn-danger my-3 repeat">اضف المزيد </span>
                                    {{-- <input type="file" id="input-file-now" multiple class="dropify"  name="pdf[]" data-default-file="" required data-validation-required-message="{{trans('word.This field is required')}}"/> --}}
                                </div>
                            </div>
                        </div>

                        <!--begin::Dropzone-->

                            <div class="form-group row ">
                                <div class="col-md-3 repeatresult" style="margin-bottom:15px;">
                                    <img class="border rounded" data-preview="p1" src="{{ URL::asset('admin/assets/media/avatars/upload.png')}}" width="170" height="170">
                                    <h6 data-file-name="p1"></h6>
                                    <label class="btn btn-secondary" for="p1">
                                        <input type="file" id="p1" name="pdf[]" style="display:none">
                                        <input type="file" id="p3" name="pdf[]" style="display:none">
                                        <input type="file" id="p4" name="pdf[]" style="display:none">
                                        <input type="file" id="p5" name="pdf[]" style="display:none">
                                        <input type="file" id="p6" name="pdf[]" style="display:none">
                                        <input type="file" id="p7" name="pdf[]" style="display:none">
                                        <input type="file" id="p8" name="pdf[]" style="display:none">
                                        <input type="file" id="p9" name="pdf[]" style="display:none">
                                        <input type="file" id="p10" name="pdf[]" style="display:none">
                                        <input type="file" id="p11" name="pdf[]" style="display:none">
                                        <input type="file" id="p12" name="pdf[]" style="display:none">
                                        <input type="file" id="p13" name="pdf[]" style="display:none">
                                        رفع الملف
                                    </label>
                                </div>
                                <div class="dfdfd"></div>
                                
                                <div class="col-md-3">

                                </div>
                            </div>
                            
                        <!--end::Dropzone-->
                <!--end::Image input-->
                <!--begin::Hint-->
            {{--                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>--}}
            <!--end::Hint-->
            </div>
            <!--end::Col-->
        </div>

@endif
    @if($data->state == 1)
        <a type="button"  class=" btn btn-danger changeState"  data-id="{{$data->id}}">الغاء نسبة الانجاز </a>

@endif

<!--end: Wizard Actions-->
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
        <button type="submit" id="loading" class=" btn btn-primary" onclick="spinner()">حفظ</button>
    </div>
</form>

<div id="lodaer2" class="loader">
    <div class="loading">
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--begin::Page scripts(used by this page) -->

<script>
    $('#kt_select4').select2({
        placeholder: ""
    });
    $('#kt_select5').select2({
        placeholder: ""
    });
    
</script>
<!--begin::Page scripts(used by this page) -->
<script>
    // $(function () {
    //     $(".repeat").on('click', function () {
    //        var $self = $(this);
	
    //        $( ".repeatresult" ).clone().appendTo( ".dfdfd" );
    //     });
    // });
    var i = 3;
    $('.repeat').click(function() {	
			$('.repeatresult:last').after('<div class="col-md-3 repeatresult" style="margin-bottom:15px;"><img class="border rounded" data-preview="p'+i+'" src="{{ URL::asset("admin/assets/media/avatars/upload.png")}}" width="170" height="170"><h6 data-file-name="p'+i+'"></h6><label class="btn btn-secondary" for="p'+i+'"><input type="file" id="p'+i+'" name="pdf[]" style="display:none">رفع الملف </label></div>');
			i++;
			return false;
	});

 </script>
 <script type="text/javascript">
    $(function() {

        $('input[type=file]').change(function() {
            var id = $(this).attr('id');
            var uploadFileName = this.files[0].name;
            var strLimit = 20;

            //
            // prevent a long string file name
            //
            if (uploadFileName.length > strLimit) {
                var endOfFileName = uploadFileName.substr( (uploadFileName.lastIndexOf('.') -2) );
                var startOfFileName = uploadFileName.substr(0, (strLimit - endOfFileName.length - 3));
                uploadFileName = startOfFileName+"..."+endOfFileName;
            }

            //
            // show file name
            //
            $('[data-file-name="' + id + '"]').html(uploadFileName);

            //
            // show image preview
            //

            var fileTypes = ['jpg', 'jpeg', 'png'];

            var extension = this.files[0].name.split('.').pop().toLowerCase(),  //file extension from input file
            isSuccess = fileTypes.indexOf(extension) > -1;  //is extension in acceptable types

            if (isSuccess) {
                var reader = new FileReader();
                reader.readAsDataURL(this.files[0]);

                reader.onload = function(e) {
                    $('[data-preview="' + id + '"]').attr('src', e.target.result);
                };
            }
            
        });

    });
</script>
<script type="text/javascript">

var loadFile = function(event) {
	var image = document.getElementById('output');
	image.src = URL.createObjectURL(event.target.files[0]);
};

    $('#loading').on('click',function () {
        document.getElementById("loader").style.display = "block";
        document.getElementById("lodaer2").style.display = "block";

    })


    $('.changeState').on('click',function () {
        var id =  $(this).data('id');

        if (id) {
            Swal.fire({
                title: "هل انت متاكد من اللغاء نسبة الانجاز",
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
                        url: '{{url("changeState")}}',
                        type: "get",
                        data: {'id': id},
                        dataType: "JSON",
                        success: function (data) {
                            if (data.message == "Success") {
                                Swal.fire("نجح", "تم اللغاء نسبة الانجاز بنجاح", "success");
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

</script>
