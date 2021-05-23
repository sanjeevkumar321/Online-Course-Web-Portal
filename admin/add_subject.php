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
    $slno='';    
    $heading = mysqli_real_escape_string($conn, $_POST['heading']);
    $date = strtotime(mysqli_real_escape_string($conn, $_POST['date']));
    $new_date = date("d-m-Y", $date);
    $desc = mysqli_real_escape_string($conn, $_POST['desc']);
    $vlink = $_POST['vlink'];
    $category = mysqli_real_escape_string($conn, $_POST['category']);



    $sql = "INSERT INTO `subjects`( `heading`, `des`, `link`, `c_id`, `create_on`) VALUES ('" . $heading . "','" . $desc . "','" . $vlink . "','" . $category . "','" . $new_date . "')";

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
                                        <input type="date" data-date="dd mm yyyy"  class="form-control form-control-user" id="date" name="date" placeholder="Date" required>
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
                                        <?php
                                            $query = "SELECT * FROM courses";
                                            $results=mysqli_query($conn, $query);
                                            //loop
                                            foreach ($results as $courses){
                                        ?>
                                                <option value="<?php echo $courses["id"];?>"><?php echo $courses["name"];?></option>
                                        <?php
                                            }
                                        ?>
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
                    
                     <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">All Subject</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Sl no</th>
                                            <th>Heading</th>
                                            <th>Desc</th>
                                            <th>Link</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                           
                                        </tr>
                                    </thead>

                                    <tbody id="fetchdata">
                                       
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->


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
        <form  id="editform">
                                <div class="form-group row">
                                    <input type="text" id="editid"  hidden>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                       <label for="editheading">Heading</label>
                                        <input type="text" class="form-control form-control-user" id="editheading" name="editheading" placeholder="Heading" required>
                                    </div>
                                    <div class="col-sm-6">
                                         <label for="editdate">Date</label>
                                        <input type="date" data-date="dd mm yyyy"  class="form-control form-control-user" id="editdate" name="editdate" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                     <label for="editdesc">Description</label>
                                   <textarea class="form-control" id="editdesc" name="editdesc" rows="3" required></textarea>
                                </div>
                                <div class="form-group row">
                                     <div class="form-group col-md-6">
                                        <label for="editvlink">Video Link</label>
                                        <input type="text" class="form-control" id="editvlink" name="editvlink" required>
                                     </div>
                                    <div class="col-sm-6">
                                       <label for="editcourse">Category</label>
                                        <select id="editcourse" name="editcourse" class="form-control" required>
                                        <option selected>Choose...</option>
                                        <?php
                                            $query = "SELECT * FROM courses";
                                            $results=mysqli_query($conn, $query);
                                            //loop
                                            foreach ($results as $courses){
                                        ?>
                                                <option value="<?php echo $courses["id"];?>"><?php echo $courses["name"];?></option>
                                        <?php
                                            }
                                        ?>
                                    </select>
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
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_subject.php",             
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
function deletedata(id){
var deletedata="delete";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_subject.php",             
        data: {action:deletedata,id:id},           
        success: function(response){                   
            alert(response);
            fetchdata();
        }

    });
}
function edit(id){

 var subjectdetails="subjectdetails";
     $.ajax({    //create an ajax request to display.php
        type: "POST",
        url: "action/action_subject.php",           
        data: {action:subjectdetails,id:id},  
        dataType:"json",           
        success: function(response){                    
            // console.log(response[0].id);
            $("#editid").val(response[0].id);
            $("#editheading").val(response[0].heading);
             $("#editdesc").val(response[0].des);
             $("#editvlink").val(response[0].link);
             $("#editcourse").val(response[0].c_id);
             var newdate = response[0].create_on.split("-").reverse().join("-");
             $("#editdate").val(newdate);
            $('#editmodal').modal("show");
        }

    });
}

function update(){
     var editid=$("#editid").val();
             var editheading=$("#editheading").val();
             var editdesc=$("#editdesc").val();
             var editvlink=$("#editvlink").val();
             var editcourse=$("#editcourse").val();
             var editdate=$("#editdate").val();

          var updatedata="updatedata";
          $.ajax({    
        type: "POST",
        url: "action/action_subject.php",             
        data: {action:updatedata,id:editid,editheading:editheading,editdesc:editdesc,editvlink:editvlink,editcourse:editcourse,editdate:editdate},           
        success: function(response){                   
            alert(response);
          //   $("#editid").val("");
          // $("#editname").val("");
          $('#editmodal').modal("hide");
            fetchdata();
        }

    });
}
</script>
<!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
</body></html>