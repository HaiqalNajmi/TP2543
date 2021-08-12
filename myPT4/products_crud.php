<?php
 
include_once 'database.php';
if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");

$extention = ['jpg', 'jpeg', 'gif'];
function uploadPhoto($file, $id)
{
  global $extention;
  $target_dir = "products/";
  $imageFileType = strtolower(pathinfo(basename($file["name"]), PATHINFO_EXTENSION));
  
  $newfilename = "{$id}.{$imageFileType}";

    /*
     * 0 = image file is a fake image
     * 1 = file is too large.
     * 2 = PNG & GIF files are allowed
     * 3 = Server error
     * 4 = No file were uploaded
     */

    if ($file['error'] == 4)
      return 4;

    /* if (file_exists($target_file) && $isCreate)
      return 5; */

    // Check if image file is a actual image or fake image
    if (!getimagesize($file['tmp_name']))
      return 0;

    // Check file size
    if ($file["size"] > 10000000)
      return 1;

    // Allow certain file formats
    if (!in_array($imageFileType, $extention))
      return 2;

    if (!move_uploaded_file($file["tmp_name"], $target_dir.$newfilename))
      return 3;

    return array('status' => 200, 'name' => $newfilename, 'ext' => $imageFileType);
  }
 
//Create
if (isset($_POST['create'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {
    $uploadStatus = uploadPhoto($_FILES['fileToUpload'], $_POST['pid']);

if (isset($uploadStatus['status'])) {
  try {
 
      $stmt = $conn->prepare("INSERT INTO tbl_products_a174863_pt2(FLD_PRODUCT_ID, FLD_PRODUCT_NAME, FLD_PRICE, FLD_SIZE, FLD_TYPE, FLD_DESCRIPTION, FLD_QUANTITY, FLD_PRODUCT_IMAGE) VALUES(:pid, :name, :price, :size, :type, :descrp, :quantity, :image)");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':size', $size, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':descrp', $descrp, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':image', $uploadStatus['name']);
       
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $size =  $_POST['size'];
    $type = $_POST['type'];
    $descrp = $_POST['descrp'];
    $quantity = $_POST['quantity'];
     
    $stmt->execute();
    } catch(PDOException $e)
      {
        $_SESSION['error']=$e->getMessage();
      }
} else {
  if ($flag == 0)
      $_SESSION['error'] = "Please make sure the file uploaded is an image.";
    elseif ($flag == 1)
      $_SESSION['error'] = "Sorry, only file with below 10MB are allowed.";
    elseif ($flag == 2)
      $_SESSION['error'] = "Sorry, only ".join(", ",$extention)." files are allowed.";
    elseif ($flag == 3)
      $_SESSION['error'] = "Sorry, there was an error uploading your file.";
    elseif ($flag == 4)
      $_SESSION['error'] = 'Please upload an image.';
    else
      $_SESSION['error'] = "An unknown error has been occurred.";
    }
  } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to create a new customer.";
    }
    header("LOCATION: {$_SERVER['REQUEST_URI']}");
    exit();
}
 
