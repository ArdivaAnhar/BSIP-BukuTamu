<?php
include "koneksi.php";

// persiapan untuk excel
header('Content-type: aplication/vnd-ms-excel');
header('Content-Disposition: attachment; filename= Export Excel Data Pengunjung.xls');
header('Pragma no-cache');
header('Expires:0');

?>

<table border="1">
    <thead>
        <tr>
            <th colspan="6">
                Rekapitulasi Data Pengunjung
            </th>
        </tr>
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

            $tgl1 = $_POST['tanggala'];
            $tgl2 = $_POST['tanggalb'];

            $tampil = mysqli_query($koneksi, "SELECT * FROM ttamu where tanggal BETWEEN '$tgl1' and '$tgl2' order by tanggal asc");
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