<?php
header("Content-type: text/html; charset=utf-8");
error_reporting(-1);

require_once "funcs.php";

$db = @mysqli_connect('localhost', 'mysql', 'mysql', 'data_clicker') or die('Ошибка соединения с БД');
mysqli_set_charset($db, "utf8") or die('Не установлена кодировка');

$info_data = info_account();

if (isset($_POST["add"]))
{
  $info_data[0]["score"] += + 1 + $info_data[0]["buy"];
  update_score($info_data[0]["score"], $info_data[0]["buy"] + 1);
  unset($_POST["add"]);
  header("Location: {$_SERVER['PHP_SELF']}");
}
if (isset($_POST["buy"]))
{
  if ($info_data[0]["score"] >= $info_data[0]["buy"] * 5)
  {
    update_buy($info_data[0]["buy"]);
    update_score($info_data[0]["score"], $info_data[0]["buy"] * 5 * -1);
    unset($_POST["buy"]);
    $info_data[0]["buy"] += 1;
  }
  header("Location: {$_SERVER['PHP_SELF']}");
}
?>
<!DOCTYPE html>
<html lang="ru">

 <head>
  <meta charset="utf-8" />
  <title>Clicker</title>    
 </head>
 <body>

  <?php
    echo "<p>Вы пошли, как {$info_data[0]["login"]}</p>";
    echo "<p>Ваш счет: {$info_data[0]["score"]}</p>";
    echo "<p>Кол-во купленных бонусов: {$info_data[0]["buy"]}</p>";
    echo "<p>Цена покупки бонуса: ". $info_data[0]["buy"] * 5 . "</p>"; 
  ?>

  <form method="POST">
    <p>
      <input type="submit" name="add" value="Нажать">
    </p>
  </form>
  <form method="POST">
    <p>
      <input type="submit" name="buy" value="Купить">
    </p>
  </form>

  <form action="index.php">
    <p>
      <button>Выйти</button>
    </p>
  </form>

 </body>
</html>