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
      if(!empty($_POST['course'])) { 
   
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $dept = mysqli_real_escape_string($conn, $_POST['dept']);
    $batch = mysqli_real_escape_string($conn, $_POST['batch']);
    $courses= json_encode($_POST['course']);
    // $slno='';   
     
         

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

if (isset($_POST['editsubmit'])) {
    // $slno='';   
       if(!empty($_POST['editcourse'])) { 
         $id = mysqli_real_escape_string($conn, $_POST['editid']);
    $editusername = mysqli_real_escape_string($conn, $_POST['editusername']);
    $editpass = mysqli_real_escape_string($conn, $_POST['editpassword']);
    $editname = mysqli_real_escape_string($conn, $_POST['editname']);
    $editdept = mysqli_real_escape_string($conn, $_POST['editdept']);
    $editbatch = mysqli_real_escape_string($conn, $_POST['editbatch']);
    $editcourses= json_encode($_POST['editcourse']);
         
   $sql = "UPDATE `users` SET `name`='" . $editname . "',`dept`='" . $editdept . "',`username`='" . $editusername . "',`password`='" . $editpass . "',`batch`='" . $editbatch . "',`courses`='" . $editcourses . "' where id='" . $id . "'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['msg'] = "update successfully";
      header('location:#');
    } else {
        $_SESSION['msg'] = "erro";
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <!-- <h1 class="h3 mb-0 text-gray-800">Add user</h1> -->
                      
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
                                        $result=mysqli_query($conn,"select * from batch where status =1");
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
                                        $result=mysqli_query($conn,"select * from courses where status =1");
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


<div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form  id="editform" action="" method="post">
             <div class="form-group row">
                 <input type="text" id="editid" name="editid"  hidden>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                       <label for="editname">Name</label>
                                        <input type="text" class="form-control form-control-user" id="editname" name="editname" placeholder="name" required>
                                    </div>
                                    <div class="col-sm-6">
                                         <label for="editdept">Department</label>
                                   <input type="text" class="form-control form-control-user" id="editdept" name="editdept" placeholder="Department" required>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                     <div class="form-group col-md-6">
                                        <label for="editusername">username</label>
                                        <input type="text" class="form-control" id="editusername" name="editusername" placeholder="username" required>
                                     </div>
                                    <div class="col-sm-6">
                                       <label for="editpassword">Password</label>
                            <input type="text" class="form-control" id="editpassword" name="editpassword" placeholder="editpassword" required>

                                    </div>
                                </div>

                                <div class="form-group row">
                                     <div class="form-group col-md-6">
                                         <label for="">Batch</label>
                                       <select  class="form-control" name="editbatch">
                                           <?php  
                                        $result=mysqli_query($conn,"select * from batch where status =1");
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
                                        $result=mysqli_query($conn,"select * from courses where status =1");
                                        while($data = mysqli_fetch_row($result))
                                        {   
                                        echo '
                                            <div class="form-check pl-5">
                                            <input type="checkbox" class="edit-form-check-input" id='.$data[0].' value="'.$data[0].'" name="editcourse[]">
                                            <label class="form-check-label" for="exampleCheck1">'.$data[1].'</label>
                                          </div>

                                        ';
                                        }
                                    ?>
                                     </div>
                                </div>
                                                 
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="editsubmit">update</button>
      </div>
       
    </div>
  </div>
</div>
</form>
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
    $('input[name="editcourse[]"]').each(function() {this.checked = false;});
 var userdata="userdata";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_users.php",           
        data: {action:userdata,id:id},  
        dataType:"json",           
        success: function(response){                    
        console.log(response);
            var myArray = JSON.parse(response[0].courses);
              
                $('.edit-form-check-input').filter(function () {    
                if (myArray.indexOf(this.id) != -1)
                return $(this).closest('div').find(':checkbox');
                }).prop("checked", true);

                    $("#editid").val(response[0].id);
                    $("#editname").val(response[0].name);
                     $("#editdept").val(response[0].dept);
                     $("#editusername").val(response[0].username);
                     $("#editbatch").val(response[0].batch);
                      $("#editpassword").val(response[0].password);
                   $('#editmodal').modal("show");
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
// function view(course){
//           var myArray = course;
//         // console.log(course);
//         alert(myArray);
// }

function active(id){
var active="active";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_users.php",             
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
        url: "action/action_users.php",             
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