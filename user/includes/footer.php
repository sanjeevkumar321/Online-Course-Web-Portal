            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <!-- <span>Copyright © Your Website 2021</span> -->
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top" style="display: none;">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Change password Modal-->
    <div class="modal fade" id="changepassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                 <form action="" method="post">
                <div class="modal-body">
                    
                                <div class="form-group">
                                    <div class="col-mb-12">
                                       <label for="name">New password</label>
                                        <input type="text" class="form-control form-control-user" id="newpassword" name="newpassword" placeholder="new password" required>
                                    </div>
                                     <div class="col-mb-12">
                                       <label for="name">confirm password</label>
                                        <input type="text" class="form-control form-control-user" id="cnewpassword" name="cnewpassword" placeholder="comfirm password" required>
                                    </div>
                                </div>
                             
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                   <input type="submit" class="btn btn-primary" name="changepassword" value="Change password">
                </div>
            </form>
            </div>
        </div>
    </div>
<?php
if (isset($_POST['changepassword'])) {
    $newpassword=mysqli_real_escape_string($conn,$_POST['newpassword']);
     $cnewpassword=mysqli_real_escape_string($conn,$_POST['cnewpassword']);

     if($newpassword == $cnewpassword)
     {
                                $sql="UPDATE `users` SET `password`='". $newpassword."'  WHERE id=".$_SESSION['uid']." ";
                               $result=mysqli_query($conn,$sql);
                               if ($result) {
                                  echo '<script>alert("Changed Succsfully")</script>';
                               }
                               else{
                                echo '<script>alert("Error")</script>';
                               }
     }
     else{
         echo '<script>alert("password did not match please try again")</script>';
     }

}
?>