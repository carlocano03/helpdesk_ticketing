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
        }, 5000);


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

        var rowIdx = 1;
        $(document).on('click', '.add_row', function() {
            console.log('Hello');
            $('#table_body').append(
                `<tr class="data_lot" id="R${++rowIdx}">
                <td class="row-index">
                    <span>${rowIdx}</span>
                </td>
                <td contenteditable="true" style="background: #dff9fb;">
                
                </td>
                <td>
                    <span id="deleteRow">Delete</span>
                </td>
            </tr>`
            );
        });
        // jQuery button click event to remove a row.
        $('#table_body').on('click', '#deleteRow', function() {
            var child = $(this).closest('tr').nextAll();
            child.each(function() {
                var id = $(this).attr('id');
                var idx = $(this).children('.row-index').children('span');
                var dig = parseInt(id.substring(1));
                idx.html(`${dig - 1}`);
                $(this).attr('id', `R${dig - 1}`);
            });
            $(this).closest('tr').remove();
            rowIdx--;
        });
        $('#it_form').hide('300');
        $(document).on('change', '#concernDepartment', function() {
            var dept = $(this).val();
            switch (dept) {
                case 'Information Technology Department':
                    $('#it_form').show('300');
                    break;
            
                default:
                    $('#it_form').hide('300');
                    break;
            }
        });

    });
</script>