<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>World Of Warcraft Server</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />

</head>

<body>

<div id="box">

	<div id="header">
    </div>

	<div id="menu">
    	<ul>
		<li><a href="?p=news" title="Новости">Новости</a></li>
		<li><a href="?p=registration" title="Регистрация">Регистрация</a></li>
		<li><a href="?p=banned" title="Забаненные">Забаненные</a></li>
		<li><a href="?p=top" title="Топ команд арены">Топ арены</a></li>
		<li><a href="?p=about" title="О проекте">О проекте</a></li>
        </ul>
    </div>
    
        
    <div id="info">
    <center>
        <table>
            <tr>
                <td>Realm:</td>
                <td><a>Moonglade</a></td>
                <td>Exp</td>
                <td><a>x3</a></td>
            </tr>
            <tr>
                <td>Game version</td>
                <td><a>3.3.5a</a></td>
                <td>Talent</td>
                <td><a>x3</a></td>
            </tr>
            <tr>
                <td>Realm type</td>
                <td><a>Blizzlike</a></td>
                <td>Honor/Arena</td>
                <td><a>x1</a></td>
            </tr>
            <tr>
                <td>Realmlist</td>
                <td><a>set realmlist 127.0.0.1</a></td>
                <td>Gold</td>
                <td><a>x1</a></td>
            </tr>
        </table>
    </center>
    </div>
    
    <div id="content">
        <?php
            $content = isset($_REQUEST['p']) ? $_REQUEST['p'] : '';
            if($content == '') {
                $content = 'news';
            }
            
            if(file_exists('pages/' . $content . '.php')) {
                include('pages/' . $content . '.php');
            }
            else {
                include('pages/news.php');
            }
        ?>
    </div>
    
</div>

    
<div id="footer">
    <p><a href="http://wotlk.hopto.org" target="blank">Game portal</a> - best game portal</p>
</div>

</body>

</html>
