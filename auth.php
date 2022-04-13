<?php
$_SESSION['lgn'] = $_POST['login'];
$_SESSION['psw'] = $_POST['password'];
echo $_SESSION['lgn'] . ' ' . $_POST['login'];
require_once('parts/mysql.php');
$sql = "SELECT * FROM employee;";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  if (!($_SESSION['lgn'] == $row['lgn'] && $_SESSION['psw'] == $row['psw'])) {
    echo "Неверный логин или пароль";
  } else {
    exit("<meta http-equiv='refresh' content='0; url=menu.php' />");
  }
}
