<script>
    $(document).ready(function() {
        var tableSupport = $('#table_support').DataTable({
            "fnRowCallback": function(nRow, aData, iDisplayIndex, asd) {
                if (aData[4] == 'Pending') {
                    $('td', nRow).css('background-color', 'rgba(255, 214, 214, 0.59)');
                } else if (aData[4] == 'Posted') {
                    $('td', nRow).css('background-color', 'transparent');
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
                "type": "POST",
                "data": function(data) {
                    data.department = $('#filter_dept').val();
                    data.status = $('#filter_status').val();
                }
            },
        });
        $('#filter_dept').on('change', function() {
            tableSupport.draw();
        });
        $('#filter_status').on('change', function() {
            tableSupport.draw();
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

        $(document).on('click', '#openModalTicket', function() {
            var department = $(this).data('dept');
            $.ajax({
                url: "<?php echo base_url(); ?>solutionmanagement/fetch_employee",
                method: "POST",
                data: {
                    department: department
                },
                success: function(data) {
                    $('#concernPerson').html(data);
                    if (department == 'Information Technology Department') {
                        $('#it_form').show('300');
                        $('#form').hide('300');
                    } else {
                        $('#it_form').show('300');
                        $('#form').show('300');
                    }
                    $('#department').val(department);
                    $('#ticketingModal').modal('show');
                }
            });

        });

        var rowIdx = 1;
        $(document).on('click', '.add_row', function() {
            console.log('Hello');
            $('#table_body').append(
                `<tr id="R${++rowIdx}">
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

        //Add Ticket Function
        $(document).on('click', '#createTicket', function() {
            var dept = $('#department').val();
            var assignee = $('#concernPerson').val().split('|');
            var empID = assignee[0];
            var concernPerson = assignee[1];
            var level = $('#level').val();
            var table_data = [];

            // switch (dept) {
            //     case 'Human Resource Department':
            //         alert('Human Resources');
            //         break;

            //         //ITD Form
            //     default:
            $('#table_body tr').each(function(row, tr) {
                $(this).find("td:nth-child(2)").each(function() {
                    if ($(this).text().trim() != '') {
                        var sub = {
                            'concern': $(tr).find('td:eq(1)').text()
                        };
                        table_data.push(sub);

                        if (assignee != '' && level != '') {
                            Swal.fire({
                                title: 'Are you sure?',
                                text: "You want to continue this transactions.",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, proceed'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: "<?= base_url('SolutionManagement/addTicket') ?>",
                                        method: "POST",
                                        data: {
                                            'data_table': table_data,
                                            empID: empID,
                                            concernPerson: concernPerson,
                                            level: level,
                                            dept: dept,
                                        },
                                        dataType: "json",
                                        beforeSend: function() {
                                            $('#__loading').show();
                                        },
                                        success: function(data) {
                                            if (data.message == 'Success') {
                                                Swal.fire(
                                                    'Thank you!',
                                                    'Ticket successfuly submitted.',
                                                    'success'
                                                );
                                                setTimeout(function() {
                                                    window.location.href = "<?= base_url('SolutionManagement/ticketing') ?>"
                                                }, 2000);
                                            } else {
                                                Swal.fire('Error!', 'Failed to submit ticket. Please contact system administrator', 'error');
                                            }
                                        },
                                        complete: function() {
                                            $('#__loading').hide();
                                        },
                                        error: function() {
                                            $('#__loading').hide();
                                            Swal.fire('Error!', 'Something went wrong. Please contact system administrator', 'error');
                                        }
                                    });
                                }
                            })
                        } else {
                            Swal.fire('Warning!', 'Please fill out the required fields.', 'warning');
                        }
                    } else {
                        Swal.fire('Warning!', 'Empty table fields found.', 'warning');
                    }
                });
            });
            // break;
            // }
        });

        $(document).on('click', '.view_ticket', function() {
            var ticketNo = $(this).attr('id');
            window.location.href = "<?= base_url('SolutionManagement/ticketInfo?ticketNo=') ?>" + ticketNo;
        });

        var ticketNo = $('#ticket').val();
        var tableConcern = $('#table_concern').DataTable({
            "ordering": false,
            "searching": false,
            "lengthChange": false,
            "info": false,
            "paging": false,
            "serverSide": true,
            "processing": true,
            "pageLength": 25,
            // "bDestroy": true,
            "ajax": {
                "url": "<?= base_url('SolutionManagement/getTicketInformation/') ?>" + ticketNo,
                "type": "POST",
            }
        });

        $(document).on('change', '#priority_level', function() {
            var ticketNo = $(this).data('id');
            var level = $(this).val();
            $.ajax({
                url: "<?= base_url('SolutionManagement/updateLevel') ?>",
                method: "POST",
                data: {
                    ticketNo: ticketNo,
                    level: level
                },
                dataType: "json",
                beforeSend: function() {
                    $('#__loading').show();
                },
                success: function(data) {
                    if (data.message == 'Success') {
                        Swal.fire(
                            'Thank you!',
                            'Updated successfully.',
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        Swal.fire('Error!', 'Failed to update. Please contact system administrator', 'error');
                    }
                },
                complete: function() {
                    $('#__loading').hide();
                },
                error: function() {
                    $('#__loading').hide();
                    Swal.fire('Error!', 'Something went wrong. Please contact system administrator', 'error');
                }
            });
        });

        //Add Evaluation
        $(document).on('change', '.evaluate_concern', function() {
            var concernID = $(this).attr('id');
            var evaluateConcern = $(this).val();
            $.ajax({
                url: "<?= base_url('SolutionManagement/evaluateConcern') ?>",
                method: "POST",
                data: {
                    concernID: concernID,
                    evaluateConcern: evaluateConcern
                },
                dataType: "json",
                beforeSend: function() {
                    $('#__loading').show();
                },
                success: function(data) {
                    if (data.message == 'Success') {
                        tableConcern.draw();
                    } else {
                        Swal.fire('Error!', 'Failed to update. Please contact system administrator', 'error');
                    }
                },
                complete: function() {
                    $('#__loading').hide();
                },
                error: function() {
                    $('#__loading').hide();
                    Swal.fire('Error!', 'Something went wrong. Please contact system administrator', 'error');
                }
            });
        });

        //Add Evaluation
        $(document).on('change', '.add_solutions', function() {
            var concernID = $(this).attr('id');
            var solutions = $(this).val();
            $.ajax({
                url: "<?= base_url('SolutionManagement/add_solutions') ?>",
                method: "POST",
                data: {
                    concernID: concernID,
                    solutions: solutions
                },
                dataType: "json",
                beforeSend: function() {
                    $('#__loading').show();
                },
                success: function(data) {
                    if (data.message == 'Success') {
                        tableConcern.draw();
                    } else {
                        Swal.fire('Error!', 'Failed to update. Please contact system administrator', 'error');
                    }
                },
                complete: function() {
                    $('#__loading').hide();
                },
                error: function() {
                    $('#__loading').hide();
                    Swal.fire('Error!', 'Something went wrong. Please contact system administrator', 'error');
                }
            });
        });

    });
</script>