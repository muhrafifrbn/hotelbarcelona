<?php

session_start();
if(!isset($_SESSION['admin'])){
	header('location:../login.php');
}

include 'controller.php';
include 'koneksi.php';


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
      <title>Admin</title>
	    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
	    <!----css3---->
        <link rel="stylesheet" href="css/custom.css">
		
		<link rel="shortcut icon" href="../img/logo.png" type="image/x-icon">
		<!--google fonts -->
	
	    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
	
	
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
											<?= $_SESSION['admin']; ?>
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
					<h4 class="page-title">Halaman Admin</h4>  
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
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Kamar</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#fasilitas" type="button" role="tab" aria-controls="fasilitas" aria-selected="false">Fasilitas Kamar</button>
							</li>
						</ul>
					</nav>
				 </div>
<div class="col-md-12">
  <div class="text-center tab-content" id="myTabContent">
  <div class=" table-wrapper tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">		
								<div class="table-title">
									<div class="row">
										<div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
											<h2 class="ml-lg-2">Kamar</h2>
										</div>
										<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
										<a href="#addkamar" class="btn btn-success" data-toggle="modal">
										<i class="material-icons">&#xE147;</i>
										<span>Tambah</span>
										</a>
										</div>
									</div>
								</div>
								
								<table class="table table-striped table-hover">
									<thead>
										<tr>
										<th>No</th>
										<th>Type Kamar</th>
										<th>Nomor Kamar</th>
										<th>Status</th>
										<th>Harga</th>
										<th>Foto</th>
										<th>Actions</th>
										</tr>
									</thead>
									
									<tbody>

										<?php $i = 1; ?>
										<?php foreach($rows as $kmr):  ?>
										<tr>
										<th><?= $i ?></th>
										<th><?= $kmr['type_kamar']; ?></th>
										<th><?= $kmr['jumlah_kamar']; ?></th>
									
										<th><?= $kmr['status']; ?></th>
										
										<th><?= $kmr['harga']; ?></th>
										<th><img src="img/<?= $kmr['foto']; ?>" alt="" srcset="" width="150"></th>
										
										<th>
									    <a href="#ubahKamar<?= $kmr['id_kamar'] ?>" class="edit" data-toggle="modal" >
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
										</a>
										
										<a href="#hapusDataKamar<?= $kmr['id_kamar']?>" class="delete" data-toggle="modal">
										<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
										</a>
										</th>
										</tr>
										<?php $i++; ?>
										<?php endforeach;  ?>
									</tbody>
									
									
								</table>
								
								
							</div>



              <div class=" table-wrapper tab-pane fade "id="fasilitas" role="tabpanel" aria-labelledby="profile-tab">		
								<div class="table-title">
									<div class="row">
										<div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
											<h2 class="ml-lg-2">Fasilitas Kamar</h2>
											</div>
											<div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
											<a href="#addfasilitas" class="btn btn-success" data-toggle="modal">
											<i class="material-icons">&#xE147;</i>
											<span>Tambah</span>
											</a>
											
										</div>
									</div>
								</div>
								
								<table class="table table-striped table-hover">
									<thead>
										<tr>
										<th>NO</th>
										<th>Nomor Kamar</th>
										<th>Nama Fasilitas</th>
										<th>Keterangan Fasilitas</th>
										<th>Actions</th>
										</tr>
									</thead>
									
									<tbody>
										<?php $i=1; foreach($rows2 as $fsl): ?>
									   <tr>
										<th><?= $i; ?></th>
										<?php
										$id = $fsl['id_kamar'];
										$data = mysqli_query($koneksi, "SELECT type_kamar FROM kamar WHERE id_kamar = $id");
										if(mysqli_num_rows($data) > 0){
											$d =  mysqli_fetch_assoc($data)['type_kamar'];
										}
										else{
											$d = "Tidak Ditemukan Type Kamar";
										}
										
										?>
										<th><?= $d  ?></th>
										<th><?= $fsl['nama_fasilitas'] ?></th>
										<th><?= $fsl['keterangan_fasilitas'] ?></th>
										<th>
											<a href="#editFasilitas<?= $fsl['id_fasilitas'] ?>" class="edit" data-toggle="modal">
										<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
										</a>
										<a href="#hapusDataFasilitasKamar<?= $fsl['id_fasilitas'] ?>" class="delete" data-toggle="modal">
										<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
										</a>
										</th>
										</tr> 
									   
									    <?php $i++; endforeach; ?>		
									
									</tbody>
									
									
								</table>
								
									
							</div>

              
