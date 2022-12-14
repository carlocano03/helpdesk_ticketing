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
                "type": "POST",
                "data": function(data) {
                    data.department = $('#filter_dept').val();
                    data.from = $('#from').val();
                    data.to = $('#to').val();
                }
            },
        });
        $('#filter_dept').on('change', function() {
            tableForms.draw();
        });
        $('#from').on('change', function() {
            if ($('#from').val() > $('#to').val() && $('#to').val() != '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Date Range,Please Check the date. Thank you!',
                });
                $('#from').val('');
            } else {
                tableForms.draw();
            }
        });
        $('#to').on('change', function() {
            if ($('#to').val() < $('#from').val()) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Invalid Date Range,Please Check the date. Thank you!',
                });
                $('#to').val('');
            } else {
                tableForms.draw();
            }
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

        $(document).on('click', '.download_forms', function() {
            var doc_id = $(this).attr('id');
            if (doc_id != '') {
                window.location.href = "<?= base_url('FormController/downloadForms?docID=')?>" + doc_id;
            } else {
                Swal.fire('Error!', 'No document found.', 'error');
            }
        });
    });
</script>