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
    <title>Profile</title>
    <link rel="stylesheet" href="./css/Uprofile.css">
  </head>
  <body>
    <h1 class="head1">User Dashboard Page</h1>
    <h2 class="head2">Welcome , <?php echo $_SESSION['funame']?> <?php echo $_SESSION['luname']?> <h2>
    <div class="page">
      <nav>
        <ul>
            <li><a href="add_task.php">Add Task &nbsp;&nbsp;</a></li>
            <li><a href="show_tasks.php">Show Task &nbsp;&nbsp;</a></li>
            <li><a href="update_profile.php">Update Profile &nbsp;&nbsp; </a></li>
            <li><a href="logout.php">Logout  &nbsp;&nbsp;</a></li>
            <li><a href="delete_account.php">Delete Account &nbsp;&nbsp; </a></li>
        </ul>
      </nav>
    </div>
    <div>
      <div class="imgg">

    </div>
    </div>
  </body>
</html>