<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="name" type="text" placeholder="Full Name" name="name" value="<?= set_value('name'); ?>" />
                                            <label for="name">Full Name</label>
                                            <?= form_error('name', '<small class="text-danger">', '</small>'); ?>

                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="email" name="email" type="email" placeholder="Email Address" value="<?= set_value('email'); ?>" />
                                            <label for="email">Email address</label>
                                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password1" name="password1" type="password" placeholder="Create a password" />
                                                    <label for="password1">Password</label>
                                                    <?= form_error('password1', '<small class="text-danger">', '</small>'); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="password2" type="password" name="password2" placeholder="Confirm password" />
                                                    <label for="password2">Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-4 mb-0">
                                            <div class="d-grid"><button type="submit" class="btn btn-primary btn-block">Create Account</button></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="<?= base_url('auth') ?>">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>