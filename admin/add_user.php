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
       if(!empty($_POST['course'])) { 
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $courses= json_encode($_POST['course']);
         
    $sql = "INSERT INTO `users`(`name`, `dept`, `username`, `password`, `batch`, `courses`) VALUES
     ('" . $name . "','" . $dept . "','" . $username . "','" . $pass . "','" . $batch . "','" . $courses . "')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "New record created successfully";
        header('location:#');
    } else {
        $_SESSION['msg'] = "erro";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


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
      <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">Add user</h1>
                      
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                           
                    </div>
                    
                        <div class="row justify-content-center">

                            <div class="col-xl-10 col-lg-10 col-md-9">
                              <form action="" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                       <label for="name">Name</label>
                                        <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="name" required>
                                    </div>
                                    <div class="col-sm-6">
                                         <label for="dept">Department</label>
                                   <input type="text" class="form-control form-control-user" id="dept" name="dept" placeholder="Department" required>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                     <div class="form-group col-md-6">
                                        <label for="username">username</label>
                                        <input type="text" class="form-control" id="username" name="username" placeholder="username" required>
                                     </div>
                                    <div class="col-sm-6">
                                       <label for="password">Password</label>
                                     <input type="text" class="form-control" id="password" name="password" placeholder="password" required>

                                    </div>
                                </div>

                                <div class="form-group row">
                                     <div class="form-group col-md-6">
                                         <label for="">Batch</label>
                                       <select  class="form-control" name="batch">
                                           <?php  
                                        $result=mysqli_query($conn,"select * from batch");
                                        while($data = mysqli_fetch_row($result))
                                        {   
                                        echo '
                                            <option value='.$data[1].'>'.$data[1].'</option>
                                        ';
                                        }
                                    ?>
                                       </select>
                                     </div>

                                      <div class="form-group col-md-6 row pt-4">
                                         <!-- <label>Courses</label><br> -->
                                    <?php  
                                        $result=mysqli_query($conn,"select * from courses");
                                        while($data = mysqli_fetch_row($result))
                                        {   
                                        echo '
                                            <div class="form-check pl-5">
                                            <input type="checkbox" class="form-check-input" id='.$data[0].' value="'.$data[0].'" name="course[]">
                                            <label class="form-check-label" for="exampleCheck1">'.$data[1].'</label>
                                          </div>

                                        ';
                                        }
                                    ?>
                                     </div>
                                </div>
                                 <hr>
                                <div class="row justify-content-center">
                                    <button name="submit" class="btn btn-bg text-white">Add Admin</button>
                                </div>
                            </form>

                                            
                            </div>

                        </div>
                    <!-- Content Row -->

                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Admin</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl no</th>
                                            <th>Name</th>
                                            <th>Dept</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Batch</th>
                                            <th>course</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>

                                    <tbody id="fetchdata">
                                       
                                    </tbody>
                                </table>

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
<script type="text/javascript">
    function fetchdata(){
        var fetch="fetch";
     $.ajax({    
        type: "POST",
        url: "action/action_users.php",             
        data: {action:fetch},           
        success: function(response){                    
            $("#fetchdata").html(response); 
            // alert(response);
              $('#dataTable').DataTable();
        }

    });
    }
$(document).ready(function() {             
     fetchdata();
});

function deactive(id){
    var deactive="deactive";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_users.php",             
        data: {action:fetch,id:id},           
        success: function(response){                    
            alert(response);    
        }

    });

}
function edit(id){
alert("abc");
 var userdata="userdata";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_users.php",           
        data: {action:userdata,id:id},  
        dataType:"json",           
        success: function(response){                    
        
            var myArray = JSON.parse(response[0].courses);
                
                $('.form-check-input').filter(function () {    
    if (myArray.indexOf(this.id) != -1)
          return $(this).closest('div').find(':checkbox');
}).prop("checked", true);
        }

    });
}

function deletedata(id){
var deletedata="delete";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_users.php",             
        data: {action:deletedata,id:id},           
        success: function(response){                   
            alert(response);
            fetchdata();
        }

    });
}
function view(course){
          var myArray = course;
        // console.log(course);
        alert(myArray);
}
</script>

 <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body></html>