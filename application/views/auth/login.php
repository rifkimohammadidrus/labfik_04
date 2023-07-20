<!DOCTYPE html>
<html lang="en-id">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LABFIK | Login</title>

    <link rel="stylesheet" href="https://ifik.telkomuniversity.ac.id/assets/vendor/bootstrap-4.5.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="https://ifik.telkomuniversity.ac.id/assets/vendor/fontawesome-free-5.13.0-web/css/all.min.css">
    <link rel="stylesheet" href="https://ifik.telkomuniversity.ac.id/assets/vendor/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="https://ifik.telkomuniversity.ac.id/assets/css/moeicss-alpha.css">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://ifik.telkomuniversity.ac.id/assets/css/style.css">
    <link rel="stylesheet" href="https://ifik.telkomuniversity.ac.id/assets/css/style-users1.css">

    <script src="https://ifik.telkomuniversity.ac.id/assets/js/jquery.min.js" type="30c8f833165a545dd070a2cd-text/javascript"></script>

    <script src="https://ifik.telkomuniversity.ac.id/assets/vendor/bootstrap-4.5.0-dist/js/popper.min.js" type="30c8f833165a545dd070a2cd-text/javascript"></script>
    <script src="https://ifik.telkomuniversity.ac.id/assets/vendor/bootstrap-4.5.0-dist/js/bootstrap.min.js" type="30c8f833165a545dd070a2cd-text/javascript"></script>
    <script src="https://ifik.telkomuniversity.ac.id/assets/vendor/owl-carousel/owl.carousel.min.js" type="30c8f833165a545dd070a2cd-text/javascript"></script>
    <link rel="icon" href="https://ifik.telkomuniversity.ac.id/assets/img/logo/favicon.png" type="image/gif">

</head>

<body>
    <div class="user-overlay"></div>
    <div class="user-overlay-circle"></div>
    <div class="user-overlay-circle2"></div>
    <div class="account-container stacked">
        <div class="clear"></div>
        <div class="content custom-form custom-form-icon icon-left">
            <div class="login-banner"><img src="https://ifik.telkomuniversity.ac.id/assets/img/8.jpg" alt=""></div>
            <img src="https://ifik.telkomuniversity.ac.id/assets/img/logo/logo-dummy.png" alt="" />
            <h6>Login</h6>
            <div id="messages"></div>
            <div id="messages"></div>
            <?= $this->session->flashdata('massage') ?>
            <form class="user" action="<?= base_url('auth'); ?>" method="post" id="loginForm1" accept-charset="utf-8">
                <div class="custom-form">
                    <div class="form-group">
                        <div class="fas fa-user"></div><input class="form-control" id="email" name="email" type="text" placeholder="." value="<?= set_value('email'); ?>" />
                        <label for="email">Enter Email Addres...</label>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="fas fa-key"></div>
                        <input class="form-control" id="password" name="password" type="password" placeholder="." />
                        <label for="password">Password</label>
                    </div>
                </div>
                <a href="https://ifik.telkomuniversity.ac.id/auth/forgotpassword"><b>I've forgotten my password</b></a>
                <div class="login-actions">
                    <button class="login-action btn btn-primary btn-lg btn-block btn-pill fs18px mobile-fs14px" type="submit"> Login
                    </button>
                </div>
            </form>
            <div class="login-extra">
                Don't have an Accoount? <a href="<?= base_url(); ?>auth/registration"><b>Register Here</b></a>
            </div>
        </div>
        <a href="https://ifik.telkomuniversity.ac.id/" class="user-back"> <span class="fas fa-chevron-left"></span> Homepage</a>
    </div>

</body>

</html>