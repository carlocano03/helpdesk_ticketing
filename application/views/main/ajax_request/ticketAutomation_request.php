<script>
    $(document).ready(function() {
        $('.other_dept').hide(300);
        $('.co_employee').hide(300);
        var tableTicket = $('#table_ticket').DataTable({
            "fnRowCallback": function(nRow, aData, iDisplayIndex, asd) {
                if (aData[4] == 'Pending') {
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
                "url": "<?= base_url('ticket/getTicket') ?>",
                "type": "POST",
                "data": function(data) {
                    data.department = $('#filter_dept').val();
                    data.status = $('#filter_status').val();
                }
            },
        });
        $('#filter_dept').on('change', function() {
            tableTicket.draw();
        });
        $('#filter_status').on('change', function() {
            tableTicket.draw();
        });
        // setInterval(function() {
        //     getTicket();
        // }, 5000);

        $(document).on('click', '.view_ticketInfo', function() {
            var ticketNo = $(this).attr('id');
            window.location.href = "<?= base_url('ticket/ticketInformation?ticketNo=') ?>" + ticketNo;
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
            "bDestroy": true,
            "ajax": {
                "url": "<?= base_url('ticket/getTicketInfo/') ?>" + ticketNo,
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
                        // tableConcern.draw();
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

        //Add Solutions
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
                        // tableConcern.draw();
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


        //Transfer Ticket function
        $(document).on('click', '.transfer_ticket', function() {
            var ticketNo = $('#ticket').val();
            var department = $('#concernDept').val()
            $.ajax({
                url: "<?php echo base_url(); ?>solutionmanagement/fetch_employee",
                method: "POST",
                data: {
                    department: department
                },
                success: function(data) {
                    $('#co_employee').html(data);
                    $('#ticketModalTransfer').modal('show');
                }
            });
        });

        $(document).on('change', '#trans_dept', function() {
            var department = $(this).val();

            $.ajax({
                url: "<?php echo base_url(); ?>solutionmanagement/fetch_employee",
                method: "POST",
                data: {
                    department: department
                },
                success: function(data) {
                    $('#assignee').html(data);
                }
            });
        });

        $(document).on('change', '#transfer_options', function() {
            var trans = $(this).val();
            switch (trans) {
                case 'other_department':
                    $('.other_dept').show(300);
                    $('.co_employee').hide(300);
                    $('#trans_dept').prop('required', true);
                    $('#assignee').prop('required', true);
                    $('#co_employee').prop('required', false);
                    break;

                default:
                    $('.co_employee').show(300);
                    $('.other_dept').hide(300);
                    $('#co_employee').prop('required', true);
                    $('#trans_dept').prop('required', false);
                    $('#assignee').prop('required', false);
                    break;
            }
        });

        $(document).on('submit', '#transferTicket', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            $.ajax({
                url: "<?= base_url() . 'ticket/trasferTicket' ?>",
                method: "POST",
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#__loading').show();
                },
                success: function(data) {
                    if (data.message == 'Success') {
                        Swal.fire(
                            'Thank you!',
                            'Trasferred successfuly.',
                            'success'
                        );
                        setTimeout(function() {
                            window.location.href = "<?= base_url('main/ticketMonitoring') ?>"
                        }, 2000);
                    } else {
                        Swal.fire('Error!', 'Failed to transfer ticket. Please contact system administrator', 'error');
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

        //Add Support System
        $(document).on('change', '.support_system', function() {
            var concernID = $(this).attr('id');
            var support_system = $(this).val();
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to support through " + support_system,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, proceed'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?= base_url('SolutionManagement/addSupport_system') ?>",
                        method: "POST",
                        data: {
                            concernID: concernID,
                            support_system: support_system
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $('#__loading').show();
                        },
                        success: function(data) {
                            if (data.message == 'Success') {
                                // tableConcern.draw();
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
                } else {
                    $(this).val('');
                }
            })
        });

    });
</script>