<?php
session_start();
require("parts/head.php");
?>
<title>Соединённые города – CRM</title>
</head>

<body>
  <div class="header">
    <div class="header-item">
      <div class="header-item-info">
        Cargotrans CRM <br />
        "Соединённые города"
      </div>
    </div>
  </div>
  <div class="auth">
    <div class="auth-form">
      <form action="auth.php" method="post">
        <table>
          <tr>
            <td></td>
            <th>Вход в систему</th>
          </tr>
          <tr>
            <td><label for="login">Логин:</label></td>

            <td><input type="text" name="login" id="login" /></td>
          </tr>
          <tr>
            <td><label for="password">Пароль:</label></td>
            <td><input type="password" name="password" id="password" /></td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="submit" value="Войти" class="bluebtn" name="enter" id="enter" />
            </td>
          </tr>
        </table>
      </form>
      <?php
      require_once('parts/mysql.php');
      $sql = "SELECT * FROM employee;";
      $result = mysqli_query($link, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        if (!($_SESSION['lgn'] == $row['lgn'] && $_SESSION['psw'] == $row['psw'])) {
          $userName = "Имя пользователя";
          $authNump = "disabled='true'";
        } else {
          $userName = $row['name_emp'];
          $authNump = "";
        }
      }
      ?>
    </div>
    <div class="auth-nump">
      <div class="auth-nump-field">
        <input <?php echo $authNump ?> id="passfield" type="password" maxlength="6" placeholder="••••••" />
      </div>
      <div class="auth-nump-btns"><button id="n1">1</button></div>
      <div class="auth-nump-btns"><button id="n2">2</button></div>
      <div class="auth-nump-btns"><button id="n3">3</button></div>
      <div class="auth-nump-btns"><button id="n4">4</button></div>
      <div class="auth-nump-btns"><button id="n5">5</button></div>
      <div class="auth-nump-btns"><button id="n6">6</button></div>
      <div class="auth-nump-btns"><button id="n7">7</button></div>
      <div class="auth-nump-btns"><button id="n8">8</button></div>
      <div class="auth-nump-btns"><button id="n9">9</button></div>
      <div class="auth-nump-btns">
        <button id="nU">
          <img src="img/unlock.svg" alt="img: unlock" />
        </button>
      </div>
      <div class="auth-nump-btns"><button id="n0">0</button></div>
      <div class="auth-nump-btns">
        <button id="nB">
          <img src="img/backspace.svg" alt="img: backspace" />
        </button>
      </div>
    </div>
    <div class="auth-info">
      <div class="info-login">
        <?php
        if ($userName == "Имя пользователя") echo "Вход не выполнен";
        else echo "Оператор:";
        ?>
      </div>
      <div class="info-user"><?php echo $userName; ?></div>
      <div class="info-logout"><button disabled="true">Выход</button></div>
      <div class="info-crm">
        Cargotrans CRM <br />
        "Соединённые города"
      </div>
    </div>
  </div>
  <script type="text/javascript" charset="utf8" src="js/jquery.js"></script>
  <script type="text/javascript" charset="utf8" src="js/index.js"></script>
</body>

</html>