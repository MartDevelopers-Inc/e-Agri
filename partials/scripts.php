<!-- J Querry -->
<script src="../public/backend_assets/plugins/jquery/jquery-3.5.1.min.js"></script>
<!-- Bootstrap popper -->
<script src="../public/backend_assets/plugins/bootstrap/js/popper.min.js"></script>
<!-- Bootstrap -->
<script src="../public/backend_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!-- Perfect Scrollbar -->
<script src="../public/backend_assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<!-- Pace Js -->
<script src="../public/backend_assets/plugins/pace/pace.min.js"></script>
<!-- App Main Js -->
<script src="../public/backend_assets/js/main.min.js"></script>
<!-- Custom Js -->
<script src="../public/backend_assets/js/custom.js"></script>
<!-- Alerts Js -->
<script src="../public/backend_assets/iziToast/iziToast.min.js"></script>
<!-- Dashboard Js -->
<script src="../public/backend_assets/js/pages/dashboard.js"></script>
<!-- Datatable Js -->
<script src="../public/backend_assets/plugins/datatables/datatables.min.js"></script>
<!-- Data Table Init -->
<script src="../public/backend_assets/js/pages/datatables.js"></script>
<!-- Initialize Alerts -->
<?php if (isset($success)) { ?>
    <script>
        iziToast.success({
            title: 'Success',
            position: 'topLeft',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            transitionInMobile: 'fadeInUp',
            transitionOutMobile: 'fadeOutDown',
            message: '<?php echo $success; ?>',
        });
    </script>

<?php } ?>

<?php if (isset($err)) { ?>
    <script>
        iziToast.error({
            title: 'Error',
            timeout: 1000,
            resetOnHover: true,
            position: 'topLeft',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            transitionInMobile: 'fadeInUp',
            transitionOutMobile: 'fadeOutDown',
            message: '<?php echo $err; ?>',
        });
    </script>

<?php } ?>

<?php if (isset($info)) { ?>
    <script>
        iziToast.warning({
            title: 'Warning',
            position: 'topLeft',
            transitionIn: 'flipInX',
            transitionOut: 'flipOutX',
            transitionIn: 'fadeInUp',
            transitionInMobile: 'fadeInUp',
            transitionOutMobile: 'fadeOutDown',
            message: '<?php echo $info; ?>',
        });
    </script>

<?php }
?>
<!-- Select 2 Js -->
<script src="../public/backend_assets/plugins/select2/js/select2.full.min.js"></script>
<script>
    $('.select').select2();
    /* File Upload */
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>