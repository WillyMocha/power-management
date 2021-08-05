<?php
include("./koneksi.php");
include('../include/config.php');
// menyimpan data kedalam variabel
session_start();
if(isset($_SESSION['alogin'])){
	$row = $dbh->query("select count(*) from device")->fetchColumn();
 	if ($row < 10){
		try{
			$username 	= $_SESSION['alogin'];
			$nama  	 	= $_POST['nama'];
			$daya     	= $_POST['daya'];
			$jumlah     = $_POST['jumlah'];
			$jam     	= $_POST['jam'];
			$prioritas  = $_POST['prioritas'];
			$total_daya	= ($daya * $jumlah)/1000;
			$value		= $_POST['nilai'];

			// query SQL untuk insert data
			$sql = $dbh->prepare("INSERT INTO device_pb VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
			if($prioritas == 1){
				$value = 1000;
			}elseif ($prioritas == 2){
				$value = 900;
			}elseif ($prioritas == 3){
				$value = 800;
			}elseif ($prioritas == 4){
				$value = 700;
			}elseif ($prioritas == 5){
				$value = 600;
			}elseif ($prioritas == 6){
				$value = 500;
			}elseif ($prioritas == 7){
				$value = 400;
			}elseif ($prioritas == 8){
				$value = 300;
			}elseif ($prioritas == 9){
				$value = 200;
			}else{
				$value = 100;
			};
			$sql-> execute([$username, $nama, $daya, $jumlah, $jam, $prioritas, $total_daya, $value]);

			echo "<script>
			location.href='../datadevicepb.php';
			</script>";
		} catch (PDOException $e) {
			echo "<script>
		      alert('prioritas sudah digunakan')
		      location.href='../datadevicepb.php';
		      </script>";
		}
	}else{
		echo "<script>
	      alert('perangkat sudah melebihi batas, perangkat terdaftar saat ini : $row')
	      location.href='../datadevicepb.php';
	      </script>";
	}
}
?>