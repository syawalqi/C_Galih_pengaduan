<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/sb-admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary" style="background-image: url(<?= base_url() ?>assets/Delicious/assets/img/background/background2.jpg)";>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-10">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->

                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Log In!</h1>
                            </div>
                            <?= $this->session->flashdata('message')?>
                            <form class="user" method="post" action="<?= base_url('galih_login/login') ?>">
                                <?= form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash())?>
                                <div class="form-group">
                                    <input value="<?= set_value('nama')?>" type="nama" name="nama" id="nama" class="form-control form-control-user" id="exampleInputNama" aria-describedby="namaHelp" placeholder="Enter Nama ">
                                    <?= form_error('nama', '<small class="text-danger pl-3">', '</small>')?> 
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">  
                                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>')?>                                  
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Login
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('galih_login') ?>">Back</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('galih_login/register') ?>">Create an Account!</a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url() ?>assets/sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/sb-admin/js/sb-admin-2.min.js"></script>

</body>

</html>