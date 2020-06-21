<?php 
session_start();
// session_destroy();

    $_SESSION['username']=null;
    $_SESSION['userid']=null;
    $_SESSION['userpassword']=null;
    $_SESSION['useremail']=null;
    $_SESSION['userrole']=null;

    header("location:login.php");




?>



