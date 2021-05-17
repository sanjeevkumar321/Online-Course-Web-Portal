<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');}
    ?>
<html lang="en"><head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
 <link href="css/style.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
<style type="text/css">
    .spinner {
  width: 200px;
  height: 200px;
}

.spinner svg {
  width: 100%;
  height: 100%;
  overflow: visible;
  animation: rotation 1455ms infinite linear;
}

.spinner circle {
  stroke: currentColor;
  stroke-dasharray: 44px;
  stroke-dashoffset: 11px;
  transform-origin: center;
  transform: rotatey(180deg) rotate(90deg);
  animation: spinner 3850ms infinite ease;
}

@keyframes spinner {
  0% {
    stroke-dashoffset: 33px;
    transform: rotatey(0deg) rotate(0deg);
  }
  25% {
    stroke-dashoffset: 11px;
    transform: rotatey(0deg) rotate(0deg);
  }
  25.0001% {
    stroke-dashoffset: 11px;
    transform: rotatey(180deg) rotate(270deg);
  }
  50% {
    stroke-dashoffset: 33px;
    transform: rotatey(180deg) rotate(270deg);
  }
  50.0001% {
    stroke-dashoffset: 33px;
    transform: rotatey(0deg) rotate(180deg);
  }
  75% {
    stroke-dashoffset: 11px;
    transform: rotatey(0deg) rotate(180deg);
  }
  75.0001% {
    stroke-dashoffset: 11px;
    transform: rotatey(180deg) rotate(90deg);
  }
  100% {
    stroke-dashoffset: 33px;
    transform: rotatey(180deg) rotate(90deg);
  }
}

@keyframes rotation {
  100% {
    transform: rotate(360deg);
  }
}

/* Template CSS */

html, body {
  height: 100%;
  font-family: sans-serif;
}

.content {
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  color: hsl(328deg 100% 54%);
}
</style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
         <?php include "includes/sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
               <?php include "includes/navbar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-3" style="overflow: auto; height: 600px;">
                         <?php 

                            if(isset($_GET['c']))
                            {
                                $c = mysqli_real_escape_string($conn, $_GET['c']);
                                $sql="select * from courses where category='$c'";
                               $result=mysqli_query($conn,$sql);
                               while($data = mysqli_fetch_row($result))
                                {  
                                    echo ' <div class="card mb-2 py-2 border-left-info" onclick=seturl("'.$data[1].'","'.$data[2].'","'.$data[3].'");>
                                            <div class="card-body">
                                             '.$data[1].'
                                            </div>
                                          </div>';
                                }
                            }



                         ?>
                        </div>      
                        <div class="col-md-9" id="video" style="overflow: auto; height: 600px;">   

                                 <div class="content" id="videolorder">
                                  <div class="spinner">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="8" cy="8" r="7" stroke-width="2"/>
                                    </svg>
                                  </div>
                                </div>              
            <div id="videocontener" style="display: none;">
                <iframe id="youtubevideo" width="100%" height="80%" src="https://youtu.be/G0yrccheSac" frameborder="0" allowfullscreen></iframe>
                <h1 id="heading"></h1>
                <p id="des"></p>
            </div>
                        </div>                      
                    </div>

                    <!-- Content Row -->

                    

                    <!-- Content Row -->
                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<!-- footer -->
 <?php include "includes/footer.php" ?>
 
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

<script type="text/javascript">
    function seturl(hed,des,url){
        $("#videolorder").show();
        $("#videocontener").hide();
        document.getElementById('youtubevideo').src = url;
         // $("#video").html('<iframe id="youtubevideo" width="100%" height="100%" src="'+url+'" frameborder="0" allowfullscreen></iframe>');
         

$("#heading").text(hed);
$("#des").text(des);
    }
    $('#youtubevideo').on( 'load', function() {
   $("#videolorder").hide();
$("#videocontener").show();
});
</script>

</body></html>