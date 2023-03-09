<?php

session_start();
if(!isset($_SESSION['resepsionis'])){
  header('location:../login.php');
}

include 'controller.php';
include 'koneksi.php';

// echo $_SESSION['admin'];
// die;

if(isset($_POST['konfirmasi'])){
  $pesan_kamar = konfirmasi_pesanan($_POST);
}

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
        <title>crud dashboard</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="css/custom.css">
		
		
		<!--google fonts -->
	
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
        <link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
	<!--google material icon-->
      <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">

  </head>
  <body>
  

<div class="wrapper">


       
		
		
		
		
		<!--------page-content---------------->
		
		<div id="content" style="width:100%;">
		   
		   <!--top--navbar----design--------->
		   
		   <div class="top-navbar">
		      <div class="xp-topbar">

                <!-- Start XP Row -->
                <div class="row"> 
                      <!-- Start XP Col -->
                      <div class="col d-flex justify-content-center ">
                            <div class="xp-profilebar text-center d-flex justify-content-between" style="width:100%">
                                <nav class="navbar p-0">
                                  <ul class="nav navbar-nav flex-row ml-auto "> 
                                    <li class="dropdown nav-item active">
                                        <a class="nav-link bg-primary" href="#" >
                                        Anda Sebagai <?= $_SESSION['akses'] ?>, Nama :	
                                        <?= $_SESSION['resepsionis']; ?>
                                        </a>
                                    </li>  
                                  </ul>
                                </nav>
                                <nav class="navbar p-0">
                                  <ul class="nav navbar-nav flex-row ml-auto  "> 
                                    <li class="dropdown nav-item active ">
                                        <a class="nav-link bg-danger" href="../logout.php" >
                                        Logout
                                        </a>
                                    </li>  
                                   </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- End XP Col -->

                </div> 
                <!-- End XP Row -->

            </div>
              <div class="xp-breadcrumbbar text-center">
                <h4 class="page-title">Halaman Resepsionis</h4>  
                <!-- <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Booster</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>                 -->
              </div>
			
		   </div>
		   
		   
		   
		   <!--------main-content------------->
		   
		   <div class="main-content">
			  <div class="row">
              <div class="container d-flex justify-content-center">
					<nav>
						<!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Kamar</button>
              </li>
						</ul> -->
					</nav>
				 </div>
<div class="col-md-12">
  <div class="text-center tab-content" id="myTabContent">
	<div class="table-wrapper  tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab" >
        <div class="table-title">
        <div class="row">
            <div class="col-sm-6 p-0 d-flex justify-content-lg-start justify-content-center">
            <h2 class="ml-lg-2">Data Resepsionis</h2>
            </div>
        </div>
        </div>
        <table class="table table-striped table-hover">
        <thead>
            <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
            <th>Nama Tamu</th>
            <th>Tanggal Cekin</th>
            <th>Tanggal Cekout</th>
            <th>Type Kamar</th>
            <th>Jumlah Kamar</th>
            <th>Status</th>
            <th>Aksi</th>
            <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
           <?php $i = 1;  foreach($rows4 as $rsp) { ?>
            <?php $id_kamar = $rsp['id_kamar'];
                 $result = mysqli_query($koneksi,"SELECT * FROM kamar WHERE id_kamar = $id_kamar");
                 $type_kamar = mysqli_fetch_assoc($result)['type_kamar'];

                 $id_pemesanan = $rsp['id_pesanan'];
                 $cek_transaksi = mysqli_query($koneksi,"SELECT * FROM transaksi WHERE id_pesanan = '$id_pemesanan'");
                 if(mysqli_num_rows($cek_transaksi) > 0){
                  $foto = mysqli_fetch_assoc($cek_transaksi)['foto'];
                  $cek_foto = 2;
                 }
                 else{
                  $cek_foto = 1;
                 }   
            ?>
            <tr>
              <th><?= $i ?></th>
              <th><?= $rsp['nama_pemesan'] ?></th>
              <th><?= $rsp['email_pemesan'] ?></th>
              <th><?= $rsp['hp_pemesan'] ?></th>
              <th><?= $rsp['nama_tamu'] ?></th>
              <th><?= $rsp['cek_in'] ?></th>
              <th><?= $rsp['cek_out'] ?></th>
              <th><?= $type_kamar ?></th>
              <th><?= $rsp['jml_kamar'] ?></th>
              <?php if( $rsp['status'] == 1) {?>  
              <th> <span class="badge bg-warning">Belum di Konfirmasi</span></th>
              <?php } else { ?>
               <th> <span class="badge bg-success">Sudah di Konfirmasi</span></th>
               <?php } ?>
               <th>
                   <?php if($cek_foto == 2){ ?>
                         <form action="" method="POST">
                            <input type="hidden" name="id_pesanan" value="<?php echo $rsp['id_pesanan']; ?>">
                            <input type="hidden" name="status" value="2">
                            <button type="submit" name="konfirmasi" class="btn btn-sm btn-primary">Konfirmasi</button>
                          </form>
                    <?php } else{ ?>  
                      <button type="button" name="konfirmasi" class="btn btn-sm btn-danger">Konfirmasi</button>
                    <?php }?>      
               </th>
               <th><a href="#foto_pesan<?= $rsp['id_pesanan'] ?>" class="btn btn-primary" data-toggle="modal" >Bukti</a></th>
              </tr>
            <?php  $i++; } ?>
        </tbody>
        </table>
    
      </div>
	
