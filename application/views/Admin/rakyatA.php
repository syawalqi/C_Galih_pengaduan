<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="card-body">
        <div class="table-responsive">
            <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pengaduan<h2>

             <!-- selamat datang -->
             <!-- <div class="tes">
                    <h2>
                    <?php   
                        if ($this->session->userdata('isLogin')) {
                            echo "Selamat datang : ".$this->session->userdata('nama');
                        }else{ }
                    ?>
                    </h2>


                    
                </div> -->
                <!-- selamat datang -->

            <table>
            <?php foreach ($pengaduan as $p) : ?>
                <thead>
                    <tr>
                        <td>Nama</td>
                        <td>: &nbsp;&nbsp;&nbsp;<?=$p['nama']?></td>
                    </tr>
                    <br>
                    <tr>
                        <td>isi</td>
                        <td>: &nbsp;&nbsp;&nbsp;<?=$p['isi_laporan']?></td>
                    </tr>
                    <br>
                    <tr>
                        <td>nik</td>
                        <td>: &nbsp;&nbsp;&nbsp;<?=$p['nik']?></td>
                    </tr>
                    <br>
                    <tr>
                        <td>ketegori</td>
                        <td>: &nbsp;&nbsp;&nbsp;<?=$p['kategori']?></td>
                    </tr>
                    <br>
                    <tr>
                        <td>subkategori</td>
                        <td>: &nbsp;&nbsp;&nbsp;<?=$p['subkategori']?></td>
                    </tr>
                    <br>
                    <tr>
                        <td>status</td>
                        <td>: &nbsp;&nbsp;&nbsp;<?=$p['status']?></td>
                    </tr>
                    <?php endforeach;?>
                </thead>
            </table>