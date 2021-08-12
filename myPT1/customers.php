<!--
Matric Number: A174863
Name: Muhammad Haiqal Najmi bin Zulkarnain
-->
<!DOCTYPE html>
<html>
<head>
	<title>Pet Fish Ordering System: Customers</title>
	<style>
		form {
			margin: 0 auto;
			width: 500px;
			padding: 1em;
			border: 1px solid #CCC;
			border-radius: 1em;
		}
		label {
			display: inline-block;
			width: 160px;
			text-align: left;
		}
		input,
		textarea,
		select {
			width: 300px;
			box-sizing: border-box;
			border: 1px solid #999;
		}
	</style>
</head>
<body>
	<center>
		<button>
			<a href="index.php">Home</a>
		</button>
		<button>
			<a href="products.php">Products</a>|
		</button>
		<button>
			<a href="customers.php">Customers</a>|
		</button>
		<button>
			<a href="staffs.php">Staffs</a>|
		</button>
		<button>
			<a href="orders.php">Orders</a>
		</button>
	</center>
	<hr style="margin: 20px 0;">
	<form action="customers.php" method="post">
		<label for="cid">Customer ID</label>
		<input type="text" name="cid">
		<br>
		<br>
		<label for="fname">First Name</label>
		<input type="text" name="fname">
		<br>
		<br>
		<label for="lname">Last Name</label>
		<input type="text" name="lname">
		<br>
		<br>
		<!-- <div style="margin: auto; display: flex; align-items: center; justify-content: center;">
			<label for="gender">Gender</label>
			<input type="radio" name="gender" value="Male">
			Male
			<input type="radio" name="gender" value="Female">
			Female
		</div> 
		<br>
		<br> -->
		<label for="phonenum">Phone Number</label>
		<input type="text" name="phone">
		<br>
		<br>
		<hr style="margin: 20px 0;">
		<div style="margin: auto; display: flex; align-items: center; justify-content: center;">
			<button type="submit" name="create">Create</button>
			<button type="reset" style="margin-left: 2em">Clear</button>
		</div>
	</form>
	<hr>
	<div style="display: flex; align-items: center; justify-content: center;">
	<table border="1">
		<tbody>
			<tr>
				<td>Customer ID</td>
				<td>First Name</td>
				<td>Last Name</td>
				<!-- <td>Gender</td> -->
				<td>Phone Number</td>
				<td></td>
			</tr>
			<tr>
				<td>C001</td>
				<td>James</td>
				<td>Bond</td>
				<!-- <td>Male</td> -->
				<td>019-2849132</td>
				<td>
					<a href="customers.php">Edit</a>
					<a href="customers.php">Delete</a>
				</td>
			</tr>
			<tr>
				<td>C002</td>
				<td>Marie</td>
				<td>Antoinette</td>
				<!-- <td>Female</td> -->
				<td>011-7226581</td>
				<td>
					<a href="customers.php">Edit</a>
					<a href="customers.php">Delete</a>
				</td>
			</tr>
		</tbody>
	</table>
	</div>
</body>
</html>