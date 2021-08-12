<?php
include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Pet Fish Ordering System : Products</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="products.php" method="post">
      Product ID
      <input name="pid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_ID']; ?>" id="pid" readonly> <br>
      Name
      <input name="name" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_NAME']; ?>" required> <br>
      Price(RM)
      <input name="price" type="number" min="0.00" max="10000.00" step="0.01" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRICE']; ?>" required> <br>
      Size
      <select name="size" required>
        <option value="Small" <?php if(isset($_GET['edit'])) if($editrow['FLD_SIZE']=="Small") echo "selected"; ?>>Small</option>
        <option value="Medium" <?php if(isset($_GET['edit'])) if($editrow['FLD_SIZE']=="Medium") echo "selected"; ?>>Medium</option>
        <option value="Large" <?php if(isset($_GET['edit'])) if($editrow['FLD_SIZE']=="Large") echo "selected"; ?>>Large</option>
      </select> <br>
      Type
      <select name="type" required>
        <option value="Pet Fish" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Pet Fish") echo "selected"; ?>>Pet Fish</option>
        <option value="Fish Food" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Fish Food") echo "selected"; ?>>Fish Food</option>
        <option value="Aquarium Supplies" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Aquarium Supplies") echo "selected"; ?>>Aquarium Supplies</option>
      </select> <br>
      Description
      <input type="text" name="descrp" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_DESCRIPTION']; ?>" required> <br>
      Quantity
      <input name="quantity" type="number" min="1" max="999" step="1" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_QUANTITY']; ?>" required> <br><br>

      <?php if (isset($_GET['edit'])) { ?>
        <input type="hidden" name="oldpid" value="<?php echo $editrow['FLD_PRODUCT_ID']; ?>">
        <button type="submit" name="update">Update</button>
      <?php } else { ?>
        <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Product ID</td>
        <td>Name</td>
        <td>Price (RM)</td>
        <td>Size</td>
        <td>Type</td>
        <td>Description</td>
        <td>Quantity</td>
        <td></td>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a174863_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
        ?>   
        <tr>
          <td><?php echo $readrow['FLD_PRODUCT_ID']; ?></td>
          <td><?php echo $readrow['FLD_PRODUCT_NAME']; ?></td>
          <td><?php echo $readrow['FLD_PRICE']; ?></td>
          <td><?php echo $readrow['FLD_SIZE']; ?></td>
          <td><?php echo $readrow['FLD_TYPE']; ?></td>
          <td><?php echo $readrow['FLD_DESCRIPTION']; ?></td>
          <td><?php echo $readrow['FLD_QUANTITY']; ?></td>
          <td>
            <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>">Details</a>
            <a href="products.php?edit=<?php echo $readrow['FLD_PRODUCT_ID']; ?>">Edit</a>
            <a href="products.php?delete=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
          </td>
        </tr>
      <?php
      }
      if (!isset($_GET['edit'])&&$stmt->rowCount()>0){
        $num = ltrim($readrow['FLD_PRODUCT_ID'], 'P')+1;
        $num = 'P'.str_pad($num,3,"0",STR_PAD_LEFT);
      }
      elseif(!isset($_GET['edit'])){
            $num = 'P'.str_pad(1,3,"0",STR_PAD_LEFT);
          }
      $conn = null;
      ?>
      <script type="text/javascript">
        if("<?php echo $num ?>" !== null && "<?php echo $num ?>" !== ""){
          var pid = document.getElementById("pid");
          pid.value = "<?php echo $num ?>";
        }
      </script>
    </table>
  </center>
</body>
</html>