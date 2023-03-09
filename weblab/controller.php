<?php
require 'koneksi.php';

// DATA KAMAR
$data = mysqli_query($koneksi,"SELECT * FROM kamar");
$rows = [];
while($row = mysqli_fetch_assoc($data)){
	$rows[] = $row;
}

// DATA FASILITAS
$data2 = mysqli_query($koneksi,"SELECT * FROM fasilitas");
$rows2 = [];
while($row = mysqli_fetch_assoc($data2)){
	$rows2[] = $row;
}




// DATA PEMESANAN
$data4 = mysqli_query($koneksi,"SELECT * FROM pemesanan");
$rows4 = [];
while($row = mysqli_fetch_assoc($data4)){
	$rows4[] = $row;
}





if(isset($_POST['tambah_kamar'])){
    $type_kamar = $_POST['typekamar'];
    $jumlah_kamar = $_POST['jumlah_kamar'];
    $status = $_POST['status'];
    $harga = $_POST['harga'];
     $gambar = upload();
     if($gambar === false){
        echo "<script>
        document.location.href = 'admin.php';
        </script>";
     }
     else{
        $tambah = mysqli_query($koneksi, "INSERT INTO kamar VALUES
        ('','$type_kamar','$jumlah_kamar','$status','$harga','$gambar')"
        );
     }
    if(mysqli_affected_rows($koneksi) > 0){
        echo "<script>
        alert('Data Berhasil Ditambahkan!');
        document.location.href = 'admin.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Data Gagal Ditambahkan!');
        document.location.href = 'admin.php';
        </script>";
    }
}




if(isset($_POST['tambah_fasilitas'])){
    $nomor_kamar = $_POST['status'];
    $nama_fasilitas = $_POST['namafasilitas'];
    $keterangan = $_POST['keteranganfasilitas'];
  


    $tambah = mysqli_query($koneksi, "INSERT INTO fasilitas VALUES
    ('','$nama_fasilitas','$keterangan','$nomor_kamar')"
    );

    if(mysqli_affected_rows($koneksi) > 0){
        echo "<script>
        alert('Data Berhasil Ditambahkan!');
        document.location.href = 'admin.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Data Gagal Ditambahkan!');
        document.location.href = 'admin.php';
        </script>";
    }
}



if(isset($_POST['tambah_fasilitas_hotel'])){
    $nama_fasilitas_hotel = $_POST['namafasilitashotel'];
    $keterangan_fasilitas_hotel = $_POST['keteranganfasilitashotel'];
     $gambar = upload();
     if($gambar === false){
        echo "<script>
        document.location.href = 'admin.php';
        </script>";
     }
     else{
        $tambah = mysqli_query($koneksi, "INSERT INTO fasilitas_hotel VALUES
        ('','$nama_fasilitas_hotel','$keterangan_fasilitas_hotel','$gambar')"
        );
     }
    if(mysqli_affected_rows($koneksi) > 0){
        echo "<script>
        alert('Data Berhasil Ditambahkan!');
        document.location.href = 'admin.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Data Gagal Ditambahkan!');
        document.location.href = 'admin.php';
        </script>";
    }
}



if(isset($_POST['ubahfasilitas'])){
    $id = $_POST['id'];
    $nama = $_POST['namafasilitas'];
    $keterangan = $_POST['keteranganfasilitas'];
    $nomor_kamar = $_POST['status'];

    $query = "UPDATE fasilitas SET 
    nama_fasilitas = '$nama', 
    keterangan_fasilitas = '$keterangan',
    id_kamar = '$nomor_kamar'
    WHERE id_fasilitas = $id
   ";
    mysqli_query($koneksi, $query);
if(mysqli_affected_rows($koneksi) > 0){
    echo "<script>
    alert('Data Berhasil Diubah!');
    document.location.href = 'admin.php';
    </script>";
}
else{
    echo "<script>
    alert('Data Gagal Diubah!');
    document.location.href = 'admin.php';
    </script>";
}

}




if(isset($_POST['editkamar'])){
    $id = $_POST['id'];
    $type_kamar = $_POST['typekamar'];
    $nomor_kamar = $_POST['nomorkamar'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];
    $gambarLama = $_POST['gambarlama'];

    if($_FILES['foto']['error'] === 4){
        $gambar = $gambarLama;
    }
    else{
        $gambar =  upload();
    }
    $query = "UPDATE kamar SET 
    type_kamar = '$type_kamar', 
    jumlah_kamar = '$nomor_kamar',
    status = '$status',
    harga = '$harga',
    foto = '$gambar'
    WHERE id_kamar = $id
   ";

    mysqli_query($koneksi, $query);
if(mysqli_affected_rows($koneksi) > 0){
    echo "<script>
    alert('Data Berhasil Diubah!');
    document.location.href = 'admin.php';
    </script>";
}
else{
    echo "<script>
    alert('Data Gagal Diubah!');
    document.location.href = 'admin.php';
    </script>";
}
}



if(isset($_POST['hapusdatakamar'])){
    $id = $_POST['id'];
    // mysqli_query($koneksi, "DELETE FROM kamar WHERE id_kamar = $id");
    $bukti_pesan = mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE id_kamar = $id");
    if(mysqli_num_rows($bukti_pesan)>0){
        $data_bukti = mysqli_fetch_assoc($bukti_pesan);
        $id_pesan = $data_bukti['id_pesanan'];
        mysqli_query($koneksi,"DELETE FROM transaksi WHERE id_pesanan = $id_pesan");
    }
  
    mysqli_query($koneksi, "DELETE FROM pemesanan WHERE id_kamar = $id");
    mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id_kamar = $id");
    mysqli_query($koneksi, "DELETE FROM kamar WHERE id_kamar = $id");
    if(mysqli_affected_rows($koneksi) > 0){
        echo "<script>
        alert('Data Berhasil Dihapus!');
        document.location.href = 'admin.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Data Gagal Dihapus!');
        document.location.href = 'admin.php';
        </script>";
    }
}


