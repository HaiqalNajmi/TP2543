<?php
  include_once 'database.php';
?>
 
<!DOCTYPE html>
<html>
<head>
  <title>Pet Fish Ordering System : Invoice</title>
</head>
<body>
  <center>
    MY PET FISH STORE SDN. BHD. <br>
    Lot 16, Jalan Metro Wangsa, <br>
    Seksyen 10 Wangsa Maju, <br>
    53300, Setapak <br>
    W.P Kuala Lumpur <br>
    <hr>
    <?php
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_orders_a174863, tbl_staffs_a174863_pt2,
        tbl_customers_a174863_pt2, tbl_orders_details_a174863 WHERE
        tbl_orders_a174863.fld_staff_num = tbl_staffs_a174863_pt2.FLD_STAFF_ID AND
        tbl_orders_a174863.fld_customer_num = tbl_customers_a174863_pt2.FLD_CUSTOMER_ID AND
        tbl_orders_a174863.fld_order_num = tbl_orders_details_a174863.fld_order_num AND
        tbl_orders_a174863.fld_order_num = :oid");
      $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
      $oid = $_GET['oid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
    ?>
    Order ID: <?php echo $readrow['fld_order_num'] ?> |
    Order Date: <?php echo $readrow['fld_order_date'] ?>
    <hr>
    Staff: <?php echo $readrow['FLD_STAFF_FNAME']." ".$readrow['FLD_STAFF_LNAME'] ?> |
    Customer: <?php echo $readrow['FLD_CUSTOMER_FNAME']." ".$readrow['FLD_CUSTOMER_LNAME'] ?> |
    Date: <?php echo date("d M Y"); ?>
    <hr>
    <table border="1">
      <tr>
        <td>No</td>
        <td>Product</td>
        <td>Quantity</td>
        <td>Price(RM)/Unit</td>
        <td>Total(RM)</td>
      </tr>
      <?php
      $grandtotal = 0;
      $counter = 1;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tbl_orders_details_a174863,
            tbl_products_a174863_pt2 where 
            tbl_orders_details_a174863.fld_product_num = tbl_products_a174863_pt2.FLD_PRODUCT_ID AND
            fld_order_num = :oid");
        $stmt->bindParam(':oid', $oid, PDO::PARAM_STR);
          $oid = $_GET['oid'];
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
            echo "Error: " . $e->getMessage();
      }
      foreach($result as $detailrow) {
      ?>
      <tr>
        <td><?php echo $counter; ?></td>
        <td><?php echo $detailrow['FLD_PRODUCT_NAME']; ?></td>
        <td><?php echo $detailrow['fld_order_detail_quantity']; ?></td>
        <td><?php echo $detailrow['FLD_PRICE']; ?></td>
        <td><?php echo $detailrow['FLD_PRICE']*$detailrow['fld_order_detail_quantity']; ?></td>
      </tr>
      <?php
        $grandtotal = $grandtotal + $detailrow['FLD_PRICE']*$detailrow['fld_order_detail_quantity'];
        $counter++;
      } // while
      $conn = null;
      ?>
      <tr>
        <td colspan="4" align="right">Grand Total</td>
        <td><?php echo $grandtotal ?></td>
      </tr>
    </table>
    <hr>
    Computer-generated invoice. No signature is required.
 
  </center>
</body>
</html>