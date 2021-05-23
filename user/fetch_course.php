<?php
include('includes/config.php');
session_start();
$sql="SELECT  courses.id,courses.name, count(c_id) FROM subjects INNER JOIN courses ON subjects.c_id = courses.id where ".$_SESSION["courses_query"]." GROUP BY subjects.c_id;";
// echo($sql);
$result=mysqli_query($conn,$sql);

  $colours = array("bg-card-red"=>"red", "bg-card-blue"=>"blue", "bg-card-green"=>"green");

while($data = mysqli_fetch_row($result))
{   
  $col=array_rand($colours,1);
    echo '<div class="col-md-3 grid-margin mb-3">
    <a href="play_video.php?c='.base64_encode(base64_encode($data[0])).'" >
                <div class="card '.$col.' card-img-holder text-white">
                  <div class="card-body">
                    <img src="img/circle.svg" class="card-img-absolute" alt="circle-image">
                    <h4 class="font-weight-normal mb-3">'.$data[1].'<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">'.$data[2].'</h2>
                  </div>
                </div>
                </a>
              </div>
             ';
}

?>