<?php
require_once 'database.php';

if (isset($_SESSION['loggedin']))
    header("LOCATION: index.php");

if (isset($_POST['userid'], $_POST['password'])) {
    $UserID = htmlspecialchars($_POST['userid']);
    $Pass = $_POST['password'];

    if (empty($UserID) || empty($Pass)) {
        $_SESSION['error'] = 'Please fill in the blanks.';
    } else {
        $stmt = $conn->prepare("SELECT * FROM tbl_staffs_a174863_pt2 WHERE (FLD_STAFF_ID = :id OR FLD_EMAIL = :id) LIMIT 1");
        $stmt->bindParam(':id', $UserID);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($user['FLD_STAFF_ID'])) {
            if ($user['FLD_PASSWORD'] == $Pass) {
                unset($user['FLD_PASSWORD']);
                $_SESSION['loggedin'] = true;
                $_SESSION['user'] = $user;

                header("LOCATION: index.php");
                exit();
            } else {
                $_SESSION['error'] = 'Invalid login credentials. Please try again.';
            }
        } else {
            $_SESSION['error'] = 'Account does not exist.';
        }
    }

    header("LOCATION: " . $_SERVER['REQUEST_URI']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>Pet Fish Inventory System : Login</title>
  <!-- Bootstrap -->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="bootstrap/css/style.css" type="text/css" rel="stylesheet">

  <link rel="shortcut icon" type="image/x-icon" href="FishLogo.png"/>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  </head>
  <body>

  <div class="form-structor">
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="POST">
      <div class="login">
        <h1 class="form-title" id="signup">Sign in</h1>
        <div class="form-holder">
          <input type="text" class="input" placeholder="Email/User ID" id="inputUserID" name="userid" required />
          <input type="password" class="input" placeholder="Password" id="inputUserPass" name="password" required />
        </div>
        <?php
        if (isset($_SESSION['error'])) {
          echo "<br><p class='alert alert-danger text-center'>{$_SESSION['error']}</p>";
          unset($_SESSION['error']);
        }
        ?>
        <button class="submit-btn" type="submit">Login</button>
      </div>
    </form>
    <div class="signup slide-up">
      <div class="center text-center">
        <h4 class="form-title" id="login">Demo Account</h4>
        <div class="form-holder">
          <h4>Admin Account</h4>
          <hr>
          <p>Staff ID: S001</p>
          <p>Email: larry.bay@bike.com</p>
          <p>Password: 1234</p>
        </div>
        <div class="form-holder">
          <h4>Staff Account</h4>
          <hr>
          <p>Staff ID: S002</p> 
          <p>Email: james.martin@bike.com</p>
          <p>Password: 1234</p>
        </div>
      </div>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="bootstrap/js/style.js"></script>
</body>
</html>

