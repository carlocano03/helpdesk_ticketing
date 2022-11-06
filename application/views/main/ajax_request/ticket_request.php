<script>
    $(document).ready(function() {
        tblSupport();
        function tblSupport() {
            $('#table_support').DataTable({
                "fnRowCallback": function(nRow, aData, iDisplayIndex, asd) {
                    if (aData[6] == 'Pending') {
                        $('td', nRow).css('background-color', 'rgba(255, 214, 214, 0.59)');
                    } else {
                        $('td', nRow).css('background-color', 'rgba(209, 253, 208, 0.59)');
                    }
                },
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
                "bDestroy": true,
                "ajax": {
                    "url": "<?= base_url('solutionmanagement/get_ticket') ?>",
                    "type": "POST"
                },
            });
        }
        setInterval(function() {
            tblSupport();
        },5000);
    });

    $(document).on('change', '#concernDepartment', function() {
        var department = $(this).val();

        $.ajax({
            url: "<?php echo base_url(); ?>solutionmanagement/fetch_employee",
            method: "POST",
            data: {
                department: department
            },
            success: function(data) {
                $('#concernPerson').html(data);
            }
        });
    });

    $(document).on('submit', '#addTicket', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $.ajax({
            url: "<?= base_url() . 'SolutionManagement/addTicket' ?>",
            method: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.message != '') {
                    Swal.fire('Warning!', 'Error in inserting of data.', 'warning');
                } else {
                    Swal.fire(
                        'Thank you!',
                        'Added successfully.',
                        'success'
                    );
                    var table = $('#table_support').DataTable();
                    table.draw();
                    $('#addTicket').trigger('reset');
                    $('#ticketingModal').modal('hide');
                }
            },
            error: function() {
                Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
            }
        });
    });
</script>