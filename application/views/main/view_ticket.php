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
                if ($dateAdded == '') {
                    $dateCreated = '';
                } else {
                    $dateCreated = date('M D, j Y h:i a', strtotime($dateAdded));
                }
                ?>
                <label><b>Ticket No.:</b></label><br>
                <small><?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?></small>
                <hr>
                <label><b>Priority Level:</b></label><br>
                <small><?= isset($ticketInfo->concern_level) ? $ticketInfo->concern_level : '' ?></small>
                <!-- <select name="priority_level" id="priority_level" data-id="<?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?>" class="form-select form-select-sm">
                    <option value="">Select Priority Level</option>
                    <option value="Critical" <?= (isset($ticketInfo->concern_level) && $ticketInfo->concern_level == 'Critical') ? 'selected':''?>>Critical</option>
                    <option value="High" <?= (isset($ticketInfo->concern_level) && $ticketInfo->concern_level == 'High') ? 'selected':''?>>High</option>
                    <option value="Medium" <?= (isset($ticketInfo->concern_level) && $ticketInfo->concern_level == 'Medium') ? 'selected':''?>>Medium</option>
                    <option value="Low" <?= (isset($ticketInfo->concern_level) && $ticketInfo->concern_level == 'Low') ? 'selected':''?>>Low</option>
                </select> -->
                <hr>
                <label><b>Date Request:</b></label><br>
                <small><?= isset($dateCreated) ? $dateCreated : '' ?></small>
                <hr>
                <label><b>Requested by:</b></label><br>
                <small><?= isset($ticketInfo->request_by) ? $ticketInfo->request_by : '' ?></small>
                <hr>
                <label><b>Department / Branch:</b></label><br>
                <small><?= isset($ticketInfo->request_department) ? $ticketInfo->request_department : '' ?></small>
            </div>
            <div class="col-md-9">
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
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header"><i class="bi bi-list-columns-reverse me-2"></i>Ticket Trail</div>
            <div class="card-body">
                <h1>Tircket Trail for <span><?= isset($ticketInfo->ticket_no) ? $ticketInfo->ticket_no : '' ?></span></h1>
                <div class="container">

                    <?php foreach($ticketTrail as $row) : ?>
                    <div class="timeline-block timeline-block-right">
                        <div class="marker"></div>
                        <div class="timeline-content">
                            <h3><?= $row->remarks;?></h3>
                            <span><?= date('M D j, Y h:i a', strtotime($row->date_added))?></span>
                            <p><?= isset($row->ticket_status) ? $row->ticket_status : '' ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>

    </section>
</main><!-- End #main -->