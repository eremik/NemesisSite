<?
   include ("config.php");

   $j=1;
           $teamType = array(
                   '2' => '2x2',
                   '3' => '3x3',
                   '5' => '5x5'
       );

   $connect = mysql_connect($db_host,$db_user,$db_pass) OR DIE("'Can't connect with $db_host");
   mysql_select_db($db_char, $connect) or die(mysql_error());

   if(!isset($_GET['guid'])){

   $sql = mysql_query("SELECT * FROM `arena_team` ORDER by `rating` DESC LIMIT 10");

   echo "<center><table width=70%>
   <tr>
   <td>Название команды</td>
   <td align=center>Тип команды</td>
   <td align=center><center>Лидер команды</center></td>
   <td>Фракция</td>
   <td align=center>Рейтинг</td>

   </tr>";
   while ($row = mysql_fetch_array($sql)){
   $query_num = mysql_query("SELECT COUNT(*) FROM `arena_team_member` WHERE `arenateamid`='$row[arenateamid]'");
   $gleader = "SELECT name, race FROM `characters` WHERE `guid`='$row[captainGuid]'";
   $myrow = mysql_fetch_array(mysql_query($gleader));
   $top = mysql_query("SELECT * FROM `arena_team` WHERE `rating`='$row[rating]'");
   $toprow = mysql_fetch_array($top);


   if($myrow['race']=="1" or $myrow['race']=="3" or $myrow['race']=="4" or $myrow['race']=="7" or  $myrow['race']=="11"){

    $faction = "alliance";
    }else{
    $faction = "horde";}

   echo "
   <tr>
   <td >
   <p style='padding-left: 5px'>".$row[arenateamid].$row['name']."</a></p>
   </td>
   <td  align=center><center>".$teamType[$row['type']]."</center></td>

   <td>".$row[captainguid].$myrow['name']."</td>
   <td align=center><center><img src=images/".$faction.".png title=".$faction."></center></td>
   <td align=right><p style='padding-right: 8px'>".$toprow['rating']."</p></td></tr>";

   }
   echo "</table></center><br><br>";
   }

   if (@$_GET['guid'] ) {

   $name = "SELECT * FROM `arena_team` WHERE `arenateamid`='$_GET[guid]'";
   $nrow = mysql_fetch_array(mysql_query($name));
   $top = "SELECT * FROM `arena_team_stats` WHERE `arenateamid`='$_GET[guid]'";
   $trow = mysql_fetch_array(mysql_query($top));
   $member = "SELECT * FROM `arena_team_member` WHERE `arenateamid`='$_GET[guid]'";
   $mrow = mysql_fetch_array(mysql_query($member));

   $sql = mysql_query("SELECT * FROM `characters`, `arena_team_member` WHERE `characters`.`guid`=`arena_team_member`.`guid` and `arenateamid` = '".$_GET["guid"]."' ");
   $row = mysql_fetch_array($sql);
   $data = explode(' ',$row['data']);
   $lvl = $data[$ver];
   $gender = dechex($data[36]);
   $gender = str_pad($gender,8, 0, STR_PAD_LEFT);
   $gender = $gender{3};
   $guid = $row['guid'];
   $race = $row['race'];
   $class = $row['class'];
   $online = $row['online'];
   $j=1;

   echo "<center>
   <table border=0 width=60%>
   <tr>
   <td>
   <table border=1 width=100%>
   <tr><td>Team Name</td><td  >".$nrow['name']."</td></tr>
   <tr><td>Rating</td><td  >".$trow['rating']."</td></tr>
   <tr><td>Command Type</td><td  >".$teamType[$nrow['type']]."</td></tr>
   <tr><td colspan=2 >Statistics of the Week</td></tr>
   <tr><td>Played: ".$trow['games']."</td><td  >Won: ".$trow['wins']."</td></tr>
   <tr><td colspan=2 >Stats</td></tr>
   <tr><td>Played: ".$trow['played']."</td><td  >Won: ".$trow['wins2']."</td></tr>

   </table>
   ";

   echo "<table border=1 width=100%>
   <tr>
   <td align=center>#</td>
   <td align=center>Player Name</td>
   <td align=center>lvl</td>
   <td align=center>Race</td>
   <td align=center>Class</td>
   <td align=center>Game of the Week</td>
   <td align=center>Won week</td>
   <td align=center>Games for the season</td>
   <td align=center>Won season</td>
   <td align=center>Personal rating</td>
   <td align=center>Online</td>
   </tr>
   ";

   echo "<tr>
   <td valign=center width=3%>$j</td>
   <td align=center valign=center width=20%><a href='/wow/wowd/?player=".$guid."' style='color: #ff9900; font-family : Geneva; text-decoration : none;'>".$row[name]."</a></td>
   <td width=20 align=center valign=center>$lvl</td>
   <td align=center valign=center width=7%><img src=images/race/".$race."-".$gender.".gif></td>
   <td align=center valign=center width=7%><img src=images/class/$class.gif></td>
   <td align=center width=20%>".$mrow['played_week']."</td>
   <td valign=center width=20%>".$mrow['wons_week']."</td>
   <td valign=center width=10%>".$mrow['played_season']."</td>
   <td valign=center width=10%>".$mrow['wons_season']."</td>
   <td valign=center width=10%>".$mrow['personal_rating']."</td>
   <td valign=center width=10%><center><img src='images/status/".$online.".gif' height='18' width='18'></center></td>
   </tr>
   ";

   echo "</table></td></tr></table></center><br><br><br>";

   echo "<table border=1><tr><td><a href='index.php'>Index</a></td></tr></table>";
   }

   ?>
