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
    $stmt = $conn->prepare("INSERT INTO tbl_staffs_a174863_pt2(FLD_STAFF_ID, FLD_STAFF_FNAME, FLD_STAFF_LNAME, FLD_EMAIL,  FLD_PASSWORD, FLD_ROLE) VALUES(:sid, :fname, :lname, :email, :pass, :role)");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $role = $_POST['role'];
         
    $stmt->execute();
  }
  catch(PDOException $e)
  {
    $_SESSION['error'] = "Error while creating: " . $e->getMessage();
  }
} else {
    $_SESSION['error'] = "Sorry, but you don't have permission to create a new staff.";
  }
  header("LOCATION: {$_SERVER['REQUEST_URI']}");
  exit();
}
 
//Update
if (isset($_POST['update'])) {
 if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {  
  try {
 
    $stmt = $conn->prepare("UPDATE tbl_staffs_a174863_pt2 SET
      FLD_STAFF_ID = :sid, FLD_STAFF_FNAME = :fname,
      FLD_STAFF_LNAME = :lname, FLD_EMAIL = :email, 
      FLD_PASSWORD = :pass, FLD_ROLE = :role
      WHERE FLD_STAFF_ID = :oldsid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
    $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);
       
    $sid = $_POST['sid'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $role = $_POST['role'];
    $oldsid = $_POST['oldsid'];
         
    $stmt->execute();
  }
  catch(PDOException $e)
  {
    $_SESSION['error'] = "Error while updating: " . $e->getMessage();
    header("LOCATION: {$_SERVER['REQUEST_URI']}");
    exit();
  }
} else {
    $_SESSION['error'] = "Sorry, but you don't have permission to update staff.";
  }
  header("LOCATION: {$_SERVER['PHP_SELF']}");
  exit();
}
 
//Delete
if (isset($_GET['delete'])) {
  if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') {
  try {
    $stmt = $conn->prepare("DELETE FROM tbl_staffs_a174863_pt2 where FLD_STAFF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);   
    $sid = $_GET['delete'];
    $stmt->execute();
  }
  catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
} else {
        $_SESSION['error'] = "Sorry, but you don't have permission to delete staff.";
  }
  header("LOCATION: {$_SERVER['PHP_SELF']}");
  exit();
}
 
//Edit
if (isset($_GET['edit'])) {
 if (isset($_SESSION['user']) && $_SESSION['user']['FLD_ROLE'] == 'admin') { 
  try {
    $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a174863_pt2 where FLD_STAFF_ID = :sid");
   
    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $sid = $_GET['edit'];
    $stmt->execute();
 
    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
  catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
  }
} else {
    $_SESSION['error'] = "Sorry, but you don't have permission to edit a staff.";
    header("LOCATION: {$_SERVER['PHP_SELF']}");
    exit();
  }
}

 $num = $conn->query("SELECT MAX(FLD_STAFF_ID) AS pid FROM tbl_staffs_a174863_pt2")->fetch()['pid'];

  if ($num){
    $num = ltrim($num, 'S')+1;
    $num = 'S'.str_pad($num,3,"0",STR_PAD_LEFT);
  }
  else{
    $num = 'S'.str_pad(1,3,"0",STR_PAD_LEFT);
  }
  $conn = null;
 
?>