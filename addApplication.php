<?php
session_start();
?>
<?php
require('parts/mysql.php');
$sql = "SELECT * FROM employee;";
$result = mysqli_query($link, $sql);
while ($row = mysqli_fetch_assoc($result)) {
  if (!($_SESSION['lgn'] == $row['lgn'] && $_SESSION['psw'] == $row['psw'])) {
    require("parts/head.php");
?>
    <title>Приём заявки</title>
  <?php require("parts/header.php");
    echo "Неверный логин или пароль";
  } else {
    setcookie('name_emp', $row['name_emp'], time() + 1440);
    require("parts/head.php"); ?>
    <title>Оформление заявки</title>
    <style>
      input[type='text'],
      input[type='number'],
      select {
        width: 80%;
      }
    </style>
    <?php require("parts/header.php");
    // ! недоделка
    //   $line = str_replace($oldDelim, $newDelim, $line);
    //   $applications = fopen('applications.txt', 'a');
    //   fwrite($applications, "?$line\n");
    //   fclose($applications);

    //   $applications = fopen('applications.txt', 'r');
    //   $dataApplication = fread($applications, 999999999);
    //   $dataApplication = explode('?', $dataApplication);

    ?>


    <div class="wrapper">
      <h2>Оформление заявки</h2>
      <form action="*.php" method="post">
        <hr />
        <h3>Контрагент</h3>
        <!-- <label for="newClient">
          <input type="radio" value="0" name="clientExists" id="newClient" onclick="" checked>
          Новый клиент
        </label>
        <br /> -->
        <label for="addClient">
          <input type="radio" value="0" name="clientExists" id="addClient" onclick="" checked>
          Новый клиент
        </label>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <label for="existingClient">
          <input type="radio" value="1" name="clientExists" id="existingClient" onclick="">
          Существующий клиент
        </label>
        <br /><br />
        <div class="client-exists">
          Тип лица:
          <br />
          <label for="natural">
            <input type="radio" value="0" name="clientType" id="natural" checked onclick="changeClientType(0);">
            Физическое лицо
          </label>
          <br />
          <label for="legal">
            <input type="radio" value="1" name="clientType" id="legal" onclick="changeClientType(1);">
            Юридическое лицо
          </label>
          <br />
          <br />
          <label id="ClientNameLabel" for="newName">
            ФИО <font color='red'>*</font> <br />
            <input id="clientName" name="clientName" type="text" maxlength="50" required="required" />
          </label>
          <br />
          <label for="phone">
            Номер телефона <font color='red'>*</font>
            <br />
            <input type="text" id="phone" name="phone" maxlength="10" required="required">
          </label>
          <br />
          <label for="email">
            Электронная почта
            <br />
            <input type="text" id="email" name="email" maxlength="30">
          </label>
          <br />
          <label for="address">
            Адрес
            <br />
            <input id="address" name="newAddress" type="text" maxlength="255" />
          </label>
          <br />
          <label for="legalAddress">
            Юридический адрес
            <br />
            <input id="legalAddress" name="newLegalAddress" type="text" maxlength="255" disabled="true" />
          </label>
          <br />
          <label for="inn">
            ИНН
            <br />
            <input id="inn" name="newInnFJ" type="text" maxlength="12" />
          </label>
          <br />
          <label for="ipp">
            КПП
            <br />
            <input id="ipp" name="newKpp" type="text" maxlength="9" />
          </label>
          <br />
          <label for="bank">
            Наименование банка
            <br />
            <input id="bank" name="newBank" type="text" maxlength="50" />
          </label>
          <br />
          <label for="bic">
            БИК
            <br />
            <input id="bic" name="newBic" type="text" maxlength="9" />
          </label>
          <br />
          <label for="acc">
            Рассчётный счёт
            <br />
            <input id="newAcc" name="newAcc" type="text" maxlength="20" />
          </label>
          <br />
          <label for="newCorr">
            Корреспонд. счёт
            <br />
            <input id="newCorr" name="newCorr" type="text" maxlength="20" />
          </label>
        </div>
        <h3>Груз</h3>
        <label for="vol">
          Объём груза (м<sup>3</sup>)
          <br />
          <input type="text" id="vol" name="vol">
        </label>
        <br />
        <label for="description">
          Описание
          <br />
          <input type="text" id="description" name="description">
        </label>
        <br />
        <label for="cost">
          Объявленная стоимость (рублей)
          <br />
          <input type="number" id="cost" name="cost">
        </label>
        <br />
        <label for="dispatch">
          Откуда
          <br />
          <input type="text" id="dispatch" name="dispatch">
        </label>
        <br />
        <label for="destination">
          Куда
          <br />
          <input type="text" id="destination" name="destination">
        </label>
        <br />
        <label for='type'>
          Тип
          <br />
          <select name='type' id='type'>
            <option value='CC'>Клиент - Клиент</option>
            <option value='TT'>Терминал - Терминал</option>
            <option value='CT'>Клиент - Терминал</option>
            <option value='TC'>Терминал - Клиент</option>
          </select>
        </label>
        <br />
        <input class="bluebtn" id="" type="submit" name="accept" value="Принять">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input id="" type="reset" />

      </form>
    </div>
    <script>
      function changeClientType(val) {
        if (val == 0) {
          document.getElementById('ClientNameLabel').innerHTML = "ФИО <font color='red'>*</font> <br /> <input id='newName' name='newName' type='text' maxlength ='50' required='required' / > ";
        } else {
          document.getElementById('ClientNameLabel').innerHTML = "Наименование <font color='red'>*</font> <br /> <input id='newName' name='newName' type='text' maxlength ='50' required='required' / >";
        }
      }
    </script>
<?php
  }
} ?>
</body>

</html>