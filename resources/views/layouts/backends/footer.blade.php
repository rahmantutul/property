 <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{date('Y')}}<a class="ml-25" href="#" target="_blank"></a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-right d-none d-md-block">Design & Developed with<i data-feather="heart"></i></span></p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('')}}app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- <script src="{{asset('')}}app-assets/vendors/js/charts/apexcharts.min.js"></script> -->
    <script src="{{asset('')}}app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('')}}app-assets/js/core/app-menu.js"></script>
    <script src="{{asset('')}}app-assets/js/core/app.js"></script>
     <script src="{{asset('')}}app-assets/js/scripts/customizer.min.js"></script>
    <!-- END: Theme JS-->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <!-- BEGIN: Page JS-->
   @stack('js')
    <!-- END: Page JS-->

    <!--BEGIN: Sweet Alert-->
     <script src="{{asset('')}}app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
     <!--END: Sweet Alert-->

    <script src="{{asset('')}}app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="{{asset('')}}app-assets/js/scripts/forms/form-select2.js"></script>

    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/37.0.1/classic/ckeditor.js"></script> --}}


   <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    // $('.select2').select2({
    //     dropdownParent: $('#common_modal')
    // });
    </script>

<script type="text/javascript">
@if(Session::has('msg'))
toastr['success']("{{Session::get('msg')}}", {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true,
      rtl: false,
    });
@endif

@if(Session::has('infoMsg'))
toastr['info']("{{Session::get('infoMsg')}}", {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true,
      rtl: false,
    });
@endif

@if(Session::has('errMsg'))
toastr['error']("{{Session::get('errMsg')}}", {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true,
      rtl: false,
    });
@endif

function errorMessage(msg) {
    toastr['error'](msg, {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true,
      rtl: false,
    });
}
function warningMessage(msg) {
    toastr['warning'](msg, {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true,
      rtl: false,
    });
}
function successMessage(msg) {
    toastr['success'](msg, {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true,
      rtl: false,
    });
}
function infoMessage(msg) {
    toastr['info'](msg, {
      closeButton: true,
      tapToDismiss: false,
      progressBar: true,
      rtl: false,
    });
}

$(document).on('click','#theme_btn', function(e) {
    // alert("okay");
});
$(document).on('click','.btn_modal', function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
       type:'GET',
       url:url,
       data:{},
       success:function(res){
          $('div#common_modal').html(res).modal('show');
          // $('#exampleModalLabel').modal('toggle');
       }
    });
});
$(document).on('submit','form#ajax_form', function(e) {
    // alert("okay");
    e.preventDefault();
    $('span.textdanger').text('');
    var url=$(this).attr('action');
    var method=$(this).attr('method');
    var formData = new FormData($(this)[0]);
    // console.dir(formData);
    $.ajax({
        type: method,
        url: url,
        data: formData,
        async: false,
        processData: false,
        contentType: false,
        success: function(res) {
            if(res.status==true){
                // toastr.success(res.msg);
                successMessage(res.msg);
                if(res.url){
                    document.location.href = res.url;
                }
                // else{
                //     window.location.reload();
                // }
            }else if(res.status==false){
                // toastr.error(res.msg);
                warningMessage(res.msg);
            }
        },
        error:function (response){
            $.each(response.responseJSON.errors,function(field_name,error){

                $(document).find('[name='+field_name+']').after('<span class="alert-danger textdanger">' +error+ '</span>');
                // toastr.error(error);
                errorMessage(response.msg);
            })
        }
    });
});
// ajax request for delete data
$(document).on('click','a.delete', function(e) {
var form=$(this);
e.preventDefault();
var url=$(form).attr('href');
Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    type: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it.",
    confirmButtonClass: "btn btn-primary",
    cancelButtonClass: "btn btn-danger ml-1",
    buttonsStyling: !1,
  }).then(function (t) {
    t.value?
        $.ajax({
            type: 'DELETE',
            url: url,
            data: {"_token": "{{ csrf_token() }}"},
            success: function(res) {
                if(res.status==true){
                    successMessage(res.msg);
                    if(res.url){
                        document.location.href = res.url;
                    }else{
                        window.location.reload();
                    }
                }else if(res.status==false){
                    toastr.error(res.msg);
                }
            },
            error:function (response){
                errorMessage(response);
            }
        })
      : t.dismiss === Swal.DismissReason.cancel &&
        Swal.fire({
          title: "Cancelled",
          text: "Your data is safe :)",
          type: "error",
          confirmButtonClass: "btn btn-success",
        });
  });
});

