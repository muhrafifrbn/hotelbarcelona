<?php

require 'cek_registrasi.php';

if(isset($_POST['registrasi'])){
  $hasil = registrasi($_POST);
}

?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      body {
        height: 600px;
        /* border: 1px solid red; */
        display: flex;
        justify-content: center;
        align-items: center;
      }
      * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }
      input[type="text"],
      input[type="password"],select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }

      input[type="submit"] {
        width: 100%;
        background-color: #4caf50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }

      input[type="submit"]:hover {
        background-color: #45a049;
      }

      div {
        width: 50%;
        border-radius: 30px;
        background-color: #f2f2f2;
        padding: 20px;
      }
      a {
        color: blue;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        padding: 10px;
        outline: 1px solid blue;
        border-radius: 5px;
      }
      h4 {
        display: flex;
        justify-content: center;
        /* border: 1px solid red; */
      }
      a:hover {
        background-color: red;
        color: #f2f2f2;
        transition: all 1s ease;
        
      }
      h1 {
        text-align: center;
      }
      
    </style>
      <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  </head>
  <body>
    <div>
      <h1>REGISTRASI!</h1>
      <form action="" method="post">
        <label for="username">Username</label>
        <input required type="text" id="username" name="username" autocomplete="off" placeholder="Masukkan Username Anda.." />
        <label  for="namaLengkap">Nama Lengkap</label>
        <input required type="text" id="namaLengkap" name="namaLengkap" autocomplete="off" placeholder="Masukkan Nama Lengkap Anda.." />
        <label for="password">Password</label>
        <input required type="password" id="password" name="password" autocomplete="off" placeholder="Masukkan Password Anda.." />
        <label for="password2">Password</label>
        <input required type="password" id="password2" name="password2" autocomplete="off" placeholder="Konfirmasi Password Anda.." />
        <label for="pengguna">Pengguna</label>
        <select id="pengguna" name="pengguna">
          <option value="1">Admin</option>
          <option value="3">Tamu</option>
          <option value="2">Resepsionis</option>
        </select>
        <input type="submit" value="Submit" name="registrasi"/>
        <h4><a href="index.php">Kembali</a></h4>
      </form>
    </div>
  </body>
</html>
