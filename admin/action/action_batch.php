<?php

//action.php
extract($_POST);
include('../includes/config.php');

if(isset($_POST["action"]))
{
	if($_POST["action"] == "insert")
	{

		$sql = "INSERT INTO `batch`(`name`) VALUES ('".$_POST['name']."')";
			if (mysqli_query($conn, $sql)) {
			  echo "Inserted successfully";
			} else {
			  echo "Error " . mysqli_error($conn);
			}
	}
	if($_POST["action"] == "delete")
	{

		$sql = "DELETE FROM batch WHERE id=".$_POST["id"]."";

			if (mysqli_query($conn, $sql)) {
			  echo "Record deleted successfully";
			} else {
			  echo "Error deleting record: " . mysqli_error($conn);
			}
	}
	// fetch batch
	if($_POST["action"] == "fetch")
	{

				$data =  ''; 
				$btn='';

					$displayquery = "SELECT * FROM `batch`"; 
					$result = mysqli_query($conn,$displayquery);

						if(mysqli_num_rows($result) > 0){

							$number = 1;
							while ($row = mysqli_fetch_array($result)) {
								
									if($row['status']==1){
										$btn=' <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-primary" onclick="deactive('.$row['id'].')">
                                                            <i class="fas fa-eye"></i>
                                                        </button>'	;
									}
									else{
										$btn=' <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button type="button" class="btn btn-danger" onclick="active('.$row['id'].')">
                                                            <i class="fas fa-eye"></i>
                                                        </button>'	;
									}

								$data .= '<tr>  
									<td>'.$number.'</td>
									<td>'.$row['name'].'</td>
								
								<td style="text-align: center;">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                       '.$btn.'
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


	if($_POST["action"] == "coursedetails")
	{

		$result = mysqli_query($conn,"SELECT * FROM batch WHERE id=".$_POST["id"]."");
		$rows = array();
	while($temp = mysqli_fetch_assoc($result)) {
    $rows[] = $temp;
}
		echo json_encode($rows);
	}

	if($_POST["action"] == "updatedata")
	{
		$query = "UPDATE `batch` SET `name`='".$_POST['editname']."' WHERE id=".$_POST['id'].";";
		// echo $query;
		if (mysqli_query($conn, $query)) {
			  echo "update  successfully";
			} else {
			  echo "Error " . mysqli_error($conn);
			}
	}

if($_POST["action"] == "deactive")
	{
		$query = "UPDATE `batch` SET `status`=0  WHERE id=".$_POST['id'].";";
		// echo $query;
		if (mysqli_query($conn, $query)) {
			  echo "update  successfully";
			} else {
			  echo "Error " . mysqli_error($conn);
			}
	}
if($_POST["action"] == "active")
	{
		$query = "UPDATE `batch` SET `status`=1  WHERE id=".$_POST['id'].";";
		// echo $query;
		if (mysqli_query($conn, $query)) {
			  echo "update  successfully";
			} else {
			  echo "Error " . mysqli_error($conn);
			}
	}
	
}

?>