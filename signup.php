<?php

session_start();

$showAlert=false;
$showError=false;
$exits=false;

if($_SERVER["REQUEST_METHOD"]=="POST")
{

$conn = mysqli_connect('localhost','root','','signdb');
if(!$conn){
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Connection!</strong> Error.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

$user = $_POST['user'];
$pass = $_POST['pass'];
$cpass = $_POST['cpass'];

$sql="SELECT * FROM `signtb` WHERE  name='$user' ";

$res = mysqli_query($conn, $sql);
$row=mysqli_num_rows($res);
if($row>0)
{
    echo ' <div class="alert alert-info alert-dismissible fade show" role="alert">
    <strong>User</strong> alredy exits.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
else
{
    if($pass===$cpass)
    {
        $qy = "INSERT INTO `signtb`(`name`, `password`) VALUES ('$user','$pass')";
        mysqli_query($conn, $qy);

        header('location:login.php');
    }
    else
    {
        $showError="Password do not match";
    }
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sign_up</title>
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
    <?php 
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error !</strong>'. $showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
        <div class="contain">
            <h3 class="text-center">Sign_up</h3>
            <form action="<?php
                $url = isset($_SERVER['HTTPS']) &&
                $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
                $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
                ?>" method="POST">
                
                <div class="col-md-12 mt-2">
                    <label for="exampleInputPassword1" class="form-label"><b>Username</b></label>
                    <input type="email" class="form-control" name="user" id="exampleInputPassword1" require>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="exampleInputPassword1" class="form-label"><b>password</b></label>
                    <input type="password" class="form-control" name="pass" id="exampleInputPassword1" require>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="exampleInputPassword1" class="form-label"><b>Conform password</b></label>
                    <input type="password" class="form-control" name="cpass" id="exampleInputPassword1" require>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <?php include 'footer.php' ?>