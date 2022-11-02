<script>
    $(document).ready(function() {
        $('#table_solution').DataTable({
            language: {
                search: '',
                searchPlaceholder: "Search Here...",
                paginate: {
                    next: '<i class="bi bi-chevron-right"></i>',
                    previous: '<i class="bi bi-chevron-left"></i>'
                }
            },
            "ordering": false,
            "serverSide": true,
            "processing": true,
            "pageLength": 25,
            "responsive": true,
            "ajax": {
                "url": "<?= base_url('solutionmanagement/get_solution') ?>",
                "type": "POST"
            },
        });
    });

    $(document).on('submit', '#addSolutionForm', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $.ajax({
            url: "<?= base_url() . 'SolutionManagement/addSolution' ?>",
            method: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.message != '') {
                    Swal.fire('Warning!', 'Error in uploading.', 'warning');
                } else {
                    Swal.fire(
                        'Thank you!',
                        'Successfully added. Please wait for the approval of your Department Head.',
                        'success'
                    );
                    var table = $('#table_solution').DataTable();
                    table.draw();
                    $('#addSolutionForm').trigger('reset');
                    $('#solutionModal').modal('hide');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
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

    $(document).on('click', '.approved_solution', function() {
        var solutionID = $('#solutionID').val();

        $.ajax({
            url: "<?= base_url() . 'SolutionManagement/approved_solution' ?>",
            method: "POST",
            data: {
                solutionID: solutionID
            },
            dataType: "json",
            success: function(data) {
                if (data.message == 'Success') {
                    Swal.fire(
                        'Thank you!',
                        'Approved successfully!',
                        'success'
                    );
                    $('#getSolutionModal').modal('hide');
                    var table = $('#table_solution').DataTable();
                    table.draw();
                } else {
                    Swal.fire('Warning!', 'Error in updating. Please try again!', 'warning');
                    $('#getSolutionModal').modal('hide');
                }
            }
        });
    });

    $(document).on('click', '.action_session', function() {
        var solutionID = $(this).attr('id');
        if ($(this).is(":checked")) {
            $.ajax({
                url: "<?= base_url() . 'SolutionManagement/solution_activated' ?>",
                type: "POST",
                data: {
                    solutionID: solutionID
                },
                dataType: "json",
                success: function(data) {
                    if (data.success == 'Success') {
                        Swal.fire('Thank you!', 'Solution activated.', 'success');
                        var table = $('#table_solution').DataTable();
                        table.draw();
                    } else {
                        Swal.fire("Error in updating", "Clicked button to close!", "error");
                    }

                }
            });
        } else {
            $.ajax({
                url: "<?= base_url() . 'SolutionManagement/solution_deactivated' ?>",
                type: "POST",
                data: {
                    solutionID: solutionID
                },
                dataType: "json",
                success: function(data) {
                    if (data.success == 'Success') {
                        Swal.fire('Thank you!', 'Solution deactivated.', 'success');
                        var table = $('#table_solution').DataTable();
                        table.draw();
                    } else {
                        Swal.fire("Error in updating", "Clicked button to close!", "error");
                    }
                }
            });
        }
    });

    $(document).on('click', '.delete_solution', function() {
        var solutionID = $(this).attr('id');

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
                $.ajax({
                    url: "<?= base_url() . 'SolutionManagement/delete_solution' ?>",
                    type: "POST",
                    data: {
                        solutionID: solutionID
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.success == 'Success') {
                            Swal.fire('Thank you!', 'Successfully deleted.', 'success');
                            var table = $('#table_solution').DataTable();
                            table.draw();
                        } else {
                            Swal.fire("Error", "Something went wrong. Please try again later.", "error");
                        }
                    }
                });
            }
        })
    });

    $(document).on('click', '.download_attachment', function() {
        var pdfFile = $(this).data('url');
        if (pdfFile != '') {
            window.open("<?= base_url() . 'uploaded_file/solution_file/' ?>" + pdfFile, 'targetWindow', 'resizable=yes,width=1000,height=1000');
        } else {
            swal("Failed to download", "No data found!", "error");
        }
    });
</script>