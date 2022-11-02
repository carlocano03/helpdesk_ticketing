<script>
    $(document).ready(function() {
        $('#table_account').DataTable({
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
                "url": "<?= base_url('main/get_accountData') ?>",
                "type": "POST"
            },
        });
    });

    $(document).on('click', '.action_session', function() {
        var userID = $(this).attr('id');
        if ($(this).is(":checked")) {
            $.ajax({
                url: "<?= base_url() . 'main/account_activated' ?>",
                type: "POST",
                data: {
                    userID: userID
                },
                dataType: "json",
                success: function(data) {
                    if (data.success == 'Success') {
                        Swal.fire('Thank you!', 'Account activated.', 'success');
                        var table = $('#table_account').DataTable();
                        table.draw();
                    } else {
                        Swal.fire("Error in updating", "Clicked button to close!", "error");
                    }

                }
            });
        } else {
            $.ajax({
                url: "<?= base_url() . 'main/account_deactivated' ?>",
                type: "POST",
                data: {
                    userID: userID
                },
                dataType: "json",
                success: function(data) {
                    if (data.success == 'Success') {
                        Swal.fire('Thank you!', 'Account deactivated.', 'success');
                        var table = $('#table_account').DataTable();
                        table.draw();
                    } else {
                        Swal.fire("Error in updating", "Clicked button to close!", "error");
                    }
                }
            });
        }
    });

    $(document).on('click', '.update_account', function(){
        $('#exampleModal').modal('show');
    });
</script>