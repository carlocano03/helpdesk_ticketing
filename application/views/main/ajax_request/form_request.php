<script>
    $(document).ready(function() {
        var tableForms = $('#table_forms').DataTable({
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
                "url": "<?= base_url('FormController/getForms') ?>",
                "type": "POST"
            },
        });

        $(document).on('submit', '#addForms', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'FormController/addForms' ?>",
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
                            'Successfully added.',
                            'success'
                        );
                        tableForms.draw();
                        $('#addForms').trigger('reset');
                        $('#formModal').modal('hide');
                    }
                },
                error: function() {
                    Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
                }
            });
        });
    });
</script>