<style>
    .evaluate_concern,
    .add_solutions {
        font-size: 13px;
        height: 70px;
    }
</style>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Ticket Automation & SLA Monitoring</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Ticket Trail</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <hr>
    <section class="section profile">
        <input type="hidden" id="ticket" value="<?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?>">
        <input type="hidden" id="concernDept" value="<?= isset($ticketInfo->concern_department) ? $ticketInfo->concern_department : '' ?>">
        <div class="row">
            <div class="col-md-3">
                <?php
                $dateAdded = isset($ticketInfo->date_added) ? $ticketInfo->date_added : '';
                $dateUpdate = isset($ticketInfo->date_last_update) ? $ticketInfo->date_last_update : '';
                if ($dateAdded == '') {
                    $dateCreated = '';
                } else {
                    $dateCreated = date('M D, j Y h:i a', strtotime($dateAdded));
                }

                if ($dateUpdate == '') {
                    $dateLast = '';
                } else {
                    $dateLast = date('M D, j Y h:i a', strtotime($dateUpdate));
                }
                ?>
                <label><b>Ticket No.:</b></label><br>
                <small><?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no . ' - ' : '' ?><span class="badge bg-danger"><?= isset($ticketInfo->concern_status) ? $ticketInfo->concern_status : '' ?></span></small>
                <hr>
                <label><b>Priority Level:</b></label><br>
                <small>(Initial Priority Level: <?= isset($ticketInfo->concern_level) ? $ticketInfo->concern_level : '' ?>)</small>
                <select name="priority_level" id="priority_level" data-id="<?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?>" class="form-select form-select-sm">
                    <option value="">Select Priority Level</option>
                    <option value="Critical" <?= (isset($ticketInfo->concern_level) && $ticketInfo->concern_level == 'Critical') ? 'selected' : '' ?>>Critical</option>
                    <option value="High" <?= (isset($ticketInfo->concern_level) && $ticketInfo->concern_level == 'High') ? 'selected' : '' ?>>High</option>
                    <option value="Medium" <?= (isset($ticketInfo->concern_level) && $ticketInfo->concern_level == 'Medium') ? 'selected' : '' ?>>Medium</option>
                    <option value="Low" <?= (isset($ticketInfo->concern_level) && $ticketInfo->concern_level == 'Low') ? 'selected' : '' ?>>Low</option>
                </select>
                <hr>
                <label><b>Date Request:</b></label><br>
                <small><?= isset($dateCreated) ? $dateCreated : '' ?></small>
                <hr>
                <label><b>Date of Last Update/Seen:</b></label><br>
                <small><?= isset($dateLast) ? $dateLast : '' ?></small>
                <hr>
                <label><b>Requested by:</b></label><br>
                <small><?= isset($ticketInfo->request_by) ? $ticketInfo->request_by : '' ?></small>
                <hr>
                <label><b>Department / Branch:</b></label><br>
                <small><?= isset($ticketInfo->request_department) ? $ticketInfo->request_department : '' ?></small>
            </div>
            <div class="col-md-9">
                <!-- <div>
                    <select class="form-select form-select-sm support_system" id="<?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?>">
                        <option value="">Select Support System</option>
                        <option value="Via Email">Via Email</option>
                        <option value="Phone Call">Phone Call</option>
                        <option value="Remote">Remote</option>
                        <option value="Onsite">Onsite</option>
                    </select>
                </div>
                <div class="row g-0 mt-2 duration" style="display: none;">
                    <div class="col-sm-3">
                        <input type="text" class="form-control form-control-sm" id="duration_onsite" data-id="<?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?>" placeholder="Duration">
                    </div>
                </div> -->
                <div class="table-reponsive">
                    <table class="table" id="table_concern" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Concern</th>
                                <!-- <th>Evaluate Concern</th> -->
                                <th>Solutions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="text-end">

                    <?php if ($ticketInfo->concern_status != 'Posted') : ?>
                        <?php if ($count_solutions < 1) : ?>
                            <button type="button" class="btn btn-success btn-sm post_ticket" id="<?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?>"><i class="bi bi-check2-square me-2"></i>Posted</button>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ($ticketInfo->concern_status != 'Posted') : ?>
                        <button class="btn btn-danger btn-sm transfer_ticket"><i class="bi bi-layer-forward me-2"></i>Transfer Ticket</button>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header"><i class="bi bi-list-columns-reverse me-2"></i>Ticket Trail</div>
            <div class="card-body">
                <h3 class="mt-2">Tircket Trail for <span><?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no . ' - ' : '' ?><span class="badge bg-danger"><?= isset($ticketInfo->concern_status) ? $ticketInfo->concern_status : '' ?></span></span></h3>
                <div class="container">

                    <?php foreach ($ticketTrail as $row) : ?>
                        <div class="timeline-block timeline-block-right">
                            <div class="marker"></div>
                            <div class="timeline-content">
                                <h3><?= $row->remarks; ?></h3>
                                <span><?= date('M D j, Y h:i a', strtotime($row->date_added)) ?></span>
                                <p><?= isset($row->ticket_status) ? $row->ticket_status : '' ?></p>
                                <hr>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </section>
</main><!-- End #main -->

<!-- Modal -->
<div class="modal fade" id="ticketModalTransfer" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-layer-forward me-2"></i>Transfer Ticket To Other Department/Person</h5>
                <hr class="mt-0">
                <form id="transferTicket" method="POST">
                    <input type="hidden" id="ticketNo" name="ticketNo" value="<?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?>">
                    <div class="form-floating">
                        <select class="form-select" id="transfer_options" name="transfer_options" aria-label="Floating label select example" required>
                            <option value="">Select Option</option>
                            <option value="other_department">Transfer to other department</option>
                            <option value="co_employee">Transfer to co-employee</option>
                        </select>
                        <label for="transfer_options">Transfer Options</label>
                    </div>
                    <hr>
                    <div class="other_dept">
                        <div class="form-group mb-3">
                            <label>Department</label>
                            <select class="form-select form-select-sm" id="trans_dept" name="trans_dept" aria-label="Default select example">
                                <option value="">Select Department</option>
                                <?php foreach ($department as $row) : ?>
                                    <option value="<?= $row->department ?>"><?= $row->department ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label>Assignee</label>
                            <select class="form-select form-select-sm" id="assignee" name="assignee" aria-label="Default select example">
                                <option value="">Select Assignee</option>
                            </select>
                        </div>
                    </div>
                    <div class="co_employee">
                        <div class="form-group mb-3">
                            <label>Assignee to Co-Employee</label>
                            <select class="form-select form-select-sm" id="co_employee" name="co_employee" aria-label="Default select example">
                                <option value="">Select Assignee</option>
                            </select>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="submit" class="btn btn-outline-warning text-white"><i class="bi bi-save me-2"></i>Transfer</button>
            </div>
            </form>
        </div>
    </div>
</div>