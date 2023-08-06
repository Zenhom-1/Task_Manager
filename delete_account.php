<?php
  session_start();
  require_once 'connect.php';

  if (!isset($_SESSION['user_id']))
  {
    header('Location: index.php');
    exit();
  }

  $user_id = $_SESSION['user_id'];
  $Query9 = 'delete from user where iduser = :a';
  $statment9 =$conn->prepare($Query9);
  $statment9->execute(array(
  ':a' => $user_id
  )
  );
  session_destroy();
  header('Location: index.php');
  exit();
?>