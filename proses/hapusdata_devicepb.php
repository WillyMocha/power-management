<?php
// $koneksi= new mysqli("localhost","root","","lipi");
 
// // Check connection
// if ($koneksi->connect_errno){
// 	die("Connection failed: " . $koneksi->connect_error);
// }
include("./koneksi.php");

$id_device_pb = $_GET['del'];

$sql = "DELETE FROM device_pb WHERE id_device_pb='$id_device_pb'";

if($koneksi->query($sql) === TRUE){
	echo "<script>
	location.href='../datadevicepb.php';
	</script>";
}else{
	 echo "Error deleting record: " . $koneksi->error;
}
?>