$(document).on('click','a.btn_status_change', function(e) {
var form=$(this);
e.preventDefault();
var url=$(form).attr('href');
Swal.fire({
    title: "Are you sure?",
    text: "You want to change data status!",
    type: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, change status.",
    confirmButtonClass: "btn btn-primary",
    cancelButtonClass: "btn btn-danger ml-1",
    buttonsStyling: !1,
  }).then(function (t) {
    t.value?
        $.ajax({
            type: 'get',
            url: url,
            // data: {"_token": "{{ csrf_token() }}"},
            success: function(res) {
                if(res.status==true){
                // await delay(5000);
                    successMessage(res.msg);
                    if(res.url){
                        document.location.href = res.url;
                    }else{
                        // window.location.reload();
                    }

                }else if(res.status==false){
                    errorMessage(res.msg);
                }
            },
            error:function (response){
            }
        })
      : t.dismiss === Swal.DismissReason.cancel &&
        Swal.fire({
          title: "Cancelled",
          text: "No change make in data status.:)",
          type: "error",
          confirmButtonClass: "btn btn-success",
        });
  });
});

$(document).on('click','a.btn_confirm_data', function(e) {
var form=$(this);
e.preventDefault();
var url=$(form).attr('href');
Swal.fire({
    title: "Are you sure?",
    text: "You want to Confirm Data!",
    type: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Confirm Data.",
    confirmButtonClass: "btn btn-primary",
    cancelButtonClass: "btn btn-danger ml-1",
    buttonsStyling: !1,
  }).then(function (t) {
    t.value?
        $.ajax({
            type: 'get',
            url: url,
            // data: {"_token": "{{ csrf_token() }}"},
            success: function(res) {
                if(res.status==true){
                // await delay(5000);
                    successMessage(res.msg);
                    if(res.url){
                        document.location.href = res.url;
                    }else{
                        // window.location.reload();
                    }

                }else if(res.status==false){
                    errorMessage(res.msg);
                }
            },
            error:function (response){
            }
        })
      : t.dismiss === Swal.DismissReason.cancel &&
        Swal.fire({
          title: "Cancelled",
          text: "No change make in data status.:)",
          type: "error",
          confirmButtonClass: "btn btn-success",
        });
  });
});

$(document).on('click','a.btn_confirm_mail', function(e) {
var form=$(this);
e.preventDefault();
var url=$(form).attr('href');
Swal.fire({
    title: "Are you sure?",
    text: "You want to Confirm Send Mail!",
    type: "warning",
    showCancelButton: !0,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, Send Mail.",
    confirmButtonClass: "btn btn-primary",
    cancelButtonClass: "btn btn-danger ml-1",
    buttonsStyling: !1,
  }).then(function (t) {
    t.value?
        $.ajax({
            type: 'get',
            url: url,
            // data: {"_token": "{{ csrf_token() }}"},
            success: function(res) {
                if(res.status==true){
                // await delay(5000);
                    successMessage(res.msg);
                    if(res.url){
                        document.location.href = res.url;
                    }else{
                        // window.location.reload();
                    }

                }else if(res.status==false){
                    errorMessage(res.msg);
                }
            },
            error:function (response){
            }
        })
      : t.dismiss === Swal.DismissReason.cancel &&
        Swal.fire({
          title: "Cancelled",
          text: "No change make send mail.:)",
          type: "error",
          confirmButtonClass: "btn btn-success",
        });
  });
});

</script>

