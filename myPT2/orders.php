<?php
  include_once 'orders_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Pet Fish Ordering System : Orders</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="orders.php" method="post">
      Order ID
      <input name="oid" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_num']; ?>"> <br>
      Order Date
      <input name="orderdate" type="text" readonly value="<?php if(isset($_GET['edit'])) echo $editrow['fld_order_date']; ?>"> <br>
      Staff
      <select name="sid">
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a174863_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $staffrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['FLD_STAFF_ID']==$staffrow['FLD_STAFF_ID'])) { ?>
          <option value="<?php echo $staffrow['FLD_STAFF_ID']; ?>" selected><?php echo $staffrow['FLD_STAFF_FNAME']." ".$staffrow['FLD_STAFF_LNAME'];?></option>
        <?php } else { ?>
          <option value="<?php echo $staffrow['FLD_STAFF_ID']; ?>"><?php echo $staffrow['FLD_STAFF_FNAME']." ".$staffrow['FLD_STAFF_LNAME'];?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?> 
      </select> <br>
      Customer
      <select name="cid">
      <?php
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
      foreach($result as $custrow) {
      ?>
        <?php if((isset($_GET['edit'])) && ($editrow['FLD_CUSTOMER_ID']==$custrow['FLD_CUSTOMER_ID'])) { ?>
          <option value="<?php echo $custrow['FLD_CUSTOMER_ID']; ?>" selected><?php echo $custrow['FLD_CUSTOMER_FNAME']." ".$custrow['FLD_CUSTOMER_LNAME']?></option>
        <?php } else { ?>
          <option value="<?php echo $custrow['FLD_CUSTOMER_ID']; ?>"><?php echo $custrow['FLD_CUSTOMER_FNAME']." ".$custrow['FLD_CUSTOMER_LNAME']?></option>
        <?php } ?>
      <?php
      } // while
      $conn = null;
      ?> 
      </select> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Order ID</td>
        <td>Order Date</td>
        <td>Staff</td>
        <td>Customer</td>
        <td></td>
      </tr>
      <?php
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM tbl_orders_a174863, tbl_staffs_a174863_pt2, tbl_customers_a174863_pt2 WHERE ";
        $sql = $sql."tbl_orders_a174863.fld_staff_num = tbl_staffs_a174863_pt2.FLD_STAFF_ID and ";
        $sql = $sql."tbl_orders_a174863.fld_customer_num = tbl_customers_a174863_pt2.FLD_CUSTOMER_ID";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $orderrow) {
      ?>
      <tr>
        <td><?php echo $orderrow['fld_order_num']; ?></td>
        <td><?php echo $orderrow['fld_order_date']; ?></td>
        <td><?php echo $orderrow['FLD_STAFF_FNAME']." ".$orderrow['FLD_STAFF_LNAME'] ?></td>
        <td><?php echo $orderrow['FLD_CUSTOMER_FNAME']." ".$orderrow['FLD_CUSTOMER_LNAME'] ?></td>
        <td>
          <a href="orders_details.php?oid=<?php echo $orderrow['fld_order_num']; ?>">Details</a>
          <a href="orders.php?edit=<?php echo $orderrow['fld_order_num']; ?>">Edit</a>
          <a href="orders.php?delete=<?php echo $orderrow['fld_order_num']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      if (!isset($_GET['edit'])&&$stmt->rowCount()>0){
        $num = ltrim($orderrow['fld_order_num'], 'O')+1;
        $num = 'O'.str_pad($num,5,"0",STR_PAD_LEFT);
      }
      elseif(!isset($_GET['edit'])){
        $num = 'O'.str_pad(1,5,"0",STR_PAD_LEFT);
      }
      $conn = null;
      ?>
      <script type="text/javascript">
      if("<?php echo $num ?>" !== null && "<?php echo $num ?>" !== ""){
      var oid = document.getElementById("oid");
      oid.value = "<?php echo $num ?>";
      }
    </script>
    </table>
  </center>
</body>
</html>