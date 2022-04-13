<?php
session_start();

require('parts/mysql.php');
$sql = "SELECT * FROM employee;";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  if (!($_SESSION['lgn'] == $row['lgn'] && $_SESSION['psw'] == $row['psw'])) {
    require("parts/head.php");
?>
    <title>Экран заявок</title>
  <?php require("parts/header.php");
    echo "Неверный логин или пароль";
  } else {
    setcookie('name_emp', $row['name_emp'], time() + 1440);
    require("parts/head.php"); ?>
    <title>Экран заявок</title>
    <?php
    require("parts/header.php");
    ?>
    <div class="list">
      <div class="list-col">
        <div class="list-col-head">
          Ожидают обработки
        </div>

        <?php
        // require("parts/mysql.php");
        // mb_internal_encoding('UTF-8');
        // // echo "<div>";
        // // echo $sql;
        $applications = fopen('applications.txt', 'r');
        $dataApplication = fread($applications, 999999999);
        $dataApplication = explode('?', $dataApplication);
        $cnt1 = 0;
        foreach ($dataApplication as &$value) {
          $cnt1++;
          echo "<form action='-' name='appl$cnt1' method='post' ondblclick='submit();'><div class='list-col-elem'>";
          $detailedApplicationData = explode('|', $value);
          for ($i = 0; $i < 12; $i++) {
            if ($detailedApplicationData[$i] == '%') $detailedApplicationData = '';
          }
          echo $detailedApplicationData[0] . " " . $detailedApplicationData[10] . " " . $detailedApplicationData[11] . "<br /><br />";
          echo '<i>Клиент</i>: ' . $detailedApplicationData[1] . '<br />';
          echo '<i>Объём</i>: ' . $detailedApplicationData[4] . '<br />';
          echo '<i>Описание</i>: ' . $detailedApplicationData[5] . '<br />';
          echo '<i>Объявленная стоимость</i>: ' . $detailedApplicationData[6] . '<br />';
          echo "</div></form>";
        }




        fclose($applications);
        // while ($row = mysqli_fetch_assoc($result)) {
        //   // $id = $row['id_client'];
        //   echo "<tr>";
        //   echo "<td>" . $row['name_client'] . "</td>";
        //   echo "<td>+7" . $row['phone'] . "<br />" . $row['email'] . "</td>";
        //   echo "<td>" .   $row['address'] . "</td>";
        //   echo "<td>" . $row['legalAddress'] . "</td>";
        //   echo "<td>" . $row['inn'] . "<br />" . $row['kpp'] . "</td>";
        //   echo "<td>" . $row['bic'] . "<br />" . $row['bank'] . "</td>";
        //   echo "<td>" . $row['acc'] . "<br />" . $row['corr'] . "</td>";
        //   echo "</tr>";
        // }
        // // echo "</div>";
        // mysqli_close($link);
        ?>

      </div>
      <div class="list-col">
        <div class="list-col-head">
          В обработке
        </div>
        <?php
        // require("parts/mysql.php");
        // mb_internal_encoding('UTF-8');
        // echo "<div>";
        // // echo $sql;
        // $result = mysqli_query($link, $sql);
        // while ($row = mysqli_fetch_assoc($result)) {
        //   // $id = $row['id_client'];
        //   echo "<tr>";
        //   echo "<td>" . $row['name_client'] . "</td>";
        //   echo "<td>+7" . $row['phone'] . "<br />" . $row['email'] . "</td>";
        //   echo "<td>" .   $row['address'] . "</td>";
        //   echo "<td>" . $row['legalAddress'] . "</td>";
        //   echo "<td>" . $row['inn'] . "<br />" . $row['kpp'] . "</td>";
        //   echo "<td>" . $row['bic'] . "<br />" . $row['bank'] . "</td>";
        //   echo "<td>" . $row['acc'] . "<br />" . $row['corr'] . "</td>";
        //   echo "</tr>";
        // }
        // echo "</div>";
        // mysqli_close($link);
        ?>
      </div>
      <div class="list-col">
        <div class="list-col-head">
          Перезвон
        </div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>


      </body>
  <?php
  }
}
  ?>

  </html>