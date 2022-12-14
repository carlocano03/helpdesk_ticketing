<main id="main" class="main">

    <div class="pagetitle">
        <h1>Supplementary Forms</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Supplementary Forms</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">List of Uploaded Forms</h5>
                <hr>
                <div class="row g-3 mb-2">
                    <div class="col-md-4">
                        <a href="#formModal" data-bs-toggle="modal" class="btn btn-success btn-sm" title="Upload forms">
                            <i class="bi bi-upload me-2"></i>Upload Supplementary Forms
                        </a>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filter_status">From</label>
                            <input type="date" class="form-control form-control-sm" id="from">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filter_status">To</label>
                            <input type="date" class="form-control form-control-sm" id="to">
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
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="table_forms" width="100%">
                        <thead>
                            <tr>
                                <th>Document No.</th>
                                <th>Document Type</th>
                                <th>Document</th>
                                <th>Department</th>
                                <th>Date Created</th>
                                <th>Date Last Edit</th>
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

<!-- Modal Update -->
<div class="modal fade" id="formModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-upload me-2"></i>Upload Supplementary Forms</h5>
                <hr class="mt-0">
                <form id="addForms" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label>Document No</label>
                        <input type="text" class="form-control form-control-sm" required name="doc_no" autocomplete="off" />
                    </div>
                    <div class="form-group mb-3">
                        <label>Document Type</label>
                        <input type="text" class="form-control form-control-sm" required name="doc_type" autocomplete="off" />
                    </div>
                    <div class="form-group mb-3">
                        <label>Document Name</label>
                        <input type="text" class="form-control form-control-sm" required name="doc_name" autocomplete="off" />
                    </div>
                    <div class="form-group mb-3">
                        <label>Department</label>
                        <select class="form-select form-select-sm" name="department">
                            <option value="">Select Department</option>
                            <?php foreach ($department as $row) : ?>
                                <option value="<?= $row->department ?>"><?= $row->department ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Document Availability</label>
                        <select class="form-select form-select-sm" name="doc_availability">
                            <option value="">Select Availability</option>
                            <option value="Public">Public</option>
                            <option value="Private">Private</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Document File <small class="text-danger"><i>(.docs, pdf & excel)</i></small></label>
                        <input type="file" class="form-control form-control-sm" name="inpFile" accept="application/pdf,.csv,.doc,.docx, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel, application/msword" />
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="submit" class="btn btn-outline-warning text-white"><i class="bi bi-save me-2"></i>Save Forms</button>
            </div>
            </form>
        </div>
    </div>
</div>