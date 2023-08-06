<?php
  session_start();
  if (!isset($_SESSION['user_id']))
  {
      header('Location: index.php');
      exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <link rel="stylesheet" href="./css/Uprofile.css">
  </head>
  <body>
    <span class="heada1">Update Profile</span>
    <span class="heada2"><?php echo $_SESSION['funame']?> <?php echo $_SESSION['luname']?> </span>
    <?php
      if ($_SESSION['role'] === 'Admin')
      {
        echo '<a href="admindashboard.php" class="backlink">Back to Profile</a>';
      }
      else if ($_SESSION['role'] === 'User')
      {
        echo '<a href="profile.php" class="backlink">Back to Profile</a>';
      } 
    ?>
      <div class="container zooom">
      <h1 class="headnp">Update First Name</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="fname" class="luf">New First Name:</label><br><br>
        <input type="text" id="fname" name="fname" class="inpuf" value="<?php if(isset($_POST['fname'])) {echo $_POST['fname'];} ?>"><br><br>
        <label for="password" class="luf">Password:</label><br><br>
        <input type="password" id="password" name="password" class="inpuf"><br><br>
        <input type="submit" value="Update First Name" class="inpufs" name="fsub">
      </form> 
    </div>
    <?php
      require_once 'connect.php';
      $Countererrorf = 0;
      if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['fsub']))
      {
        $fnamep = $_POST['fname'];
        $pattern = '/^[A-Za-z]+$/';
        if(empty($fnamep) || !preg_match($pattern, $fnamep))
        {
          echo "
          <h2 style='position:absolute; top: 10.2%; left: 63%; color: #EFC176' id='fnt'>
                    First Name Faild!..Please Enter Letters Only.
                </h2>";
          echo "<script>
            setTimeout ( function() {
                fnt.innerHTML = '';
              } , 3000);
          </script>";
          $Countererrorf++;
        }
        $passp = htmlspecialchars($_POST['password']);
        if(empty($passp) || strlen($passp)<8)
        {
          echo "<h2 style='position:absolute; top: 13.6%; left: 63%; color: #EFC176' id='pasy'>
                    Password Faild!..Please Enter Valid Password.
                </h2>";
          echo "<script>
            setTimeout ( function() {
                pasy.innerHTML = '';
              } , 3000);
          </script>";
          $Countererrorf++;
        }
        $Query10 = 'select user.password from user where iduser = :a';
        $statment10 = $conn->prepare($Query10);
        $statment10->execute(array(
          ':a'=>$_SESSION['user_id']
        )
        );
        $datauser=$statment10->fetch(PDO::FETCH_ASSOC);

        if(isset($fnamep) 
        && isset($passp)
        && $datauser
        && $datauser['password'] === $passp 
        && $Countererrorf == 0)
        {
          $Query11 = 'update user set fname = :a where iduser = :b';
          $statmen11 = $conn->prepare($Query11);
          $statmen11->execute(array(
            ':a'=>$fnamep,
            ':b'=>$_SESSION['user_id']
          )
          );
          echo "<h1 style='position:absolute; top: 11%; left: 65%; color:#EFC176'>
                Update New First Name Successfull...
                </h1>"; 
          echo '<script>
              setTimeout(function() {
                  window.location.href = "index.php";
              }, 2000);
          </script>';
          session_destroy();
        }
        else if($Countererrorf == 0)
        {
          echo "<h1 style='position:absolute; top: 11%; left: 65%; color:#EFC176' id='uif'>
                Update First Name Faild...
                </h1>"; 
          
          echo "<script>
            setTimeout ( function() {
                uif.innerHTML = '';
              } , 3000);
          </script>";
        }
      }
    ?>
    <hr>
    <div class="container zooom">
      <h1 class="headnp">Update Last Name</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="lname" class="luf">New Last Name:</label><br><br>
        <input type="text" id="lname" name="lname" class="inpuf" value="<?php if(isset($_POST['lname'])) {echo $_POST['lname'];} ?>"><br><br>
        <label for="passwordl" class="luf">Password:</label><br><br>
        <input type="password" id="passwordl" name="passwordl"  class="inpuf"><br><br>
        <input type="submit" value="Update Last Name" class="inpufs" name="lsub">
      </form> 
    </div>
    <?php
      require_once 'connect.php';
      $Countererrorl = 0;
      if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['lsub']))
      {
        $lname = $_POST['lname'];
        $patternl = '/^[A-Za-z]+$/';
        if(empty($lname) || !preg_match($patternl, $lname))
        {
          echo "
          <h2 style='position:absolute; top: 26.2%; left: 63%; color: #EFC176' id='lnt'>
                    Last Name Faild!..Please Enter Letters Only.
                </h2>";
          echo "<script>
            setTimeout ( function() {
                lnt.innerHTML = '';
              } , 3000);
          </script>";
          $Countererrorl++;
        }
        $passpl = htmlspecialchars($_POST['passwordl']);
        if(empty($passpl) || strlen($passpl)<8)
        {
          echo "<h2 style='position:absolute; top: 29.7%; left: 63%; color: #EFC176' id='pasyl'>
                    Password Faild!..Please Enter Valid Password.
                </h2>";
          echo "<script>
            setTimeout ( function() {
                pasyl.innerHTML = '';
              } , 3000);
          </script>";
          $Countererrorl++;
        }
        $Query12 = 'select user.password from user where iduser = :a';
        $statment12 = $conn->prepare($Query12);
        $statment12->execute(array(
          ':a'=>$_SESSION['user_id']
        )
        );
        $datauserl=$statment12->fetch(PDO::FETCH_ASSOC);

        if(isset($lname) 
        && isset($passpl)
        && $datauserl
        && $datauserl['password'] === $passpl 
        && $Countererrorl == 0)
        {
          $Query13 = 'update user set lname = :a where iduser = :b';
          $statmen13 = $conn->prepare($Query13);
          $statmen13->execute(array(
            ':a'=>$lname,
            ':b'=>$_SESSION['user_id']
          )
          );
          echo "<h1 style='position:absolute; top: 27%; left: 65%; color:#EFC176'>
                Update New Last Name Successfull...
                </h1>"; 
          echo '<script>
              setTimeout(function() {
                  window.location.href = "index.php";
              }, 2000);
          </script>';
          session_destroy();
        }
        else if($Countererrorl == 0)
        {
          echo "<h1 style='position:absolute; top: 27%; left: 65%; color:#EFC176' id='uil'>
                Update Last Name Faild...
                </h1>"; 
          echo "<script>
            setTimeout ( function() {
                uil.innerHTML = '';
              } , 3000);
          </script>";
        }
      }
    ?>
    <hr>
    <div class="container zooom">
      <h1 class="headnp">Update Email Address</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="email" class="luf">New Email Address:</label><br><br>
        <input type="email" id="email" name="email" class="inpuf" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>"><br><br>
        <label for="passworde" class="luf">Password:</label><br><br>
        <input type="password" id="passworde" name="passworde" class="inpuf"><br><br>
        <input type="submit" value="Update Email Address" class="inpufs" name="esub">
      </form> 
    </div>
    <?php
      require_once 'connect.php';
      $Countererrore = 0;
      if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['esub']))
      {
        $emailp = strtolower($_POST['email']);
        if(empty($emailp) || !filter_var($emailp , FILTER_VALIDATE_EMAIL))
        {
          echo "<h2 style='position:absolute; top: 42.3%; left: 63%; color: #EFC176' id='emye'>
                  Email Address Faild!..Please Enter Valid Email.
                </h2>";
          echo "<script>
                  setTimeout ( function() {
                      emye.innerHTML = '';
                    } , 3000);
                </script>";
          $Countererrore++;
        }
        $Query14 = 'select user.email
                    from user
                    where email = :a';
        $statment14 =$conn->prepare($Query14);
        $statment14->execute(array(
        ':a'=>$emailp
        )
        );
        $checkedloge=$statment14->fetch(PDO::FETCH_ASSOC);
        if($checkedloge && $checkedloge['email'] == $emailp && !empty($emailp))
        {
          echo "<h2 style='position:absolute; top: 42.3%; left: 63%; color: #EFC176' id='emyde'>
                  This Email is already in use. Try using another Email.
                </h2>";
          echo "<script>
            setTimeout ( function() {
                emyde.innerHTML = '';
              } , 3000);
          </script>";
          $Countererrore++;
        }
        $passple = htmlspecialchars($_POST['passworde']);
        if(empty($passple) || strlen($passple)<8)
        {
          echo "<h2 style='position:absolute; top: 45.6%; left: 63%; color: #EFC176' id='pasyle'>
                    Password Faild!..Please Enter Valid Password.
                </h2>";
          echo "<script>
              setTimeout ( function() {
                  pasyle.innerHTML = '';
                } , 3000);
            </script>";
          $Countererrore++;
        }
        $Query15 = 'select user.password from user where iduser = :a';
        $statment15 = $conn->prepare($Query15);
        $statment15->execute(array(
          ':a'=>$_SESSION['user_id']
        )
        );
        $datauserle=$statment15->fetch(PDO::FETCH_ASSOC);

        if(isset($emailp) 
        && isset($passple)
        && $datauserle
        && $datauserle['password'] === $passple 
        && $Countererrore == 0)
        {
          $Query16 = 'update user set email = :a where iduser = :b';
          $statmen16 = $conn->prepare($Query16);
          $statmen16->execute(array(
            ':a'=>$emailp,
            ':b'=>$_SESSION['user_id']
          )
          );
          echo "<h1 style='position:absolute; top: 43%; left: 65%; color:#EFC176'>
                  Update New Email Address Successfull...
                </h1>"; 
          echo '<script>
              setTimeout(function() {
                  window.location.href = "index.php";
              }, 2000);
          </script>';
          session_destroy();
        }
        else if($Countererrore == 0)
        {
          echo "<h1 style='position:absolute; top: 43%; left: 65%; color:#EFC176' id='uil'>
                Update Email Address Faild...
                </h1>"; 
          echo "<script>
            setTimeout ( function() {
                uil.innerHTML = '';
              } , 3000);
          </script>";
        }
      }
    ?>
    <hr>
    <div class="container zooom">
      <h1 class="headnp">Update Password</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="npass" class="luf">New Password:</label><br><br>
        <input type="password" id="npass" name="npass" class="inpuf" value="<?php if(isset($_POST['npass'])) {echo $_POST['npass'];} ?>"><br><br>
        <label for="opass" class="luf">Old Password:</label><br><br>
        <input type="password" id="opass" name="opass" class="inpuf"><br><br>
        <input type="submit" value="Update Password" class="inpufs" name="psub">
      </form> 
    </div>
    <?php
      require_once 'connect.php';
      $Countererrorp = 0;
      if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['psub']))
      {
        $npass = htmlspecialchars($_POST['npass']);
        if(empty($npass) || strlen($npass)<8)
        {
          echo "<h2 style='position:absolute; top: 58.4%; left: 63%; color: #EFC176' id='pasyn'>
                    Password Faild!..Enter Password of 8 characters or more.
                </h2>";
          echo "<script>
              setTimeout ( function() {
                  pasyn.innerHTML = '';
                } , 3000);
            </script>";
          $Countererrorp++;
        }
        $opass = htmlspecialchars($_POST['opass']);
        if(empty($opass) || strlen($opass)<8)
        {
          echo "<h2 style='position:absolute; top: 61.8%; left: 63%; color: #EFC176' id='pasylo'>
                    Password Faild!..Please Enter Valid Password.
                </h2>";
          echo "<script>
                  setTimeout ( function() {
                      pasylo.innerHTML = '';
                    } , 3000);
                </script>";
          $Countererrorp++;
        }
        $Query17 = 'select user.password from user where iduser = :a';
        $statment17 = $conn->prepare($Query17);
        $statment17->execute(array(
          ':a'=>$_SESSION['user_id']
        )
        );
        $datauserlp=$statment17->fetch(PDO::FETCH_ASSOC);

        if(isset($npass) 
        && isset($opass)
        && $datauserlp
        && $datauserlp['password'] === $opass 
        && $Countererrorp == 0)
        {
          $Query18 = 'update user set password = :a where iduser = :b';
          $statmen18 = $conn->prepare($Query18);
          $statmen18->execute(array(
            ':a'=>$npass,
            ':b'=>$_SESSION['user_id']
          )
          );
          echo "<h1 style='position:absolute; top: 58.6%; left: 65%; color:#EFC176'>
                Update New Password Successfull...
                </h1>"; 
          echo '<script>
              setTimeout(function() {
                  window.location.href = "index.php";
              }, 2000);
          </script>';
          session_destroy();
        }
        else if($Countererrorp == 0)
        {
          echo "<h1 style='position:absolute; top: 58.6%; left: 65%; color:#EFC176' id='uilp'>
                Update Password Faild...
                </h1>"; 
          echo "<script>
            setTimeout ( function() {
                uilp.innerHTML = '';
              } , 3000);
          </script>";
        }
      }
    ?>
    <hr>
    <div class="container zooom">
      <h1 class="headnp">Update Phone Number</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="nphone" class="luf">New Phone Number:</label><br><br>
        <input type="tel" id="nphone" name="nphone" class="inpuf" value="<?php if(isset($_POST['nphone'])) {echo $_POST['nphone'];} ?>"><br><br>
        <label for="nppass" class="luf">Password:</label><br><br>
        <input type="password" id="nppass" name="nppass" class="inpuf"><br><br>
        <input type="submit" value="Update Phone Number" class="inpufs" name="npsub">
      </form> 
    </div>
    <?php
      require_once 'connect.php';
      $Countererrornp = 0;
      if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['npsub']))
      {
        $nphone = $_POST['nphone'];
        $patternnp = '/^(010|011|012|015)[0-9]{8}$/';
        if (
            !empty($nphone)
            && preg_match($patternnp, $nphone)
        ) {
            echo "";
        } else {
            echo "<h2 style='position:absolute; top: 74.4%; left: 63%; color: #EFC176' id='mobyn'>
                      Phone Number Failed!..Please Enter Valid Phone Number.
                  </h2>";
            echo "<script>
              setTimeout(function() {
                  document.getElementById('mobyn').innerHTML = '';
                }, 3000);
            </script>";
            $Countererrornp++;
        }
        $nppass = htmlspecialchars($_POST['nppass']);
        if(empty($nppass) || strlen($nppass)<8)
        {
          echo "<h2 style='position:absolute; top: 77.8%; left: 63%; color: #EFC176' id='pasylnp'>
                    Password Faild!..Please Enter Valid Password.
                </h2>";
          echo "<script>
            setTimeout ( function() {
                pasylnp.innerHTML = '';
              } , 3000);
          </script>";
          $Countererrornp++;
        }
        $Query19 = 'select user.password from user where iduser = :a';
        $statment19 = $conn->prepare($Query19);
        $statment19->execute(array(
          ':a'=>$_SESSION['user_id']
        )
        );
        $datauserlnp=$statment19->fetch(PDO::FETCH_ASSOC);

        if(isset($nphone) 
        && isset($nppass)
        && $datauserlnp
        && $datauserlnp['password'] === $nppass 
        && $Countererrornp == 0)
        {
          $Query20 = 'update user set mobile = :a where iduser = :b';
          $statmen20 = $conn->prepare($Query20);
          $statmen20->execute(array(
            ':a'=>$nphone,
            ':b'=>$_SESSION['user_id']
          )
          );
          echo "<h1 style='position:absolute; top:75%; left: 65%; color:#EFC176'>
                Update New Phone Number Successfull...
                </h1>"; 
          echo '<script>
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 2000);
                </script>';
          session_destroy();
        }
        else if($Countererrornp == 0)
        {
          echo "<h1 style='position:absolute; top: 75%; left: 65%; color:#EFC176' id='uilpp'>
                Update Phone Number Faild...
                </h1>"; 
          echo "<script>
            setTimeout ( function() {
                uilpp.innerHTML = '';
              } , 3000);
          </script>";
        }
      }
    ?>
    <hr>
    <div class="container zooom">
      <h1 class="headnp">Update Data OF Birth</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="dateu" class="luf">New Date OF Birth:</label><br><br>
        <input type="date" id="dateu" name="dateu" class="inpuf" value="<?php if(isset($_POST['dateu'])) {echo $_POST['dateu'];} ?>"><br><br>
        <label for="passdu" class="luf">Password:</label><br><br>
        <input type="password" id="passdu" name="passdu" class="inpuf"><br><br>
        <input type="submit" value="Update Data OF Birth" class="inpufs" name="dasub">
      </form> 
    </div>
    <?php
      require_once 'connect.php';
      $Countererrornpd = 0;
      if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['dasub']))
      {
        $dateu = $_POST['dateu'];
        if(empty($dateu) || strtotime($dateu) > strtotime('31 December 2016'))
        {
          echo "<h2 style='position:absolute; top: 90.6%; left: 63%; color: #EFC176' id='dateua'>
                    Please Select Your Correct Date Of Birth.
                </h2>";
          echo "<script>
                  setTimeout ( function() {
                      dateua.innerHTML = '';
                    } , 3000);
                </script>";
          $Countererrornpd++;
        }
        $passdu = htmlspecialchars($_POST['passdu']);
        if(empty($passdu) || strlen($passdu)<8)
        {
          echo "<h2 style='position:absolute; top: 93.9%; left: 63%; color: #EFC176' id='pasylnpd'>
                    Password Faild!..Please Enter Valid Password.
                </h2>";
          echo "<script>
                setTimeout ( function() {
                    pasylnpd.innerHTML = '';
                  } , 3000);
              </script>";
          $Countererrornpd++;
        }
        $Query21 = 'select user.password from user where iduser = :a';
        $statment21 = $conn->prepare($Query21);
        $statment21->execute(array(
          ':a'=>$_SESSION['user_id']
        )
        );
        $datauserlnpd=$statment21->fetch(PDO::FETCH_ASSOC);

        if(isset($dateu) 
        && isset($passdu)
        && $datauserlnpd
        && $datauserlnpd['password'] === $passdu 
        && $Countererrornpd == 0)
        {
          $Query22 = 'update user set data = :a where iduser = :b';
          $statmen22 = $conn->prepare($Query22);
          $statmen22->execute(array(
            ':a'=>$dateu,
            ':b'=>$_SESSION['user_id']
          )
          );
          echo "<h1 style='position:absolute; top: 91%; left: 65%; color:#EFC176' id='dddf'>
                Update New Date OF Birth Successfull...
                </h1>"; 
          echo '<script>
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 2000);
                </script>';
          session_destroy();
        }
        else if($Countererrornpd == 0)
        {
          echo "<h1 style='position:absolute; top: 91%; left: 65%; color:#EFC176' id='uilppd'>
                Update Date OF Birth Faild...
                </h1>"; 
          echo "<script>
            setTimeout ( function() {
                uilppd.innerHTML = '';
              } , 3000);
          </script>";
        }
      }
    ?>
    <script>
      window.scrollTo({
        top: sessionStorage.getItem("scrollSaver"),
      });

      setTimeout(() => {
        window.addEventListener("scroll", () => {
          sessionStorage.setItem(
            "scrollSaver",
            document.documentElement.scrollTop
          );
        });
      },0);
    </script>
  </body>
</html>
