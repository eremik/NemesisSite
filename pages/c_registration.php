<?php
include 'config.php';

$conn = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
mysql_select_db($db_auth) or die(mysql_error());

$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$rpassword = $_POST["rpassword"];

if ($username == "" || $password == "" || $email == "")
{
        echo "
         <h2>Заполните все поля!<h2>
     <br>
        <a href='?p=registration'><< Назад</a>
        ";
        exit();
}

if($password != $rpassword)
{
        echo "
         <h2>Пароли не совпадают!<h2>
     <br>
        <a href='?p=registration'><< Назад</a>
        ";
        exit();
}

if (!preg_match('/^[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)*\@[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+(?:\.[^\x00-\x20()<>@,;:\\".[\]\x7f-\xff]+)+$/i', $email))
{
        echo "
         <h2>Некорректный e-mail<h2>
     <br>
        <a href='?p=registration'><< Назад</a>
        ";
        exit();
}

$query = mysql_query("SELECT * FROM account WHERE username = '$username' OR reg_mail = '$email'");
$rows = mysql_num_rows($query);

if ($rows > 0)
{
        echo "
         <h2>Такой логин или email существует!<h2>
     <br>
        <a href='?p=registration'><< Назад</a>
        ";
        exit();
}

mysql_query("INSERT INTO account (username, sha_pass_hash, email, reg_mail, expansion, locale, os) VALUES (UPPER('".$username."'), SHA1(CONCAT(UPPER('".$username."'),':',UPPER('".$password."'))), '".$email."', '".$email."', '2', '8', 'Win')");
echo "
         <h2>Аккаунт успешно зарегистрирован!<h2>
        ";
?>
