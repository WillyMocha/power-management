<?php
// $koneksi= new mysqli("localhost","root","","lipi");
 
// // Check connection
// if ($koneksi->connect_errno){
// 	die("Connection failed: " . $koneksi->connect_error);
// }
include("./koneksi.php");

$id_device = $_GET['del'];

$sql = "DELETE FROM device WHERE id_device='$id_device'";

if($koneksi->query($sql) === TRUE){
	echo "<script>
	location.href='../datatk.php';
	</script>";
}else{
	 echo "Error deleting record: " . $koneksi->error;
}
?>