</div>
</div>


<!-- TAMBAH DATA KAMAR -->
        <div class="modal fade " tabindex="-1" id="addkamar" role="dialog">
							<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Tambah Kamar</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
								<form class="row g-4" action="controller.php" method="post" enctype="multipart/form-data">
								<div class="col-md-6">
									<label style="display:block;" for="typekamar" class="form-label">Type Kamar</label>
									<select class="form-select  " style="width:100%;" name="typekamar"  aria-label="Default select example">
									<option value="Residence">Residence</option>
									<option value="Deluxe">Deluxe</option>
									<option value="Master">Master</option>
									</select>
								</div>
								<div class="col-md-6">
									<label for="jumlah_kamar" class="form-label">Jumlah Kamar</label>
									<input required type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar" autocomplete="off">
								</div>
								<div class="col-md-6">
								    <label style="display:block;" for="status" class="form-label">Status</label>
									<select class="form-select  " style="width:100%;" name="status"  aria-label="Default select example">
									<option value="ready">Ready</option>
									<option value="sold">Sold</option>
									</select>
								</div>
								<div class="col-4">
									<label for="harga" class="form-label">Harga</label>
									<input required type="text" class="form-control" id="harga" name="harga" autocomplete="off">
								</div>
								<div class="col-md-12">
								<label for="foto" class="form-label">Foto</label>
								<input class="form-control" type="file" id="foto" name="foto">
								</div>
								

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-success" name="tambah_kamar">Add</button>
									</div>
									</form>
									</div>
							</div>
					</div>
<!-- AKHIR TAMBAH DATA KAMAR -->

<!-- TAMBAH DATA FASILITAS KAMAR-->
		<div class="modal fade " tabindex="-1" id="addfasilitas" role="dialog">
							<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Tambah Fasilitas</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
								<form class="row g-4" action="controller.php" method="post">
								<div class="col-md-6">
								    <label style="display:block;" for="status" class="form-label">Type Kamar</label>
									<select class="form-select  " style="width:100%;" name="status"  aria-label="Default select example">
									<option value="">--- Pilih Kamar ---</option>
										<?php
										$data = mysqli_query($koneksi, "SELECT * FROM kamar");
										while ($d = mysqli_fetch_array($data)) { 
										?>
										<option value="<?php echo $d['id_kamar']; ?>"><?php echo $d['type_kamar']; ?></option>
										<?php
										}
										?>
									</select>
								</div>
								<div class="col-md-6">
									<label for="namafasilitas" class="form-label">Nama Fasilitas</label>
									<input required type="text" class="form-control" id="namafasilitas" name="namafasilitas" autocomplete="off">
								</div>						
								<div class="col-md-12">
									<label for="exampleFormControlTextarea1" class="form-label">Keterangan Fasilitas</label>
									<textarea required class="form-control" id="exampleFormControlTextarea1" rows="3" name="keteranganfasilitas"></textarea>
								</div>								

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
										<button type="submit" class="btn btn-success" name="tambah_fasilitas">Add</button>
									</div>
									</form>
									</div>
							</div>
					</div>
<!-- AKHIR TAMBAH DATA FASILITAS KAMAR-->



