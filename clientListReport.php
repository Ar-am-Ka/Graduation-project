<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Печать страниц Список клиентов</title>
  <link rel="stylesheet" href="style/print.css" />
</head>

<body>
  <h2>Соединённые Города</h2>
  <?php
  $sql = $_COOKIE['queryForClient'];
  mb_internal_encoding('UTF-8');
  echo "<div class='data-wrapper'><table id='сlient' class='data-table table_sort'>
    <thead><tr>
      <th>Имя лица</th>
      <th>Контактный телефон /<br />E-mail</th>
      <th>Адрес</th>
      <th>Юридический адрес</th>
      <th>ИНН /<br />КПП</th>
      <th>БИК / Банк</th>
      <th>Рассчётный счёт /<br />Корреспонд. счёт</th>
    </tr>
    </thead>
    <tbody>";
  require_once('parts/mysql.php');
  // echo $sql;
  $result = mysqli_query($link, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    // $id = $row['id_client'];
    echo "<tr>";
    echo "<td>" . $row['name_client'] . "</td>";
    echo "<td>+7" . $row['phone'] . "<br />" . $row['email'] . "</td>";
    echo "<td>" .   $row['address'] . "</td>";
    echo "<td>" . $row['legalAddress'] . "</td>";
    echo "<td>" . $row['inn'] . "<br />" . $row['kpp'] . "</td>";
    echo "<td>" . $row['bic'] . "<br />" . $row['bank'] . "</td>";
    echo "<td>" . $row['acc'] . "<br />" . $row['corr'] . "</td>";
    echo "</tr>";
  }
  mysqli_close($link);
  ?>
</body>

</html>