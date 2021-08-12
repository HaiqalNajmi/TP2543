<?php
  include_once 'staffs_crud.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Pet Fish Ordering System : Staffs</title>
</head>
<body>
  <center>
    <a href="index.php">Home</a> |
    <a href="products.php">Products</a> |
    <a href="customers.php">Customers</a> |
    <a href="staffs.php">Staffs</a> |
    <a href="orders.php">Orders</a>
    <hr>
    <form action="staffs.php" method="post">
      Staff ID
      <input name="sid" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_ID']; ?>" id="sid" readonly> <br>
      First Name
      <input name="fname" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_FNAME']; ?>" required> <br>
      Last Name
      <input name="lname" type="text" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_STAFF_LNAME']; ?>" required> <br>
      Email Address
      <input name="email" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_EMAIL']; ?>" required> <br>
      <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldsid" value="<?php echo $editrow['FLD_STAFF_ID']; ?>">
      <button type="submit" name="update">Update</button>
      <?php } else { ?>
      <button type="submit" name="create">Create</button>
      <?php } ?>
      <button type="reset">Clear</button>
    </form>
    <hr>
    <table border="1">
      <tr>
        <td>Staff ID</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Email Address</td>
        <td></td>
      </tr>
      <?php
      // Read
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
      foreach($result as $readrow) {
      ?>
      <tr>
        <td><?php echo $readrow['FLD_STAFF_ID']; ?></td>
        <td><?php echo $readrow['FLD_STAFF_FNAME']; ?></td>
        <td><?php echo $readrow['FLD_STAFF_LNAME']; ?></td>
        <td><?php echo $readrow['FLD_EMAIL']; ?></td>
        <td>
          <a href="staffs.php?edit=<?php echo $readrow['FLD_STAFF_ID']; ?>">Edit</a>
          <a href="staffs.php?delete=<?php echo $readrow['FLD_STAFF_ID']; ?>" onclick="return confirm('Are you sure to delete?');">Delete</a>
        </td>
      </tr>
      <?php
      }
      if (!isset($_GET['edit'])&&$stmt->rowCount()>0){
        $num = ltrim($readrow['FLD_STAFF_ID'], 'S')+1;
        $num = 'S'.str_pad($num,3,"0",STR_PAD_LEFT);
      }
      elseif(!isset($_GET['edit'])){
        $num = 'S'.str_pad(1,3,"0",STR_PAD_LEFT);
      }
      $conn = null;
      ?>
      <script type="text/javascript">
        if("<?php echo $num ?>" !== null && "<?php echo $num ?>" !== ""){
          var sid = document.getElementById("sid");
          sid.value = "<?php echo $num ?>";
        }
      </script>
    </table>
  </center>
</body>
</html>