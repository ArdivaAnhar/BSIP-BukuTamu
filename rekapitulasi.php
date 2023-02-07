<?php include 'header.php'?>

<!-- row -->
<div class="row">
    <!-- first -->
    <div class="col-md-12">
        <!-- card -->
        <div class="card shadow mb-4  mt-3">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary text-center">
            Rekapitulasi Pengunjung
        </h5>
    </div>
    <div class="card-body">
        <form method="POST" action="" class="text-center">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Dari Tanggal</label>
                        <input class="form-control" type="date" name="tanggal1" value="<?= isset($_POST['tanggal1'])? $_POST['tanggal1'] : date('d-m-Y') ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Hingga Tanggal</label>
                        <input class="form-control" type="date" name="tanggal2" value="<?= isset($_POST['tanggal2'])? $_POST['tanggal2'] : date('d-m-Y') ?>" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-2">
                    <button class="btn btn-primary form-control" name="btampilkan">
                        <i class="fa fa-search"></i>
                        Tampilkan
                    </button>
                </div>
                <div class="col-md-2">
                    <a href="admin.php" class="form-control btn btn-danger">
                        <i class="fa fa-backward"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </form>

        <?php 
        if (isset($_POST['btampilkan'])) :

        ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama Lengkap</th>
                        <th>Instansi</th>
                        <th>Bertemu</th>
                        <th>Keperluan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $tgl1 = $_POST['tanggal1'];
                    $tgl2 = $_POST['tanggal2'];

                    $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal BETWEEN '$tgl1' and '$tgl2' order by id");
                    $no = 1;

                    while($data = mysqli_fetch_array($tampil)){
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['tanggal'] ?></td>
                        <td><?= $data['nama_lengkap'] ?></td>
                        <td><?= $data['instansi'] ?></td>
                        <td><?= $data['nama'] ?></td>
                        <td><?= $data['tujuan'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
            </table>

            <!-- Export Data Ke Excel -->
            <center>
                <form method="POST" action="exportexcel.php">
                    <div class="col-md-4">
                    <input type="hidden" name="tanggala" value="<?= @$_POST['tanggal1'] ?>">
                    <input type="hidden" name="tanggalb" value="<?= @$_POST['tanggal2'] ?>">

                <button class="btn btn-success form-control" name="bexport">
                    <i class="fa fa-download"></i>
                    Export Data Excel
                </button>                  
                    </div>
                </form>
            </center>

            </div>

            <?php endif; ?>
        
        </div>
    </div>
    <!-- end card -->
    </div>
    <!-- end -->
</div>
<!-- end row -->

<?php include 'footer.php'?>