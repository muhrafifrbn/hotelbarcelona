<?php

$koneksi = mysqli_connect("localhost","root","","db_hotel_hilton");
if(!$koneksi){
    echo mysqli_error($koneksi);
}

?>