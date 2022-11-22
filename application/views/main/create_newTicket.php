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
                        <a href="#" style="color: #444444;">
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
                        <a href="#" style="color: #444444;">
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