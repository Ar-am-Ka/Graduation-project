<?php
$host = 'localhost';
$db = "cargotrans_crm";
$user = 'root';
$pass = 'root';
$link = mysqli_connect($host, $user, $pass, $db)
  or exit("Ошибка подключения к серверу" . mysqli_error($link));
