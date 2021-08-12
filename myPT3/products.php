<?php
include_once 'products_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Pet Fish Ordering System : Products</title>
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="fish.png"/>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
      <?php include_once 'nav_bar.php'; ?>
      <hr>
      <div class="container-fluid">
        <div class="row">
          <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="page-header">
              <h2>Create New Product</h2>
            </div>

            <form action="products.php" method="post" class="form-horizontal">

              <div class="form-group">
                <label for="productid" class="col-sm-3 control-label">ID</label>
                <div class="col-sm-9">
                  <input name="pid" type="text" class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_ID']; else echo $num ?>" required readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="productname" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRODUCT_NAME']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="productprice" class="col-sm-3 control-label">Price</label>
                <div class="col-sm-9">
                  <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PRICE']; ?>" min="0.0" step="0.01" required>
                </div>
              </div>

              <div class="form-group">
                <label for="productsize" class="col-sm-3 control-label">Size</label> 
                <div class="col-sm-9">
                  <select name="size" class="form-control" id="productsize" required>
                    <option value="">Please select</option>
                    <option value="Small" <?php if(isset($_GET['edit'])) if($editrow['FLD_SIZE']=="Small") echo "selected"; ?>>Small</option>
                    <option value="Medium" <?php if(isset($_GET['edit'])) if($editrow['FLD_SIZE']=="Medium") echo "selected"; ?>>Medium</option>
                    <option value="Large" <?php if(isset($_GET['edit'])) if($editrow['FLD_SIZE']=="Large") echo "selected"; ?>>Large</option>
                  </select> <br>
                </div>
              </div> 

              <div class="form-group">
                <label for="producttype" class="col-sm-3 control-label">Type</label>
                <div class="col-sm-9">
                  <select name="type" class="form-control" id="producttype" required>
                    <option value="">Please select</option>
                    <option value="Pet Fish" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Pet Fish") echo "selected"; ?>>Pet Fish</option>
                    <option value="Fish Food" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Fish Food") echo "selected"; ?>>Fish Food</option>
                    <option value="Aquarium Supplies" <?php if(isset($_GET['edit'])) if($editrow['FLD_TYPE']=="Aquarium Supplies") echo "selected"; ?>>Aquarium Supplies</option>
                  </select> <br>
                </div>
              </div>

              <div class="form-group">
                <label for="productdesc" class="col-sm-3 control-label">Description</label>
                <div class="col-sm-9">
                  <input type="text" name="descrp" class="form-control" id="productdesc" placeholder="Product Description" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_DESCRIPTION']; ?>" required>
                </div>
              </div>

              <div class="form-group">
                <label for="productqty" class="col-sm-3 control-label">Quantity</label>
                <div class="col-sm-9">
                  <input name="quantity" type="number" class="form-control" id="productqty" placeholder="Product Quantity" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_QUANTITY']; ?>" min="0" required>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                  <?php if (isset($_GET['edit'])) { ?>
                    <input type="hidden" name="oldpid" value="<?php echo $editrow['FLD_PRODUCT_ID']; ?>">
                    <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
                  <?php } else { ?>
                    <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
                  <?php } ?>
                  <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
                </div>
              </div>
            </form>
          </div>
        </div>

        <hr>
        <div class="row">
          <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <div class="page-header">
              <h2>Products List</h2>
            </div>
            <table class="table table-striped table-bordered">
              <tr>
                <th>Product ID</th>
                <th>Name</th>
                <th>Price (RM)</th>
                <th>Size</th>
                <th>Type</th>
                <th>Quantity</th>
                <th></th>
              </tr>
              <?php
              // Read
              $per_page = 5;
              if (isset($_GET["page"]))
                $page = $_GET["page"];
              else
                $page = 1;
              $start_from = ($page-1) * $per_page;
              try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("SELECT * FROM tbl_products_a174863_pt2 LIMIT $start_from, $per_page"); 
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
                  <td>RM <?php echo $readrow['FLD_PRICE']; ?></td>
                  <td><?php echo $readrow['FLD_SIZE']; ?></td>
                  <td><?php echo $readrow['FLD_TYPE']; ?></td>
                  <td><?php echo $readrow['FLD_QUANTITY']; ?></td>
                  <td>
                    <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-warning btn-xs" role="button">Details</a>
                    <a href="products.php?edit=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
                    <a href="products.php?delete=<?php echo $readrow['FLD_PRODUCT_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                  </td>
                </tr>
                <?php
              } 
              
              $conn = null;
              ?>
            </table>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <nav>
              <ul class="pagination">
                <?php
                try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT * FROM tbl_products_a174863_pt2");
                  $stmt->execute();
                  $result = $stmt->fetchAll();
                  $total_records = count($result);
                }
                catch(PDOException $e){
                  echo "Error: " . $e->getMessage();
                }
                $total_pages = ceil($total_records / $per_page);
                ?>
                <?php if ($page==1) { ?>
                  <li class="disabled"><span aria-hidden="true">«</span></li>
                <?php } else { ?>
                  <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
                  <?php
                }
                for ($i=1; $i<=$total_pages; $i++)
                  if ($i == $page)
                    echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
                  else
                    echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
                  ?>
                  <?php if ($page==$total_pages) { ?>
                    <li class="disabled"><span aria-hidden="true">»</span></li>
                  <?php } else { ?>
                    <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
                  <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        </div>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script> 
      </body> 
      </html>