<?php

// aktifkan session
session_start();

echo "<script>
            var yakin = confirm('Apakah Anda Yakin ingin Keluar dari Halaman Administrator?              Jika Anda Keluar dari halaman ini Anda harus Login Kembali!');
            if (yakin) {
                window.location = 'index.php';
            }else{
            window.location = 'admin.php';
            }
        </script>";