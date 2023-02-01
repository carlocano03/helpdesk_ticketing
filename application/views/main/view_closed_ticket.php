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
                <small><?= isset($ticketInfo->concern_level) ? $ticketInfo->concern_level : '' ?></small>
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
                <hr>
                <label><b>Remarks:</b></label><br>
                <small><?= isset($ticketInfo->remarks) ? $ticketInfo->remarks : '' ?></small>
                <hr>
                <label><b>Feedback:</b></label><br>
                <small><?= isset($ticketInfo->feedback) ? $ticketInfo->feedback : '' ?></small>
            </div>
            <div class="col-md-5">
                <div class="table-reponsive">
                    <table class="table" id="table_concern" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Concern</th>
                                <th>Evaluate Concern</th>
                                <th>Solutions</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="text-end">
                    <button type="button" class="btn btn-secondary btn-sm print_ticket" id="<?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?>"><i class="bi bi-printer-fill me-2"></i>Print Ticket</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><i class="bi bi-list-columns-reverse me-2"></i>Ticket Trail</div>
                    <div class="card-body">
                        <h5>Tircket Trail for <span><?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no . ' - ' : '' ?><span class="badge bg-danger"><?= isset($ticketInfo->concern_status) ? $ticketInfo->concern_status : '' ?></span></span></h5>
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
            </div>
        </div>
        <hr>


    </section>
</main><!-- End #main -->