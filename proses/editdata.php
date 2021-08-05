<?php
include("./koneksi.php");
// menyimpan data kedalam variabel
 $id_device			= $_POST['id_device'];
 $nama  	 		= $_POST['nama'];
 $daya       		= $_POST['daya'];
 $jumlah  			= $_POST['jumlah'];
 $jam  				= $_POST['jam'];
 $prioritas  		= $_POST['prioritas'];
 $total_daya		= ($daya * $jumlah)/1000;
// menyimpan data kedalam table
$sql = "UPDATE device SET nama='$nama',daya='$daya' ,jumlah='$jumlah' ,jam='$jam' ,prioritas='$prioritas' ,total_daya='$total_daya' WHERE id_device='$id_device'";

 if($koneksi->query($sql) === TRUE){
  	echo "<script>
  	location.href='../datatk.php';
  	</script>";
 }else{
  	echo "<script>
  	alert('prioritas sudah digunakan')
  	location.href='../datatk.php';
  	</script>" . $koneksi->error;
 }
?>