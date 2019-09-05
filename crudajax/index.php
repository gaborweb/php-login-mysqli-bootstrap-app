<?php

session_start();

if (!isset($_SESSION["username"])) {

	header("location: ../login_form/login.php");
}

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<style>
	.display-none {

		display: none;
	}
</style>

</head>
<body>

	<div class="container">

		<h4>Welcome <?php echo $_SESSION['username']; ?></h4>

		<h1 class="text-primary text-uppercase text-center">AJAX CRUD OPERATION</h1>

		<div class="d-flex justify-content-end">
			<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Record</button>
		</div>

		<h2 class="text-danger">All records</h2>
		<div id="content"></div>

		<div id="myModal" class="modal">
			<div class="modal-dialog">

				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">AJAX CRUD OPERATION</h4>
						<button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
					</div>
					<div class="modal-body">
						<input type="text" id="hiddenUserId" class="display-none">
						<div class="form-group">
							<label>Firstname</label>
							<input type="text" id="firstname" class="form-control" placeholder="First Name">
						</div>
						<div class="form-group">
							<label>Lastname</label>
							<input type="text" id="lastname" class="form-control" placeholder="Last Name">
						</div>
						<div class="radio">
							<label>Gender</label>
							<div>
								<label><input type="radio" name="gender" value="Male" checked>Male</label>
								<label><input type="radio" name="gender" value="Female">Female</label>
							</div>
						</div>
						<div class="form-group">
							<label>Country</label>
							<div>
								<select class="form-control" name="country" id="country">
									<option value="Hungary">Hungary</option>
									<option value="Germany">Germany</option>
									<option value="England">England</option>
									<option value="Ireland">Ireland</option>
									<option value="USA">USA</option>
									<option value="Australia">Australia</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="text" id="email" class="form-control" placeholder="Email">
						</div>
						<div class="form-group">
							<label>Mobile</label>
							<input type="text" id="mobile" class="form-control" placeholder="Mobile">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="buttonSave" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button>
						<button type="button" id="buttonUpdate" class="btn btn-primary display-none" onclick="UpdateUserDetails()">Update</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeModal()">Close</button>
					</div>
				</div>

			</div>
		</div>
		<a href="../login_form/logout.php" class="btn btn-dark btn-lg" role="button">Logout</a>
	</div>

	<script>
		$(document).ready(function() {

			readRecords();
		});


		function addRecord() {

			var addrecord = "addrecord";
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			var email = $("#email").val();
			var mobile = $("#mobile").val();
			var gender = $("input[name=gender]:checked").val();
			var country = $("#country").val();

			$.ajax({
				method: "POST",
				url: "backend.php",
				data: {
					addrecord: addrecord,
					firstname: firstname,
					lastname: lastname,
					email: email,
					mobile: mobile,
					gender: gender,
					country: country
				},
				success: function(response, status) {
					readRecords();
					closeModal();
				},
			});
		}

		function closeModal() {

			$("#buttonUpdate").addClass("display-none");
			$("#buttonSave").removeClass("display-none");
			this.setFieldsEmpty();
		}

		function DeleteUser(deleteId) {

			console.log("deleteId:", deleteId);

			var conf = confirm("Are You sure to delete this record");
			if (conf === true) {

				$.ajax({
					method: "POST",
					url: "backend.php",
					data: {
						deleteId: deleteId
					},
					success: function(response, status) {
						alert("record was deleted successfully");
						readRecords();
					},
					error: function(xhr, status, error) {
						var err = eval("(" + xhr.responseText + ")");
						alert("Error: ", err.Message);
					}
				});
			}
		}

		function GetUserDetails(userId) {

			$.ajax({
				method: "POST",
				url: "backend.php",
				data: {
					userId: userId
				},
				success: function(response, status) {

					var user = JSON.parse(response);

					$("#hiddenUserId").val(user.id);
					$("#firstname").val(user.firstname);
					$("#lastname").val(user.lastname);
					$("#email").val(user.email);
					$("#mobile").val(user.mobile);
				},
				error: function(xhr, status, error) {
					var err = eval("(" + xhr.responseText + ")");
					alert("Error: ", err.Message);
				}
			});

			$("#myModal").modal("show");
			$("#buttonUpdate").removeClass("display-none");
			$("#buttonSave").addClass("display-none");

		}

		function readRecords() {

			var readrecord = "readrecord";
			$.ajax({
				method: "POST",
				url: "backend.php",
				data: {
					readrecord: readrecord
				},
				success: function(response, status) {
					$("#content").html(response);
				},
			});
		}

		function setFieldsEmpty() {

			$("#hiddenUserId").val("");
			$("#firstname").val("");
			$("#lastname").val("");
			$("#email").val("");
			$("#mobile").val("");

		}

		function UpdateUserDetails() {

			var updaterecord = "updaterecord";
			var firstname = $("#firstname").val();
			var lastname = $("#lastname").val();
			var email = $("#email").val();
			var mobile = $("#mobile").val();
			var gender = $("input[name=gender]:checked").val();
			var country = $("#country").val();
			var hiddenUserId = $("#hiddenUserId").val();

			$.ajax({
				method: "POST",
				url: "backend.php",
				data: {
					updaterecord: updaterecord,
					firstname: firstname,
					lastname: lastname,
					email: email,
					mobile: mobile,
					gender: gender,
					country: country,
					hiddenUserId: hiddenUserId
				},
				success: function(response, status) {

					$("#myModal").modal("hide");
					readRecords();
					closeModal()
				},
			});

		}
	</script>

</body>

</html>