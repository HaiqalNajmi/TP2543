<!DOCTYPE html>
<html>
<head>
  <title>My Guestbook</title>
</head>
 
<body>
 
<form method="post" action="insert.php">
  Name :
  <input type="text" name="name" size="40" required>
  <br>
  Email :
  <input type="text" name="email" size="25" required>
  <br>
  How did you find me?
  <select name="known">
        <option>From a friend</option>
        <option>I googled you</option>
        <option>Just surf on in</option>
        <option>From your Facebook</option>
        <option>I clicked an ads</option>
    </select><br>
  I like your:<br>
  <input type="checkbox" id="front_page" name="front_page" value="fp">
    <label for="front_page">Front Page</label><br>

  <input type="checkbox" id="form" name="like_form" value="form">
    <label for="form">Form</label><br>

  <input type="checkbox" id="ui" name="like_ui" value="ui">
    <label for="ui">User Interface</label><br>
    <br>
  Comments :<br>
  <textarea name="comment" cols="30" rows="8" required></textarea>
  <br>
  <input type="submit" name="add_form" value="Add a New Comment">
  <input type="reset">
  <br>
</form>
 
</body>
</html>