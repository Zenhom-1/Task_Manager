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
    <div class="heada1">All Your Tasks</div>
    <div class="headas2"><?php echo $_SESSION['funame']?> <?php echo $_SESSION['luname']?> </div>
    <table>
      <tr>
          <th class="th1">Task Name</th>
          <th>Task Day</th>
          <th>Task Time</th>
          <th class="th2">Finished OR Still</th>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <?php
        require_once 'connect.php';
        $useridd = $_SESSION['user_id'];
        $Query5 = 'select task.tname , task.tdate , task.ttime , task.idtask
                    from task
                    where idu = :a';
        $statment5 =$conn->prepare($Query5);
        $statment5->execute(array(
        ':a'=>$useridd
        )
        );
        if($statment5)
        {
          while($task=$statment5->fetch(PDO::FETCH_ASSOC))
          {
            echo "<tr><td>";
            echo $task['tname'];
            echo '</td><td>';
            echo $task['tdate'];
            echo '</td><td>';
            echo $task['ttime'] .' Minutes';
            echo '</td><td>';
            echo "<a class='deletelink' href=delete.php?IDTask=" , (htmlentities($task['idtask'])) , ">Delete Task</a></td></tr>";
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
