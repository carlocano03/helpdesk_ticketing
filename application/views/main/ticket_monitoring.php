<style>
    #table_ticket td:nth-child(4),
    #table_ticket td:nth-child(5),
    #table_ticket td:nth-child(6) {
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
                <h5 class="card-title">List of Created Ticket</h5>
                <button type="button" class="btn btn-secondary btn-sm" title="Export data">
                    <i class="bi bi-download me-2"></i>Export Data
                </button>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table_ticket" width="100%">
                        <thead>
                            <tr>
                                <th>Ticket No</th>
                                <th>Date Request</th>
                                <th>Concern</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Status</th>
                                <!-- <th>Request By</th> -->
                                <th class="text-center">Action</th>
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