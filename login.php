<?php
session_start();
if(isset($_SESSION['userid'])){
  header("Location: index.php");
}
include "konekcija.php";
if(isset($_POST['submit'])){
  if(empty($_POST['username']) || empty($_POST['password'])){
      $msg="Popunite sva polja";
  }else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);

    $password = md5($password);
    
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    if($q = $mysqli ->query($sql)){
      if(mysqli_num_rows($q) > 0){
      $red = $q->fetch_object();
      $_SESSION['userid'] = $red->id;
      $_SESSION['admin'] = $red->admin;
      if($red->admin == 1){
        header("Location: admin.php");
    }else{
      header("Location: index.php");
    }
  }else{
    $msg = "Pogresno korisnicko ime ili lozinka";
  }
}else{
  $msg = "Greska u upitu";
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> 
</head>
<body>
  <div class="row">
    <div class="col-lg-4 col-xs-12"></div>
    <div class="col-lg-4 col-xs-12">
      <div class="well login-form">
        <form action="" method="POST">
          <h1 class="text-center">Log in</h1>
          <?php if(isset($msg)){
            ?> 
            <div class="alert alert-info text-center"><?php echo $msg; ?></div>
            <?php } ?>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Username...">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password...">  
          </div>
          <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
        </form>
      </div>
    </div>
    <div class="col-lg-4 col-xs-12"></div>
  </div>

</body>
</html>
