<?php

session_start();
if(!isset($_SESSION['admin'])){
  header('location : login.php');
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
        .container{
            width: 50%;
            margin : auto;
        }
        h1{
            text-align:center;
        }
        a{
            display: inline-block;
            color : red;
            text-decoration : none;
            margin : auto;
            font-size : 20px
        }
        button {
           width: 100%;
           padding: 30px;
           border-radius:10px;
        }
    </style>
</head>
<body>
    <div class="container"><h1>INI HALAMAN ADMIN</h1>
<button class="down-cv"><a href="logout.php">LOGOUT</a></button></div>

</body>
</html>