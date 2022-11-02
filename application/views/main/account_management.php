<style>
    #table_account td:nth-child(1),
    #table_account td:nth-child(5),
    #table_account td:nth-child(7),
    #table_account td:nth-child(8) {
        text-align: center;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Account Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Account Management</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User's Account</h5>
                <a href="<?= base_url('main/exportAccount')?>" class="btn btn-secondary btn-sm" title="Export account">
                    <i class="bi bi-download me-2"></i>Export Data
                </a>
                <div class="mt-2">
                    <table class="table table-hover table-striped" id="table_account" width="100%">
                        <thead>
                            <tr>
                                <!-- <th class="text-center">Action</th> -->
                                <th class="text-center"></th>
                                <th>Username</th>
                                <th>Fullname</th>
                                <th>Department</th>
                                <th class="text-center">Access Level</th>
                                <th>Date Created</th>
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

<!-- Modal Update -->
<div class="modal fade" id="exampleModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <h5><i class="bi bi-person-plus-fill me-2"></i>Account Management</h5>
                <hr class="mt-0">
                <form class="addAccount" method="POST">
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" class="form-control form-control-sm" id="fullname" name="fullname">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control form-control-sm" id="username" name="username">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-sm" id="password" name="password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control form-control-sm" id="confirm_password" name="confirm_password">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email_add" class="form-label">Email Address</label>
                        <input type="email" class="form-control form-control-sm" id="email_add" name="email_add">
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select form-select-sm text-uppercase" id="department" name="department">
                            <option selected>Select Department</option>
                            <option value="1">Department 1</option>
                            <option value="2">Department 2</option>
                            <option value="3">Department 3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="user_level" class="form-label">User Level</label>
                        <select class="form-select form-select-sm text-uppercase" id="user_level" name="user_level">
                            <option selected>Select User Level</option>
                            <option value="1">Administrator</option>
                            <option value="2">User</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary text-white" data-bs-dismiss="modal"><i class="bi bi-x-square me-2"></i>Close</button>
                <button type="button" class="btn btn-outline-warning text-white"><i class="bi bi-save me-2"></i>Save Account</button>
            </div>
            </form>
        </div>
    </div>
</div>