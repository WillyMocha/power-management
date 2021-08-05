<?php
include("./koneksi.php");
include('../include/config.php');
// menyimpan data kedalam variabel
session_start();
if(isset($_SESSION['alogin'])){
	try{
		$command = escapeshellcmd('python ../python/kirim_jam.py');
		$output = shell_exec($command);
		echo "<script>
		location.href='../datarekomendasi.php';
		</script>";
	} catch (PDOException $e) {
		echo "Error updating record: " . $e->getMessage();
	}
}

?>