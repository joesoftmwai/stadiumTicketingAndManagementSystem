<?php session_start(); ?>

<?php 

$_SESSION['firstname'] = null;
$_SESSION['email']     = null;

 session_destroy();

 header('Location: index.php');

 ?>