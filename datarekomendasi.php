<?php
session_start();
error_reporting(0);
include('include/config.php');
// include('proses/hitung.php');
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
    <!-- Twitter meta-->
    <title>Power Management</title>
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
          <h1> Rekomendasi </h1>
        </div>
        <div class="button-tambah" style="padding-left:650px" >
          <a href="proses/hitung.php"><input type="submit" name="login" value="Hitung" class="btn btn-block" style="background-color:gray;width:200px;font-family:calibri light"></a>
        </div>
        <div class="button-tambah">
          <a href="proses/kirim.php"><input type="submit" name="login" value="Apply" class="btn btn-block" style="background-color:gray;width:200px;font-family:calibri light"></a>
        </div>
        <?php
          if($_SESSION['level'] === '1'):
        ?>
        <div class="button-tambah">
        <!-- <a href="proses/form_tambah.php"><input type="submit" name="login" value="Tambah Data" class="btn btn-block" style="background-color:gray;width:200px;font-family:calibri light"></a> -->
         <?php  //include('include/modalCSV.php') ?> 
        </div>
          <?php endif;?>
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
              <thead>
                <tr>
                <th>Device</th>
                <th>Jam Demand</th>
                <th>Jam Rekomendasi</th>
                <?php
                  if($_SESSION['level'] === '1'):
                ?>
                <th class="text-center">Action</th>
                  <?php endif;?>
                </tr>
              </thead>
              <tbody>
                <?php 
                if(isset($_SESSION['alogin'])){
                    try{
                      $username   = $_SESSION['alogin'];
                      $sql = "SELECT device_pb.nama, device_pb.jam, rekomendasi.jam_rek FROM device_pb JOIN rekomendasi ON device_pb.prioritas=rekomendasi.prioritas";
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
                      <tr>
                        <td><?php echo htmlentities($result->nama);?></td>
                        <td><?php 
                                if ($result->jam == 0){
                                  echo 'Auto';
                                }else{
                                  echo htmlentities($result->jam);
                                } 
                              ?>
                        </td>
                        <td><?php echo htmlentities($result->jam_rek);?></td>
                        <?php if($_SESSION['level'] === '1'): ?>
                        <td class="d-flex justify-content-center">&nbsp;&nbsp;
                        <a href="proses/form_editnb.php?kd_stasiun=<?php echo $result->kd_stasiun;?>"> <button type="button" class="btn btn-warning mr-2">Edit</button></a>
                        <a href="proses/hapusnb.php?del=<?php echo $result->kd_stasiun;?>" onclick="return confirm('Do you want to delete');"><button type="button" class="btn btn-danger">Delete</button></a>
                        <?php endif;?>
                      </tr>
                      <?php $cnt=$cnt+1; }} ?>
              </tbody>
            </table>
              <?php
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
                  echo "* Jika jam demand 24 jam untuk semua device, maka hanya kuat untuk : ";
                  echo ceil ($hari);
                  echo " hari";
              } 
              ?>
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
          "pagingType": "full_numbers"
        } );
        // $("#example").DataTable();
      } );
    </script>

  </body>
  </html>
  <?php } ?>