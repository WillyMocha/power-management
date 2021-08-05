<?php
include("./koneksi.php");
include('../include/config.php');
// menyimpan data kedalam variabel
session_start();
if(isset($_SESSION['alogin'])){
 	$row = $dbh->query("select count(*) from device")->fetchColumn();
 	if ($row < 10){
  		try{
   			$username   = $_SESSION['alogin'];
		  	$nama       = $_POST['nama'];
		   	$daya       = $_POST['daya'];
		   	$jumlah     = $_POST['jumlah'];
		   	$jam        = $_POST['jam'];
		   	$prioritas  = $_POST['prioritas'];
		   	$total_daya = ($daya * $jumlah)/1000;

			// query SQL untuk insert data
			$sql = $dbh->prepare("INSERT INTO device VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
			$sql-> execute([$username, $nama, $daya, $jumlah, $jam, $prioritas, $total_daya]);
			echo "<script>location.href='../datatk.php';</script>";
		} catch (PDOException $e) {
		  	echo "<script>
		      alert('prioritas sudah digunakan')
		      location.href='../datatk.php';
		      </script>";
		 }
  
	}else{
		echo "<script>
	      alert('perangkat sudah melebihi batas, perangkat terdaftar saat ini : $row')
	      location.href='../datatk.php';
	      </script>";
	}
}
?>