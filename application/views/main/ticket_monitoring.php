<style>
    #table_ticket td:nth-child(5) {
        text-align: center;
    }
</style>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Ticket Monitoring</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Ticket Monitoring</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">My Ticket List</h5>
                <hr>
                <div class="row g-3 mb-2">
                    <div class="col-md-6">
                        <button type="button" class="btn btn-secondary btn-sm" title="Export data">
                            <i class="bi bi-download me-2"></i>Export Data
                        </button>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filter_dept">Department</label>
                            <select class="form-select form-select-sm" id="filter_dept">
                                <option value="">Select Department</option>
                                <?php foreach($department as $row) : ?>
                                    <option value="<?= $row->department?>"><?= $row->department?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filter_status">Status</label>
                            <select class="form-select form-select-sm" id="filter_status">
                                <option value="">Select Status</option>
                                <?php foreach($status as $row) : ?>
                                    <option value="<?= $row->concern_status?>"><?= $row->concern_status?></option>
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
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->