if(isset($_POST['hapus_data_fasilitas_kamar'])){
    $id = $_POST['id'];
    mysqli_query($koneksi,"DELETE FROM fasilitas WHERE id_fasilitas = $id");
    if(mysqli_affected_rows($koneksi) > 0){
        echo "<script>
        alert('Data Berhasil Dihapus!');
        document.location.href = 'admin.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Data Gagal Dihapus!');
        document.location.href = 'admin.php';
        </script>";
    }
}



function pesanKamar($data){
    global $koneksi;
    $nama_pemesan = $data['nama_pemesan'];
    $email_pemesan = $data['email_pemesan'];
    $no_handphone = $data['hp_pemesan'];
    $nama_tamu = $data['nama_tamu'];
    $id_kamar = $data['id_kamar'];
    $tanggal_cekIn = $data['cekin'];
    $tanggal_cekOut = $data['cekout'];
    $jumlah_kamar = $data['jumlah_kamar'];
    $nama_lengkap = $data['nama_lengkap'];
    $nomor_ktp =  $data['nomor_ktp'];
    
    $cek_ktp = mysqli_query($koneksi,"SELECT * FROM pemesanan WHERE no_ktp = $nomor_ktp");
 if(mysqli_num_rows($cek_ktp) > 0){
    echo "<script>
    alert('Nomor Ktp sudah ada, Pemesanan GAGAL!');
    document.location.href = 'index.php';
    </script>";
 }
 else{
    $data_kamar = mysqli_query($koneksi,"SELECT * FROM kamar WHERE id_kamar = $id_kamar");
    $data_jumlah_kamar = mysqli_fetch_assoc($data_kamar)['jumlah_kamar'];

    if($jumlah_kamar <= $data_jumlah_kamar){
        $hasil_jumlah_kamar = $data_jumlah_kamar - $jumlah_kamar;
        if($hasil_jumlah_kamar == 0){
            $status = "sold";
        }
        else{
            $status = "ready";
        }
        mysqli_query($koneksi,"INSERT INTO pemesanan VALUES 
        ('','$nama_pemesan','$email_pemesan','$no_handphone','$nama_tamu','$tanggal_cekIn','$tanggal_cekOut','$jumlah_kamar','$id_kamar','1','$nama_lengkap','$nomor_ktp')
       ");

        mysqli_query($koneksi,"UPDATE kamar SET jumlah_kamar = '$hasil_jumlah_kamar', status = '$status'  WHERE id_kamar = $id_kamar");
      
    }
    else{
        echo "<script>
        alert('Pastikan Anda Memesan Jumlah Kamar Yang Benar');
        document.location.href = 'index.php';
        </script>";
    }

    if(mysqli_affected_rows($koneksi) > 0){
        echo "<script>
        alert('Pemesanan Berhasil');
        document.location.href = 'index.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Pemesanan Gagal');
        document.location.href = 'index.php';
        </script>";
    }
   
 }

}


function konfirmasi_pesanan($data){
    global $koneksi;
    $id_pesanan = $data['id_pesanan'];
    $status = $data['status'];

    mysqli_query($koneksi, "update pemesanan set status='$status' where id_pesanan='$id_pesanan'");

    if(mysqli_affected_rows($koneksi) > 0){
       header("location:resepsionis.php");
    }
    else{
        header("location:resepsionis.php");
    }
}


    // $kode_pemesan = $data['kode_pemesan']; 
 if(isset($_POST['bukti_pesan'])){   
    $id_pemesan = $_POST['kode_pemesanan'];
     $gambar = upload();
     if($gambar === false){
        echo "<script>
        document.location.href = 'konfirmasi.php';
        </script>";
     }
     else{
        $tambah = mysqli_query($koneksi, "INSERT INTO transaksi VALUES
        ('','$id_pemesan','$gambar')"
        );
     }
    if(mysqli_affected_rows($koneksi) > 0){
        echo "<script>
        alert('Data Berhasil Ditambahkan!');
        document.location.href = 'konfirmasi.php';
        </script>";
    }
    else{
        echo "<script>
        alert('Data Gagal Ditambahkan!');
        document.location.href = 'konfirmasi.php';
        </script>";
    }
 }



function upload(){
    $namaFile = $_FILES["foto"]["name"];
    $ukuranFile = $_FILES["foto"]["size"];
    $error = $_FILES["foto"]["error"];
    $tmpName = $_FILES["foto"]["tmp_name"];

   
    if( $error === 4){
          echo "
          <script>
          alert('Pilih Gambar Terlebih Dahulu!');
          </script>
          ";
          return false;
    }

    
    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    
    if( !in_array($ekstensiGambar, $ekstensiGambarValid)){  
          echo "
          <script>
          alert('File Yang Anda Upload Bukan Gambar!');
          </script>
          ";
          return false;
    }

    
    if( $ukuranFile > 500000){
          echo "
          <script>
          alert('Ukuran Gambar Terlalu Besar!');
          </script>
          ";
          return false;
    }
    $namaFileBaru = uniqid();
    $namaFileBaru .= ".";
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/'.$namaFileBaru);

    return $namaFileBaru;
}



?>