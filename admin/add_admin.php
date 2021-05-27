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
     $name = mysqli_real_escape_string($conn, $_POST['name']);
      $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);



    $sql = "INSERT INTO `admin`( `name`, `dept`, `username`, `password`, `created_at`) VALUES 
             ('" . $name . "','" . $dept . "','" . $username . "','" . $pass . "','" . $currentTime . "')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "New record created successfully";
        echo '<script type="text/javascript"> 
    alert("Insert successfully"); 
    window.location.href = "add_admin.php";
   </script>';
    } else {
        $_SESSION['msg'] = "erro";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>


 <?php include "includes/header.php" ?>

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
                   <!--  <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Admin</h1>
                        
                    </div> -->

                    <!-- Content Row -->
                    <div class="row justify-content-center">
                      
                    <div class="col-lg-10">
                        <div class="p-5">
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
                                 <hr>
                                <div class="row justify-content-center">
                                    <button name="submit" class="btn btn-bg text-white">Add Admin</button>
                                </div>
                            </form>
                        </div>
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
                                            <th>Usename</th>
                                          <th style="text-align: center;">Action</th>
                                           
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
  
<!-- modal -->
<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="editform">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                       <label for="editname">Name</label>
                                        <input type="text" class="form-control form-control-user" id="editname" placeholder="name" required>
                                          <input type="text" id="editid"  hidden>
                                    </div>
                                    <div class="col-sm-6">
                                         <label for="editdept">Department</label>
                                   <input type="text" class="form-control form-control-user" id="editdept" placeholder="Department" required>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                     <div class="form-group col-md-6">
                                        <label for="editusername">username</label>
                                        <input type="text" class="form-control" id="editusername"  placeholder="username" required>
                                     </div>
                                    <div class="col-sm-6">
                                       <label for="editpassword">Password</label>
                                     <input type="text" class="form-control" id="editpassword"  placeholder="password" required>

                                    </div>
                                </div>
                                
                            </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="update();">update</button>
      </div>
    </div>
  </div>
</div>


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
        url: "action/action_admin.php",             
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
        url: "action/action_admin.php",             
        data: {action:fetch,id:id},           
        success: function(response){                    
            alert(response);    
        }

    });

}
function edit(id){

 var admindetails="admindetails";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_admin.php",           
        data: {action:admindetails,id:id},  
        dataType:"json",           
        success: function(response){                    
            // console.log(response[0].id);
             $("#editid").val(response[0].id);
            $("#editname").val(response[0].name);
            $("#editdept").val(response[0].dept);
            $("#editpassword").val(response[0].password);
            $("#editusername").val(response[0].username);

            $('#editmodal').modal("show");
        }

    });
}
function deletedata(id){
var deletedata="delete";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_admin.php",             
        data: {action:deletedata,id:id},           
        success: function(response){                   
            alert(response);
            fetchdata();
        }

    });
}
function update(){
           var editid= $("#editid").val();
           var editname= $("#editname").val();
           var editdept= $("#editdept").val();
           var editpassword= $("#editpassword").val();
           var editusername= $("#editusername").val();
          var updatedata="updatedata";
          $.ajax({    
        type: "POST",
        url: "action/action_admin.php",             
        data: {action:updatedata,id:editid,editname:editname,editdept:editdept,editpassword:editpassword,editusername:editusername},           
        success: function(response){                   
            alert(response);
            $("#editid").val("");
          $("#editname").val("");
          $("#editdept").val("");
          $("#editpassword").val("");
          $("#editusername").val("");
          $('#editmodal').modal("hide");
            fetchdata();
        }

    });
}

function active(id){
var active="active";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_admin.php",             
        data: {action:active,id:id},           
        success: function(response){         
            alert(response);
            fetchdata();
        }

    });
}

function deactive(id){
    var deactive="deactive";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_admin.php",             
        data: {action:deactive,id:id},           
        success: function(response){                    
            alert(response);    
             fetchdata();  
        }

    });

}
</script>
  <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body></html>