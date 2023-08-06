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
    <title>Add Task</title>
    <link rel="stylesheet" href="./css/Uprofile.css">
  </head>
  <body>
    <span class="heada1">Add Task</span>
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
    <div class="pagetask zoom">
      <form class="formm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label for="addtask" class="lab">Add Task Name:</label>
        <input class="inpt" type="text" id="addtask" name="addtask" value="<?php if(isset($_POST['addtask'])) {echo $_POST['addtask'];} ?>" autofocus>
        <label for="taskday" class="lab">Task Day:</label>
        <input class="inpt" type="date" id="taskday" name="taskday" value="<?php if(isset($_POST['taskday'])) {echo $_POST['taskday'];} ?>">
        <label for="tasktime" class="lab">Task Time In Minutes:</label>
        <input class="inpt" type="text" id="tasktime" name="tasktime" value="<?php if(isset($_POST['tasktime'])) {echo $_POST['tasktime'];} ?>">
        <input type="submit" class="subt" value="Add Task">
      </form>
    </div>
    <?php
      require_once 'connect.php';
      $Countererror = 0;
      if ($_SERVER['REQUEST_METHOD'] === 'POST')
      {
        $addtaskk = $_POST['addtask'];
        $pattern = '/^[A-Za-z0-9\s]+$/';
        if(empty($addtaskk) || !preg_match($pattern, $addtaskk))
        {
          echo "
          <h3 style='position:absolute; top: 39%; left: 58%; color: #EFC176' id='addtaskkk'>
            Task Name Faild!..Please Enter Letters OR Number Only.
          </h3>";
          echo "<script>
            setTimeout ( function() {
                addtaskkk.innerHTML = '';
              } , 3000);
          </script>";
          $Countererror++;
        }
        if(empty($_POST['taskday']))
        {
          echo "<h3 style='position:absolute; top: 53%; left: 58%; color: #EFC176' id='dat'>
                  Please Select Your Correct Date Of Birth.
                </h3>";
          echo "<script>
            setTimeout ( function() {
                dat.innerHTML = '';
              } , 3000);
          </script>";
          $Countererror++;
        }
        $taskktime = $_POST['tasktime'];
        $pattern = '/^[0-9]+$/';
        if(empty($taskktime) || !preg_match($pattern, $taskktime) || strlen($taskktime) > 3)
        {
          echo "
          <h3 style='position:absolute; top: 68%; left: 58%; color: #EFC176' id='taskkktime'>
            Task Time Faild!..Please Enter Correct Minutes Less Than 999 .
          </h3>";
          echo "<script>
            setTimeout ( function() {
                taskkktime.innerHTML = '';
              } , 3000);
          </script>";
          $Countererror++;
        }
        if(isset($addtaskk) 
        && isset($_POST['taskday'])
        && isset($taskktime)
        && $Countererror == 0)
        {
          $Query4 = 'insert into task (tname,tdate,ttime,idu) values(:a,:b,:c,:d)';
          $statmen4 = $conn->prepare($Query4);
          $statmen4->execute(array(
            ':a'=>$addtaskk,
            ':b'=>$_POST['taskday'],
            ':c'=>$taskktime,
            ':d'=>$_SESSION['user_id']
          )
          );
          echo "<h1 style='position:absolute; top: 50%; left: 60%; color:#EFC176' id='succ'>
                    The task has been added successfully...
                </h1>"; 
          if ($_SESSION['role'] === 'Admin')
          {
            echo '<script>
            setTimeout ( function() {
                  succ.innerHTML = "";
                } , 3000);
              setTimeout(function() {
                  window.location.href = "admindashboard.php";
              }, 3000);
            </script>';
          }
          else if ($_SESSION['role'] === 'User')
          {
            echo '<script>
            setTimeout ( function() {
                  succ.innerHTML = "";
                } , 3000);
              setTimeout(function() {
                  window.location.href = "profile.php";
              }, 3000);
            </script>';
          } 
      }
    }
    ?>
  </body>
</html>
