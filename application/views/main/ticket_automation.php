<style>
    #table_support td:nth-child(8) {
        text-align: center;
    }

    .ai-support .input-group-text {
        background: #FFEFBA;
        background: -webkit-linear-gradient(to left, #FFFFFF, #FFEFBA);
        background: linear-gradient(to left, #FFFFFF, #FFEFBA);
        color: orange;
        font-weight: 600;
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
                <button type="button" class="btn btn-success btn-sm" title="Add account" data-bs-toggle="modal" data-bs-target="#ticketingModal">
                    <i class="bi bi-pencil-square me-2"></i>Create Ticket
                </button>
                <button type="button" class="btn btn-secondary btn-sm" title="Export data">
                    <i class="bi bi-download me-2"></i>Export Data
                </button>
                <hr>
                <!-- <div class="row g-2 ai-support">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Filter By Department</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Select Department</option>
                                <option value="1">IT Department</option>
                                <option value="2">HR Department</option>
                                <option value="3">Finance</option>
                                <option value="3">Business Development</option>
                                <option value="3">Legal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Filter By Section</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Select Section</option>
                                <option value="1">Section 1</option>
                                <option value="2">Section 2</option>
                                <option value="3">Section 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Filter By Concern</label>
                            <select class="form-select" id="inputGroupSelect01">
                                <option selected>Select Concern</option>
                                <option value="1">Concern 1</option>
                                <option value="2">Concern 2</option>
                                <option value="3">Concern 3</option>
                            </select>
                        </div>
                    </div>
                </div> -->
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
                            <!-- <tr>
                                <td>TN-123458</td>
                                <td>Hardware - System Unit</td>
                                <td>No Display</td>
                                <td>Sample User</td>
                                <td>IT Department</td>
                                <td>Sample Remarks</td>
                                <td>2022-09-04 13:21:50</td>
                                <td>Pending</td>
                            </tr> -->
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
                <form id="addTicket" method="POST">
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select form-select-sm" id="concernDepartment" name="concernDepartment" aria-label=".form-select-sm example" required>
                            <option value="">Select Department</option>
                            <?php
                            foreach ($department as $row) {
                                echo "<option value='" . $row->department . "'>" . $row->department . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="concern" class="form-label">To Concern Person</label>
                        <select class="form-select form-select-sm" id="concernPerson" name="concernPerson" aria-label=".form-select-sm example" required>
                            <option value="">Select Person</option>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="concern" class="form-label">Concern</label>
                        <select class="form-select form-select-sm" name="concern" aria-label=".form-select-sm example" required>
                            <option value="">Select Concern</option>
                            <option value="Hardware">Hardware</option>
                            <option value="Software">Software</option>
                            <option value="Network">Network</option>
                            <option value="Documents">Documents</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="concern" class="form-label">Concern Level</label>
                        <select class="form-select form-select-sm" name="concern_level" aria-label=".form-select-sm example" required>
                            <option value="">Select Concern</option>
                            <option value="Critical">Critical</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Expected date of accomplishment</label>
                        <input type="date" name="date_accomplish" class="form-control form-control-sm" required>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="remarks" id="remarks" style="height: 100px"></textarea>
                        <label for="remarks">Remarks</label>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="submit" class="btn btn-outline-warning text-white"><i class="bi bi-save me-2"></i>Save Ticket</button>
            </div>
            </form>
        </div>
    </div>
</div>