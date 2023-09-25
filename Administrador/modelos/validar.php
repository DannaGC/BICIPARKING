<?php
$admin = $_POST['admin'];
$password = $_POST['password'];

$admi = '0000000';
$contra = '123456';

session_start();
if ($admin === $admi && $password === $contra) {
  $_SESSION['admin'] = $admin;
  header("Location: ../pages/listado.php");
  exit();
}else{
  echo "El código de ingreso o la contraseña son incorrectos.";
}
?>