<!-- UBAH DATA KAMAR -->
		    <?php foreach($rows as $kmr):  ?>		   			   
				 <div class="modal fade" tabindex="-5" id="ubahKamar<?= $kmr['id_kamar'] ?>" role="dialog">
					 <div class="modal-dialog" role="document">
										 <div class="modal-content">
												 <div class="modal-header">
													 <h5 class="modal-title">Edit Kamar</h5>
													 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
													 <span aria-hidden="true">&times;</span>
													 </button>
												 </div>
										  <div class="modal-body">
											 <form class="row g-4" action="controller.php" method="post" enctype="multipart/form-data">
											 <input type="hidden" name="gambarlama" value="<?= $kmr['foto'];?>" >	
											 <input type="hidden" name="id" value="<?= $kmr['id_kamar'];?>" >
											 <div class="col-md-6">
											 <label style="display:block;" for="status" class="form-label">Type Kamar</label>
												 <select class="form-select  " style="width:100%;" name="typekamar"  aria-label="Default select example">
												 <?php if($kmr['type_kamar'] == "Residence") { ?>
												 <option value="Residence" selected>Residence</option>
												 <option value="Deluxe">Deluxe</option>
												 <option value="Master">Master</option>
												 <?php } elseif($kmr['type_kamar'] == "Deluxe") { ?>
												 <option value="Residence">Residence</option>
												 <option value="Deluxe" selected>Deluxe</option>
												 <option value="Master">Master</option>
												 <?php } else { ?>
												 <option value="Residence">Residence</option>
												 <option value="Deluxe">Deluxe</option>
												 <option value="Master" selected>Master</option>
												 <?php } ?> 
												 </select>
											 </div>
											 <div class="col-md-6">
												 <label for="nomorkamar" class="form-label">Jumlah Kamar</label>
												 <input type="number" class="form-control" id="nomorkamar" name="nomorkamar" value="<?= $kmr['jumlah_kamar'];?>">
											 </div>
											 
											 <div class="col-md-6">
												 <label style="display:block;" for="status" class="form-label">Status</label>
												 <select class="form-select  " style="width:100%;" name="status"  aria-label="Default select example">
												 <?php if($kmr['status'] == "ready"){ ?>
												 <option value="ready" selected>Ready</option>
												 <option value="sold">Sold</option>
												 <?php } if($kmr['status'] == "sold"){ ?>
												 <option value="ready">Ready</option>
												 <option value="sold" selected>Sold</option>
												 <?php } ?>
												 </select>
											 </div>
											 <div class="col-4">
												 <label for="harga" class="form-label">Harga</label>
												 <input type="text" class="form-control" id="harga" name="harga" value="<?= $kmr['harga'];?>">
											 </div>
											 <div class="col-md-8 mt-3">
											 <img src="img/<?= $kmr['foto']; ?>" alt="" width="150">
											 </div>
											 <div class="col-md-12">
											 <label for="foto" class="form-label">Foto</label>
											 <input class="form-control" type="file" id="foto" name="foto">
											 </div>
										 </div>
												 <div class="modal-footer">
													 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
													 <button type="submit" class="btn btn-success" name="editkamar">edit</button>
												 </div>
												 </form>
												 </div>
						 </div>
				 </div>
			 <?php endforeach; ?>
<!-- AKHIR UBAH DATA KAMAR -->

<!-- UBAH DATA FASILITAS KAMAR-->
     <?php foreach($rows2 as $fsl):  ?>		   
		<div class="modal fade" tabindex="-5" id="editFasilitas<?=$fsl['id_fasilitas']?>" role="dialog">
			<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Edit Fasilitas</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
									<form class="row g-4" action="controller.php" method="post">
									<input type="hidden" name="id" value="<?= $fsl['id_fasilitas'];?>" >
									<div class="col-md-6">
										<label style="display:block;" for="status" class="form-label">Type Kamar</label>
										<select class="form-select  " style="width:100%;" name="status"  aria-label="Default select example">
										<option value="">--- Pilih Kamar ---</option>
												<?php 
												$id_fasilitas = $fsl['id_fasilitas'];
												$data = mysqli_query($koneksi, "SELECT * FROM fasilitas WHERE id_fasilitas='$id_fasilitas'");
												while($d = mysqli_fetch_array($data)){
												$kamar = mysqli_query($koneksi, "select * from kamar");
												while ($a = mysqli_fetch_array($kamar)) {
												if ($a['id_kamar'] == $d['id_kamar']) { ?>
													<option value="<?php echo $a['id_kamar']; ?>" selected><?php echo $a['type_kamar']; ?></option>";
												<?php }else{ ?>
													<option value="<?php echo $a['id_kamar']; ?>"><?php echo $a['type_kamar']; ?></option>";
												<?php }
												}
												 }
												?>  
										</select>
									</div>
									<div class="col-md-6">
										<label for="typekamar" class="form-label">Nama Fasilitas</label>
										<input type="text" class="form-control" id="typekamar" name="namafasilitas" value="<?= $fsl['nama_fasilitas'];?>" >
									</div>
									<div class="col-md-12">
										<label for="exampleFormControlTextarea1" class="form-label">Keterangan Fasilitas</label>
										<textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="keteranganfasilitas"  ><?= $fsl['keterangan_fasilitas'];?></textarea>
									</div>
									
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
											<button type="submit" class="btn btn-success" name="ubahfasilitas">Ubah</button>
										</div>
										</form>
										</div>
				</div>
		</div>
	<?php endforeach; ?>
