<style>
    #table_support td:nth-child(7) {
        text-align: center;
    }

    #table_request th:nth-child(1) {
        width: 5%;
    }

    #table_request th:nth-child(3) {
        width: 5%;
    }

    .ai-support .input-group-text {
        background: #FFEFBA;
        background: -webkit-linear-gradient(to left, #FFFFFF, #FFEFBA);
        background: linear-gradient(to left, #FFFFFF, #FFEFBA);
        color: orange;
        font-weight: 600;
    }

    #deleteRow {
        color: #c0392b;
        cursor: pointer
    }

    #deleteRow:hover {
        text-decoration: underline;
        cursor: pointer;
        color: #e74c3c;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ticket Automation & SLA Monitoring</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Ticket Automation</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">List of Created Ticket</h5>
                <a href="<?= base_url('ticket/createTicket')?>" class="btn btn-success btn-sm" title="Add account">
                    <i class="bi bi-pencil-square me-2"></i>Create Ticket
                </a>
                <button type="button" class="btn btn-secondary btn-sm" title="Export data">
                    <i class="bi bi-download me-2"></i>Export Data
                </button>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped" id="table_support" width="100%">
                        <thead>
                            <tr>
                                <th>Ticket No.</th>
                                <th>Concern</th>
                                <th>Concern Person</th>
                                <th>Department</th>
                                <th>Remarks</th>
                                <th>Expected Date</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Modal -->
<div class="modal fade" id="ticketingModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-ticket-detailed me-2"></i>Ticket Automation</h5>
                <hr class="mt-0">
                <!-- <form id="addTicket" method="POST"> -->
                <div class="mb-3">
                    <div class="form-floating">
                        <select class="form-select" id="concernDepartment" name="concernDepartment">
                            <option value="">Select Concern Department</option>
                            <?php
                            foreach ($department as $row) {
                                echo "<option value='" . $row->department . "'>" . $row->department . "</option>";
                            }
                            ?>
                        </select>
                        <label for="floatingSelect">List of Department</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="concern">Assignee</label>
                    <select class="form-select form-select-sm" id="concernPerson" name="concernPerson" aria-label=".form-select-sm example" required>
                        <option value="">Select Assignee</option>

                    </select>
                </div>
                <hr>

                <!-- IT TICKET FORM -->
                <div id="it_form">
                    <div class="alert alert-secondary p-1"><i class="bi bi-ui-checks ms-2 me-2"></i>IT REQUEST FORM</div>
                    <table class="table" width="100%" cellspacing="0" id="table_request">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Primary Concern</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table_body">
                            <tr>
                                <td>1</td>
                                <td contenteditable="true" style="background: #dff9fb;"></td>
                                <td>
                                    <span id="deleteRow">Delete</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-danger btn-sm add_row"><i class="bi bi-plus-square-fill me-2"></i>Add Row</button>
                </div>
                <!-- END OF IT TICKET FORM -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-outline-warning text-white"><i class="bi bi-save me-2"></i>Save Ticket</button>
            </div>
        </div>
    </div>
</div>