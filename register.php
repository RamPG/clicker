<?php
session_start();
header("Content-type: text/html; charset=utf-8");
error_reporting(-1);

$db = @mysqli_connect('localhost', 'mysql', 'mysql', 'data_clicker') or die('Ошибка соединения с БД');
mysqli_set_charset($db, "utf8") or die('Не установлена кодировка');

require_once "funcs.php";
if (!empty($_POST))
{
	$check = add_account();
	if ($check)
	{
    $_SESSION["check_register"] = "Вы успешно зарегистрировались";
  	header("Location: /index.php");
	}
  else
  {
  		$_SESSION["check_register"] = "Ошибка регистрации";
  	  header("Location: {$_SERVER['PHP_SELF']}");
  }
  die;
  		
}
?>
<!DOCTYPE html>
<html lang="ru">

 <head>
  <meta charset="utf-8" />
  <title>REGISTER</title>

 </head>

 <body>
  <form method="post">
		<p>
			<label for="login_add">Придумайте логин:</label><br>
			<input type="text" name="login_add">
		</p>
		<p>
			<label for="password_add">Придумайте пароль:</label><br>
			<input type="password" name="password_add">
		</p>
		<p>
			<button type="submit">Зарегистрироваться</button>
		</p>    
  </form> 
  <form action="index.php">
    <p>
      <button type="submit">Вернуться к главной странице</button>
    </p>    
  </form>
  <?php
   if (!empty($_SESSION["check_register"]))
   {
    if ($_SESSION["check_register"] == "Ошибка регистрации")
    {
   	  echo "<p>{$_SESSION["check_register"]}</p>";
   	  unset($_SESSION["check_register"]);
    }
   }  
  ?>
 </body>

</html>