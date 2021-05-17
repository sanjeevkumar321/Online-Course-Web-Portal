<?php
include('includes/config.php');
$result=mysqli_query($conn,"select name,count(name) from courses GROUP BY name");

  $colours = array("bg-card-red"=>"red", "bg-card-blue"=>"blue", "bg-card-green"=>"green");

while($data = mysqli_fetch_row($result))
{   
  $col=array_rand($colours,1);
    echo '<div class="col-md-3 grid-margin m-3">
                <div class="card '.$col.' card-img-holder text-white">
                  <div class="card-body">
                    <img src="img/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">'.$data[0].'<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">'.$data[1].'</h2>
                   <a href="http://localhost/technogenr/tutorial_training/new%20admin/startbootstrap-sb-admin-2-gh-pages/play_video.php?c='.$data[0].'" class="btn btn-light">Link</a>
                  </div>
                </div>
              </div>
             ';
}

?>