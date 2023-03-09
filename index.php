<?php


require  'weblab/controller.php';
require  'weblab/koneksi.php';
session_start();



if(isset($_SESSION['admin'])){
  header('location:weblab/admin.php');
}
else if(isset($_SESSION['resepsionis'])){
  header('location:weblab/resepsionis.php');
}
  

if(isset($_POST['pesan_kamar'])){
   $hasil = pesanKamar($_POST);
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="style.css" />
     <!-- ICON BOOSTRAPE -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css" />
    <!-- ICON FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  </head>
  <body id="home">
    <header>
      <div class="container naik">
        <nav>
          <div class="logo"><a href="#">Hotel Hilton</a></div>
          <ul class="navbar">
            <li><a href="#home">Home</a></li>
            <li><a href="#kamar">Kamar</a></li>
            <li><a href="#fasilitas">Fasilitas</a></li>
            <?php if(isset($_SESSION['tamu'])){ ?>
            <li><a href="weblab/konfirmasi.php" style="border-left:1px solid black;">Pesanan</a></li>
            <?php } ?>
          </ul>
        </nav>
        <div class="hero-image">
          <div class="text-hero-image">
            <p>WELCOME,</p>
            <p>Hotel Hilton</p>
            <?php if(isset($_SESSION['tamu'])){ ?>
            <p style="color :#242e5a">"<?= $_SESSION['tamu']; ?>"</p>
            <?php } else{ ?>
              <p style="color :#242e5a">"Silahkan Login Untuk Pemesanan"</p>
            <?php } ?>
          
            <?php if(isset($_SESSION['tamu'])) {?>
              <button class="down-cv"><a href="logout.php">Logout</a></button>
            <?php } else{?>
              <button class="hire-btn"><a href="login.php">Login</a></button>
            <button class="down-cv"><a href="registrasi.php">Registrasi</a></button>
             
            <?php } ?> 
          </div>
        </div>
      </div>
    </header>
    <main>
      <div class="container">
        <section class="form">
          <form action="" method="post">
            <div class="box-input">
              <?php if(isset($_SESSION['tamu'])){ ?>
              <input required type="hidden" name="nama_lengkap" value="<?= $_SESSION['tamu'] ?>" />
              <?php } ?>
              <label for="cekin"> Tanggal Cek In </label>
              <input required type="date" name="cekin" id="cekin" />
            </div>
            <div class="box-input">
              <label for="cekout"> Tanggal Cek Out </label>
              <input required type="date" name="cekout" id="cekout" />
            </div>
            <div class="box-input">
              <label for="jmlkamar"> Jumlah Kamar </label>
              <input required type="number" name="jumlah_kamar" id="jmlkamar" />
            </div>
            <div class="box-input">
              <?php if(isset($_SESSION['tamu'])){ ?>
              <button type="button"  data-bs-toggle="modal" data-bs-target="#exampleModal">Pesan</button>
               <?php } else {?>
              <a href="login.php" style="text-decoration:none; color:black;"><button type="button" >Pesan</button></a>
               <?php } ?>
            </div>
          
         
        </section>
        <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <div class="form-group">
                        <label>Nama Pemesan</label>
                        <input required type="text" name="nama_pemesan" class="form-control" placeholder="Masukan Nama Pemesan" autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label>Email Pemesan</label>
                        <input required type="text" name="email_pemesan" class="form-control" placeholder="Masukan Email Pemesan" autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label>No. Handphone</label>
                        <input required type="text" name="hp_pemesan" class="form-control" placeholder="Masukan No. Handphone" autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label>Nama Tamu</label>
                        <input required type="text" name="nama_tamu" class="form-control" placeholder="Masukan Nama Tamu" autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label>Pilih Kamar</label>
                        <select name="id_kamar" class="form-control">
                          <option value="">--- Pilih Kamar ---</option>
                          <?php
                          // include 'koneksi.php';
                          // $data = mysqli_query($koneksi, "select * from kamar");
                          // while ($d = mysqli_fetch_array($data)) { 
                            foreach($rows as $kmr){
                            ?>
                            <option value="<?php echo $kmr['id_kamar']; ?>"><?php echo $kmr['type_kamar']; ?></option>
                            <?php
                          }
                          ?>
                        </select>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="pesan_kamar">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          </form>
        <article class="about">
          <h1>tentang kami</h1>
          <p>
          Hotel kelas atas dengan bangunan bergaya Spanyol ini menghadap ke Laut Jawa, serta berjarak 3 km dari Pantai Anyer dan 47 km dari Gunung Karang yang berapi.
          Kamar bernuansa hangat dan suite dilengkapi dengan dekorasi sederhana dan furnitur dari kayu jati, serta menyediakan TV layar datar dan balkon pribadi dengan pemandangan kolam renang atau pedesaan. Hotel bernuansa santai yang terletak di samping Pantai Anyer ini berjarak 6 menit berjalan kaki dari Mercusuar Cikoneng.
        </p>
        </article>
        <article id="kamar">
          <h1>Kamar</h1>
          <div class="flex-kamar">
          <?php foreach($rows as $data) { 
               $id = $data['id_kamar'];
               $fasilitas = mysqli_query($koneksi,"SELECT * FROM fasilitas WHERE id_kamar = $id");
               if(mysqli_num_rows($fasilitas) > 0){
                $keterangan = mysqli_fetch_assoc($fasilitas)['keterangan_fasilitas'];
               }
               else{
                 $keterangan = "Data fasilitias belum ditambahkan";
               }
             
               
            ?>
           <div class="box-kamar">
              <div class="header">
                <img src="weblab/img/<?= $data['foto'] ?>" alt="foto_kamar_hotel" />
              </div>
              <div class="text">
                <h2><?= $data['type_kamar'] ?></h2>
                <ul>
                 <li>Fasilitas : </li>
                 <li><?= $keterangan ?></li>
                 <li>Harga : Rp.<?= $data['harga'] ?></li>
                 <li>Jumlah Kamar Tersedia: <?= $data['jumlah_kamar'] ?></li>
                 <?php if($data['status']== "ready") {?>
                 <li style="color:green;">Status : READY</li>
                 <?php } ?>
                 <?php if($data['status']== "sold") {?>
                 <li style="color:red;">Status : SOLD</li>
                 <?php } ?>
                </ul>
              </div>
            </div>
            <?php } ?>
          </div> 
        </article>
        <article id="fasilitas">
          <h1>Fasilitas Hotel</h1>
          <div class="flex-fasilitas">
           <div class="box-fasilitas">
              <div class="header">
                <img src="img/sauna.jpg"alt="foto_fasilitas_hotel" />
              </div>
              <div class="text">
                <h2>Sauna</h2>
                <ul>
                 <li>ruangan dengan suhu panas dan kering yang digunakan untuk membantu tubuh mengeluarkan keringat dan membakar lebih banyak kalori.</li>
                </ul>
              </div>
            </div>
           <div class="box-fasilitas">
              <div class="header">
                <img src="img/kolam.jpg" alt="foto_fasilitas_hotel" />
              </div>
              <div class="text">
                <h2>Kolam Renang</h2>
                <ul>
                <li>Kolam renang ini dirancang untuk tamu dan beroperasi dari 6:00-21:00 setiap hari, dengan dikelilingi taman tropis yang indah.</li>
                </ul>
              </div>
            </div>
           <div class="box-fasilitas">
              <div class="header">
                <img src="img/taman.jpg" alt="foto_fasilitas_hotel" />
              </div>
              <div class="text">
              <h2>Area Terbuka</h2>
                <ul>
                <li>bersifat terbuka, tempat tumbuh tanaman, baik yang tumbuh tanaman secara alamiah maupun yang sengaja ditanam.</li>
                </ul>
              </div>
            </div>
           <div class="box-fasilitas">
              <div class="header">
                <img src="img/basment.jpg" alt="foto_fasilitas_hotel" />
              </div>
              <div class="text">
              <h2>Parkir Basement</h2>
                <ul>
                <li>Tempat parkir yang luas dan nyaman, lobby yang luas dan nyaman, check in/out cepat.</li>
                </ul>
              </div>
            </div>
           <div class="box-fasilitas">
              <div class="header">
                <img src="img/restaurant.jpg" alt="foto_fasilitas_hotel" />
              </div>
              <div class="text">
              <h2>Restaurant</h2>
                <ul>
                <li> Restoran kasual memiliki teras dan tempat makan di tepi pantai.  Jenis makanan yang beragam, serta pelayanan yang memuaskan.</li>
                </ul>
              </div>
            </div>
            <div class="box-fasilitas">
              <div class="header">
                <img src="img/pantai.jpg" alt="foto_fasilitas_hotel" />
              </div>
              <div class="text">
              <h2>Pantai Pribadi</h2>
                <ul>
                <li>Pantai yang luas dan nyaman, menikmati keindahan alam pantai, melihat matahari terbit atau tenggelam.</li>
                </ul>
              </div>
            </div>
          </div> 
        </article>
      </div>
    </main>
    <footer>
      <div class="container flex-footer">
        <p>Social Media Account</p>

        <!--paragraph-->
        <p>Marbella Anyer menawarkan akomodasi bintang 5 di Kareo dan menghadap ke pantai!</p>
        <!--social-->
        <div class="social-icons">
          <a href="#"><i class="fab fa-whatsapp"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
        </div>

        <!--copyright-->
        <p class="copyright">Copyright by Rafif Rabbani</p>
      </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
  </body>
</html>
