<?php

require 'cek_login.php';

session_start();
if(isset($_SESSION['admin'])){
  header('location:weblab/admin.php');
}
else if(isset($_SESSION['tamu'])){
  header('location:index.php');
}
else if(isset($_SESSION['resepsionis'])){
  header('location:weblab/resepsionis.php');
}
   
  
if(isset($_POST['login'])){
  $hasil = login($_POST);
  $_POST = [];
  if($hasil == 1){
     $error =  "Password Anda Salah";
  }
  if($hasil == 2){
     $error =  "Username Anda Salah";
  }

}
?>

<!DOCTYPE html>
<html>
  <head>
    <style>
      body {
        height: 500px;
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
      input[type="password"] {
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
        text-decoration: none;
        display: inline-block;
        text-align: center;
        padding: 10px;
        outline: 1px solid blue;
        border-radius: 5px;
      }
      h4 {
        margin : 5px;
        /* border: 1px solid red; */
        display: inline-block;
      }
      a.register {
        background-color: blue;
        color: #f2f2f2;
        transition: all 1s ease;
      }
      
      a.kembali, .error{
        background-color: red;
        color: #f2f2f2;
        transition: all 1s ease;
      }
      h1 {
        text-align: center;
      }
      section{
        /* border: 1px solid red; */
        display: flex;
        justify-content: space-between;
      }
    </style>
      <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  </head>
  <body>
    <div>
      <h1>LOGIN!</h1>
      <?php if(isset($error)){ ?>
        <h1 class="error"><?= $error; ?></h1>
      <?php } ?>
      <form action="" method="post">
        <label for="username">Username</label>
        <input required type="text" id="username" autocomplete="off" name="username" placeholder="Masukkan Username Anda.." />
        <label for="password">Password</label>
        <input required type="password" id="password" autocomplete="off" name="password" placeholder="Masukkan Password Anda.." />
        <input type="submit" value="Submit" name="login"/>
        <section>
        <h4><a class="kembali" href="index.php">Kembali</a></h4>
        <h4><a class="register" href="registrasi.php">Registrasi</a></h4>
        </section>
      
      </form>
    </div>
  </body>
</html>
