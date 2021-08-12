<!--
Matric Number: A174863
Name: Muhammad Haiqal Najmi bin Zulkarnain
-->
<!DOCTYPE html>
<html>
<head>
	<title>Pet Fish Ordering System: Products Details</title>
	<style>
		form {
			width: 500px;
			padding: 1em;
		}
		ul {
			list-style: none;
			padding: 0;
			margin: 0 12px;
		}
		form li+li {
			margin-top: 1em;
		}
		label {
			display: inline-block;
			width: 160px;
			text-align: left;
		}
		.product {
			width: auto !important;
		}
		input,
		textarea,
		select {
			width: 300px;
			box-sizing: border-box;
			border: 1px solid #999;
		}
		input:focus,
		textarea:focus {
			border-color: #000;
		}
		textarea {
			vertical-align: top;
			height: 5em;
		}
		.button {
			padding-left: 90px;
		}
		button {
			margin-left: .5em;
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
		<hr>
	</center>
	<h1 align="center">Products Details</h1>
	<div style="display: flex; align-items: center; justify-content: center;">
		<table border="1" style="width: 70%;">
			<tbody>
				<tr>
					<td>
						<form action="products.php" method="post">
							<ul>
								<li>
									<label>Product ID</label>
									<label class="product">P001</label>
								</li>
								<li>
									<label>Name</label>
									<label class="product">Dragon Scale Male Betta Fish</label>
								</li>
								<li>
									<label>Price</label>
									<label class="product">RM 40.00</label>
								</li>
								<li>
									<label>Size</label>
									<label class="product">Small</label>
								</li>
								<li>
									<label>Type</label>
									<label class="product">Pet Fish</label>
								</li>
								<li>
									<label for="descrp">Description</label>
									<textarea id="descrp" name="product_desc" rows="4" cols="50">They also have the ability to breathe air from the surface through their labyrinth, which acts like lungs.</textarea>
								</li>
								<li>
									<label>Quantity</label>
									<label class="product">20</label>
								</li>
							</ul>
						</form>
					</td>
					<td style="width: 40%; vertical-align: top; text-align: left;">
						<img src="products/P001.jpg" width="100%" height="auto">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>