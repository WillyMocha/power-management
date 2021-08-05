<?php
session_start();
error_reporting(0);
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
{ 
  header('location:index.php');
}
else{
// Code for change password 
  if(isset($_POST['submit']))
  {
    $password=md5($_POST['password']);
    $newpassword=md5($_POST['newpassword']);
    $username=$_SESSION['alogin'];
    $sql ="SELECT Password FROM admin WHERE UserName=:username and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':username', $username, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0)
    {
      $con="update admin set Password=:newpassword where UserName=:username";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1-> bindParam(':username', $username, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      $_SESSION['msg']="Password Changed Successfully !!";
    }
    else {
      $_SESSION['msg']="Old Password not match !!";
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <link rel="shortcut icon" href="images/profile.png">
    <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Vali Admin">
    <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
    <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
    <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
    <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
    <title>PT. Kembar Abadi Prima</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript">
      function valid()
      {
       if(document.chngpwd.password.value=="")
       {
        alert("Current Password Filed is Empty !!");
        document.chngpwd.password.focus();
        return false;
      }
      else if(document.chngpwd.newpassword.value=="")
      {
        alert("New Password Filed is Empty !!");
        document.chngpwd.newpassword.focus();
        return false;
      }
      else if(document.chngpwd.confirmpassword.value=="")
      {
        alert("Confirm Password Filed is Empty !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      else if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
      {
        alert("Password and Confirm Password Field do not match  !!");
        document.chngpwd.confirmpassword.focus();
        return false;
      }
      return true;
    }
  </script>
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
        <h1><i class="fa fa-edit"></i> Change Password</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="tile">
          <div class="tile-body">
           <?php if(isset($_POST['submit']))
           {?>
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
            </div>
          <?php } ?>


          <form name="chngpwd" method="post" onSubmit="return valid();">
            <div class="form-group">
              <label type="password" name="password" class="control-label">Current Password</label>
              <input class="form-control" type="password" id="password" name="password" placeholder="Enter Current Password" required>
            </div>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input type="password" name="newpassword" class="form-control" id="newpassword" placeholder="Enter New Paswword" required>
            </div>
            <div class="form-group">
              <label class="control-label">Confirm New Password</label>
              <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="Enter your new Password again" required>
            </div>
            <div class="form-group">
              <button class="btn btn-primary" type="submit" name="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Change Password</button>
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

</body>
</html>
<?php } ?>