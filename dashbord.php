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
        <link rel="stylesheet" type="text/css" href="admin/assets_/css/bootstrap.css">
        <link rel="shortcut icon" href="images/electricity.png">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
        <!-- Open Graph Meta-->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="Vali Admin">
        <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
        <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
        <title>Power Management</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.111/css/jquery.dataTables.min.css">

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
          <h1>Dashboard</h1>
        </div>
      </div>
      <div class="row">
      <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <canvas id="myChart"></canvas>
                <canvas id="myChart1"></canvas>
                <canvas id="myChart2"></canvas>
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
<script src="js/chart.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="js/plugins/pace.min.js"></script>
<script>   
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['2014','2015','2016','2017','2018',],
        datasets: [{
            label: 'Konservasi',
            data: [34,117,144,100,119],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Pendidikan',
            data: [23,95,81,65,93],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Wisata',
            data: [4,79,31,31,53],
            backgroundColor: [
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)'
            ],
            borderColor: [
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)'
            ],
            borderWidth: 1
        },
    ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        title:{
            display:true,
            text: "Data Aktual",
            fontSize: 18,
            fontColor: "#000"
        }
    }
});
</script>
<script>
var ctx = document.getElementById('myChart1').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['2014','2015','2016','2017','2018',],
        datasets: [{
            label: 'Konservasi',
            data: [34,119,154,100,130],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Pendidikan',
            data: [24,96,69,66,86],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Wisata',
            data: [3,76,33,30,50],
            backgroundColor: [
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)'
            ],
            borderColor: [
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)'
            ],
            borderWidth: 1
        },
    ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        title:{
            display:true,
            text: "Data KNN",
            fontSize: 18,
            fontColor: "#000"
        }
    }
});
</script>
<script>
var ctx = document.getElementById('myChart2').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['2014','2015','2016','2017','2018'],
        datasets: [{
            label: 'Konservasi',
            data: [39,138,166,117,155],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Pendidikan',
            data: [15,69,53,42,59],
            backgroundColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
        },
        {
            label: 'Wisata',
            data: [7,82,37,37,52],
            backgroundColor: [
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)'
            ],
            borderColor: [
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)',
                'rgba(1, 255, 5, 1)'
            ],
            borderWidth: 1
        },
    ]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        },
        title:{
            display:true,
            text: "Data Naive Bayes",
            fontSize: 18,
            fontColor: "#000"
        }
    }
});
</script>
</body>
</html>
<?php } ?>