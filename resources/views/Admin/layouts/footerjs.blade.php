  <!-- BEGIN: Vendor JS-->
  <script src="{{ asset('dashboard/app-assets/vendors/js/vendors.min.js')}}"></script>

  {{-- <script src="{{ asset('dashboard/app-assets/vendors/js/extensions/dropzone.min.js')}}"></script> --}}
  <script src="{{ asset('dashboard/app-assets/vendors/js/ui/prism.min.js')}}"></script>
  <!-- BEGIN Vendor JS-->
  <script src="{{ asset('dashboard/app-assets/vendors/js/gallery/masonry/masonry.pkgd.min.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/gallery/photo-swipe/photoswipe.min.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/gallery/photo-swipe/photoswipe-ui-default.min.js')}}"></script>

  <script src="{{ asset('dashboard/app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/pickadate/picker.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/pickers/pickadate/picker.date.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/forms/toggle/switchery.min.js')}}"></script>
<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('dashboard/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<!-- END: Page Vendor JS-->

<script src="{{ asset('dashboard/app-assets/vendors/js/editors/tinymce/tinymce.min.js') }}"></script>
  {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}


  <!-- BEGIN: Page Vendor JS-->
  <script src="{{ asset('dashboard/app-assets/vendors/js/charts/chart.min.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/charts/raphael-min.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/charts/morris.min.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/charts/jvector/jquery-jvectormap-2.0.3.min.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/vendors/js/charts/jvector/jquery-jvectormap-world-mill.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/data/jvector/visitor-data.js')}}"></script>
  <!-- END: Page Vendor JS-->

  <script src="{{ asset('dashboard/app-assets/vendors/js/extensions/cropper.min.js') }}"></script>
  <!-- BEGIN: Theme JS-->
  <script src="{{ asset('dashboard/app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/js/core/app-menu.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/js/core/app.js')}}"></script>

  {{-- <script src="{{ asset('dashboard/app-assets/js/scripts/extensions/dropzone.js')}}"></script> --}}

  <script src="{{ asset('dashboard/app-assets/js/scripts/gallery/photo-swipe/photoswipe-script.js')}}"></script>
  <script src="{{ asset('dashboard/app-assets/js/scripts/tables/datatables/datatable-basic.js')}}"></script>
  <!-- END: Theme JS-->
  <script src="{{ asset('dashboard/app-assets/js/scripts/editors/editor-tinymce.js') }}"></script>
<script src="{{ asset('dashboard/app-assets/js/scripts/extensions/image-cropper.js') }}"></script>


  <script src="{{ asset('dashboard/app-assets/js/scripts/forms/select/form-select2.js')}}"></script>

<!-- BEGIN: Page JS-->
<script src="{{ asset('dashboard/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
<!-- END: Page JS-->
  <!-- BEGIN: Page JS-->
  {{-- <script src="{{ asset('dashboard/app-assets/js/scripts/pages/dashboard-sales.js')}}"></script> --}}

  <script src="{{ asset('dashboard/app-assets/js/scripts/pages/account-setting.js')}}"></script>


  {{-- <script src="{{ asset('dashboard/summernote/summernote-bs4.min.js') }}"></script> --}}
  <!-- END: Page JS-->
  <script>
    $(".img").change(function() {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $(".img-preview").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>

{{-- <script>
    $('.summernote').summernote({
            tabSize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        })
</script> --}}