</div>
</div>


<?php  foreach($rows4 as $rsp) : ?>
    <!-- Edit Modal HTML -->
    <div  class="modal fade" tabindex="-5" id="foto_pesan<?= $rsp['id_pesanan'] ?>" role="dialog">
    <?php 
         $id_pemesanan = $rsp['id_pesanan'];
         $cek_transaksi = mysqli_query($koneksi,"SELECT * FROM transaksi WHERE id_pesanan = '$id_pemesanan'");
        if(mysqli_num_rows($cek_transaksi) > 0){
          $foto = mysqli_fetch_assoc($cek_transaksi)['foto'];
          $cek_foto = 2;
        }
        else{
          $cek_foto = 1;
        }   
        
    ?>
    <div class="modal-dialog">
        <div class="modal-content">
        <form>
            <div class="modal-header">
            <h4 class="modal-title">Bukti Pemesanan</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
            <div class="form-group">
            <label for="kode_pemesanan" class="form-label" >Kode Pemesanan</label>
			     	<input readonly required type="number" class="form-control" id="kode_pemesanan" name="kode_pemesanan"  value="<?= $rsp['id_pesanan']; ?>">
            </div>
            <div class="form-group">
              <?php if($cek_foto == 2){ ?>
                <img src="img/<?= $foto; ?>" alt="foto_bukti_transaksi" width="150">
               <?php } else { ?>
                 <h1>Bukti Transaksi Belum Ada</h1>
                <?php } ?>
            </div>
            </div>
            <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            </div>
        </form>
        </div>
  </div>
</div>
<?php endforeach; ?>












    <!-- Edit Modal HTML -->
    <div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
        <form>
            <div class="modal-header">
            <h4 class="modal-title">Add Employee</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" class="form-control" required>
            </div>
            </div>
            <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-success" value="Add">
            </div>
        </form>
        </div>
  </div>
</div>
<!-- Edit Modal HTML -->
<div id="editEmployeeModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h4 class="modal-title">Edit Employee</h4>
          <button type="button" class="close" data-dismiss="modal" 
		  aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Address</label>
            <textarea class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-info" value="Save">
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <form>
        <div class="modal-header">
          <h4 class="modal-title">Delete Employee</h4>
          <button type="button" class="close" data-dismiss="modal" 
		  aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete these Records?</p>
          <p class="text-warning"><small>This action cannot be undone.</small></p>
        </div>
        <div class="modal-footer">
          <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
          <input type="submit" class="btn btn-danger" value="Delete">
        </div>
      </form>
    </div>
	</div>
  </div>
				
		   
			  </div>
			 
			 
			 <!---footer---->
			 
			 
		</div>
		
		<footer class="footer">
			    <div class="container-fluid">
				       <div class="footer-in">
                 <p class="mb-0">Muhammad Rafif Rabbani</p>
                </div>
				</div>
			 </footer>
</div>
</div>


<!----------html code compleate----------->








  
     <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
   <script src="js/jquery-3.3.1.slim.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/jquery-3.3.1.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  <script type="text/javascript">
        
		
		
</script>
  
  



  </body>
  
  </html>


