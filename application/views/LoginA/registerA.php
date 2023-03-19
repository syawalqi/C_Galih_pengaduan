<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register Admin</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url()?>assets/sb-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url()?>assets/sb-admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success"
    style="background-image: url(<?= base_url() ?>assets/Delicious/assets/img/background/background1.jpg)" ;>

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" method="post" action="<?= base_url('Admin/register'); ?>">
                        <?= form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash());?>
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label for="nama_petugas">nama_petugas</label>
                            <input type="text" value="<?= set_value('nama_petugas')?>" class="form-control form-control-user"
                                name="nama_petugas" id="Nama_petugas" placeholder="Nama">
                            <?= form_error('nama_petugas', '<small class="text-danger pl-3">', '</small>')?>
                        </div>
                        
                        <div class="col-sm-12">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control form-control-user" name="password" id="Password"
                                placeholder="Password">
                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>')?>
                        </div>


                        <div class="col-sm-12">
                            <label for="Username">username</label>
                            <input type="text" value="<?= set_value('username')?>"
                                class="form-control form-control-user" name="username" id="Username"
                                placeholder="Username">
                            <?= form_error('username', '<small class="text-danger pl-3">', '</small>')?>
                        </div>

                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label for="Telp">Telepon</label>
                            <input type="text" value="<?= set_value('telp')?>" class="form-control form-control-user"
                                name="telp" id="Telp" placeholder="Telepon">
                            <?= form_error('telp', '<small class="text-danger pl-3">', '</small>')?>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-info btn-user btn-block">register</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="<?= base_url('Admin') ?>">Kembali</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="<?= base_url('Admin')?>">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url()?>assets/sb-admin/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url()?>assets/sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url()?>assets/sb-admin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url()?>assets/sb-admin/js/sb-admin-2.min.js"></script>

</body>

</html>