<!--
Matric Number: A174863
Name: Muhammad Haiqal Najmi bin Zulkarnain
-->
<!DOCTYPE html>
<html>
<head>
	<title>Pet Fish Ordering System: Staffs</title>
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
	<form action="staffs.php" method="post">
      <label for="sid">Staff ID</label>
      <input name="sid" type="text"> 
      <br>
      <br>
      <label for="fname">First Name</label>
      <input name="fname" type="text"> 
      <br>
      <br>
      <label for="lname">Last Name</label>
      <input name="lname" type="text"> 
      <br>
      <br>
      <!-- <div style="margin: auto; display: flex; align-items: center; justify-content: center;">
        <label for="gender">Gender</label>
        <input name="gender" type="radio" value="Male"> 
        Male
        <input name="gender" type="radio" value="Female"> 
        Female 
      </div>
      <br>
      <br>
      <label for="phonenum">Phone Number</label>
      <input name="phone" type="text"> 
      <br>
      <br> -->
      <label for="email">Email Address</label>
      <input name="email" type="text"> 
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
    			<td>Staff ID</td>
        		<td>First Name</td>
        		<td>Last Name</td>
        		<!-- <td>Gender</td>
        		<td>Phone Number</td> -->
        		<td>Email Address</td>
        		<td></td>
    		</tr>
    		<tr>
    			<td>S001</td>
        		<td>Larry</td>
        		<td>Bay</td>
        		<!-- <td>Male</td>
        		<td>013-3922010</td> -->
        		<td>larry.bay@bike.com</td>
        		<td>
          			<a href="staffs.php">Edit</a>
          			<a href="staffs.php">Delete</a>
        		</td>
    		</tr>
    		<tr>
    			<td>S002</td>
        		<td>James</td>
       		 	<td>Martin</td>
        		<!-- <td>Male</td>
        		<td>019-8321266</td> -->
        		<td>james.martin@bike.com</td>
        		<td>
          			<a href="staffs.php">Edit</a>
          			<a href="staffs.php">Delete</a>
        		</td>
    		</tr>
    	</tbody>
    </table>
    </div>
</body>
</html>