//Update
if (isset($_POST['update'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {

  try {
 
      $stmt = $conn->prepare("UPDATE tbl_products_a174863_pt2 SET FLD_PRODUCT_ID = :pid, FLD_PRODUCT_NAME = :name, FLD_PRICE = :price, FLD_SIZE = :size, FLD_TYPE = :type, FLD_DESCRIPTION = :descrp, FLD_QUANTITY = :quantity
        WHERE FLD_PRODUCT_ID = :oldpid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);
      $stmt->bindParam(':size', $size, PDO::PARAM_STR);
      $stmt->bindParam(':type', $type, PDO::PARAM_STR);
      $stmt->bindParam(':descrp', $descrp, PDO::PARAM_STR);
      $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);
       
      $pid = $_POST['pid'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $size =  $_POST['size'];
      $type = $_POST['type'];
      $descrp = $_POST['descrp'];
      $quantity = $_POST['quantity'];
      $oldpid = $_POST['oldpid'];
     
      $stmt->execute();

      //Image Upload
      $flag = uploadPhoto($_FILES['fileToUpload'], $pid);

    if (isset($flag['status'])) {
      $stmt = $conn->prepare("UPDATE tbl_products_a174863_pt2 SET FLD_PRODUCT_IMAGE = :image WHERE FLD_PRODUCT_ID = :oldpid LIMIT 1");

      $stmt->bindParam(':image', $flag['name']);
      $stmt->bindParam(':oldpid', $oldpid);
      $stmt->execute();

    } elseif ($flag != 4) {
      if ($flag == 0)
        $_SESSION['error'] = "Please make sure the file uploaded is an image.";
      elseif ($flag == 1)
        $_SESSION['error'] = "Sorry, only file with below 10MB are allowed.";
      elseif ($flag == 2)
        $_SESSION['error'] = "Sorry, only PNG & GIF files are allowed.";
      elseif ($flag == 3)
        $_SESSION['error'] = "Sorry, there was an error uploading your file.";
      else
        $_SESSION['error'] = "An unknown error has been occurred.";
    }
  } catch (PDOException $e) {
      $_SESSION['error'] = $e->getMessage();
  } catch (Exception $e) {
      $_SESSION['error'] = $e->getMessage();
    }
  } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to update this product.";
        header("LOCATION: {$_SERVER['PHP_SELF']}");
        exit();
    } 

    if (isset($_SESSION['error']))
      header("LOCATION: {$_SERVER['REQUEST_URI']}");
    else
      header("Location: {$_SERVER['PHP_SELF']}");

    exit();
}
 
//Delete
if (isset($_GET['delete'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {
  try {
      $pid = $_GET['delete'];
      /* $stmt = $conn->prepare("DELETE FROM tbl_products_a174863_pt2 WHERE FLD_PRODUCT_ID = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR); */
      
      // Select Product Image Name
        $query = $conn->query("SELECT FLD_PRODUCT_IMAGE FROM tbl_products_a174863_pt2 WHERE FLD_PRODUCT_ID = '{$pid}' LIMIT 1")->fetch(PDO::FETCH_ASSOC);
      // Check if selected product id exists .
       if (isset($query['FLD_PRODUCT_IMAGE'])) {
            // Delete Query
          $stmt = $conn->prepare("DELETE FROM tbl_products_a174863_pt2 WHERE FLD_PRODUCT_ID = :pid");
            $stmt->bindParam(':pid', $pid);
    
          $stmt->execute();
  
        // Delete Image
          unlink("products/{$query['FLD_PRODUCT_IMAGE']}");
      }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
    } else {
        $_SESSION['error'] = "Sorry, but you don't have permission to delete this product.";
    }
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();   
}
 
//Edit
if (isset($_GET['edit'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {
  try {
 
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a174863_pt2 WHERE FLD_PRODUCT_ID = :pid");
     
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
       
      $pid = $_GET['edit'];
     
      $stmt->execute();
 
      $editrow = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($editrow['FLD_PRODUCT_IMAGE']))
            $editrow['FLD_PRODUCT_IMAGE'] = $editrow['FLD_PRODUCT_ID'] . '.jpg';
  }
  catch(PDOException $e){
    $_SESSION['error'] = "Error: " . $e->getMessage();
  }
  } else {
      $_SESSION['error'] = "Sorry, but you don't have permission to edit a customer.";
  } 
  if (isset($_SESSION['error'])) {
      header("LOCATION: {$_SERVER['PHP_SELF']}");
      exit();
    }
}

 $num = $conn->query("SELECT MAX(FLD_PRODUCT_ID) AS pid FROM tbl_products_a174863_pt2")->fetch()['pid'];

  if ($num){
    $num = ltrim($num, 'P')+1;
    $num = 'P'.str_pad($num,3,"0",STR_PAD_LEFT);
  }
  else{
    $num = 'P'.str_pad(1,3,"0",STR_PAD_LEFT);
  }
  $conn = null;
?>