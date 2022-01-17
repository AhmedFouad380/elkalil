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
            <?php
            $a = str_replace('[', "" ,$data->values);
            $b = str_replace(']', "" ,$a);

            $answers = explode(',', $b);

            ?>
            @foreach($answers as $data1)
                <label class="form-label fs-6 fw-bold">{{$data1}}</label>
                <input value="{{$data1}}" @if(is_array($data1 ,$answers) )checked  @endif type="checkbox" name="asnwer[]" class="form-control form-control-lg form-control-solid">
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
            <label class="col-lg-4 col-form-label fw-bold fs-6">المرفق</label>
            <!--end::Label-->
            <!--begin::Col-->
            <div class="col-lg-12">
                        <div class="card">
                            <div class="card-block">
                                <h4 class="card-title"></h4>
                                <div class="controls">
                                    {{-- <input type="file" id="input-file-now" multiple class="dropify"  name="pdf[]" data-default-file="" required data-validation-required-message="{{trans('word.This field is required')}}"/> --}}
                                </div>
                            </div>
                        </div>

                        <!--begin::Dropzone-->
                        <div class="well" data-bind="fileDrag: multiFileData">
                            <div class="form-group row">
                                <div class="col-md-12">
                                          <!-- ko foreach: {data: multiFileData().dataURLArray, as: 'dataURL'} -->
                                          <img style="height: 100px; margin: 5px  5px 10px;" class="img-rounded  thumb" data-bind="attr: { src: dataURL }, visible: dataURL">
                                          <!-- /ko -->
                                    <div data-bind="ifnot: fileData().dataURL">
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <input type="file" name="pdf[]" multiple data-bind="fileInput: multiFileData, customFileInput: {
                                      buttonClass: 'btn btn-success',
                                      fileNameClass: 'disabled form-control',
                                      onClear: onClear,
                                    }" accept="image/*">
                                </div>
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
   

<!--end: Wizard Actions-->
    <div class="modal-footer">
        <div class="col-md-3">
            @if($data->state == 1)
                <a type="button"  class=" btn btn-danger changeState"  data-id="{{$data->id}}">الغاء نسبة الانجاز </a>
            @endif
        </div>
        <div class="col-md-8" style="text-align: left;">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">الغاء</button>
            <button type="submit" id="loading" class=" btn btn-primary" onclick="spinner()">حفظ</button>
        </div>
        
    </div>
</form>

<div id="lodaer2" class="loader">
    <div class="loading">
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--begin::Page scripts(used by this page) -->
<script src='http://cdnjs.cloudflare.com/ajax/libs/knockout/3.1.0/knockout-min.js'></script>
    <script src='{{ URL::asset('admin/assets/plugins/knockout/knockout-file-bindings.js')}}'></script>
<script>
    $('#kt_select4').select2({
        placeholder: ""
    });
    $('#kt_select5').select2({
        placeholder: ""
    });
</script>
<!--begin::Page scripts(used by this page) -->
<script type="text/javascript">
    $(function(){
        var viewModel = {};
        viewModel.fileData = ko.observable({
            dataURL: ko.observable(),
            // base64String: ko.observable(),
        });
        viewModel.multiFileData = ko.observable({
            dataURLArray: ko.observableArray(),
        });
        viewModel.onClear = function(fileData){
            if(confirm('Are you sure?')){
            fileData.clear && fileData.clear();
            }
        };
        viewModel.debug = function(){
            window.viewModel = viewModel;
            console.log(ko.toJSON(viewModel));
            debugger;
        };
        ko.applyBindings(viewModel);
    });
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
