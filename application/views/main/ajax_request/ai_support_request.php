<style>
    #loading {
        text-align: center;
        background: url('<?= base_url('assets/img/loader.gif') ?>') no-repeat center;
        height: 150px;
    }
</style>

<script>
    $(document).ready(function() {
        filter_data(1);

        function filter_data(page) {
            $('.filter_data').html("<div id='loading'></div>");
            var action = 'fetch_data';
            var support = $('#searcSupport').val();
            var department = $('#filterdepartment').val();
            var section = $('#filtersection').val();
            var concern = $('#filterconcern').val();
            $.ajax({
                url: "<?= base_url(); ?>solutionmanagement/fetch_data/" + page,
                method: "POST",
                dataType: "JSON",
                data: {
                    action: action,
                    support: support,
                    department: department,
                    section: section,
                    concern: concern
                },
                success: function(data) {
                    $('.filter_data').html(data.product_list);
                    $('#pagination_link').html(data.pagination_link);
                }
            });
        }

        $(document).on('click', '.pagination li a', function(event) {
            event.preventDefault();
            var page = $(this).data('ci-pagination-page');
            filter_data(page);
        });

        $(document).on('change', '#filterdepartment', function() {
            filter_data(1);
        });

        $(document).on('change', '#filterconcern', function() {
            filter_data(1);
        });

        $(document).on('keyup', '#searcSupport', function() {
            var test = $(this).val();
            if (test != '') {
                filter_data();
            } else {
                filter_data(1);
            }
        });

        $("#searcSupport").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?= base_url() ?>solutionmanagement/getsolutionTitle",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $('#searcSupport').val(ui.item.label);
                filter_data(1);
            }
        });

    });

    $(document).on('click', '.view_solution', function() {
        var solutionID = $(this).attr('id');

        $.ajax({
            url: "<?= base_url() . 'SolutionManagement/get_data_solution' ?>",
            method: "POST",
            data: {
                solutionID: solutionID
            },
            dataType: "json",
            success: function(data) {
                $('#getSolutionModal').modal('show');
                $('#videoFrame').html(data.video);
                $('#audioFrame').html(data.audio);
                $('#step').html(data.sol);
                $('#solutionID').val(solutionID);
                if (data.posted == 'Posted') {
                    $(".approved_solution").attr("disabled", true);
                    $(".disapproved_solution").attr("disabled", true);
                } else {
                    $(".approved_solution").attr("disabled", false);
                    $(".disapproved_solution").attr("disabled", false);
                }
            }
        });
    });
</script>