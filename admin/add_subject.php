<?php
session_start();
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
    header('location:index.php');
} else {
    date_default_timezone_set('Asia/Kolkata'); // change according timezone
    $currentTime = date('d-m-Y h:i:s A', time());
}

if (isset($_POST['submit'])) {
    // $slno='';    
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $vlink = mysqli_real_escape_string($conn, $_POST['vlink']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);



    $sql = "INSERT INTO `courses`(`heading`, `description`, `link`,`category`, `date`) VALUES ('" . $heading . "','" . $desc . "','" . $vlink . "','" . $category . "','" . $date . "')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "New record created successfully";
        header('location:add_course.php');
    } else {
        $_SESSION['msg'] = "erro";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

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

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
     <link href="css/style.css" rel="stylesheet">


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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                       
                    </div>

                    <!-- Content Row -->
                    <div class="row justify-content-center">
                        <?php if (isset($_POST['submit'])) { ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <?php echo htmlentities($_SESSION['msg']); ?>
                        <?php echo htmlentities($_SESSION['msg'] = ""); ?>
                    </div>
                <?php } ?>
                    <div class="col-lg-10">
                        <div class="p-5">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                       <label for="heading">Heading</label>
                                        <input type="text" class="form-control form-control-user" id="heading" name="heading" placeholder="Heading" required>
                                    </div>
                                    <div class="col-sm-6">
                                         <label for="date">Date</label>
                                        <input type="date" class="form-control form-control-user" id="date" name="date" placeholder="Date" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                     <label for="desc">Description</label>
                                   <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea>
                                </div>
                                <div class="form-group row">
                                     <div class="form-group col-md-6">
                                        <label for="vlink">Video Link</label>
                                        <input type="text" class="form-control" id="vlink" name="vlink" required>
                                     </div>
                                    <div class="col-sm-6">
                                       <label for="category">Category</label>
                                        <select id="category" name="category" class="form-control" required>
                                        <option selected>Choose...</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                    </div>
                                </div>
                                 <hr>
                                <div class="row justify-content-center">
                                    <button name="submit" class="btn btn-bg text-white">Add Course</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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



</body></html>