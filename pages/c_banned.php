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

$query = mysql_query("SELECT * FROM account_banned WHERE username = '$username'");
$rows = mysql_num_rows($query);

if ($rows > 0)
{
        echo "
         <h2>История блокировок аккаунта чиста!<h2>
     <br>
        <a href='?p=banned'><< Назад</a>
        ";
        exit();
}

mysql_query("SELECT * FROM account_banned WHERE username in (SELECT auth.account.id FROM auth.account WHERE auth.account.`username`='$username')");
        echo "
         <h2>Заблокирован аккаунт: <h2>
        ";
?>
