<!--
Matric Number: A174863
Name: Muhammad Haiqal Najmi bin Zulkarnain
-->
<!DOCTYPE html>
<html>
<head>
	<title>Pet Fish Ordering System: Orders</title>
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
	<form action="orders.php" method="post">
      <label for="oid">Order ID</label>
      <input name="oid" type="text" disabled> 
      <br>
      <br>
      <label for="orderdate">Order Date</label>
      <input name="orderdate" type="date" disabled>
      <br>
      <br>
      <label for="staff">Staff</label>
      <select name="sid">
        <option value="S001">Larry Bay</option>
        <option value="S002">James Martin</option>
        <option value="S003">Jennifer Henderson</option>
      </select> 
      <br>
      <br>
      <label for="cust">Customer</label>
      <select name="cid">
        <option value="C001">James Bond</option>
        <option value="C002">Marie Antoinette</option>
        <option value="C003">William Johnson</option>
      </select> 
      <br>
      <br>
      <hr style="margin: 20px 0;">
      <div style="display: flex; align-items: center; justify-content: center;">
        <button type="submit" name="create">Create</button>
        <button type="reset" style="margin-left: 2em">Clear</button>
      </div>
    </form>
    <hr>
    <div style="display: flex; align-items: center; justify-content: center;">
    <table border="1">
    	<tbody>
    		<tr>
        		<td>Order ID</td>
        		<td>Order Date</td>
        		<td>Staff ID</td>
        		<td>Customer ID</td>
        		<td></td>
      		</tr>
      		<tr>
      			<td>D001</td>
        		<td>09-09-2015</td>
        		<td>James Martin</td>
        		<td>James Bond</td>
        		<td>
          			<a href="orders_details.php">Details</a>
          			<a href="orders.php">Edit</a>
          			<a href="orders.php">Delete</a>
        		</td>
      		</tr>
    	</tbody>
    </table>
   </div>
</body>
</html>