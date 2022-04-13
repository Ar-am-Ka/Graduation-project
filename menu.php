<?php
session_start();
require_once('parts/mysql.php');
$sql = "SELECT * FROM employee;";
$result = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($result)) {
  if (!($_SESSION['lgn'] == $row['lgn'] && $_SESSION['psw'] == $row['psw'])) {
    require("parts/head.php");
?>
    <title>Меню</title>
  <?php require("parts/header.php");
    echo "Неверный логин или пароль";
  } else {
    setcookie('name_emp', $row['name_emp'], time() + 1440);
    require("parts/head.php"); ?>
    <title>Меню</title>
    <?php
    require("parts/header.php");
    ?>
    <div class="menu">
      <div onclick="document.location.href ='monitorApplication.php'" class="menu-link">Монитор заявок</div>
      <div onclick="document.location.href ='getApplication.php'" class="menu-link">Принятие заявок</div>
      <div onclick="document.location.href ='addApplication.php'" class="menu-link">Оформление заявки</div>
      <div onclick="document.location.href ='clientList.php'" class="menu-link">Список клиентов</div>
    </div>
    <span id="userName" style="display:none"> <?php echo $userName ?></span>
    <script>
      document.getelementById("name-operator").innerHTML = document.getElementById("userName").innerHTML;
    </script>
    </body>

<?php

  }
}

mysqli_close($link);
?>

</html>