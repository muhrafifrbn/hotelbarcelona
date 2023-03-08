<?php

$koneksi = mysqli_connect("localhost","root","","praujikom");
if(!$koneksi){
    echo mysqli_error($koneksi);
}

?>