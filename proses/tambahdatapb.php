<?php
include("./koneksi.php");
include('../include/config.php');
// menyimpan data kedalam variabel
session_start();
if(isset($_SESSION['alogin'])){
	try{
		$username 	= $_SESSION['alogin'];
		$jumlah     = $_POST['jumlah'];
		$kwatt     = $jumlah/1467.28;
		$hari     = $_POST['hari'];

		// query SQL untuk update data
		$sql = $dbh->prepare("UPDATE pascabayar SET jumlah=$jumlah, kwatt=$kwatt, hari=$hari WHERE id_pb='1'");
		$sql-> execute([$jumlah, $kwatt, $hari]);

		$th_kwatt = $kwatt / $hari;

		foreach($dbh->query('SELECT SUM(total_daya) FROM device') as $row){
			//https://www.sepulsa.com/blog/biaya-dan-tarif-listrik-per-kwh-2018
			//http://ngelistrik.com/2018/10/06/apa-itu-kwh/
			$tdwatt = $row['SUM(total_daya)'];
			echo($tdwatt);
		}

		if ($th_kwatt < $tdwatt){
			echo "<script>
		      alert('Jumlah tagihan melebihi batas yang ditentukan, silahkan jumlah tagihannya ditambah atau kurangi target harinya')
		      location.href='form_tambah_pb.php';
			  </script>";
		}else{
			echo "<script>
			location.href='../datapb.php';
			</script>";
		}
		
	} catch (PDOException $e) {
		echo "Error updating record: " . $e->getMessage();
	}
}
?>