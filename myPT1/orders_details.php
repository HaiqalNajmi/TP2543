<!--
Matric Number: A174863
Name: Muhammad Haiqal Najmi bin Zulkarnain
-->
<!DOCTYPE html>
<html>
<head>
	<title>Pet Fish Ordering System: Orders Details</title>
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
			<hr>
				Order ID: D001
			<br>
				Order Date: 09-09-2015
			<br>
				Staff: James Martin
			<br>
				Customer: James Bond
			<br>
			<hr>
			<form action="orders_details.php" method="post">
				Product
				<select name="pid">
					<option value="P001">Dragon Scale Male Betta Fish</option>
					<option value="P002">Half Moon Male Betta Fish</option>
					<option value="P003">Oranda Goldfish</option>
					<option value="P010">Stress Reliever Salt 500g</option>
				</select>
				Quantity
				<input type="quantity" name="text">
				<button type="submit" name="addproduct">Add Product</button>
				<button type="reset">Clear</button>
			</form>
			<hr>
			<table border="1">
				<tbody>
					<tr>
						<td>Order Detail ID</td>
        				<td>Product</td>
        				<td>Quantity</td>
       					<td></td>
					</tr>
					<tr>
						<td>OD001</td>
						<td>Dragon Scale Male Betta Fish</td>
						<td>2</td>
						<td>
							<a href="orders_details.php">Delete</a>
						</td>
					</tr>
					<tr>
						<td>OD002</td>
						<td>Stress Reliever Salt 500g</td>
						<td>1</td>
						<td>
							<a href="orders_details.php">Delete</a>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<a href="invoice.php" target="_blank">Generate Invoice</a>
	</center>
</body>
</html>