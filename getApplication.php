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
    <title>Приём заявки</title>
    <style>
      input[type='text'],
      input[type='number'],
      select {
        width: 600px
      }
    </style>
    <?php require("parts/header.php");
    ?>


    <div class="wrapper">
      <h2>Приём заявки</h2>
      <form action="acceptApplication.php" method="post">
        <label for="newNatural">
          <input type="radio" value="0" name="newClientType" id="newNatural" checked onclick="changeClientType(0);">
          Физическое лицо
        </label>
        <br />
        <label for="newLegal">
          <input type="radio" value="1" name="newClientType" id="newLegal" onclick="changeClientType(1);">
          Юридическое лицо
          <br />
          <br />
          <label id="ClientNameLabel" for="newName">
            ФИО <font color='red'>*</font> <br />
            <input id="newName" name="newName" type="text" maxlength="50" required="required" />
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
            <input type="text" name="email" maxlength="30">
          </label>
          <br />
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