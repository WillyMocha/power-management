<?php
session_start();
include('include/config.php');
if(isset($_POST['login']))
{
  $username=$_POST['username'];
  $pass=($_POST['pass']);
  $sql ="SELECT username, pass FROM login WHERE username=:username and pass=:pass";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':username', $username, PDO::PARAM_STR);
  $query-> bindParam(':pass', $pass, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);

  if($query->rowCount() > 0)
  {
    $_SESSION['alogin']=$_POST['username'];
    echo "<script type='text/javascript'> document.location = 'datatk.php'; </script>";
  } else{
    echo "<script>alert('Invalid Details');</script>";
  }
}

if (isset($_POST['regist'])) {
  try {
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $sqlregist = $dbh->prepare("INSERT INTO login VALUES (null, '2', ?, ?)");
    $sqlregist-> execute([$username, $password]);
    echo "<script>
    alert('Sukses!');
    </script>";
  } catch (PDOException $e) {
    echo "Error updating record: " . $e->getMessage();
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="login/css/main.css">
  <link rel="stylesheet" type="text/css" href="login/css/sign_up.css">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Power Management</title>
  <link rel="shortcut icon" href="img/icon.png">

</head>
<body>
  <section class="material-half-bg">
    <div class="cover">
    </div>

  </section>
  <section class="login-content">
    <div class="login-box">

      <form class="login-form" method="post">
        <a class="brand" href="../power_management/index.php">
          <div class="thumbnail"><center><img src="login/img/logo1.png" height="130"/></center></div>
        </a>
          <div class="form-group">
            <input class="form-control"  name="username" type="text" placeholder="Username" autofocus>
          </div>
          <div class="form-group">
            <input class="form-control" type="password"  name="pass" placeholder="Password">
          </div>
          <br/>
          <div class="form-group btn-container">
            <button type="submit" name="login" class="btn btn-info btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>SIGN IN</button>
          </div>
          <button onclick="document.getElementById('id01').style.display='block'" class="btn-signup" type="button">Sign Up</button>
        </form>
        <!-- The Modal (contains the Sign Up form) -->
        <div id="id01" class="modal">
          <form class="modal-content" method="POST" action=<?php echo $_SERVER['PHP_SELF'] ?>>
            <div class="container">
              <hr>
              <label for="email"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" required>
              <label for="psw"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="pass" required>
              <div class="clearfix">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <button type="submit" class="btnsignup" name="regist">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <footer class="page-footer font-small mdb-color lighten-3 pt-4">
    <!-- Copyright -->

    <!-- <div class="footer-copyright text-center py-3"><font color="white">Powered by</font><br/><br/>
      <a class="brand" href="https://telkomuniversity.ac.id/">
          <div class="thumbnail"><center><img src="login/img/telu.png" height="50"/></center></div></a>
    </div> -->
    <div class="footer-copyright text-center text-white py-3">Powered by
    <a href="https://telkomuniversity.ac.id/"> Telkom University</a>
    </div>
    </footer>
    <!-- Essential javascripts for application to work-->
    <script src="login/js/jquery-3.2.1.min.js"></script>
    <script src="login/js/popper.min.js"></script>
    <script src="login/js/bootstrap.min.js"></script>
    <script src="login/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="login/js/plugins/pace.min.js"></script>
    

    <script type="text/javascript">
      // Login Page Flipbox control
      $('.login-content [data-toggle="flip"]').click(function() {
      	$('.login-box').toggleClass('flipped');
      	return false;
      }); 
    </script>
  </body>
  </html>