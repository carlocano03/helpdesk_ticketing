<script>
    $(document).ready(function() {
        getTicket();

        function getTicket() {
            $('#table_ticket').DataTable({
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
                    "url": "<?= base_url('ticket/getTicket') ?>",
                    "type": "POST"
                },
            });
        }
        // setInterval(function() {
        //     getTicket();
        // }, 5000);

        $(document).on('change', '.concern', function() {
            var ticketID = $(this).attr('id');
            var concernStatus = $(this).val();
            var requestBy = $(this).data('request');
            var ticketNo = $(this).data('ticket');

            $.ajax({
                url: "<?= base_url('ticket/updateStatus') ?>",
                method: "POST",
                data: {
                    ticketID: ticketID,
                    concernStatus: concernStatus,
                    requestBy: requestBy,
                    ticketNo: ticketNo
                },
                dataType: "json",
                success: function(data) {
                    if (data.success == 'Success') {
                        Swal.fire(
                            'Thank you!',
                            'Successfully updated.',
                            'success'
                        );
                        var table = $('#table_ticket').DataTable();
                        table.draw();
                    } else {
                        Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                    }
                }
            });
        });

        $(document).on('click', '.done_ticket', function() {
            var ticketID = $(this).attr('id');
            var requestBy = $(this).data('request');
            var ticketNo = $(this).data('ticket');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, its done!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('ticket/doneTicket') ?>",
                        method: "POST",
                        data: {
                            ticketID: ticketID,
                            requestBy: requestBy,
                            ticketNo: ticketNo
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.success == 'Success') {
                                Swal.fire(
                                    'Thank you!',
                                    'Successfully updated.',
                                    'success'
                                );
                                var table = $('#table_ticket').DataTable();
                                table.draw();
                            } else {
                                Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                            }
                        }
                    });
                }
            })
        });

    });
</script>