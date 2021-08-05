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

		// query SQL untuk update data
		$sql = $dbh->prepare("UPDATE token SET jumlah=$jumlah, kwatt=$kwatt WHERE id_token='1'");
		$sql-> execute([$jumlah, $kwatt]);
		$command = escapeshellcmd('python ../python/kirim_token.py');
		$output = shell_exec($command);
		echo $output;
		echo "<script>location.href='../token.php';</script>";
	} catch (PDOException $e) {
		echo "Error updating record: " . $e->getMessage();
	}
}

?>