<!--AKHIR UBAH DATA FASILITAS KAMAR-->


<!-- HAPUS DATA KAMAR -->
   <?php foreach($rows as $kmr) :?>
				<div class="modal fade" tabindex="-1" id="hapusDataKamar<?= $kmr['id_kamar'] ?>" role="dialog">
	  	  <div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hapus Data Kamar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="controller.php" method="post">
			<input type="hidden" name="id" value="<?= $kmr['id_kamar'];?>" >
			<div class="modal-body row g-4 text-center">
				<p>Apakah Anda yakin ingin menghapus Catatan ini?</p>
				<div class="col-md-6">
				<p>Type Kamar = <?= $kmr['type_kamar'] ?></p>
				</div>
				<div class="col-md-5">
				<p>Jumlah Kamar = <?= $kmr['jumlah_kamar'] ?></p>
				</div>
				<div class="col-md-5">
				<p>Status = <?= $kmr['status'] ?></p>
				</div>
				<div class="col-md-5">
				<p>Harga = <?= $kmr['harga'] ?></p>
				</div>
				<div class="col-md-6">
				<p>Foto = <img src="img/<?= $kmr['foto']; ?>" alt="" width="150"></p>
				</div>
				<p class="text-warning"><small>this action Cannot be Undone,</small></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success" name="hapusdatakamar">Delete</button>
			</div>
			</form>
			</div>
		</div>
		</div>
<?php endforeach; ?>
<!-- AKHIR HAPUS DATA KAMAR -->

<!-- HAPUS DATA FASILITAS KAMAR-->
    <?php foreach($rows2 as $fsl) :?>
				<div class="modal fade" tabindex="-1" id="hapusDataFasilitasKamar<?= $fsl['id_fasilitas'] ?>" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Hapus Data Fasilitas Kamar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="controller.php" method="post">
			<input type="hidden" name="id" value="<?= $fsl['id_fasilitas'];?>" >
			<div class="modal-body row g-4 text-center">
			<?php
					$id = $fsl['id_kamar'];
					$data = mysqli_query($koneksi, "SELECT type_kamar FROM kamar WHERE id_kamar = $id");
					if(mysqli_num_rows($data)>0){
						$d =  mysqli_fetch_assoc($data)['type_kamar'];
					}
					else{
						$d = "Tidak Ditemukan Type Kamar";
					}
				
			?>							
				<p>Apakah Anda yakin ingin menghapus Catatan ini?</p>
				<div class="col-md-6">
				<p>Type Kamar = <?= $d ?></p>
				</div>
				<div class="col-md-5">
				<p>Nama Fasilitas = <?= $fsl['nama_fasilitas'] ?></p>
				</div>
				<div class="col-md-5">
				<p>Keterangan Fasilitas = <?= $fsl['keterangan_fasilitas'] ?></p>
				</div>
				<p class="text-warning"><small>this action Cannot be Undone,</small></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-success" name="hapus_data_fasilitas_kamar">Delete</button>
			</div>
			</form>
			</div>
		</div>
		</div>
<?php endforeach; ?>
<!-- AKHIR HAPUS DATA FASILITAS KAMAR-->
	
			 
				
		   
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


