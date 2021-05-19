<?php
include('includes/config.php');
session_start();
$sql="select id,name from courses  where ".$_SESSION["courses_query"].";";
$result=mysqli_query($conn,$sql);

  $colours = array("bg-card-red"=>"red", "bg-card-blue"=>"blue", "bg-card-green"=>"green");

while($data = mysqli_fetch_row($result))
{   
  $col=array_rand($colours,1);
    echo '<div class="col-md-3 grid-margin m-3">
    <a href="play_video.php?c='.$data[0].'" >
                <div class="card '.$col.' card-img-holder text-white">
                  <div class="card-body">
                    <img src="img/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">'.$data[1].'<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">'.$data[1].'</h2>
                  </div>
                </div>
                </a>
              </div>
             ';
}

?>