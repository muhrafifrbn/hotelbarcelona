<?php
require 'weblab/koneksi.php';

if(isset($_POST['registrasi'])){
    if(!empty($_POST['username'] || !empty($_POST['password']) )){
        $username = $_POST['username'];
        $namaLengkap = $_POST['namaLengkap'];
        $password = mysqli_real_escape_string($koneksi,$_POST['password']) ;
        $password2 = mysqli_real_escape_string($koneksi,$_POST['password2']) ;
        $pengguna = $_POST['pengguna'];
    
        $cek = mysqli_query($koneksi,"SELECT username FROM akun WHERE username = '$username'");
        if(mysqli_num_rows($cek) > 0){
            echo "<script>
            alert('Username Sudah Terdaftar!');
            document.location.href = 'registrasi.php';
            </script>";
            exit; 
        }
        if($password != $password2){
            echo "<script>
            alert('Konfirmasi Password Anda Salah!');
            document.location.href = 'registrasi.php';
            </script>";
            exit; 
        }
    
        $password = md5($password);
    
        $register = mysqli_query($koneksi, "INSERT INTO akun VALUES('','$username','$namaLengkap','$password','$pengguna')");
        
        if(mysqli_affected_rows($koneksi) > 0){
            echo "<script>
            alert('Anda Berhasil Registrasi');
            document.location.href = 'login.php';
            </script>";
            exit; 
        }
    }
    else{
        echo "<script>
        alert('Data Tidak Boleh Kosong!. Regitrasi GAGAL!');
        document.location.href = 'registrasi.php';
        </script>";
        exit; 
    }
    

}

?>