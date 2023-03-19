</div>
</div>
</div>
</div>
        <!-- END layout-wrapper -->
        
        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/select2/js/select2.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select2-multiple').select2();
                $('.select2-single').select2();
            });
            
            function removebrochure(lang){
                 $('input[name="old'+lang+'"]').val('')
                 $('#'+lang+'link').attr('style',"display:none")
            }
        </script>

        <!-- apexcharts -->
        <!-- <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
        <!-- Required datatable js -->
       
        <!-- dashboard init -->
       <!-- <script src="{{ asset('backend/assets/js/pages/dashboard.init.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('backend/assets/js/app.js') }}"></script>
        <script src="{{ URL::asset('backend/tinymce/tinymce.min.js') }}"></script>
        <script>
            var editor_config = {
              path_absolute : "/",
              selector: 'textarea#specification',
              relative_urls: false,
              plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
              ],
              toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
              file_picker_callback : function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = '<?php echo asset(''); ?>laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                  cmsURL = cmsURL + "&type=Images";
                } else {
                  cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                  url : cmsURL,
                  title : 'Filemanager',
                  width : x * 0.8,
                  height : y * 0.8,
                  resizable : "yes",
                  close_previous : "no",
                  onMessage: (api, message) => {
                    callback(message.content);
                  }
                });
              }
            };

            tinymce.init(editor_config);
          </script>
          <script>
  var editor_config = {
    path_absolute : "/",
    selector: 'textarea#shortdescription',
    relative_urls: false,
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table directionality",
      "emoticons template paste textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    file_picker_callback : function(callback, value, meta) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = '<?php echo asset(''); ?>laravel-filemanager?editor=' + meta.fieldname;
      if (meta.filetype == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.openUrl({
        url : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no",
        onMessage: (api, message) => {
          callback(message.content);
        }
      });
    }
  };

  tinymce.init(editor_config);
</script>
<script>
    $(document).ready(function () {
        $('#productname').change(function(e) {
          $.get('{{ route('checkproductslug') }}', 
            { 'title': $(this).val() }, 
            function( data ) {
              $('#slug').val(data.slug);
            }
          );
        });
        
        $('#categoryname').change(function(e) {
            $.get('{{ route('checkcategoryslug') }}', 
              { 'title': $(this).val() }, 
              function( data ) {
                $('#slug').val(data.slug);
              }
            );
        });
        $('#newstitle').change(function(e) {
            $.get('{{ route('checknewsslug') }}', 
              { 'title': $(this).val() }, 
              function( data ) {
                $('#slug').val(data.slug);
              }
            );
        });
        $('#applicationname').change(function(e) {
            $.get('{{ route('checkapplicationslug') }}', 
              { 'title': $(this).val() }, 
              function( data ) {
                $('#slug').val(data.slug);
              }
            );
        });
   });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
 @if(Session::has('message'))
 var type = "{{ Session::get('alert-type','info') }}"
 switch(type){
    case 'info':
    toastr.info(" {{ Session::get('message') }} ");
    break;

    case 'success':
    toastr.success(" {{ Session::get('message') }} ");
    break;

    case 'warning':
    toastr.warning(" {{ Session::get('message') }} ");
    break;

    case 'error':
    toastr.error(" {{ Session::get('message') }} ");
    break; 
 }
 @endif 
</script>
<script src="{{ asset('backend/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $( ".deleteaction" ).click(function(e) {
            e.preventDefault();
            var link= $(this).attr("href");
            Swal.fire({ 
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
              }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href= link;
                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }
              })
        });
    });
</script>    
<script type="text/javascript">
    $(document).ready(function () {
 
      // initialize the counter for textbox
      var x = 1;
 
      // handle click event on Add More button
      $('#addoptionrow').click(function (e) {
        e.preventDefault();
          x++; // increment the counter
          var newoptionhtml=``;
                           // newtabhtml='<div class="card"><div class="card-header" id="newtab'+x+'"><h5 class="mb-0"><a href="#!" data-toggle="collapse" data-target="#newtab'+x+'" aria-expanded="false" aria-controls="newtab'+x+'">Collapsible Group Item #1</a></h5><a href="#" class="remove-lnk">Remove</a></div>';
                           // newtabhtml=newtabhtml+'<div id="#newtab'+x+'" class=" card-body collapse" aria-labelledby="newtab'+x+'" data-parent="#accordionExample">';
                           
                            newoptionhtml='<div class="newoptionrow row">';
                            
                            newoptionhtml=newoptionhtml+`<div class="col-md-3">
                            <div class="mb-3">
                                <label for="add_option_name" class="form-label">Option Name</label>
                                <input name="add_option_name[]" type="text" class="form-control" id="add_option_name" value="" required="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="add_option_price" class="form-label">Option Price</label>
                                <input name="add_option_price[]" type="text" class="form-control" id="add_option_price" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="add_option_discountprice" class="form-label">Option Discount Price</label>
                                <input name="add_option_discountprice[]" type="text" class="form-control" id="add_option_discountprice" value="">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <a href="#" class="remove-lnk newoptionremovelnk">Remove</a>
                            </div>
                        </div>`;
                        newoptionhtml=newoptionhtml+'</div>';
          //$('#accordionExample').append($('#detailtabhtml').html()); // add input field
          $('#appendnewoptions').append(newoptionhtml); // add input field
      });
 
      // handle click event of the remove link
      $('#appendnewoptions').on("click", ".newoptionremovelnk", function (e) {
        e.preventDefault();
        $(this).closest('.newoptionrow').remove();  // remove input field
        x--; // decrement the counter
      })
 
    });
  </script>
   <script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <!-- Datatable init js -->
        <script src="{{ asset('backend/assets/js/pages/datatables.init.js')}}"></script>    
