<?php
session_start();
header("Content-type: text/html; charset=utf-8");
error_reporting(-1);

require_once "funcs.php";

$db = @mysqli_connect('localhost', 'mysql', 'mysql', 'data_clicker') or die('Ошибка соединения с БД');
mysqli_set_charset($db, "utf8") or die('Не установлена кодировка');
if (isset($_POST["password"]) and isset($_POST["login"]))
{
  $check = enter_account();
  if ($check)
  {
    setcookie("login", $_POST["login"]);
    setcookie("password", $_POST["password"]);
    header("Location: /clicker.php");
  }
  else
  {
    $_SESSION["enter"] = "Ошибка при входе.";
    header("Location: {$_SERVER['PHP_SELF']}");
  }
  die;
}
?>
<!DOCTYPE html>
<html lang="ru">

 <head>
  <meta charset="utf-8" />
  <title>LOGIN</title>

 </head>

 <body>
  <form method="post">
		<p>
			<label for="login">Логин:</label><br>
			<input type="text" name="login">
		</p>
		<p>
			<label for="password">Пароль:</label><br>
			<input type="password" name="password">
		</p>
    <p>
      <button type="submit">Войти</button>
    </p>
  </form>
    <form action="register.php">
		<p>
			<button type="submit">Зарегистрироваться</button>
		</p>
  </form>
  <?php
   if (!empty($_SESSION["check_register"]))
   {
    echo "<p>{$_SESSION["check_register"]}</p>";
    unset($_SESSION["check_register"]);
   }
   if (!empty($_SESSION["enter"]))
   {
    echo "<p>{$_SESSION["enter"]}</p>";
    unset($_SESSION["enter"]);
   }
  ?>
 </body>

</html>