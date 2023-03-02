<style>
    #table_ticket td:nth-child(5),
    #table_ticket td:nth-child(6),
    #table_support_posted td:nth-child(5),
    #table_support_posted td:nth-child(6) {
        text-align: center;
    }

    #pills-tab .nav-link {
        color: #2ecc71;
        font-weight: 600;
        outline: none;
        padding: 13px;
        margin-bottom: -15px;
        font-size: 14px;
    }

    #pills-tab .nav-link.active {
        background: none !important;
        color: #009879;
        text-decoration: 3px underline #009879;
        text-underline-offset: 5px;
    }

    #pills-tab .nav-link:hover {
        color: #009879;
        text-decoration: 3px underline #009879;
        text-underline-offset: 5px;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ticket Monitoring</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Ticket Monitoring</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">My Ticket List</h5>
                <hr>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">My Ticket List</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Posted Ticket</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <hr>
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary btn-sm" title="Export data">
                                    <i class="bi bi-download me-2"></i>Export Data
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
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
                            <table class="table table-hover table-striped" id="table_ticket" width="100%">
                                <thead>
                                    <tr>
                                        <th>Ticket No.</th>
                                        <th>Request By</th>
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
                    <!-- End of 1st Tab -->

                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <hr>
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <button type="button" class="btn btn-secondary btn-sm" title="Export data">
                                    <i class="bi bi-download me-2"></i>Export Data
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group-text" for="filter_status">From</label>
                                            <input type="date" class="form-control form-control-sm" id="filter_from">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-sm mb-3">
                                            <label class="input-group-text" for="filter_status">To</label>
                                            <input type="date" class="form-control form-control-sm" id="filter_to">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-sm mb-3">
                                    <label class="input-group-text" for="filter_dept">Department</label>
                                    <select class="form-select form-select-sm" id="filter_dept_posted">
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
                                    <select class="form-select form-select-sm" id="filter_status_posted">
                                        <option value="">Select All</option>
                                        <?php foreach ($status as $row) : ?>
                                            <option value="<?= $row->concern_status ?>"><?= $row->concern_status ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="table_support_posted" width="100%">
                                <thead>
                                    <tr>
                                        <th>Ticket No.</th>
                                        <th>Request By</th>
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
                    <!-- End of 2nd Tab -->
                </div>


            </div>
        </div>
    </section>
</main><!-- End #main -->