<?php
include('includes/config.php');
$result=mysqli_query($conn,"SELECT c.id,c.name, COUNT(s.heading) FROM courses c LEFT JOIN subjects s ON c.id = s.c_id GROUP BY c.id");
// SELECT name, count(c_id) FROM subjects INNER JOIN courses ON subjects.c_id = courses.id GROUP BY subjects.c_id


  $colours = array("bg-card-red"=>"red", "bg-card-blue"=>"blue", "bg-card-green"=>"green");

while($data = mysqli_fetch_row($result))
{   
  $col=array_rand($colours,1);
    echo '<div class="col-md-3 grid-margin mb-3">
     <a href="play_video.php?c='.$data[0].'" >
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