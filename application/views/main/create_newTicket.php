<style>
    #table_request td {
        height: 70px;
    }

    #table_support td:nth-child(7) {
        text-align: center;
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
        <h1>Create New Ticket</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Creation of Ticket</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="dashboard">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">List of Department</h5>
                <hr class="mt-0">

                <div class="row g-2 mt-3">
                    <!-- ITD Card -->
                    <div class="col-xxl-3 col-md-3">
                        <a href="" id="openModalTicket" data-dept="Information Technology Department" data-bs-toggle="modal" style="color: #444444;">
                            <div class="card info-card menu-card border">

                                <div class="card-body">
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="card-icon d-flex align-items-center justify-content-center">
                                            <img src="<?= base_url('assets/img/dept/ITD1.png') ?>" alt="">
                                        </div>
                                        <div class="ps-4 text-center">
                                            <span class="small pt-1 fw-bold">INFORMATION TECHNOLOGY
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div><!-- End ITD Card -->

                    <!-- HRD Card -->
                    <div class="col-xxl-3 col-md-3">
                        <a href="" id="openModalTicket" data-dept="Human Resource Department" data-bs-toggle="modal" style="color: #444444;">
                            <div class="card info-card menu-card border">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="card-icon d-flex align-items-center justify-content-center">
                                            <img src="<?= base_url('assets/img/dept/HRD.png') ?>" alt="">
                                        </div>
                                        <div class="ps-4 text-center">
                                            <span class="small pt-1 fw-bold">HUMAN RESOURCE
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div><!-- End HRD Card -->

                    <!-- Accounting Card -->
                    <div class="col-xxl-3 col-md-3">
                        <a href="" id="openModalTicket" data-dept="Accounting Department" data-bs-toggle="modal" style="color: #444444;">
                            <div class="card info-card menu-card border">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="card-icon d-flex align-items-center justify-content-center">
                                            <img src="<?= base_url('assets/img/dept/accounting.png') ?>" alt="">
                                        </div>
                                        <div class="ps-4 text-center">
                                            <span class="small pt-1 fw-bold">ACCOUNTING DEPARTMENT
                                            </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div><!-- End Accounting Card -->

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
                    <label for="concern">Assignee</label>
                    <input type="hidden" name="department" id="department">
                    <select class="form-select form-select-sm" id="concernPerson" name="concernPerson" aria-label=".form-select-sm example">
                        <option value="">Select Assignee</option>

                    </select>
                </div>

                <div class="mb-3" id="form">
                    <label for="form_list">Form</label>
                    <select class="form-select form-select-sm" id="form_list" name="form_list" aria-label=".form-select-sm example">
                        <option value="">Select Form</option>

                    </select>
                </div>
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
                    <button class="btn btn-danger btn-sm add_row"><i class="bi bi-plus-square-fill me-2"></i>Add Row</button>
                    <hr>
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