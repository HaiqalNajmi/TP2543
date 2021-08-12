<?php
require 'database.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Pet Fish Inventory System : Search Product</title>
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
<?php include_once 'nav_bar.php'; ?>
<?php
//if (isset($_SESSION['user']) && $_SESSION['user']['FLD_STAFF_ROLE'] == 'admin') {
?>
<div class="container-fluid dark" style="padding-bottom: 30px;">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
            <div class="page-header">
                <h2>Catalog: Search</h2>
            </div>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post">
                <div class="col-sm-offset-2 col-sm-8">
                    <div class="form-group">
                        <label for="inputKeyword">Keywords (Type, Price, Size)</label>
                        <input type="text" class="form-control" id="inputKeyword" name="search"
                        placeholder="Eg. PetFish 40.00 Small">
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-sm-offset-5 col-sm-3 text-center">
                        <button class="btn btn-default btn-lg" type="submit">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
                        </button>
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
                <h2>Product Catalog - Top 10 Featured</h2>
            </div>
            <table class="table table-bordered">
                <tr style="background: #003566;color: #fff;">
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Size</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th></th>
                </tr>
                <tbody>
                    <?php
                    $result = array();
                    if (isset($_POST['search'])) {
                        $keywords = explode(" ", $_POST['search']);

                        if (count($keywords) == 3) {
                            $type = $keywords[0]."%";
                            $price = $keywords[1]."%";
                            $size = $keywords[2]."%";

                            $stmt = $conn->prepare("SELECT * FROM tbl_products_a174863_pt2 WHERE FLD_TYPE LIKE :type AND FLD_PRICE LIKE :price AND FLD_SIZE LIKE :size ORDER BY FLD_PRODUCT_ID ASC");
                            $stmt->bindParam(":type", $type);
                            $stmt->bindParam(":price", $price);
                            $stmt->bindParam(":size", $size);

                            $stmt->execute();
                            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        } else {
                            echo "<tr><td colspan='6'>No information available. (<p class='text-danger'>Please check you search keywords.</p>)</td></tr>";
                        }
                    } else {
                        $stmt = $conn->query("SELECT * FROM tbl_products_a174863_pt2 ORDER BY FLD_QUANTITY ASC LIMIT 0,10");
                        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    }

                    if (count($result) > 0) {
                        foreach ($result as $readrow) {
                            ?>
                            <tr style="color: #ffffff;">
                                <td><?php echo $readrow['FLD_PRODUCT_ID']; ?></td>
                                <td><?php echo $readrow['FLD_PRODUCT_NAME']; ?></td>
                                <td><?php echo $readrow['FLD_PRICE']; ?></td>
                                <td><?php echo $readrow['FLD_SIZE']; ?></td>
                                <td><?php echo $readrow['FLD_TYPE']; ?></td>
                                <td><?php echo $readrow['FLD_QUANTITY']; ?></td>
                                <td class="text-center">
                                    <a href="products_details.php?pid=<?php echo $readrow['FLD_PRODUCT_ID']; ?>"
                                       class="btn btn-warning btn-xs" role="button">Details</a>
                                       <button data-toggle="modal" data-target="#imageModal"
                                       data-img="<?php echo $readrow['FLD_PRODUCT_IMAGE']; ?>"
                                       data-name="<?php echo $readrow['FLD_PRODUCT_NAME']; ?>"
                                       class="btn btn-info btn-xs" role="button">Image
                                   </button>
                               </td>
                           </tr>
                           <?php
                       }
                   } else {
                    echo "<tr><td colspan='6'>No information available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

</div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="imageModalLabel" style="color: #0f0f0f;">Product Image</h4>
            </div>
            <div class="modal-body text-center">
                <img class="product-image" src="products/no-photo.png" alt="No Photo" class="img-rounded"
                style="height: 500px;width: 500px;">
            </div>
            <div class="modal-footer" style="text-align: center !important;">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"
integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd"
crossorigin="anonymous"></script>

<script type="application/javascript">
    $('#imageModal').on('show.bs.modal', function (event) {
        const button = $(event.relatedTarget);
        const imgUrl = button.data('img');
        const productName = button.data('name');

        const modal = $(this);
        modal.find('.modal-title').text(`${productName}'s image`);
        modal.find('.product-image').prop('title', `${productName}'s image`);
        modal.find('.product-image').attr('src', 'products/' + imgUrl);
    });

    $('.product-image').on("error", function () {
        this.src = 'products/no-photo.png';
    });
</script>
</body>
</html>