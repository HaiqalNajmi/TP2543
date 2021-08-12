<?php
 
include_once 'database.php';
if (!isset($_SESSION['loggedin']))
    header("LOCATION: login.php");
 
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
//Create
if (isset($_POST['create'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {

  try {
 
    $stmt = $conn->prepare("INSERT INTO tbl_customers_a174863_pt2(FLD_CUSTOMER_ID, FLD_CUSTOMER_FNAME, FLD_CUSTOMER_LNAME, FLD_PHONE_NUMBER) VALUES(:cid, :fname, :lname, :phone)");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
       
    $stmt->execute();
  }
 
  catch(PDOException $e)
  {
    $_SESSION['error'] = "Error while creating: " . $e->getMessage();
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
    $stmt = $conn->prepare("UPDATE tbl_customers_a174863_pt2 SET FLD_CUSTOMER_ID = :cid, FLD_CUSTOMER_FNAME = :fname, FLD_CUSTOMER_LNAME = :lname, FLD_PHONE_NUMBER = :phone
      WHERE FLD_CUSTOMER_ID = :oldcid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':oldcid', $oldcid, PDO::PARAM_STR);
       
    $cid = $_POST['cid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $oldcid = $_POST['oldcid'];
       
    $stmt->execute();
  }
  catch(PDOException $e) {
   $_SESSION['error'] = "Error while updating: " . $e->getMessage();
    header("LOCATION: {$_SERVER['REQUEST_URI']}");
    exit(); 
  }
} else {
    $_SESSION['error'] = "Sorry, but you don't have permission to update customer.";
    }
  
  header("LOCATION: {$_SERVER['PHP_SELF']}");
  exit();
}
 
//Delete
if (isset($_GET['delete'])) {
 if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {
  try {
    $stmt = $conn->prepare("DELETE FROM tbl_customers_a174863_pt2 WHERE FLD_CUSTOMER_ID = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);   
    $cid = $_GET['delete'];
    $stmt->execute();
  }
  catch(PDOException $e) {
    $_SESSION['error'] = "Error while deleting: " . $e->getMessage();
  }
} else {
        $_SESSION['error'] = "Sorry, but you don't have permission to delete customer.";
  }
  header("LOCATION: {$_SERVER['PHP_SELF']}");
  exit();
}
 
//Edit
if (isset($_GET['edit'])) {
 if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {
  try {
    $stmt = $conn->prepare("SELECT * FROM tbl_customers_a174863_pt2 WHERE FLD_CUSTOMER_ID = :cid");
   
    $stmt->bindParam(':cid', $cid, PDO::PARAM_STR);  
    $cid = $_GET['edit'];
    $stmt->execute();
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
    $_SESSION['error'] = "Error while editing: " . $e->getMessage();
    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
  }
} else {
    $_SESSION['error'] = "Sorry, but you don't have permission to edit a customer.";
    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
    }
}
 
 $num = $conn->query("SELECT MAX(FLD_CUSTOMER_ID) AS pid FROM tbl_customers_a174863_pt2")->fetch()['pid'];

  if ($num){
    $num = ltrim($num, 'C')+1;
    $num = 'C'.str_pad($num,3,"0",STR_PAD_LEFT);
  }
  else{
    $num = 'C'.str_pad(1,3,"0",STR_PAD_LEFT);
  }
  $conn = null;
 
?>