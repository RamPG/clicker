<?php
	function add_account()
	{
		global $db;
		extract($_POST);
		$check_query = "SELECT login FROM clicker WHERE login = '$login_add'";
		if (empty(mysqli_fetch_all((mysqli_query($db, $check_query)))) and $login_add != "" and $password_add != "")
		{
			$add_query = "INSERT INTO clicker (login, password, score, buy) VALUES ('$login_add', '$password_add', '0', '0')";
			mysqli_query($db, $add_query);
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function enter_account()
	{
		global $db;
		extract($_POST);
		$check_query = "SELECT login, password FROM clicker WHERE login = '$login' AND password = '$password'";
		if (!empty(mysqli_fetch_all((mysqli_query($db, $check_query)))))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function info_account()
	{
		global $db;
		extract($_COOKIE);
		$check_query = "SELECT * FROM clicker WHERE login = '$login' AND password = '$password'";
		return mysqli_fetch_all(mysqli_query($db, $check_query), MYSQLI_ASSOC);
	}
	function update_score($value, $add)
	{
		global $db;
		extract($_COOKIE);
		$element = mysqli_fetch_all(mysqli_query($db, "SELECT score FROM clicker WHERE login = '$login' AND password = '$password'"));
		$score = $element[0][0];
		$check_query = "UPDATE clicker SET score = '$score' + '$add' WHERE login = '$login'";
		mysqli_query($db, $check_query);

	}
	function update_buy($value)
	{
		global $db;
		extract($_COOKIE);
		$element = mysqli_fetch_all(mysqli_query($db, "SELECT buy FROM clicker WHERE login = '$login' AND password = '$password'"));
		$buy = $element[0][0];
		$check_query = "UPDATE clicker SET buy = '$buy' + 1 WHERE login = '$login'";
		mysqli_query($db, $check_query);
	}
	
?>