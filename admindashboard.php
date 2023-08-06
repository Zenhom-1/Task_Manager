<?php
  session_start();
  if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'Admin') 
  {
      header('Location: index.php');
      exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./css/Uprofile.css">
  </head>
  <body>
    <h1 class="head1">Admin Dashboard Page</h1>
    <h2 class="head2 adh">Welcome , <?php echo $_SESSION['funame']?> <?php echo $_SESSION['luname']?> <h2>
    <div >
      <nav >
        <ul class="page">
            <li><a href="add_task.php">Add Task &nbsp;&nbsp;</a></li>
            <li><a href="show_tasks.php">Show Task &nbsp;&nbsp;</a></li>
            <li><a href="update_profile.php">Update Profile &nbsp;&nbsp; </a></li>
            <li><a href="logout.php">Logout  &nbsp;&nbsp;</a></li>
            <li><a href="delete_account.php">Delete Account &nbsp;&nbsp; </a></li>
            <li><a href="show_user.php">Show ALL Users &nbsp;&nbsp; </a></li>
            <li><a href="all_task.php">ALL Tasks &nbsp;&nbsp; </a></li>
        </ul>
      </nav>
    </div>
    <div class="tm">
    </div>
  </body>
</html>