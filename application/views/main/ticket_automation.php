<style>
    #table_support td:nth-child(5),
    #table_support td:nth-child(6),
    #table_support_posted td:nth-child(5) {
        text-align: center;
    }

    #table_request td {
        height: 70px;
    }

    #table_request th:nth-child(1) {
        width: 5%;
    }

    #table_request th:nth-child(3) {
        width: 5%;
    }

    #table_request td:nth-child(2) {
        vertical-align: baseline;
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
        <h1>Ticketing System - My Ticket Request</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Ticketing System</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">List of Created Ticket</h5>
                <hr>
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                        <a href="#ticketingModal" data-bs-toggle="modal" class="btn btn-success btn-sm" title="Add account">
                            <i class="bi bi-pencil-square me-2"></i>Create Ticket
                        </a>
                        <button type="button" class="btn btn-secondary btn-sm" title="Export data">
                            <i class="bi bi-download me-2"></i>Export Data
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                    <h5>Filtering Section</h5>
                        <div class="row">
                    
                            <div class="col-md-4">
                                                              <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="filter_status">From</label>
                                    <input type="date" class="form-control form-control-sm" id="from">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="filter_status">To</label>
                                    <input type="date" class="form-control form-control-sm" id="to">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filter_dept">Department</label>
                            <select class="form-select form-select-sm" id="filter_dept">
                                <option value="">Select All</option>
                                <?php foreach ($department as $row) : ?>
                                    <option value="<?= $row->department ?>"><?= $row->department ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filter_status">Status</label>
                            <select class="form-select form-select-sm" id="filter_status">
                                <option value="">Select All</option>
                                <?php foreach ($status as $row) : ?>
                                    <option value="<?= $row->concern_status ?>"><?= $row->concern_status ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table_support" width="100%">
                        <thead>
                            <tr>
                                <th>Ticket No.</th>
                                <th>Concern Person</th>
                                <th>Department</th>
                                <th>Date Request</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Days Count</th>
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
                    <label for="concern">Department</label>
                    <select class="form-select form-select-sm" id="department" name="department" aria-label=".form-select-sm example">
                        <option value="">Select Department</option>
                        <?php foreach($department as $row) : ?>
                            <option value="<?= $row->department;?>"><?= $row->department;?></option>
                        <?php endforeach;?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="concern">Assignee</label>
                    <input type="hidden" name="department" id="department">
                    <select class="form-select form-select-sm" id="concernPerson" name="concernPerson" aria-label=".form-select-sm example">
                        <option value="">Select Assignee</option>

                    </select>
                </div>

                <!-- <div class="mb-3" id="form">
                    <label for="form_list">Form</label>
                    <select class="form-select form-select-sm" id="form_list" name="form_list" aria-label=".form-select-sm example">
                        <option value="">Select Form</option>

                    </select>
                </div> -->
                <hr>

                <!-- IT TICKET FORM -->
                <div id="it_form">
                    <div class="alert alert-secondary p-1"><i class="bi bi-ui-checks ms-2 me-2"></i>LIST OF CONCERN</div>
                    <table class="table" width="100%" cellspacing="0" id="table_request">
                        <thead>
                            <tr>
                                <th>#</th>
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
                    <button class="btn btn-danger btn-sm add_row"><i class="bi bi-plus-square-fill me-2"></i>Add Concern</button>
                    <hr>
                    <div class="mb-3">
                        <label for="remarks">Remarks</label>
                        <textarea name="remarks" id="remarks" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="concern">Priority Level</label>
                        <select class="form-select form-select-sm" id="level" name="level" aria-label=".form-select-sm example">
                            <option value="">Select Priority Level</option>
                            <option value="Critical">Critical</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                </div>
                <!-- END OF IT TICKET FORM -->


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-outline-warning text-white" id="createTicket"><i class="bi bi-save me-2"></i>Save Ticket</button>
            </div>
        </div>
    </div>
</div>