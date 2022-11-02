<main>
    <div class="container">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="login-content justify-content-center">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center">
                            <img src="<?= base_url('assets/img/Login-rafiki.png')?>" style="width: 100%">
                        </div>
                        <div class="col-md-5">
                            <div class="login-form">
                                <div class="d-flex justify-content-center py-4">
                                    <a href="#" class="logo d-flex align-items-center w-auto">
                                        <img src="<?= base_url('assets/img/logoTW.png')?>" alt="">
                                    </a>
                                </div><!-- End Logo -->
                                <div class="card mb-3 bg-s">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <h5 class="card-title text-center">Create Your Account</h5>
                                        </div>
                                        <div class="pt-2">
                                            <h5 class="text-center title-system">Help Desk & Ticketing System</h5>
                                        </div>
                                        <hr>

                                        <form id="register_form" method="POST" enctype="multipart/form-data">
                                            <div class="form-group mb-3">
                                                <label for="yourName" class="form-label">Name</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person-fill"></i></span>
                                                    <input type="text" name="name" class="form-control" id="yourName">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="yourEmail" class="form-label">Email</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-envelope-fill"></i></span>
                                                    <input type="email" name="email" class="form-control" id="yourEmail">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="yourPassword" class="form-label">Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-shield-lock-fill"></i></span>
                                                    <input type="password" name="password" class="form-control" id="yourPassword">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-shield-lock-fill"></i></span>
                                                    <input type="password" name="password_confirmation" class="form-control" id="confirmPassword">
                                                </div>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="yourDepartment" class="form-label">Department</label>
                                                <select class="form-select" name="department">
                                                    <option value="" selected>Open this select menu</option>
                                                    <option value="Department 1">Department 1</option>
                                                    <option value="Department 2">Department 2</option>
                                                    <option value="Department 3">Department 3</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <div id="error-message"></div>
                                            </div>

                                            <div class="border border-warning border-2 rounded mb-3 p-3">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="button-wrapper">
                                                            <span class="label">
                                                                Upload your Picture
                                                            </span>
                                                            <input type="file" name="inpFile" id="inpFile" class="upload-box" placeholder="Upload File" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 text-center">
                                                        <img id="pic" />
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-login w-100 btn-rounded" id="register_btn" type="submit">SIGN UP</button>
                                        </form>
                                        <div class="text-center mt-5 text-muted">
                                            You have an account? <a href="<?= base_url('user');?>">Sign In</a>
                                        </div>
                                    </div><!-- End of card-body -->
                                </div><!-- End of card -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main><!-- End #main -->