<?php
if (isset($_POST["insertClient"])) {

  require_once('parts/mysql.php');
  // В таблице с клиентами, Физические лица получают id больше чем 100000000 (или равно), для Юридических лиц - менее чем 100000000
  // если выбрано "Физическое лицо", то следует искать id больше или равно 100000000
  // иначе "Юридическое лицо" - меньше 100000000
  // записываем в переменную часть SQL-запроса для последующего запроса к бд с поиском наибольшего id
  $newClientType = $_POST["newClientType"] == 0 ? "id_client>=100000000" : "id_client<100000000";
  $result = mysqli_query($link, "SELECT MAX(id_client) as idn FROM client WHERE " . $newClientType . ";"); // запрос
  $row = mysqli_fetch_assoc($result); // извлекаем данные из запроса, получен наибольший id
  $idn = $row['idn'] + 1; // к наибольшему id прибавляем 1 для id в новой записи
  //далее извлечение данных из формы
  $newName = $_POST["newName"];
  $newPhone = $_POST["newPhone"];
  $newPhone = substr($newPhone, 2);
  $newPhone = preg_replace("/[^0-9]/", "", $newPhone);
  $newEmail = $_POST["newEmail"];
  $newAddress = $_POST["newAddress"];
  $newLegalAddress = $_POST["newLegalAddress"];
  $newInn = $_POST["newInn"];
  $newKpp = $_POST["newKpp"];
  $newBank = $_POST["newBank"];
  $newBic = $_POST["newBic"];
  $newAcc = $_POST["newAcc"];
  $newCorr = $_POST["newCorr"];
  if (!$idn || !$newName || !$newPhone) {
    exit('<meta http-equiv="refresh" content="0; url=clientList.php" />');
  }

  // $newName = addslashes($newName);
  // $newPhone = addslashes($newPhone);
  // $newEmail = addslashes($newEmail);
  // $newAddress = addslashes($newAddress);
  // $newLegalAddress = addslashes($newLegalAddress);
  // $newInn = addslashes($newInn);
  // $newKpp = addslashes($newKpp);
  // $newBank = addslashes($newBank);
  // $newBic = addslashes($newBic);
  // $newAcc = addslashes($newAcc);
  // $newCorr = addslashes($newCorr);

  $sql = "INSERT INTO client VALUES('" . $idn . "','" . $newName . "','" . $newPhone . "','" . $newEmail . "','" . $newAddress . "','" . $newLegalAddress . "','" . $newInn . "','" . $newKpp . "','" . $newBank . "','" . $newBic . "','" . $newAcc . "','" . $newCorr . "');";  // формирование запроса на внесение новой записи в таблицу

  $result = mysqli_query($link, $sql);  // запись в таблицу
  if ($result)
    echo mysqli_affected_rows($link) . " - запись внесена";
  else echo "Ошибка внесения данных";
  mysqli_close($link);
  // Выполнили КОД и назад на страницу с клиентами. <meta http-equiv="refresh" content="0; url=clientList.php" /> потом занести в экзит
  exit('<meta http-equiv="refresh" content="0; url=clientList.php" />');
}
