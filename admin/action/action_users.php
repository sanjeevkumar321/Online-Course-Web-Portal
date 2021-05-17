<?php

//action.php
extract($_POST);
include('../includes/config.php');

if(isset($_POST["action"]))
{
	
	if($_POST["action"] == "delete")
	{

		$sql = "DELETE FROM users WHERE id=".$_POST["id"]."";

			if (mysqli_query($conn, $sql)) {
			  echo "Record deleted successfully";
			} else {
			  echo "Error deleting record: " . mysqli_error($conn);
			}
	}
	// fetch users
	if($_POST["action"] == "fetch")
	{

				$data =  ''; 

					$displayquery = "SELECT * FROM `users`"; 
					$result = mysqli_query($conn,$displayquery);

						if(mysqli_num_rows($result) > 0){

							$number = 1;
							while ($row = mysqli_fetch_array($result)) {
								
								$data .= '<tr>  
									<td>'.$number.'</td>
									<td>'.$row['name'].'</td>
									<td>'.$row['dept'].'</td>
									<td>'.$row['username'].'</td>
									<td>'.$row['password'].'</td>
									<td>'.$row['batch'].'</td>
									<td>'.$row['courses'].'</td>
								
								<td>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-primary" onclick="deactive('.$row['id'].')">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger" onclick="deletedata('.$row['id'].')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-info" onclick="edit('.$row['id'].')">
                                                            <i class="fas fa-edit"></i>
                                                        </button>
                                                      </div>
                                                </td>
					    		</tr>';
					    		$number++;

							}
						} 
	
					 
				    	echo $data;
				       

	}


	if($_POST["action"] == "userdata")
	{

		$result = mysqli_query($conn,"SELECT * FROM users WHERE id=".$_POST["id"]."");
		$rows = array();
	while($temp = mysqli_fetch_assoc($result)) {
    $rows[] = $temp;
}
		echo json_encode($rows);
	}



	
}

?>