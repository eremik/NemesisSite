<?php
include 'config.php';

$conn = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
mysql_select_db($db_auth) or die(mysql_error());

$username = $_POST["username"];

if ($username == "")
{
        echo "
         <h2>Введите логин!<h2>
     <br>
        <a href='?p=banned'><< Назад</a>
        ";
        exit();
}

$query = mysql_query("SELECT * FROM $db_auth.account_banned WHERE id in (SELECT $db_auth.account.id FROM $db_auth.account WHERE $db_auth.account.`username`='$username')");
$rows = mysql_num_rows($query);

if ($rows > 0)
{
        echo "
         <h2>Аккаунт заблокирован!<h2>
     <br>
        <a href='?p=banned'><< Назад</a>
        ";
        exit();
}
else
{        echo "
         <h2>История блокировок чиста!<h2>
        ";
	exit();
}
?>
