<?php
include_once 'customers_crud.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Pet Fish Ordering System : Customers</title>
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap/css/body.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="FishLogo.png"/>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  </head>
  <body>
    <?php include_once 'nav_bar.php'; ?>
    
    <div class="container-fluid dark" style="padding-bottom: 30px;">
      <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="page-header">
            <h2>Create New Customer</h2>
          </div>

          <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='text-danger text-center'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>

          <form action="customers.php" method="post" class="form-horizontal">
            <?php
                    if (isset($_GET['edit'])) {
                        echo '<input type="hidden" name="cid" value="' . $editrow['FLD_CUSTOMER_ID'] . '" />';
                    }
            ?>
            <div class="form-group">
              <label for="customerid" class="col-sm-3 control-label">ID</label>
              <div class="col-sm-9">
                <input name="cid" type="text" class="form-control" id="customerid" placeholder="Customer ID" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUSTOMER_ID']; else echo $num ?>" required readonly>
              </div>
            </div>
            
            <div class="form-group">
              <label for="customerfname" class="col-sm-3 control-label">First Name</label>
              <div class="col-sm-9">
                <input name="fname" type="text" class="form-control" id="customerfname" placeholder="First Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUSTOMER_FNAME']; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label for="customerlname" class="col-sm-3 control-label">Last Name</label>
              <div class="col-sm-9">
                <input name="lname" type="text" class="form-control" id="customerlname" placeholder="Last Name" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_CUSTOMER_LNAME']; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label for="customerphone" class="col-sm-3 control-label">Phone No.</label>
              <div class="col-sm-9">
                <input name="phone" type="text" class="form-control" id="customerphone" placeholder="Phone Number (eg. 01X-XXXXXXXX)" value="<?php if(isset($_GET['edit'])) echo $editrow['FLD_PHONE_NUMBER']; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                <?php if (isset($_GET['edit'])) { ?>
                  <input type="hidden" name="oldcid" value="<?php echo $editrow['FLD_CUSTOMER_ID']; ?>">
                  <button type="submit" class="btn btn-default" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>

                <?php } else { ?>
                  <button type="submit" class="btn btn-default" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>

                <?php } ?>
                <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">  
      <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
          <div class="page-header">
            <h2>Customer List</h2>
          </div>
          <table class="table table-bordered">
            <tr style="background: #003566;color: #fff;">
              <th>Customer ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Phone Number</th>
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
              $stmt = $conn->prepare("SELECT * FROM tbl_customers_a174863_pt2 LIMIT {$start_from}, {$per_page}");
              $stmt->execute();
              $result = $stmt->fetchAll();
            }
            catch(PDOException $e){
              echo "Error: " . $e->getMessage();
            }
            foreach($result as $readrow) {
              ?>
              <tr  style="color: #ffffff;">
                <td><?php echo $readrow['FLD_CUSTOMER_ID']; ?></td>
                <td><?php echo $readrow['FLD_CUSTOMER_FNAME']; ?></td>
                <td><?php echo $readrow['FLD_CUSTOMER_LNAME']; ?></td>
                <td><?php echo $readrow['FLD_PHONE_NUMBER']; ?></td>
                <td class="text-center">
                  <?php
                    if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {
                  ?>
                  <a href="customers.php?edit=<?php echo $readrow['FLD_CUSTOMER_ID']; ?>" class="btn btn-success btn-xs" role="button">Edit</a>
                  <a href="customers.php?delete=<?php echo $readrow['FLD_CUSTOMER_ID']; ?>" onclick="return confirm('Are you sure to delete?');" class="btn btn-danger btn-xs" role="button">Delete</a>
                <?php
                  }
                ?>
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
                $stmt = $conn->prepare("SELECT * FROM tbl_customers_a174863_pt2");
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
                <li class="disabled"><span aria-hidden="true">??</span></li>
              <?php } else { ?>
                <li><a href="customers.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">??</span></a></li>
                <?php
              }
              for ($i=1; $i<=$total_pages; $i++)
                if ($i == $page)
                  echo "<li class=\"active\"><a href=\"customers.php?page=$i\">$i</a></li>";
                else
                  echo "<li><a href=\"customers.php?page=$i\">$i</a></li>";
                ?>
                <?php if ($page==$total_pages) { ?>
                  <li class="disabled"><span aria-hidden="true">??</span></li>
                <?php } else { ?>
                  <li><a href="customers.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">??</span></a></li>
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