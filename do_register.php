<?php
require_once 'dbconfig.php';

if($_POST)
{
    $user_name 		= mysql_real_escape_string($_POST['user_name']);
    $user_email 	= mysql_real_escape_string($_POST['user_email']);
    $user_password 	= mysql_real_escape_string($_POST['password']);
	
	$password 	= password_hash( $user_password, PASSWORD_BCRYPT, array('cost' => 11));
	
    try
    {
        $stmt = $db_con->prepare("SELECT * FROM tbl_users WHERE user_email=:email");
        $stmt->execute(array(":email"=>$user_email));
        $count = $stmt->rowCount();
		
        if($count==0){
            $stmt = $db_con->prepare("INSERT INTO tbl_users(user_name,user_email,user_password) VALUES(:uname, :email, :pass)");
            $stmt->bindParam(":uname",$user_name);
            $stmt->bindParam(":email",$user_email);
            $stmt->bindParam(":pass",$password);

            if($stmt->execute())
            {
                echo "registered";
            }
            else
            {
                echo "Query could not execute !";
            }

        }
        else{

            echo "1";
        }

    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>