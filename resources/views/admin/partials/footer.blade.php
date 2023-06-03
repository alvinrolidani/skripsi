<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © Qovex.
            </div>
            <div class="col-sm-6">
                <div class="text-sm-end d-none d-sm-block">
                    Design & Develop by Themesbrand
                </div>
            </div>
        </div>
    </div>
</footer>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->

</div>
<!-- end container-fluid -->

<!-- Right Sidebar -->
<div class="right-bar">
    <div data-simplebar class="h-100">
        <div class="rightbar-title px-3 py-4">
            <a href="javascript:void(0);" class="right-bar-toggle float-end">
                <i class="mdi mdi-close noti-icon"></i>
            </a>
            <h5 class="m-0">Settings</h5>
        </div>

        <!-- Settings -->
        <hr class="mt-0" />
        <h6 class="text-center mb-0">Choose Layouts</h6>

        <div class="p-4">
            <div class="mb-2">
                <img src="/templates/layouts/assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail"
                    alt="">
            </div>

            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="light-mode-switch" checked />
                <label class="form-check-label" for="light-mode-switch">Light Mode</label>
            </div>

            <div class="mb-2">
                <img src="/templates/layouts/assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail"
                    alt="">
            </div>

            <div class="form-check form-switch mb-3">
                <input type="checkbox" class="form-check-input theme-choice" id="dark-mode-switch"
                    data-bsStyle="/templates/layouts/assets/css/bootstrap-dark.min.css"
                    data-appStyle="/templates/layouts/assets/css/app-dark.min.css" />
                <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
            </div>




        </div>

    </div>
    <!-- end slimscroll-menu-->
</div>
<!-- /Right-bar -->

<!-- Right bar overlay-->


<div class="rightbar-overlay"></div>

<!-- JAVASCRIPT -->
<!-- JAVASCRIPT -->
<script src="/templates/layouts/assets/libs/jquery/jquery.min.js"></script>
<script src="/templates/layouts/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/templates/layouts/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/templates/layouts/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/templates/layouts/assets/libs/node-waves/waves.min.js"></script>
<script src="/templates/layouts/assets/libs/jquery-sparkline/jquery.sparkline.min.js"></script>

<script src="/templates/layouts/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="/templates/layouts/assets/js/pages/dashboard.init.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script src="/templates/layouts/assets/js/app.js"></script>

<script src="/templates/layouts/assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>


</body>

<script>
    $(function() {
        $("#datepicker").datepicker({
            format: 'mm-dd-yyyy',
            autoclose: true,
            todayHighlight: true,
            orientation: 'auto'
        });
        $('.selectpicker').select2();


    });




    function bacaGambar(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#load_gambar').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#preview').change(function() {
        bacaGambar(this);
    })
</script>
<!-- Mirrored from themesbrand.com/qovex/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 11 Apr 2023 14:28:51 GMT -->

</html>
