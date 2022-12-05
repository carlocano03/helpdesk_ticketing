<style>
    .search-form button {
        border: 0;
        padding: 0;
        margin-left: -30px;
        background: none;
    }

    .search-form button i {
        color: #012970;
    }

    .search-form input:focus,
    .search-form input:hover {
        outline: none;
        box-shadow: 0 0 10px 0 rgba(1, 41, 112, 0.15);
        border: 1px solid rgba(1, 41, 112, 0.3);
    }

    .search-form input {
        border: 0;
        font-size: 14px;
        color: #012970;
        border: 1px solid rgba(1, 41, 112, 0.2);
        padding: 7px 38px 7px 8px;
        border-radius: 3px;
        transition: 0.3s;
        max-width: 250px;
    }

    .ai-card {
        background: #FFEFBA;
        background: -webkit-linear-gradient(to right, #FFFFFF, #FFEFBA);
        background: linear-gradient(to right, #FFFFFF, #FFEFBA);
        box-shadow: 2px 7px 34px -12px rgba(0, 0, 0, 0.46);
        -webkit-box-shadow: 2px 7px 34px -12px rgba(0, 0, 0, 0.46);
        -moz-box-shadow: 2px 7px 34px -12px rgba(0, 0, 0, 0.46);
        cursor: pointer;
        transition: 0.8s ease;
    }

    .ai-card:hover {
        -webkit-transform: scale(0.9);
        -ms-transform: scale(0.9);
        transform: scale(0.9);
        transition: 0.9s ease;
    }

    .ai-card .card-title {
        color: #f39c12;
        text-decoration: 2px underline #f39c12;
        text-underline-offset: 5px;
    }

    .ai-card .card-text {
        width: 100%;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .ai-card .btn-view {
        color: orange;
        border: 2px solid orange;
    }

    .ai-card .btn-view:hover {
        background: #FF512F;
        background: -webkit-linear-gradient(to right, #F09819, #FF512F);
        background: linear-gradient(to right, #F09819, #FF512F);
        color: #fff;
    }

    .ai-support .input-group-text {
        background: #FFEFBA;
        background: -webkit-linear-gradient(to left, #FFFFFF, #FFEFBA);
        background: linear-gradient(to left, #FFFFFF, #FFEFBA);
        color: orange;
        font-weight: 600;
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
        <h1>Help Desk Support AI</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">AI Support</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">AI Support List</h5>
                <div class="search-bar me-2">
                    <input class="form-control" autocomplete="off" type="text" name="query" id="searcSupport" placeholder="Enter search keyword" title="Enter search keyword">
                </div><!-- End Search Bar -->
                <!-- <small><i>If your concern does not fall to any AI Solutions, click "Create Ticket" below.</i></small><br>
                <a href="ticket_automation.html" class="btn btn-outline-danger btn-sm"><i class="bi bi-pencil-square me-2"></i>Create Ticket</a>
                 -->
                <hr>
                <div class="row g-2 ai-support">
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filterdepartment">Filter By Department</label>
                            <select class="form-select" id="filterdepartment">
                                <option value="">Select Department</option>
                                <?php
                                foreach ($department as $row) {
                                    echo "<option value='" . $row->addedDepartment . "'>" . $row->addedDepartment . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filtersection">Filter By Section</label>
                            <select class="form-select" id="filtersection">
                                <option value="">Select Section</option>
                                <option value="1">Section 1</option>
                                <option value="2">Section 2</option>
                                <option value="3">Section 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group input-group-sm mb-3">
                            <label class="input-group-text" for="filterconcern">Filter By Concern</label>
                            <select class="form-select" id="filterconcern">
                                <option value="">Select Concern</option>
                                <?php
                                foreach ($concern as $row) {
                                    echo "<option value='" . $row->solutionTitle . "'>" . $row->solutionTitle . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row filter_data">


                </div><!-- End row -->
                <!-- <div class="mx-auto" id="pagination_link">

                </div> -->
                <nav aria-label="Page navigation example" id="pagination_link">

                </nav>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<!-- Modal View Solution -->
<div class="modal fade" id="getSolutionModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="d-flex justify-content-between">
                    <h5><i class="bi bi-info-square me-2"></i>Solution</h5>
                    <button class="btn btn-outline-danger btn-sm close_modal" data-bs-dismiss="modal"><i class="bi bi-x-square"></i></button>
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