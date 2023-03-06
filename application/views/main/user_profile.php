<style>
    .card-profile {
        background: #009879;
        color: #fff;
    }

    .profile-picture {
        width: 80px;
        height: 80px;
        border-radius: 100%;
        border: 3px solid rgba(2, 42, 113, 0.3);
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>My Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('main')?>">Home</a></li>
                <li class="breadcrumb-item active">My Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-gear me-2"></i>Profile Settings</h5>
                <div class="d-flex align-items-start">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</button>
                        <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Messages</button>
                        <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</button>
                    </div>
                    <div class="tab-content" id="v-pills-tabContent" style="width: 100%;">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="card">
                                <div class="card-body p-4">
                                    Hello
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="card">
                                <div class="card-body p-4">
                                    Your Profile Picture
                                    <div class="row align-items-center mt-3">
                                        <div class="col-md-1 me-2 mb-3">
                                            <img class="profile-picture" src="<?= base_url('uploaded_file/profile/' . $userProfile->photo) ?>" />
                                        </div>
                                        <div class="col-md-5">
                                            <button class="btn btn-success btn-sm mb-2"><i class="bi bi-upload me-2"></i>Upload New</button>
                                            <button class="btn btn-secondary btn-sm mb-2"><i class="bi bi-trash-fill me-2"></i>Remove Profile Picture</button>
                                        </div>
                                    </div>
                                    <hr class="mt-2">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label text-secondary">Generated ID</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label text-secondary">Full name</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label text-secondary">Email Address</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label text-secondary">Department</label>
                                                <input type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->