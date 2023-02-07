<!-- Panggil File Header -->
<?php include "header.php";?>

<?php

// Uji Jika Tombol Simpan Di Klik
if(isset($_POST['bsimpan'])){
    $tgl = date('Y-m-d');

    // htmlspecialchars agar inputan lebih aman dari injection
    $nama_lengkap = htmlspecialchars($_POST['nama_lengkap'], ENT_QUOTES);
    $instansi = htmlspecialchars($_POST['instansi'], ENT_QUOTES);
    $bertemu = htmlspecialchars($_POST['nama'], ENT_QUOTES);
    $keperluan = htmlspecialchars($_POST['tujuan'], ENT_QUOTES);

    // Persiapan Query Simpan Data
    $simpan = mysqli_query($koneksi, "INSERT INTO ttamu values('', '$tgl', '$nama_lengkap', '$instansi', '$bertemu', '$keperluan')");

    // Uji JIka Simpan Data Sukses
    if ($simpan) {
        echo "<script>alert('Simpan Data Sukses..!');
        document.location='?'</script>";
    }else {
        echo "<script>alert('Simpan Data GAGAL!!!');
        document.location='?'</script>";
    }
}

?>

<!-- Head -->
    <div class="head text-center">
        <img src="assets/img/logo.png" width="400">
        <h2 class="text-white">
            Sistem Informasi Buku Tamu
            <br>
            <b>Badan Standardisasi Instrument Pertanian</b>
        </h2>
    </div>
    <!--  endHead -->

    <!-- Row -->
    <div class="row mt-2">
        <!-- col-lg-7 -->
        <div class="col-lg-7 mb-3">
            <div class="card shadow bg-gradient-light">
                <!-- Card Body -->
                <div class="card-body">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><b>Pengunjung</b></h1>
                            </div>
                            <form class="user" method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama_lengkap" placeholder="Nama Lengkap" required>
                                </div>            
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="instansi" placeholder="Instansi" required>
                                </div>            
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="nama" placeholder="Bertemu" required>
                                </div>            
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="tujuan" placeholder="Keperluan" required>
                                </div>            

                                <button type="submit" name="bsimpan" class="btn btn-primary btn-user btn-block">
                                    Simpan Data
                                </button>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="#">
                                    By. Creator | 2023 - <?=date('Y')?>
                                </a>
                            </div>
                            <div class="text-center">
                            <a class="small" href="#">
                                    Who Is The Creator?
                                </a>
                            </div>
                </div>
                <!-- end Card Body -->
            </div>
        </div>
        <!-- endCol-lg-7 -->

         <!-- col-lg-5 -->
         <div class="col-lg-5 mb-3">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card Body -->
                <div class="card-body">
                    <div class="text-center">
                        <h1 class="h4 text-primary mb-4"><b>Statistik Pengunjung</b></h1>
                    </div>
                    <?php
                    // deklarasi tanggal
                    // menampilkan tanggal sekarang
                    $tgl_sekarang = date('Y-m-d');

                    // menampilkan tanggal kemarin
                    $kemarin = date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d'))));

                    // menampilkan 6 hari sebelum tanggal sekarang
                    $seminggu = date('Y-m-d h:i:s', strtotime('-1 week +1 day', strtotime($tgl_sekarang)));

                    $sekarang = date('Y-m-d h:i:s');

                    // deklarasi bulan
                    // menampilan bulan
                    $bulan_ini = date('m');

                    // persiapan query tampilkan jumlah data pengunjung
                    $tgl_sekarang = mysqli_fetch_array(mysqli_query(
                        $koneksi, 
                        "SELECT count(*) FROM ttamu where tanggal like '%$tgl_sekarang%' "
                    ));

                    $kemarin = mysqli_fetch_array(mysqli_query(
                        $koneksi, 
                        "SELECT count(*) FROM ttamu where tanggal like '%$kemarin%' "
                    ));

                    $seminggu = mysqli_fetch_array(mysqli_query(
                        $koneksi, 
                        "SELECT count(*) FROM ttamu where tanggal BETWEEN '$seminggu' and 
                        '$sekarang'"
                    ));
                    
                    $sebulan = mysqli_fetch_array(mysqli_query(
                        $koneksi, 
                        "SELECT count(*) FROM ttamu where month(tanggal) = '$bulan_ini'"
                    ));

                    $keseluruhan = mysqli_fetch_array(mysqli_query(
                        $koneksi, 
                        "SELECT count(*) FROM ttamu "
                    ));

                    ?>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                            <i class="fa fa-users" style="color: red"></i>&ensp;
                            Hari Ini</td>
                            <td>: <?= $tgl_sekarang[0] ?></td>
                        </tr>
                        <tr>
                            <td>
                            <i class="fa fa-calendar" style="color: yellow"></i>&ensp;    
                            Kemarin</td>
                            <td>: <?= $kemarin[0] ?></td>
                        </tr>
                        <tr>
                            <td>
                            <i class="fa fa-folder" style="color: green"></i>&ensp;    
                            Minggu Ini</td>
                            <td>: <?= $seminggu[0] ?></td>
                        </tr>
                        <tr>
                            <td>
                            <i class="fa  fa-folder-open" style="color: blue"></i>&ensp;    
                            Bulan Ini</td>
                            <td>: <?= $sebulan[0] ?></td>
                        </tr>
                        <tr>
                            <td>
                            <i class="fa fa-archive" style="color: purple"></i>&ensp;    
                            Keseluruhan</td>
                            <td>: <?= $keseluruhan[0] ?></td>
                        </tr>
                    </table>
                </div>
                <!--  end Card Body -->
            </div>
            <!-- end Card -->
         </div>
         <!-- end col-lg-5 -->
    </div>
    <!-- endRow -->

    <!-- Data Pengunjung Hari Ini -->
    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung Hari Ini [<?=date('Y-m-d')?>]</h6>
                        </div>
                        <div class="card-body">
                            <a href="rekapitulasi.php" class="btn btn-success mb-3">
                                <i class="fa fa-table"></i>
                                Rekapitulasi Pengunjung
                            </a>
                            <a href="logout.php" class="btn btn-danger mb-3">
                                <i class="fa fa-sign-out-alt"></i>
                                Logout
                            </a>


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
                                        $tgl = date('Y-m-d');
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal like '%$tgl%' order by id");
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
                                <div class="footer text-center"> 
                                <button class="btn btn-danger">
                                    <i class="fa fa-recycle"></i>
                                </button>
                                </div>
                            </div>
                        </div>
                    </div>

<!-- Panggil File Footer -->
<?php include "footer.php";?>