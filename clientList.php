<?php
session_start();
function createQueryForClient()
{
  // $clientType = $_GET["clientType"] == 1 ? "id_client<100000000" : "id_client>=100000000";
  if ($_GET["clientType"] == 1) $clientType = "id_client >= 100000000 AND ";
  else if ($_GET["clientType"] == 2) $clientType = "id_client < 100000000 AND ";
  else $clientType = '';
  $name = $_GET["name"];
  $phone = $_GET["phone"];
  $phone = substr($phone, 2);
  $phone = preg_replace("/[^0-9]/", "", $phone);
  $email = $_GET["email"];
  // $address = $_GET["address"];
  // $legalAddress = $_GET["legalAddress"];
  $inn = $_GET["inn"];
  $kpp = $_GET["kpp"];
  // $bank = $_GET["bank"];
  // $bic = $_GET["bic"];
  $acc = $_GET["acc"];
  $corr = $_GET["corr"];
  return "SELECT * FROM client WHERE $clientType(name_client like '%$name%' AND phone like '%$phone%'  AND email like '%$email%'  AND inn like '%$inn%'  AND kpp like '%$kpp%'  AND acc like '%$acc%'  AND corr like '%$corr%');";
}
$sql = createQueryForClient();
setcookie('queryForClient', $sql);
// echo $_COOKIE['queryForClient'];
require("parts/head.php");
?>
<title>Список клиентов</title>
<?php
require("parts/header.php");
require('parts/mysql.php');
$sql = "SELECT * FROM employee;";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  if (!($_SESSION['lgn'] == $row['lgn'] && $_SESSION['psw'] == $row['psw'])) {
    echo "Неверный логин или пароль";
  } else {
    $userName = $row['name_emp'];
?>
    <div class="filter">
      <form name="filter" id="filter" action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="get">
        <div class="filter-section">
          Только:
          <br />
          <label for="natural">
            &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="1" name="clientType" id="natural">
            Физические лица
          </label>
          <br />
          <label for="legal">
            &nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="2" name="clientType" id="legal">
            Юридические лица
          </label>
          <br />
        </div>
        <div class="filter-section">
          <label for="phone">
            Номер телефона:
          </label><br />
          <input type="text" id="phone" name="phone" maxlength="10">
          <br />
          <label for="email">
            Эл. почта:
          </label><br />
          <input type="text" id="email" name="email" maxlength="30">
          <br />
        </div>
        <div class="filter-section">
          <label for="inn">
            ИНН:
          </label><br />
          <input type="text" id="inn" name="inn" maxlength="12">
          <br />
          <label for="kpp">
            КПП:
          </label><br />
          <input type="text" id="kpp" name="kpp" maxlength="9">
          <br />
        </div>
        <div class="filter-section">
          <label for="acc">
            Рассчётный счёт:
          </label><br />
          <input type="text" id="acc" name="acc" maxlength="20">
          <br />
          <label for="corr">
            Корреспонд. счёт:
          </label><br />
          <input type="text" id="corr" name="corr" maxlength="20">
          <br />
        </div>
        <div class="filter-section">
          <div class="blockbtn">
            <input class="bluebtn" id="submitFilter" type="submit" name="show" value="Показать">
          </div>
          <div class="blockbtn">
            <a href="#openModal" id="newClient" class="bluebtn">Новый клиент</a>
          </div>
          <div class="blockbtn">
            <input id="resetFilter" type="reset" />
          </div>
        </div>
      </form>
    </div>
    <?php
    mb_internal_encoding('UTF-8');
    echo "<div class='data-wrapper'><table id='сlient' class='data-table table_sort'>
    <thead><tr>
      <th>ID</th>
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
    if (!isset($_GET["show"])) {
      require('parts/mysql.php');
      $sql = "SELECT * FROM client;";
      $result = mysqli_query($link, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id_client'];
        echo "<tr>";
        $color = $id >= 100000000 ? "#276994" : "#000";
        $address = mb_substr($row['address'], 4, 100);
        $legalAddress = mb_substr($row['legal_address'], 4, 100);
        echo "<td ><font color='$color'>" . $id . "</font></td>";
        echo "<td><font color='$color'>" . $row['name_client'] . "</font></td>";
        echo "<td>+7" . $row['phone'] . "<br />" . $row['email'] . "</td>";
        echo "<td>" .   $address . "</td>";
        echo "<td>" . $legalAddress . "</td>";
        echo "<td>" . $row['inn'] . "<br />" . $row['kpp'] . "</td>";
        echo "<td>" . $row['bic'] . "<br />" . $row['bank'] . "</td>";
        echo "<td>" . $row['acc'] . "<br />" . $row['corr'] . "</td>";
        echo "</tr>";
      }
      mysqli_close($link);
    } else {
      require('parts/mysql.php');
      $sql = createQueryForClient();
      // echo $sql;
      $result = mysqli_query($link, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['id_client'];
        echo "<tr>";
        $color = $id >= 100000000 ? "#276994" : "#000";
        $address = mb_substr($row['address'], 4, 100);
        $legalAddress = mb_substr($row['legal_address'], 4, 100);
        echo "<td ><font color='$color'>" . $id . "</font></td>";
        echo "<td><font color='$color'>" . $row['name_client'] . "</font></td>";
        echo "<td>+7" . $row['phone'] . "<br />" . $row['email'] . "</td>";
        echo "<td>" .   $address . "</td>";
        echo "<td>" . $legalAddress . "</td>";
        echo "<td>" . $row['inn'] . "<br />" . $row['kpp'] . "</td>";
        echo "<td>" . $row['bic'] . "<br />" . $row['bank'] . "</td>";
        echo "<td>" . $row['acc'] . "<br />" . $row['corr'] . "</td>";
        echo "</tr>";
      }
      mysqli_close($link);
    }

    // while ($i < 1) {
    //   $i++;
    //   $result = $result . "<tr>";
    //   $result = $result . "<td>61927384501</td>";
    //   $result = $result . "<td>Караханян Арам Артакович</td>";
    //   $result = $result . "<td>+79780462048<br />Jamsaramya@yandex.ru</td>";
    //   $result = $result . "<td>РК, г Ялта,<br />ул Кривошты, д 13, кв 36 </td>";
    //   $result = $result . "<td>(РК, г Ялта,<br />ул Кривошты, д 13, кв 36)</td>";
    //   $result = $result . "<td>721274745926<br />89421234</td>";
    //   $result = $result . "<td>987134654<br />РНКБ Банк (ПАО)</td>";
    //   $result = $result . "<td>12345678900987654321<br />67890543210987612345</td>";
    //   $result = $result . "</tr>";
    // }
    // $i = 0;
    // while ($i < 1) {
    //   $i++;
    //   $result = $result . "<tr>";
    //   $result = $result . "<td>61927384501</td>";
    //   $result = $result . "<td>Караханян Левон Артакович</td>";
    //   $result = $result . "<td>+89780462048<br />Jamsaramya@yandex.ru</td>";
    //   $result = $result . "<td>РК, г Ялта,<br />ул Кривошты, д 13, кв 36 </td>";
    //   $result = $result . "<td>(РК, г Ялта,<br />ул Кривошты, д 13, кв 36)</td>";
    //   $result = $result . "<td>121274745926<br />89421234</td>";
    //   $result = $result . "<td>187134654<br />РНКБ Банк (ПАО)</td>";
    //   $result = $result . "<td>42345678900987654321<br />67890543210987612345</td>";
    //   $result = $result . "</tr>";
    // }
    echo "</tbody></table></div>";

    // exit('<meta http-equiv="refresh" content="0; url=clientList.php" />');
    ?>

    <!-- <table id="table_sort" class="table_sort">
  <thead>
    <tr>
      <th>ID</th>
      <th>Имя лица</th>
      <th>Контактный телефон</th>
      <th>e-mail</th>
      <th>Адрес</th>
      <th>Юридический адрес</th>
      <th>ИНН<br />КПП</th>
      <th>БИК Банк</th>
      <th>Р/с<br />корр/с</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>61927384501</td>
      <td>Арам Артакович</td>
      <td>+79780462048</td>
      <td>Jamsaramya@yandex.ru</td>
      <td>РК, г Ялта, ул Кривошты, д 13, кв 36</td>
      <td>(отсутсвует)</td>
      <td>7212747459626<br />89421234</td>
      <td>987134654 РНКБ Банк (ПАО)</td>
      <td>12345678900987654321<br />67890543210987612345</td>
    </tr>
    <tr>
      <td>11927384501</td>
      <td>Караханян Арам Артакович</td>
      <td>+79780462048</td>
      <td>Jamsaramya@yandex.ru</td>
      <td>РК, г Ялта, ул Кривошты, д 13, кв 36</td>
      <td>(отсутсвует)</td>
      <td>7212747459626<br />89421234</td>
      <td>987134654 РНКБ Банк (ПАО)</td>
      <td>12345678900987654321<br />67890543210987612345</td>
    </tr>
    <tr>
      <td>61927384501</td>
      <td>Караханян Арам Артакович</td>
      <td>+79780462048</td>
      <td>Jamsaramya@yandex.ru</td>
      <td>РК, г Ялта, ул Кривошты, д 13, кв 36</td>
      <td>(отсутсвует)</td>
      <td>7212747459626<br />89421234</td>
      <td>987134654 РНКБ Банк (ПАО)</td>
      <td>12345678900987654321<br />67890543210987612345</td>
    </tr>
  </tbody>
</table> -->

    <div id="openModal" class="modalDialog">
      <div>
        <a href="#close" title="Закрыть" class="close">&#10006;</a>
        <h3>Внесение нового клиента</h3>
        <form name="newClient" action="insertClient.php" method="post">
          <table class="form-table">
            <tr>
              <th></th>
              <th></th>
            </tr>
            <tr>
              <td>
                Выберите
              </td>
              <td>
                <label for="newNatural">
                  <input type="radio" value="0" name="newClientType" id="newNatural" checked onclick="changeClientType(0);">
                  Физическое лицо
                </label>
                <br />
                <label for="newLegal">
                  <input type="radio" value="1" name="newClientType" id="newLegal" onclick="changeClientType(1);">
                  Юридическое лицо
                </label>
              </td>
            </tr>
            <tr>
              <td>
                <label id="ClientNameLabel" for="newName">
                  ФИО *
                </label>
              </td>
              <td>
                <input id="newName" name="newName" type="text" maxlength="50" required="true" />
              </td>
            </tr>
            <tr>
              <td>
                <label for="newPhone">
                  Телефон *
                </label>
              </td>
              <td>
                <input id="newPhone" name="newPhone" type="text" maxlength="10" required="true" />
              </td>
              <td>
                <label for="newEmail">
                  Эл. почта
                </label>
              </td>
              <td>
                <input id="newEmail" name="newEmail" type="text" maxlength="30" />
              </td>
            </tr>
            <tr>
              <td>
                <label for="newAddress">
                  Адрес
                </label>
              </td>
              <td>
                <input id="newAddress" name="newAddress" type="text" maxlength="255" />
              </td>

              <td>
                <label for="newLegalAddress">
                  Юридический адрес
                </label>
              </td>
              <td>
                <input id="newLegalAddress" name="newLegalAddress" type="text" maxlength="255" disabled="true" />
              </td>
            </tr>
            <tr>
              <td>
                <label for="newInn">
                  ИНН
                </label>
              </td>
              <td>
                <input id="newInn" name="newInnFJ" type="text" maxlength="12" />
              </td>
              <td>
                <label for="newKpp">
                  КПП
                </label>
              </td>
              <td>
                <input id="newKpp" name="newKpp" type="text" maxlength="9" />
              </td>
            </tr>
            <tr>
              <td>
                <label for="newBank">
                  Наименование банка
                </label>
              </td>
              <td>
                <input id="newBank" name="newBank" type="text" maxlength="50" />
              </td>
              <td>
                <label for="newBic">
                  БИК
                </label>
              </td>
              <td>
                <input id="newBic" name="newBic" type="text" maxlength="9" />
              </td>
            </tr>
            <tr>
              <td>
                <label for="newAcc">
                  Рассчётный счёт
                </label>
              </td>
              <td>
                <input id="newAcc" name="newAcc" type="text" maxlength="20" />
              </td>
              <td>
                <label for="newCorr">
                  Корреспонд. счёт
                </label>
              </td>
              <td>
                <input id="newCorr" name="newCorr" type="text" maxlength="20" />
              </td>
            </tr>
            <tr>
              <td>
              </td>
              <td>

                <input id="insertClient" class="bluebtn" name="insertClient" type="submit" value="Внести клиента" />
              </td>
              <td>
              </td>
              <td>
                <div class="blockbtn">
                  <input type="reset" />
                </div>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
    <script type="text/javascript" charset="utf8" src="js/jquery.js"></script>
    <!-- <script type="text/javascript" charset="utf8" src="plugins/DataTables/datatables.js"></script> -->
    <script type="text/javascript" charset="utf8" src="plugins/maskedinput/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/clientList.js"></script>
    </body>
<?php
  }
}
?>

</html>