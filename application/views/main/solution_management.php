<style>
    #table_solution td:nth-child(1),
    #table_solution td:nth-child(5),
    #table_solution td:nth-child(8) {
        text-align: center;
    }
    
    #table_solution td:nth-child(4),
    #table_solution th:nth-child(4) {
        width: 25%;
        text-align: justify;
    }
    
    .instrunctions {
        text-align: justify;
        font-size: 14px;
        overflow-y: auto;
        max-height: 600px;
        padding: 5px;
    }

    .instrunctions::-webkit-scrollbar {
        width: 5px;
    }

    .instrunctions::-webkit-scrollbar-thumb {
        background: #b2bec3;
        border-radius: 10px;
    }

    .instrunctions::-webkit-scrollbar-thumb:hover {
        background: #bdc3c7;
    }

    .broken-width {
        width: 100%;
    }

    .right-width {
        min-width: 100%;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Solutions Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Solutions Management</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">List of solutions</h5>
                <button class="btn btn-warning btn-sm text-white" data-bs-toggle="modal" data-bs-target="#solutionModal" title="Add new solution">
                    <i class="bi bi-folder-plus me-2"></i>Add New Solution
                </button>
                <a href="<?= base_url('solutionmanagement/exportSolution') ?>" class="btn btn-secondary btn-sm" title="Export account">
                    <i class="bi bi-download me-2"></i>Export Data
                </a>
                <div class="mt-2">
                    <table class="table table-bordered table-hover table-striped" id="table_solution" width="100%">
                        <thead>
                            <tr>
                                <th class="text-center">Action</th>
                                <th>Reference</th>
                                <th>Title</th>
                                <th>Descriptions</th>
                                <th class="text-center">Status</th>
                                <th>Added By</th>
                                <th>Date Added</th>
                                <th></th>
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
<div class="modal fade" id="solutionModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-folder-plus me-2"></i>Solution Management</h5>
                <hr class="mt-0">
                <form id="addSolutionForm" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="solutionTitle" class="form-label">Title of Solution</label>
                        <input type="text" class="form-control form-control-sm" required name="solutionTitle" id="solutionTitle" autocomplete="off" />
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" required name="solutionDetails" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Short Descriptions</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" required name="solutionInstructions" id="floatingTextarea2" style="height: 200px"></textarea>
                            <label for="floatingTextarea2">Solution Instructions</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="videoFile" class="form-label">Video File <small class="text-danger"><i>(.mp4 only)</i></small></label>
                        <input type="file" class="form-control form-control-sm" name="videoFile" id="videoFile" accept="video/*" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="audioFile" class="form-label">Audio File <small class="text-danger"><i>(.mp3 only)</i></small></label>
                        <input type="file" class="form-control form-control-sm" name="audioFile" id="audioFile" accept="audio/*" />
                    </div>
                    <div class="form-group mb-3">
                        <label for="pdfFile" class="form-label">PDF File <small class="text-danger"><i>(.pdf only)</i></small></label>
                        <input type="file" class="form-control form-control-sm" name="pdfFile" id="pdfFile" accept="application/pdf" />
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="submit" class="btn btn-outline-warning text-white"><i class="bi bi-save me-2"></i>Save Solution</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal View Solution -->
<div class="modal fade" id="getSolutionModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <h5><i class="bi bi-info-square me-2"></i>Solution</h5>
                    <button class="btn btn-outline-danger btn-sm" data-bs-dismiss="modal"><i class="bi bi-x-square"></i></button>
                </div>
                <hr>
                <input type="hidden" id="solutionID">
                <div class="row">
                    <div class="col-md-5">
                        <h5><i class="bi bi-list-task me-2"></i>Instructions</h5>
                        <hr>
                        <div class="instrunctions" id="step">
                            
                        </div>
                    </div>

                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Audio</h5>
                                <div id="audioFrame">
                                    
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Video</h5>
                                <div id="videoFrame">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success approved_solution"><i class="bi bi-hand-thumbs-up me-2"></i>Approved</button>
                <button class="btn btn-danger disapproved_solution"><i class="bi bi-x-circle me-2"></i>Disapproved</button>
            </div>
        </div>
    </div>
</div>