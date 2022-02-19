<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                <!--begin::Dropzone-->

                <div class="form-group row">
           
                    <!--begin::Col-->
                    <div class="col-lg-10">
                        <!--begin::Dropzone-->
                        <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_2">
                            <!--begin::Controls-->
                            <div class="dropzone-panel mb-lg-0 mb-2">
                                <a class="dropzone-select btn btn-sm btn-primary me-2">اخر ملف</a>
                                <a class="dropzone-upload btn btn-sm btn-light-primary me-2">رفع الكل</a>
                                <a class="dropzone-remove-all btn btn-sm btn-light-primary">حذف الكل</a>
                            </div>
                            <!--end::Controls-->
            
                            <!--begin::Items-->
                            <div class="dropzone-items wm-200px">
                                <div class="dropzone-item" style="display:none">
                                    <!--begin::File-->
                                    <div class="dropzone-file">
                                        <div class="dropzone-filename" title="some_image_file_name.jpg">
                                            <span data-dz-name>some_image_file_name.jpg</span>
                                            <strong>(<span data-dz-size>340kb</span>)</strong>
                                        </div>
            
                                        <div class="dropzone-error" data-dz-errormessage></div>
                                    </div>
                                    <!--end::File-->
            
                                    <!--begin::Progress-->
                                    <div class="dropzone-progress">
                                        <div class="progress">
                                            <div
                                                class="progress-bar bg-primary"
                                                role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Progress-->
            
                                    <!--begin::Toolbar-->
                                    <div class="dropzone-toolbar">
                                        <span class="dropzone-start"><i class="bi bi-play-fill fs-3"></i></span>
                                        <span class="dropzone-cancel" data-dz-remove style="display: none;"><i class="bi bi-x fs-3"></i></span>
                                        <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
                                    </div>
                                    <!--end::Toolbar-->
                                </div>
                            </div>
                            <!--end::Items-->
                        </div>
                        <!--end::Dropzone-->
            
                        <!--begin::Hint-->
                        <span class="form-text text-muted">حجم الملف المسموح به  1000 ميجا</span>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
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

<script type="text/javascript">
$(function () {
    // set the dropzone container id
    const id = "#kt_dropzonejs_example_2";
    const dropzone = document.querySelector(id);

    // set the preview element template
    var previewNode = dropzone.querySelector(".dropzone-item");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
        url: "{{url('uploadPhoto')}}", // Set the url for your upload script location
        paramName: "pdf",
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        maxFilesize: 1000, // Max filesize in MB
        autoQueue: true, // Make sure the files aren't queued until manually added
        previewsContainer: id + " .dropzone-items", // Define the container to display the previews
        clickable: id + " .dropzone-select", // Define the element that should be used as click trigger to select files.
        accept: function(file, done) {
            
            if (file.name == "wow.jpg") {
                done("Naha, you don't.");
            } else {
                done();
            }
        }
    });

    myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        file.previewElement.querySelector(id + " .dropzone-start").onclick = function () { myDropzone.enqueueFile(file); };
        const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
        dropzoneItems.forEach(dropzoneItem => {
            dropzoneItem.style.display = '';
        });
        dropzone.querySelector('.dropzone-upload').style.display = "inline-block";
        dropzone.querySelector('.dropzone-remove-all').style.display = "inline-block";
    });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
        const progressBars = dropzone.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            progressBar.style.width = progress + "%";
        });
    });

    var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    myDropzone.on("sending", function (file, xhr, formData) {
        // Show the total progress bar when upload starts
        formData.append("_token", CSRF_TOKEN);
        const progressBars = dropzone.querySelectorAll('.progress-bar');
        progressBars.forEach(progressBar => {
            progressBar.style.opacity = "1";
        });
        // And disable the start button
        
        file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
        file.previewElement.querySelector(id + " .dropzone-delete").setAttribute("disabled", "disabled");
    });

    myDropzone.on("success", function(response) {
		let newName = response.xhr.response;

        if (newName) {
            $('#kt_form2').append(newName);
            console.log(newName);
        }

		myDropzone.on("renameFile", function(response) {
			return newName;
		});
	});

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("complete", function (progress) {
        const progressBars = dropzone.querySelectorAll('.dz-complete');

        setTimeout(function () {
            progressBars.forEach(progressBar => {
                progressBar.querySelector('.progress-bar').style.opacity = "0";
                progressBar.querySelector('.progress').style.opacity = "0";
                progressBar.querySelector('.dropzone-start').style.opacity = "0";
                progressBar.querySelector('.dropzone-delete').style.opacity = "0";
            });
        }, 300);
    });

    // Setup the buttons for all transfers
    dropzone.querySelector(".dropzone-upload").addEventListener('click', function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    });

    // Setup the button for remove all files
    dropzone.querySelector(".dropzone-remove-all").addEventListener('click', function () {
        dropzone.querySelector('.dropzone-upload').style.display = "none";
        dropzone.querySelector('.dropzone-remove-all').style.display = "none";
        myDropzone.removeAllFiles(true);
    });

    // On all files completed upload
    myDropzone.on("queuecomplete", function (progress) {
        const uploadIcons = dropzone.querySelectorAll('.dropzone-upload');
        uploadIcons.forEach(uploadIcon => {
            uploadIcon.style.display = "none";
        });
    });

    // On all files removed
    myDropzone.on("removedfile", function (file) {
        if (myDropzone.files.length < 1) {
            dropzone.querySelector('.dropzone-upload').style.display = "none";
            dropzone.querySelector('.dropzone-remove-all').style.display = "none";
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
                                location.reload();

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