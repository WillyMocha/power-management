<?php
session_start();
error_reporting(0);
include('include/config.php');
include('koneksi.php');

$id_device=$_GET['id_device'];
$query = "SELECT  id_device, nama, daya, jumlah, jam, prioritas, total_daya from device where id_device='$id_device'"; 
$result = mysqli_query($koneksi, $query) or die ( mysqli_error());
$row = mysqli_fetch_assoc($result);

// function fetchOutcome(){
//   $sql = "SELECT * FROM outcome";
//   $res = $koneksi->query($sql);
  
// }

if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{

  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <link rel="shortcut icon" href="../images/logo.png">
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>Edit Data</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link type="text/css" href='datatabel/jquery.dataTables.min.css' rel='stylesheet'>
    <link type="text/css" href='datatabel/responsive.dataTables.min.css' rel='stylesheet'>
    <link type="text/css" href='datatabel/buttons.dataTables.min.css' rel='stylesheet'>

  </head>
  <body class="app sidebar-mini rtl">
    <!-- Navbar-->
    <?php include('../include/header.php');?>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <?php include('../include/sidebar.php');?>
    <main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-pencil"></i> Edit Data </h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            <div class="tile-body">
              <form method="post" name="editdata" action="editdata.php">
               <div class="row">
                 <div class="col-md-6">
                    <label class="control-label">ID Device</label>
                    <input type="text" class="form-control" name="id_device" value="<?php echo $row['id_device']; ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Nama Device</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $row['nama']; ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Daya</label>
                    <input type="text" class="form-control" name="daya" value="<?php echo $row['daya']; ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Jumlah</label>
                    <input type="text" class="form-control" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
                  </div><div class="col-md-6">
                    <label class="control-label">Jam</label>
                    <input type="text" class="form-control" name="jam" value="<?php echo $row['jam']; ?>" required>
                  </div>
                  <div class="col-md-6">
                    <label class="control-label">Prioritas</label>
                    <input type="text" class="form-control" name="prioritas" value="<?php echo $row['prioritas']; ?>" required>
                  </div>
               </div>      
                  <!-- <div class="col-md-6">
                    <label class="control-label">Outcome</label>
                    <select name="id_outcome" class="form-control">
                      <?php 
                      $sql = "SELECT * FROM outcome";
                      $res = $koneksi->query($sql);
                        if($res->num_rows > 0){
                          while($row = $res->fetch_assoc()){
                            echo "<option value='".$row['id_outcome']."'>".$row['id_outcome'] ." - ".$row['outcome']."</option>";
                          }
                        }
                        ?>
                    </select>
                  </div> -->
               </div>
              </div>
                <div class="form-group mt-3">
                  <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Submit</button>
                </div>
              </form>
            </div>

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
        dom: 'Bfrtip',
        buttons: [
        'colvis'
        ]
      } );
    } );
  </script>

</body>
</html>
<?php } ?>