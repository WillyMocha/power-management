<?php
include("./koneksi.php");
// menyimpan data kedalam variabel
 $id_device_pb		= $_POST['id_device_pb'];
 $nama  	 		= $_POST['nama'];
 $daya       		= $_POST['daya'];
 $jumlah  			= $_POST['jumlah'];
 $jam  				= $_POST['jam'];
 $prioritas  		= $_POST['prioritas'];
 $total_daya		= ($daya * $jumlah)/1000;
 $value				= $_POST['nilai'];

// menyimpan data kedalam table
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

$sql = "UPDATE device_pb SET nama='$nama',daya='$daya' ,jumlah='$jumlah' ,jam='$jam' ,prioritas='$prioritas' ,total_daya='$total_daya' ,nilai='$value' WHERE id_device_pb='$id_device_pb'";

 if($koneksi->query($sql) === TRUE){
  	echo "<script>
  	location.href='../datadevicepb.php';
  	</script>";
 }else{
  	echo "Error updating record: " . $koneksi->error;
 }
?>