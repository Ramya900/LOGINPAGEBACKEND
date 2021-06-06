<?php
session_start();
if(isset($_POST['do_login']))
{
 $host="localhost";
 $username="root";
 $password="";
 $databasename="chock";
 $connect=mysql_connect($host,$username,$password);
 $db=mysql_select_db($databasename);

 $user_email=$_POST['user_email'];
 $user_password=$_POST['user_password'];
 $select_data=mysql_query("select * from user where user_email='$user_email' and user_password='$user_password'");
 if($row=mysql_fetch_array($select_data))
 {
  $_SESSION['user_email']=$row['user_email'];
  echo "success";
 }
 else
 {
  echo "fail";
 }
 exit();
}
?>