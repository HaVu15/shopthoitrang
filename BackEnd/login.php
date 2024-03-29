<?php
   include '../classes/adminlogin.php';

?>
<?php 
  $class = new adminlogin();
  if($_SERVER['REQUEST_METHOD'] === 'POST')
  {
    $adminUser =  $_POST['adminUser'];
    $adminPass =  $_POST['adminPass'];

    $login_check = $class->login_admin($adminUser,$adminPass) ;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./login.css" rel="stylesheet">
    <title>Document</title>
    <style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }
  
        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
      </style>
</head>
<body class="text-center">
    
    <main class="form-signin">
      <form action="login.php" method="POST">
        <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>
        <span>
          <?php
            if(isset($login_check)){
              echo $login_check;
            }
          ?>
        </span>
    
        <div class="form-floating">
          <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="adminUser">
          <label for="floatingInput">User</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="adminPass">
          <label for="floatingPassword">Password</label>
        </div>
    
        <div class="checkbox mb-3">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
      </form>
    </main>
    
    
        
      </body>

    

</html>