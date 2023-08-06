<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
  <link rel="stylesheet" href="./css/stlogin.css">
</head>
<body>
  <h1 class="headorgan">Welcome to organize your tasks.</h1>
	<div class="container">
		<h1>Login</h1>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<label for="Email">Email Address:</label><br><br>
			<input type="text" id="Email" name="Email" autofocus required value="<?php if(isset($_POST['Email'])) {echo $_POST['Email'];} ?>"><br><br>
			<label for="password">Password:</label><br><br>
			<input type="password" id="password" name="password" required><br><br>
			<input type="submit" value="Login" class="inp1">
		</form> 
    <br><br>
    <span>Don't have an account?</span>
    <a href="signup.php" class="inp2">Sign Up</a>
	</div>
  <a href="zenhom.html" class="Zenhom" target="_blank">&nbsp;Mahmoud Zenhom&nbsp;</a>
  <?php
      require_once 'connect.php';
      if($_SERVER['REQUEST_METHOD'] === 'POST')
      {
        $name=htmlspecialchars(strtolower($_POST['Email']));
        $pass=htmlspecialchars($_POST["password"]);
        $Query2 = 'select user.email, user.password , user.fname , user.lname , user.role , user.iduser
                    from user
                    where email = :a and password = :b';
        $statment2 =$conn->prepare($Query2);
        $statment2->execute(array(
        ':a'=>$name,
        ':b'=>$pass
        )
        );
        $checkedlog=$statment2->fetch(PDO::FETCH_ASSOC);
        if($checkedlog)
        {
          $_SESSION['user_id'] = $checkedlog['iduser'];
          $_SESSION['funame'] = $checkedlog['fname'];
          $_SESSION['luname'] = $checkedlog['lname'];
          $_SESSION['role'] = $checkedlog['role'];
          if ($checkedlog['role'] === 'Admin')
          {
            echo "<h1 style='position:absolute; top: 35%; left: 65%; color:#EFC176'>
                Login Successfull! You will be redirect to the Admin Dashboard soon!
                </h1>"; 
            echo '<script>
                setTimeout(function() {
                    window.location.href = "admindashboard.php";
                }, 2000);
            </script>';
          }
          else if ($checkedlog['role'] === 'User')
          {
            echo "<h1 style='position:absolute; top: 35%; left: 65%; color:#EFC176'>
                Login Successful! You will be redirected to the User Profile soon!
                </h1>"; 
            echo '<script>
                setTimeout(function() {
                    window.location.href = "profile.php";
                }, 2000);
            </script>';
          }
        }
        else
        { 
          echo "<h1 style='position:absolute; top: 40%; left: 70%; color:#EFC176' id='logf'>
                  Login Faild!!
                </h1>"; 
          echo "<script>
          setTimeout ( function() {
              logf.innerHTML = '';
            } , 2000);
        </script>";
        }
      }
    ?>
</body>
</html>