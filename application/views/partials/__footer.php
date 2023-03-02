<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright 2023 <strong><span>Tom's World Philippines</span></strong>. All Rights Reserved - Powered by <b>VAG</b>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.1.js"></script>
<script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/chart.js/chart.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/echarts/echarts.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/quill/quill.min.js') ?>"></script>
<script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?= base_url('assets/js/date-time.js') ?>"></script>

<!-- Template Main JS File -->
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<link href="<?= base_url('assets/js/jquery.toast.js') ?>" rel="stylesheet">

<script>
    $(document).ready(function() {

        function load_unseen_notification(view = '') {
            $.ajax({
                url: "<?= base_url() . 'SolutionManagement/getNotif' ?>",
                method: "POST",
                data: {
                    view: view
                },
                dataType: "json",
                success: function(data) {
                    $('#notifications').html(data.notification);

                    if (data.unseen_notification > 0) {
                        $('.count').html(data.unseen_notification);
                        $('.count-notif').html(data.unseen_notification)
                    } else {
                        $('.hide-notif').html('')
                    }
                }
            });
        }

        load_unseen_notification();

        setInterval(function() {
            load_unseen_notification();;
        }, 5000);
    });
</script>

</body>

</html>