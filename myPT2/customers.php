<?php
  include_once 'customers_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Pet Fish Ordering System : Customers</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="customers.php" method="post">
      Customer ID
      <input name="cid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUSTOMER_ID']; ?>" id="cid" readonly> <br>
      First Name
      <input name="fname" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUSTOMER_FNAME']; ?>" required> <br>
      Last Name
      <input name="lname" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUSTOMER_LNAME']; ?>" required> <br>
      Phone Number
      <input name="phone" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PHONE_NUMBER']; ?>" required> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldcid" value="<?php echo $editrow['FLD_CUSTOMER_ID']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Customer ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Phone Number</td>
        <td></td>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_customers_a174863_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['FLD_CUSTOMER_ID']; ?></td>
        <td><?php echo $readrow['FLD_CUSTOMER_FNAME']; ?></td>
        <td><?php echo $readrow['FLD_CUSTOMER_LNAME']; ?></td>
        <td><?php echo $readrow['FLD_PHONE_NUMBER']; ?></td>
        <td>
          <a href="customers.php?edit=<?php echo $readrow['FLD_CUSTOMER_ID']; ?>">Edit</a>
          <a href="customers.php?delete=<?php echo $readrow['FLD_CUSTOMER_ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      if (!isset($_GET['edit'])&&$stmt->rowCount()>0){
        $num = ltrim($readrow['FLD_CUSTOMER_ID'], 'C')+1;
        $num = 'C'.str_pad($num,3,"0",STR_PAD_LEFT);
      }
      elseif(!isset($_GET['edit'])){
        $num = 'C'.str_pad(1,3,"0",STR_PAD_LEFT);
      }
      $conn = null;
      ?>
      <script type="text/javascript">
        if("<?php echo $num ?>" !== null && "<?php echo $num ?>" !== ""){
          var cid = document.getElementById("cid");
          cid.value = "<?php echo $num ?>";
        }
      </script>
    </table>
  </center>
</body>
</html>