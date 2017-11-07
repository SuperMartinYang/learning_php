<?php

/*
create database injection_db;
use injection_db;
create table users(num int not null, id varchar(30) not null, password varchar(30) not null, primary key(num));

insert into users values(1, 'admin', 'ad1234');
insert into users values(2, 'wh1ant', 'wh1234');
insert into users values(3, 'secuholic', 'se1234');

*** login.php ***
*/

if(empty($_GET['username']) || empty($_GET['password'])){
  echo "<html>";
  echo "<body>";
  echo "<form name='text' action='login.php' method='get'>";
  echo "<h4>USER<!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><input type='text' name='username'><br>";
  echo "PASS<input type='password' name='password'><br></h4>";
  echo "<input type='submit' value='Login'>";
  echo "</form>";
  echo "</body>";
  echo "</html>";
}

else{
  $username = $_GET['username'];
  $password = $_GET['password'];

  $dbhost = 'localhost';
  $dbuser = 'root';
  $dbpass = 'xmm520..';
  $database = 'injection_db';

  $db = mysql_connect($dbhost, $dbuser, $dbpass);
  mysql_select_db($database,$db);
  $sql = mysql_query("select * from users where username='$username' and password='$password'") or die (mysql_error());

  $row = mysql_fetch_array($sql);

  if($row[id] && $row[password]){
    echo "<font color=#FF0000><h1>"."Login sucess"."</h1></u><br>";
    echo "<h3><font color=#000000>"."Hello, "."</u>";
    echo "<font color=#D2691E>".$row[id]."</u></h3><br>";
  }
  else{
    echo "<script>alert('Login failed');</script>";
  }
  mysql_close($db);
}

?>
