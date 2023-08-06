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
    <title>Show Users</title>
    <link rel="stylesheet" href="./css/Uprofile.css">
  </head>
  <body>
    <div class="heada1">User List</div>
    <div class="headas2"><?php echo $_SESSION['funame']?> <?php echo $_SESSION['luname']?> </div>
    <table>
      <tr>
          <th class="th1">User ID</th>
          <th>Username</th>
          <th>Role</th>
          <th>Update</th>
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
        $Query23 = 'select user.iduser  , user.role ,user.fname , user.lname
                    from user';
        $statment23 =$conn->prepare($Query23);
        $statment23->execute();
        if($statment23)
        {
          while($user=$statment23->fetch(PDO::FETCH_ASSOC))
          {
            $username = $user['fname'] ." " .$user['lname'];
            echo "<tr><td>";
            echo $user['iduser'];
            echo '</td><td>';
            echo $username;
            echo '</td><td>';
            echo $user['role'];
            echo '</td><td>';
            echo "<a class='uss' href=update_account_Admin.php?IDUser=" , (htmlentities($user['iduser'])) , "&fname=" , urldecode(htmlentities($user['fname'])) , "&lname=" , urldecode(htmlentities($user['lname'])) , ">Update User</a>";
            echo '</td><td>';
            echo "<a class='deletelink' href=delete_account_Admin.php?IDUser=" , (htmlentities($user['iduser'])) , ">Delete User</a></td></tr>";
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
