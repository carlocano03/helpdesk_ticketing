<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Date & Time:</li>
            </ol>
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
                                                <th width="15%">Ticket No</th>
                                                <th width="23%">Date Request</th>
                                                <th class="text-center" width="10%">Status</th>
                                                <th>Concern</th>
                                                <th>Request By</th>
                                                <th class="text-center" width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>TN-12345</td>
                                                <td>September 11, 2022 09:03:25 AM</td>
                                                <td class="text-center"><span class="badge bg-danger">Critical</span></td>
                                                <td>Sample Concern</td>
                                                <td>Sample User</td>
                                                <td class="text-center">
                                                    <button class="btn btn-danger btn-sm" title="Proceed"><i class="bi bi-box-arrow-right"></i></button>
                                                    <button class="btn btn-secondary btn-sm" title="Update Ticket"><i class="bi bi-pencil-square"></i></button>
                                                </td>
                                            </tr>
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

                <!-- critical -->
                <div class="card info-card backlogs-card">
                    <div class="card-body">
                        <hr>
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-center justify-content-center">
                                5
                            </div>
                            <div class="ps-3">
                                <h6>Critical</h6>
                                <span class="text-success small pt-1 fw-bold"><a href="#" class="text-success"><i class="bi bi-eye-fill me-2"></i>View All</a></span>
                            </div>
                        </div>
                    </div>
                </div><!-- end critical -->

                <!-- high -->
                <div class="card info-card backlogs-card">
                    <div class="card-body">
                        <hr>
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-center justify-content-center">
                                3
                            </div>
                            <div class="ps-3">
                                <h6>High</h6>
                                <span class="text-success small pt-1 fw-bold"><a href="#" class="text-success"><i class="bi bi-eye-fill me-2"></i>View All</a></span>
                            </div>
                        </div>
                    </div>
                </div><!-- end high -->

                <!-- medium -->
                <div class="card info-card backlogs-card">
                    <div class="card-body">
                        <hr>
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-center justify-content-center">
                                10
                            </div>
                            <div class="ps-3">
                                <h6>Medium</h6>
                                <span class="text-success small pt-1 fw-bold"><a href="#" class="text-success"><i class="bi bi-eye-fill me-2"></i>View All</a></span>
                            </div>
                        </div>
                    </div>
                </div><!-- end medium -->

                <!-- low -->
                <div class="card info-card backlogs-card">
                    <div class="card-body">
                        <hr>
                        <div class="d-flex align-items-center">
                            <div class="card-icon d-flex align-items-center justify-content-center">
                                7
                            </div>
                            <div class="ps-3">
                                <h6>Low</h6>
                                <span class="text-success small pt-1 fw-bold"><a href="#" class="text-success"><i class="bi bi-eye-fill me-2"></i>View All</a></span>
                            </div>
                        </div>
                    </div>
                </div><!-- end low -->

                <!-- critical -->
                <div class="card info-card backlogs-card">
                    <div class="card-body">
                        <h5 class="card-title">Summary Breakdown</h5>
                        <div class="card-breakdown">
                            <span><b>Department:</b> Sample Department</span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Accomplished:</b> 0</span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Backlogs:</b> 25</span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Critical:</b> 5</span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total High:</b> 3</span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Medium:</b> 10</span>
                            <hr class="mt-1 mb-1">
                            <span><b>Total Low:</b> 7</span>
                        </div>
                    </div>
                </div><!-- end critical -->


            </div><!-- End Right side columns -->

        </div>
    </section>
</main><!-- End #main -->