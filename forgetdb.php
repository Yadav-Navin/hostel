<?php

session_start();

$conn = mysqli_connect('localhost', 'root', '', 'signdb');
if ($conn) {
    echo "Connection successful";
} else {
    echo "connection Error";
}

 $newpassword = $_POST['newpassword'];
 $cpassword = $_POST['cpassword'];

 

$q = "SELECT * FROM `signtb` WHERE  name='$user' ";
$result = mysqli_query($conn, $q);
if($result ==1){
   if( $newpassword == $cpassword) 
   {
        $qu = "UPDATE `signtb` SET `password`='$newpassword' ";
        mysqli_query($conn, $qu);
        header('location:login.php');
        echo "<script>alert('Password Recovery successfully...')</script>";
   }
}
