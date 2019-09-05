<?php 

include "db.php";

if(isset($_POST['readrecord'])){
	
	
	$response='<table class="table table-bordered table-striped">
		<tr>
			<th>No.</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Mobile</th>
			<th>Gender</th>
			<th>Country</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>';
		
	$displayQuery="Select * From crudtable";
	$result=mysqli_query($conn, $displayQuery);
	
	if(mysqli_num_rows($result)>0){
		
		$number=1;
		while($row=mysqli_fetch_array($result)){
			
			$response.='<tr>
				<td>'.$number.'</td>
				<td>'.$row['firstname'].'</td>
				<td>'.$row['lastname'].'</td>
				<td>'.$row['email'].'</td>
				<td>'.$row['mobile'].'</td>
				<td>'.$row['gender'].'</td>
				<td>'.$row['country'].'</td>
				<td>
					<button class="btn btn-success" onclick="GetUserDetails('.$row['id'].')">Edit</button>
				</td>
				<td>
					<button class="btn btn-danger" onclick="DeleteUser('.$row['id'].')">Delete</button>
				</td>
			</tr>';
			
			$number++;
		}
	}
	
	$response.='</table>';
	echo $response;
}

if(isset($_POST["addrecord"]))
{
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$gender=$_POST['gender'];
	$country=$_POST['country'];
	
	
	$insertQuery="Insert Into crudtable(firstname, lastname, email, mobile, gender, country) Values('$firstname', '$lastname', '$email', '$mobile', '$gender', '$country')";
	
	$result=mysqli_query($conn, $insertQuery);
	
	if($result){
		
		echo "1 record was added";
	}else{
		
		exit(mysqli_error());
	}
}	

if(isset($_POST["deleteId"])){
	
	$deleteId=$_POST["deleteId"];
	$deleteQuery="Delete From crudtable Where id='$deleteId'";
	mysqli_query($conn, $deleteQuery);
}

if(isset($_POST["updaterecord"])){
	
	$hiddenUserId=$_POST["hiddenUserId"];
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$email=$_POST['email'];
	$mobile=$_POST['mobile'];
	$gender=$_POST['gender'];
	$country=$_POST['country'];
	
	$updateQuery="Update crudtable Set firstname='$firstname', 
		lastname='$lastname', email='$email', mobile='$mobile', gender='$gender', country='$country' Where id='$hiddenUserId'";
	$result=mysqli_query($conn, $updateQuery);
	
	if(!$result){
		
		exit(mysqli_error());
	}
	
}

if(isset($_POST["userId"]) && isset($_POST["userId"])!==""){
	
	$userId=$_POST["userId"];
	$query="Select * from crudtable Where id='$userId'";
	$result=mysqli_query($conn, $query);

	if(!$result){
		
		exit(mysqli_error());
	}
	
	$response=array();
	
	if(mysqli_num_rows($result)>0){
		
		$record = mysqli_fetch_assoc($result);
		$response=$record;
	}else{
		
		$response['status']=200;
		$response['message']='Data not found!';
	}
	
	echo json_encode($response);
}else{
	
	$warning=array();
	$warning['status']=403;
	$warning['message']='Invalid Request!';
}


?>