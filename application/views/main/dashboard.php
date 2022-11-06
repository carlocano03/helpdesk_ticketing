<style>
    #table_ticket td:nth-child(3),
    #table_ticket td:nth-child(4),
    #table_ticket td:nth-child(7) {
        text-align: center;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <!-- <ol class="breadcrumb">
                <li class="breadcrumb-item active">Date & Time:</li>
            </ol> -->
            <div class="ms-auto me-5 pe-3">
                <div class="d-flex align-items-center">
                    <div id="clock" class="me-2"></div>
                    <div id="date"></div>
                </div>
            </div>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-9">
                <div class="row">

                    <!-- List Tickets -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">List of Tickets (Critical / High / Medium / Low)</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" id="table_ticket" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Ticket No</th>
                                                <th>Date Request</th>
                                                <th class="text-center">Level</th>
                                                <th class="text-center">Status</th>
                                                <th>Concern</th>
                                                <th>Request By</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div><!-- End list tickets -->

                </div>
            </div><!-- End Left side columns -->

            <!-- Right side columns -->
            <div class="col-lg-3">
                <div class="pagetitle">
                    <h1>Backlogs</h1>
                </div><!-- End Page Title -->

                <div class="card card-primary guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="fas fa-exclamation-triangle mx-auto text-danger"></i>
                        </div>
                        <div class="card-text">
                            <h5>CRITICAL</h5>
                            <h4><?= $critical;?></h4>
                        </div>
                    </div>
                </div>

                <div class="card card-primary guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="fas fa-exclamation-circle mx-auto text-warning"></i>
                        </div>
                        <div class="card-text">
                            <h5>HIGH</h5>
                            <h4><?= $high;?></h4>
                        </div>
                    </div>
                </div>

                <div class="card card-primary guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="fas fa-hourglass-start mx-auto text-info"></i>
                        </div>
                        <div class="card-text">
                            <h5>MEDIUM</h5>
                            <h4><?= $medium;?></h4>
                        </div>
                    </div>
                </div>

                <div class="card card-primary guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="fas fa-address-book mx-auto text-primary"></i>
                        </div>
                        <div class="card-text">
                            <h5>LOW</h5>
                            <h4><?= $low;?></h4>
                        </div>
                    </div>
                </div>

                <!-- critical -->
                <div class="card info-card backlogs-card">
                    <div class="card-header">
                        <i class="bi bi-list-columns-reverse me-2"></i>SUMMARY BREAKDOWN
                    </div>
                    <div class="card-body">
                        <div class="card-breakdown mt-2">
                            <span><b>Department:</b> Sample Department</span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Accomplished:</b> <?= $finish;?></span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Ongoing:</b> <?= $ongoing;?></span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Pending:</b> <?= $pending;?></span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Backlogs:</b> 25</span>
                            <hr class="mt-1 mb-1">
       
                        </div>
                    </div>
                </div><!-- end critical -->


            </div><!-- End Right side columns -->

        </div>
    </section>
</main><!-- End #main -->