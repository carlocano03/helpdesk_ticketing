<style>
    #table_ticket td:nth-child(5) {
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
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card card-primary guest">
                                    <div class="card-body p-2">
                                        <div class="card-avatar-primary me-3">
                                            <i class="fas fa-exclamation-triangle mx-auto" style="color: #f39c12;"></i>
                                        </div>
                                        <div class="card-text">
                                            <h5>PENDING</h5>
                                            <h3 class="text-white"><?= $pending; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary guest">
                                    <div class="card-body p-2">
                                        <div class="card-avatar-primary me-3">
                                            <i class="fas fa-hourglass-start mx-auto" style="color: #f39c12;"></i>
                                        </div>
                                        <div class="card-text">
                                            <h5>ON-GOING</h5>
                                            <h3 class="text-white"><?= $ongoing; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-primary guest">
                                    <div class="card-body p-2">
                                        <div class="card-avatar-primary me-3">
                                            <i class="fas fa-calendar-alt mx-auto" style="color: #f39c12;"></i>
                                        </div>
                                        <div class="card-text">
                                            <h5>ACCOMPLISHED</h5>
                                            <h3 class="text-white"><?= $finish; ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">List of Tickets (Critical / High / Medium / Low)</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped" id="table_ticket" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Ticket No.</th>
                                                <th>Request By</th>
                                                <th>Department</th>
                                                <th>Date Request</th>
                                                <th class="text-center">Status</th>
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

                <div class="card bg-danger guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="fas fa-exclamation-triangle mx-auto text-danger"></i>
                        </div>
                        <div class="card-text">
                            <h5 class="text-white">CRITICAL</h5>
                            <h4 class="text-white"><?= $critical; ?></h4>
                        </div>
                    </div>
                </div>

                <div class="card card-orange guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="fas fa-exclamation-circle mx-auto" style="color: #f39c12;"></i>
                        </div>
                        <div class="card-text">
                            <h5 class="text-white">HIGH</h5>
                            <h4 class="text-white"><?= $high; ?></h4>
                        </div>
                    </div>
                </div>

                <div class="card card-yellow guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="fas fa-info-circle mx-auto" style="color: #f1c40f;"></i>
                        </div>
                        <div class="card-text">
                            <h5 class="text-white">MEDIUM</h5>
                            <h4 class="text-white"><?= $medium; ?></h4>
                        </div>
                    </div>
                </div>

                <div class="card bg-success guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="fas fa-address-book mx-auto text-success"></i>
                        </div>
                        <div class="card-text">
                            <h5 class="text-white">LOW</h5>
                            <h4 class="text-white"><?= $low; ?></h4>
                        </div>
                    </div>
                </div>

                <div class="card bg-secondary guest">
                    <div class="card-body p-2">
                        <div class="card-avatar-primary me-3">
                            <i class="bi bi-signpost mx-auto text-secondary"></i>
                        </div>
                        <div class="card-text">
                            <h5 class="text-white">POSTED</h5>
                            <h4 class="text-white"><?= $posted; ?></h4>
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
                            <span><b>Total Accomplished:</b> <?= $finish; ?></span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Ongoing:</b> <?= $ongoing; ?></span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Pending:</b> <?= $pending; ?></span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Backlogs:</b> <?= $pending + $ongoing + $posted; ?></span>
                            <hr class="mt-1 mb-1">

                        </div>
                    </div>
                </div><!-- end critical -->


            </div><!-- End Right side columns -->

        </div>
    </section>
</main><!-- End #main -->