<!--
Matric Number: A174863
Name: Muhammad Haiqal Najmi bin Zulkarnain
-->
<!DOCTYPE html>
<html>
<head>
	<title>Pet Fish Ordering System: Products</title>
	<style>
		form {
			margin: 0 auto;
			width: 500px;
			padding: 1em;
			border: 1px solid #CCC;
			border-radius: 1em;
		}
		ul{
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
		button{
			margin-left: 5em; 
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
	<hr>
	<div style="margin: 0 10%;">
		<form action="products.php" method="post">
		<ul>
			<li>
				<label for="pid">Product ID</label>
				<input type="text" id="pid" name="product_id">
			</li>
			<li>
				<label for="name">Name</label>
				<input type="text" id="name" name="product_name">
			</li>
			<li>
				<label for="price">Price</label>
				<input type="text" id="price" name="product_price">
			</li>
			<li>
				<label for="size">Size</label>
				<select id="size" name="product_size">
					<option value>Select</option>
					<option value="small">Small</option>
					<option value="medium">Medium</option>
					<option value="large">Large</option>
				</select>
			</li>
			<li>
				<label for="type">Type</label>
				<select id="type" name="product_type">
					<option value>Select</option>
					<option value="petfish">Pet Fish</option>
					<option value="fishfood">Fish Food</option>
					<option value="supplies">Aquarium Supplies</option>
				</select>
			</li>
			<li>
				<label for="descrp">Description</label>
				<textarea id="descrp" name="product_desc" rows="4" cols="50"></textarea>
			</li>
			<li>
				<label for="quantity">Quantity</label>
				<input type="number" id="quantity" name="product_quantity">
			</li>
		</ul>
		<hr style="margin: 20px 0;">
		<div style="margin: auto; display: flex; align-items: center; justify-content: center;">
			<button type="submit" name="create">Create</button>
			<button type="reset">Clear</button>
		</div>
	  </form>
	</div>
	<hr>
	<div style="display: flex; align-items: center; justify-content: center;">
		<table border="1" style="width: 90%;">
			<tbody>
				<tr>
					<td style="width: 10%;">Product ID</td>
					<td style="width: 10%;">Name</td>
					<td style="width: 6%;">Price</td>
					<td style="width: 10%;">Size</td>
					<td style="width: 10%;">Type</td>
					<td style="width: 32%;">Description</td>
					<td style="width: 5%;">Quantity</td>
					<td style="width: 10%;"></td>
				</tr>
				<tr>
					<td>P001</td>
					<td>Dragon Scale Male Betta Fish</td>
					<td>40.00</td>
					<td>Small</td>
					<td>Pet Fish</td>
					<td>They also have the ability to breathe air from the surface through their labyrinth, which acts like lungs.</td>
					<td>20</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P002</td>
					<td>Half Moon Male Betta Fish</td>
					<td>40.00</td>
					<td>Small</td>
					<td>Pet Fish</td>
					<td>They also have the ability to breathe air from the surface through their labyrinth, which acts like lungs.</td>
					<td>20</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P003</td>
					<td>Oranda Goldfish</td>
					<td>6.00</td>
					<td>Small</td>
					<td>Pet Fish</td>
					<td>Unlike tropical fish, goldfish will live in a wide range of water temperatures. Most goldfish are peaceful and schooling fish that mix well with other goldfish.</td>
					<td>30</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P004</td>
					<td>Super Gold Tropic 260g</td>
					<td>27.00</td>
					<td>Small</td>
					<td>Fish Food</td>
					<td>Krill shrimp, spirulina, and natural and artificial colors contained in this food will enhance the natural color of your fish, especially red. Colors will get brighter and stronger within 2-4 weeks.</td>
					<td>30</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P005</td>
					<td>Super Gold Tropic 100g</td>
					<td>11.00</td>
					<td>Small</td>
					<td>Fish Food</td>
					<td>Krill shrimp, spirulina, and natural and artificial colors contained in this food will enhance the natural color of your fish, especially red. Colors will get brighter and stronger within 2-4 weeks.</td>
					<td>40</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P006</td>
					<td>Tzi Yen Hong 260g</td>
					<td>18.00</td>
					<td>Small</td>
					<td>Fish Food</td>
					<td>This product added krill, shrimp paste & yeast to promote natural body colour, fast digestion & absorption, promote eminent growth.</td>
					<td>40</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P007</td>
					<td>Tzi Yen Hong 230g</td>
					<td>18.00</td>
					<td>Medium</td>
					<td>Fish Food</td>
					<td>This product added krill, shrimp paste & yeast to promote natural body colour, fast digestion & absorption, promote eminent growth.</td>
					<td>40</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P008</td>
					<td>Aquarium Gravel Cleaner</td>
					<td>36.00</td>
					<td>Small</td>
					<td>Aquarium Supplies</td>
					<td>An exclusive gravel guard keeps the gravel in the tank, not in the bucket. Has a comfortable grip and non-kink hosing.</td>
					<td>30</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P009</td>
					<td>Super External Bacteria & Fungus Away 120ml</td>
					<td>23.00</td>
					<td>Medium</td>
					<td>Aquarium Supplies</td>
					<td>Ocean Free (120ml)External Bacteria and Fungus Away is strongly recommended to treat fungus, ragged fin, cotton wool, fin rot diseases and prevent them from spreading which may cause death to the fishes.</td>
					<td>30</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
				<tr>
					<td>P010</td>
					<td>Stress Reliever Salt 500g</td>
					<td>14.00</td>
					<td>Medium</td>
					<td>Aquarium Supplies</td>
					<td>Free of nitrate and phosphate. Quickly achieves and maintains the ideal pH.</td>
					<td>30</td>
					<td>
						<a href="products_details.php">Details</a>
						<a href="products.php">Edit</a>
						<a href="products.php">Delete </a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>