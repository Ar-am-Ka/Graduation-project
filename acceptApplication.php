<?php
if (isset($_POST['accept'])) {
  // require_once('parts/mysql.php');  

  $line = $_POST['newClientType'] == 0 ? "ФЛ" : "ЮЛ";
  $line = $line . '|' . $_POST['newName'];
  // $phone = substr($_POST['phone'], 2);
  // $phone = preg_replace("/[^0-9]/", "", $phone);
  // $line = $line . '|' . $phone;
  $line = $line . '|' . $_POST['phone'];
  $line = $line . '|' . $_POST['email'];
  $line = $line . '|' . $_POST['vol'];
  $line = $line . '|' . $_POST['description'];
  $line = $line . '|' . $_POST['cost'];
  $line = $line . '|' . $_POST['dispatch'];
  $line = $line . '|' . $_POST['destination'];
  $line = $line . '|' . $_POST['type'];
  $line = $line . '|' . date("d.m.Y");
  $line = $line . '|' . date("H:i:s");
  $oldDelim = array(
    0 => '||||||||||',
    1 => '|||||||||',
    2 => '||||||||',
    3 => '|||||||',
    4 => '||||||',
    5 => '|||||',
    6 => '||||',
    7 => '|||',
    8 => '||'
  );
  $newDelim = array(
    0 => '|%|%|%|%|%|%|%|%|',
    1 => '|%|%|%|%|%|%|%|',
    2 => '|%|%|%|%|%|%|',
    3 => '|%|%|%|%|%|',
    4 => '|%|%|%|%|',
    5 => '|%|%|%|%|',
    6 => '|%|%|%|',
    7 => '|%|%|',
    8 => '|%|'
  );
  $line = str_replace($oldDelim, $newDelim, $line);
  $applications = fopen('applications.txt', 'a');
  fwrite($applications, "?$line\n");
  fclose($applications);
  exit('<meta http-equiv="refresh" content="0; url=getApplication.php" />');
}
