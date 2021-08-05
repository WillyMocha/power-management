<?php
session_start();
error_reporting(0);
include('include/config.php');

date_default_timezone_set("Asia/Jakarta");
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
          <h1> Status Device</h1>
          <h1><?php echo date("d-m-Y || H:i:sa");?></h1>
        </div>
        <!--<div class="button-tambah">
          <a href="proses/cek_status.php"><input type="submit" name="login" value="Cek Status Terbaru" class="btn btn-block" style="background-color:gray;width:200px;font-family:calibri light"></a>
        </div>-->
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
                <th>Status</th>
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
                      $sql = "SELECT device.nama, status.status FROM device JOIN status ON device.prioritas=status.prioritas";
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
                        <td>
                          <?php 
                            if($result->status==1){
                              echo "ON";
                            }else{
                              echo "OFF";
                            }
                          ?></td>
                        <?php if($_SESSION['level'] === '1'): ?>
                        <td class="d-flex justify-content-center">&nbsp;&nbsp;
                        <a href="proses/form_editnb.php?kd_stasiun=<?php echo $result->kd_stasiun;?>"> <button type="button" class="btn btn-warning mr-2">Edit</button></a>
                        <a href="proses/hapusnb.php?del=<?php echo $result->kd_stasiun;?>" onclick="return confirm('Do you want to delete');"><button type="button" class="btn btn-danger">Delete</button></a>
                        <?php endif;?>
                      </tr>
                      <?php $cnt=$cnt+1; }} ?>
              </tbody>
            </table>
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