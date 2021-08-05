<?php
include("./koneksi.php");
include('../include/config.php');
// menyimpan data kedalam variabel
session_start();
if(isset($_SESSION['alogin'])){

	try{
		$command = escapeshellcmd('python ../python/rekomendasi.py');
		$output = shell_exec($command);
		echo "<script>
	   	location.href='../datarekomendasi.php';
	   	</script>";
   	} catch (PDOException $e) {
	   echo "Error updating record: " . $e->getMessage();
   	}

	$sql = "SELECT device_pb.jam, device_pb.total_daya, pascabayar.jumlah from device_pb JOIN pascabayar ON device_pb.username = pascabayar.username";
    $query = $dbh -> prepare($sql);
    $query->execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);

	$vjam = 0;
	$vtotal_daya = 0;
	$vjumlah = 0;
	if($query->rowCount() > 0){
        foreach($results as $result){
			//echo htmlentities($result->jam);
			$vjam = $vjam+$result->jam;
			$vtotal_daya = $vtotal_daya+$result->total_daya;
			$vjumlah = $vjumlah+$result->jumlah;
		}
	}
	
	$total_jam = $vjam / $query->rowCount();
	
	if ($total_jam == 24){
		//echo ("true");
		$kwh 		= $vjam * $vtotal_daya;
		$uang 		= $kwh * 1467.28;
		$hari		= $vjumlah / $uang;
	}else{
	}
}
?>