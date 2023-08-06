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
    <title>Show Tasks</title>
    <link rel="stylesheet" href="./css/Uprofile.css">
  </head>
  <body>
    <div class="heada1">Task List</div>
    <div class="headas2"><?php echo $_SESSION['funame']?> <?php echo $_SESSION['luname']?> </div>
    <table>
      <tr>
          <th class="th1">User ID</th>
          <th>Username</th>
          <th>Task ID</th>
          <th>Task Name</th>
          <th>Task Day</th>
          <th>Task Time</th>
          <th class="th2">Action</th>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <?php
        require_once 'connect.php';
        $Query24 = 'select task.idu  , user.fname , user.lname , task.idtask,task.tname , task.tdate, task.ttime 
                    from user , task
                    where user.iduser = task.idu';
        $statment24 =$conn->prepare($Query24);
        $statment24->execute();
        if($statment24)
        {
          while($usertask=$statment24->fetch(PDO::FETCH_ASSOC))
          {
            $username = $usertask['fname'] ." " .$usertask['lname'];
            echo "<tr><td>";
            echo $usertask['idu'];
            echo '</td><td>';
            echo $username;
            echo '</td><td>';
            echo $usertask['idtask'];
            echo '</td><td>';
            echo $usertask['tname'];
            echo '</td><td>';
            echo $usertask['tdate'];
            echo '</td><td>';
            echo $usertask['ttime'] . ' Minutes';
            echo '</td><td>';
            echo "<a class='deletelink' href=delete.php?IDTTask=" , (htmlentities($usertask['idtask'])) , ">Delete Task</a></td></tr>";
          }
        }
      ?>
    </table>
    <br><br>
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
    </body>
</html>
