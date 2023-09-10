<?php

session_start();

$showAlert=false;
$exit=false;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$conn = mysqli_connect('localhost', 'root', '', 'signdb');
if (!$conn) {
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Connection!</strong> Error.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

 $user = $_POST['username'];
 $newpassword = $_POST['newpassword'];
 $cpassword = $_POST['cpassword'];

$q = "SELECT * FROM `signtb` WHERE  name='$user' ";
$result = mysqli_query($conn, $q);
if($result>0){
   if( $newpassword == $cpassword) 
   {
        $qu = "UPDATE `signtb` SET `password`='$newpassword' WHERE name='$user' ";
        mysqli_query($conn, $qu);
        header('location:login.php');
   }
}
else
{
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Username !</strong> Do not exits.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="icon" type="image/x-icon" href="img/hm-blue.jpeg" />
    <link rel="stylesheet" type="text/css" href="css/style3.css" />
</head>
            
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
            crossorigin="anonymous"></script>
</body>
<body>
        <div class="contain">
            <h3 class="text-center">Reset Password</h3>
            <form action="<?php
                $url = isset($_SERVER['HTTPS']) &&
                $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
                $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
                ?>" method="POST">
                
                <div class="col-md-12 mt-2">
                    <label for="exampleInputPassword1" class="form-label"><b>Username</b></label>
                    <input type="email" class="form-control" name="username" id="exampleInputPassword1">
                </div>
                <div class="col-md-12 mt-2">
                    <label for="exampleInputPassword1" class="form-label"><b>Create new password</b></label>
                    <input type="password" class="form-control" name="newpassword" id="exampleInputPassword1">
                </div>
                <div class="col-md-12 mt-2">
                    <label for="exampleInputPassword1" class="form-label"><b>Conform Password</b></label>
                    <input type="password" class="form-control" name="cpassword" id="exampleInputPassword1">
                </div>
                <div class="col-12 mt-2">
                    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <?php include 'footer.php' ?>