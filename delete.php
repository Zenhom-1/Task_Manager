<?php
// This code vulnerable to Idor
// I will mitegate it later
  session_start();
  require_once 'connect.php';

  if (!isset($_SESSION['user_id']))
  {
    header('Location: index.php');
    exit();
  }

  if (isset($_GET['IDTask']))
  {
    $task_id = $_GET['IDTask'];
    $Query7 = 'delete from task WHERE idtask = :a ';
    $statment7 = $conn->prepare($Query7);
    $statment7->execute(array(
    ':a' => $task_id
    )
    );
    header('Location: show_tasks.php');
    exit();
  }
  if (isset($_GET['IDTTask']))
  {
    $task_id = $_GET['IDTTask'];
    $Query7 = 'delete from task WHERE idtask = :a ';
    $statment7 = $conn->prepare($Query7);
    $statment7->execute(array(
    ':a' => $task_id
    )
    );
    header('Location: all_task.php');
    exit();
  }
  // else if (isset($_GET['IDTask']) && $_SESSION["role"] == "admin") 
  // {
  //     $task_id = $_GET['IDTask'];
  //     $Query8 = 'delete from task where idtask = :a';
  //     $statment8 = $conn->prepare($Query8);
  //     $statment8->execute(array(
  //     ':task_id' => $task_id
  //     )
  //     );
  //     header('Location: admindashboard.php');
  //     exit();
  // }
?>