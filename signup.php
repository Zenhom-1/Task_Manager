<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Page</title>
  <link rel="stylesheet" href="./css/stylesign.css">
</head>
<body>
	<div class="container zoom">
		<h1>Sign up</h1>
    <p>It's quick and easy.</p>
    <hr>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<label for="fname" class="l1">First Name:</label><br>
			<input class="p1" type="text" id="fname" name="FirstName" value="<?php if(isset($_POST['FirstName'])) {echo $_POST['FirstName'];} ?>"><br><br>
			<label for="lname" class="l1">Last Name:</label><br>
			<input class="p1" type="text" id="lname" name="LastName"  value="<?php if(isset($_POST['LastName'])) {echo $_POST['LastName'];} ?>"><br><br>
			<label for="email" class="l1">Email Address:</label><br>
			<input class="p1" type="email" id="email" name="emaill"  value="<?php if(isset($_POST['emaill'])) {echo $_POST['emaill'];} ?>"><br><br>
			<label for="password" class="l1">Password:</label><br>
			<input class="p1" type  ="password" id="password" name="password"  value="<?php if(isset($_POST['password'])) {echo $_POST['password'];} ?>"><br><br>
			<label for="mob" class="l1">Phone Number:</label><br>
			<input class="p1" type="tel" id="mob" name="mob"  value="<?php if(isset($_POST['mob'])) {echo $_POST['mob'];} ?>"><br><br>
			<label class="lg">Gender:</label><br><br>
			<input type="radio" id="male" name="Gender" value="Male">
      <label for="male" class="lm">Male</label>
			<input type="radio" id="female" name="Gender" class="pf" value="Female">
      <label for="female" class="lf">Female</label><br><br>
			<label for="Date" class="lg">Date Of Birth:</label><br><br>
			<input type="Date" id="Date" name="Date" class="lg" value="<?php if(isset($_POST['Date'])) {echo $_POST['Date'];} ?>"><br><br>
			<input type="submit" value="Create New Account" class="inp2" name="submit">
		</form>
	</div>
  <?php
    require_once 'connect.php';
    $Countererror = 0;
    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
      $fnamep = $_POST['FirstName'];
      $pattern = '/^[A-Za-z]+$/';
      if(empty($fnamep) || !preg_match($pattern, $fnamep))
      {
        echo "
        <h3 style='position:absolute; top: 25%; left: 63%; color: #EFC176' id='fnt'>
                  First Name Faild!..Please Enter Letters Only.
              </h3>";
        echo "<script>
          setTimeout ( function() {
              fnt.innerHTML = '';
            } , 3000);
        </script>";
        $Countererror++;
      }
      $lnamep = $_POST['LastName'];
      if(empty($lnamep) || !preg_match($pattern, $lnamep))
      {
        echo "<h3 style='position:absolute; top: 33%; left: 63%; color: #EFC176' id='lnt'>
                  Last Name Faild!..Please Enter Letters Only.
              </h3>";
        echo "<script>
          setTimeout ( function() {
              lnt.innerHTML = '';
            } , 3000);
        </script>";
        $Countererror++;
      }
      $emailp = strtolower($_POST['emaill']);
      if(empty($emailp) || !filter_var($emailp , FILTER_VALIDATE_EMAIL))
      {
        echo "<h3 style='position:absolute; top: 41%; left: 63%; color: #EFC176' id='emy'>
                  Email Address Faild!..Please Enter Valid Email.
              </h3>";
        echo "<script>
          setTimeout ( function() {
              emy.innerHTML = '';
            } , 3000);
        </script>";
        $Countererror++;
      }
        $Query3 = 'select user.email
                    from user
                    where email = :a';
        $statment3 =$conn->prepare($Query3);
        $statment3->execute(array(
        ':a'=>strtolower($_POST['emaill'])
        )
        );
        $checkedlog=$statment3->fetch(PDO::FETCH_ASSOC);
        if($checkedlog && $checkedlog['email'] == $emailp && !empty($emailp))
        {
          echo "<h3 style='position:absolute; top: 41%; left: 63%; color: #EFC176' id='emyd'>
                  This Email is already in use. Try using another Email.
                </h3>";
          echo "<script>
            setTimeout ( function() {
                emyd.innerHTML = '';
              } , 3000);
          </script>";
          $Countererror++;
        }
      $passp = htmlspecialchars($_POST['password']);
      if(empty($passp) || strlen($passp)<8)
      {
        echo "<h3 style='position:absolute; top: 49%; left: 63%; color: #EFC176' id='pasy'>
                  Password Faild!..Enter Password of 8 characters or more.
              </h3>";
        echo "<script>
          setTimeout ( function() {
              pasy.innerHTML = '';
            } , 3000);
        </script>";
        $Countererror++;
      }
      $mobp = $_POST['mob'];
      $patternn = '/^(010|011|012|015)[0-9]{8}$/';
      if (
          !empty($mobp)
          && preg_match($patternn, $mobp)
      ) {
          echo "";
      } else {
          echo "<h3 style='position:absolute; top: 57%; left: 63%; color: #EFC176' id='moby'>
                    Phone Number Failed!..Please Enter a Valid Phone Number.
                </h3>";
          echo "<script>
            setTimeout(function() {
                document.getElementById('moby').innerHTML = '';
              }, 3000);
          </script>";
          $Countererror++;
      }
      if(empty($_POST['Gender']))
      {
        echo "<h3 style='position:absolute; top: 67%; left: 63%; color: #EFC176' id='genf'>
                  Please Select Your Gender.
              </h3>";
        echo "<script>
          setTimeout ( function() {
              genf.innerHTML = '';
            } , 3000);
        </script>";
        $Countererror++;
      }
      if(empty($_POST['Date']) || strtotime($_POST['Date']) > strtotime('31 December 2016'))
      {
        echo "<h3 style='position:absolute; top: 75%; left: 63%; color: #EFC176' id='dat'>
                  Please Select Your Correct Date Of Birth.
              </h3>";
        echo "<script>
          setTimeout ( function() {
              dat.innerHTML = '';
            } , 3000);
        </script>";
        $Countererror++;
      }
      if(isset($_POST['FirstName']) 
        && isset($_POST['LastName'])
        && isset($_POST['emaill'])
        && isset($passp)
        && isset($_POST['mob'])
        && isset($_POST['Gender']) 
        && isset($_POST['Date'])
        && $Countererror == 0)
        {
        $Query1 = 'insert into user (fname,lname,email,password,mobile,gender,data) values(:a,:b,:c,:d,:e,:f,:g)';
        $statmen1 = $conn->prepare($Query1);
        $statmen1->execute(array(
          ':a'=>$_POST['FirstName'],
          ':b'=>$_POST['LastName'],
          ':c'=>strtolower($_POST['emaill']),
          ':d'=>$passp,
          ':e'=>$_POST['mob'],
          ':f'=>$_POST['Gender'],
          ':g'=>$_POST['Date']
        )
        );
        echo "<h1 style='position:absolute; top: 50%; left: 70%; color:#EFC176' id='succ'>
                  Registration New Account successful!...
              </h1>"; 
        echo '<script>
        setTimeout ( function() {
              succ.innerHTML = "";
            } , 3000);
        setTimeout(function() {
            window.location.href = "index.php";
        }, 3000);
      </script>'; 
      }
    }
    ?>
</body>
</html>