<?php
  include("./koneksi.php");
  session_start();
  if(isset($_SESSION['alogin']))
  {
      $username 	= $_SESSION['alogin'];
  }
?>
<aside class="app-sidebar">
  <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/users.png" height="50" height="50" alt="User Image">
    <div>
      <p class="app-sidebar__user-name"><a href="#" class="badge badge-secondary" id="demoNotify"><?php echo ($username); ?></a></p>
    </div>
  </div>
  <ul class="app-menu">
    <!--<li><a class="app-menu__item " href="/power_management/dashbord.php"><i class="app-menu__icon fa fa-home"></i><span class="app-menu__label">Dashboard</span></a></li>-->
    <li><a class="app-menu__item " href="/power_management/datatk.php"><i class="app-menu__icon fa fa-hdd-o"></i><span class="app-menu__label">Device Token</span></a></li>
    <li><a class="app-menu__item " href="/power_management/datadevicepb.php"><i class="app-menu__icon fa fa-hdd-o"></i><span class="app-menu__label">Device Pacabayar</span></a></li>
    <li><a class="app-menu__item " href="/power_management/token.php"><i class="app-menu__icon fa fa-flash"></i><span class="app-menu__label">Token</span></a></li>
    <li><a class="app-menu__item " href="/power_management/datapb.php"><i class="app-menu__icon fa fa-money"></i><span class="app-menu__label">Pascabayar</span></a></li>
    <li><a class="app-menu__item " href="/power_management/dataprioritas.php"><i class="app-menu__icon fa fa-power-off"></i><span class="app-menu__label">Status Device</span></a></li>
    <li><a class="app-menu__item " href="/power_management/datarekomendasi.php"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Rekomendasi</span></a></li>
    <li><a class="app-menu__item" href="/power_management/logout.php"><i class="app-menu__icon fa fa-sign-out"></i><span class="app-menu__label">Logout</span></a></li>       
  </ul>
  <!-- Footer -->
  <footer class="page-footer font-small indigo">
    <!-- Copyright -->
    <!-- <div class="footer-copyright text-center py-3"><font color="white">Powered by</font><br/><br/>
      <a class="brand" href="https://telkomuniversity.ac.id/">
          <div class="thumbnail"><center><img src="login/img/telu.png" height="100"/></center></div></a>
    </div> -->
    <!-- Copyright -->
    <div class="footer-copyright text-center text-white-50 py-3">Powered by
    <a href="https://telkomuniversity.ac.id/"> Telkom University</a>
  </div>
  </footer>
  <!-- Footer -->
  
  
</aside>


