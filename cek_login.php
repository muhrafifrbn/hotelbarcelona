<?php

require 'weblab/koneksi.php';
function login($data){
   global $koneksi;
    $username = $data['username'];
    $password = md5($data['password']);
    $cek = mysqli_query($koneksi,"SELECT * FROM akun WHERE username = '$username'");
    
    if(mysqli_num_rows($cek)>0){
       $cek = mysqli_fetch_assoc($cek);
       if($password == $cek['password']){
          $id_akses = $cek['id_akses'];
          $namaUser = $cek['nama_lengkap'];
          $cekuser = mysqli_query($koneksi,"SELECT * FROM akses WHERE id_akses = $id_akses ");
          session_start();
          $cekuser = mysqli_fetch_assoc($cekuser)['hak_user'];
          if($cekuser == "Admin"){
            $_SESSION['akses'] = $cekuser;
            $_SESSION['admin'] = "$namaUser";
            header('location:weblab/admin.php');
          }
          else if($cekuser == "Tamu"){
            $_SESSION['akses'] = $cekuser;
            $_SESSION['tamu'] = "$namaUser";
            header('location:index.php');
          }
          else if($cekuser == "Resepsionis"){
            $_SESSION['akses'] = $cekuser;
            $_SESSION['resepsionis'] = "$namaUser";
            header('location:weblab/resepsionis.php');
          }
         
       }
       else{
        // echo "<script>
        // alert('Password Anda Salah. .LOGIN GAGAL!');
        // document.location.href = 'login.php';
        // </script>";
        return 1;
        exit; 
       }
    }
    else{
        // echo "<script>
        // alert('Username anda belum terdafar. LOGIN GAGAL!');
        // document.location.href = 'login.php';
        // </script>";
        return 2;
        exit; 
    }

}
?>