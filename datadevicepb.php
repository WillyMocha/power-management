<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{
?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <link rel="shortcut icon" href="images/logo.png">
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Power Management</title>
    <link rel="shortcut icon" href="img/icon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link type="text/css" href='datatabel/jquery.dataTables.min.css' rel='stylesheet'>
    <link type="text/css" href='datatabel/responsive.dataTables.min.css' rel='stylesheet'>
    <link type="text/css" href='datatabel/buttons.dataTables.min.css' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">
   <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables_themeroller.css"> -->
   

  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include('include/header.php');?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include('include/sidebar.php');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1> Data Device Pascabayar</h1>
        </div>
        <div class="button-tambah">
        <a href="proses/form_tambah_devicepb.php"><input type="submit" name="login" value="Tambah Device Pascabayar" class="btn btn-block" style="background-color:gray;width:200px;font-family:calibri light"></a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
             <?php if(isset($_GET['del']))
             {?>
              <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong></strong>   <?php echo htmlentities($_SESSION['msg']);?>
              </div>
            <?php } ?>
            <table id="example" class="display responsive nowrap" style="width:100%">
              <thead style="text-align:center">
                <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Daya (Watt)</th>
                <th>Jumlah</th>
                <th>Jam</th>
                <th>Total Daya</th>
                <th>Prioritas</th>
                <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  if(isset($_SESSION['alogin'])){
                    try{
                      $username 	= $_SESSION['alogin'];
                      $sql = "SELECT id_device_pb, nama, daya, jumlah, jam, prioritas, total_daya from device_pb WHERE username='$username'";
                      $query = $dbh -> prepare($sql);
                      $query->execute();
                      $results=$query->fetchAll(PDO::FETCH_OBJ);
                      $cnt=1;
                    }catch(PDOException $e){
                      echo "Error showing record: " . $e->getMessage();
                    }
                  }
                  if($query->rowCount() > 0)
                  {
                    foreach($results as $result)
                      {       ?>  
                        <tr style="text-align:center">
                          <td><?php echo htmlentities($result->id_device_pb);?></td>
                          <td><?php echo htmlentities($result->nama);?></td>
                          <td><?php echo htmlentities($result->daya);?></td>
                          <td><?php echo htmlentities($result->jumlah);?></td>
                          <td><?php 
                                if ($result->jam == 0){
                                  echo 'Auto';
                                }else{
                                  echo htmlentities($result->jam);
                                } 
                              ?>
                          </td>
                          <td><?php echo htmlentities($result->total_daya);?></td>
                          <td><?php echo htmlentities($result->prioritas);?></td>
                          <td>&nbsp;&nbsp;
                            <a href="proses/form_editdpb.php?id_device_pb=<?php echo $result->id_device_pb;?>"> <button type="button" class="btn btn-warning">Edit</button></a>
                            <a href="proses/hapusdata_devicepb.php?del=<?php echo $result->id_device_pb;?>" onclick="return confirm('Do you want to delete');"><button type="button" class="btn btn-danger">Delete</button></a>
                        </tr>
                        <?php $cnt=$cnt+1; }} ?>
              </tbody>
            </table>
              <?php
                foreach($dbh->query('SELECT SUM(total_daya) FROM device') as $row){
                  //https://www.sepulsa.com/blog/biaya-dan-tarif-listrik-per-kwh-2018
                  //http://ngelistrik.com/2018/10/06/apa-itu-kwh/
                  $tdwatt = $row['SUM(total_daya)'];
                  echo("Total Daya Perangkat: ");
                  echo($tdwatt);
                  echo(" kWh");
                  echo "<br>";
                  $tagihan_h = $tdwatt*1467.28;
                  echo("Biaya Tagihan Listrik/Jam: Rp.  ");
                  echo ceil($tagihan_h);
                  echo "<br>";
                  echo("Biaya Tagihan Listrik/Bulan: Rp.  ");
                  $tagihan_b = $tagihan_h*30;
                  echo ceil($tagihan_b);
                  echo "<br>";
               }
               ?>
            <a>*Jika Jam Penggunaan Setiap Perangkat Elektronik adalah 1 Jam</a>
          </div>
        </div>
      </div>
      
      </main>
      <!-- Essential javascripts for application to work-->
      <script src="js/jquery-3.2.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/main.js"></script>
      <!-- The javascript plugin to display page loading on top-->
      <script src="js/plugins/pace.min.js"></script>
      <!-- Page specific javascripts-->
      <!-- Google analytics script-->
      <script src="datatabel/jquery.dataTables.min.js"></script>
      <script src="datatabel/dataTables.responsive.min.js"></script>
      <script src="datatabel/dataTables.buttons.min.js"></script>
      <script src="datatabel/buttons.colVis.min.js"></script>
      <script>
      $(document).ready(function() {
        $('#example').DataTable( {
          // dom: 'Bfrtip',
          // buttons: [
          // 'colvis'
          // ],
          "pagingType": "full_numbers",
        } );
        // $("#example").DataTable();
      } );
    </script>

  </body>
  </html>
  <?php } ?>