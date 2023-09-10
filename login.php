<?php

session_start();
$showAlert=false;
$showError=false;
$check=false;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$userErr = "";

$conn = mysqli_connect('localhost', 'root', '', 'signdb');
if (!$conn) {
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Connection!</strong> Error.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

$user = $_POST['username'];
$pass = $_POST['password'];


if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
    $mailErr = "Invalid Username formate";
}

$q = "SELECT * FROM `signtb` WHERE  name = '$user' ";

$query = mysqli_query($conn, $q);
$num = mysqli_num_rows($query);
if ($num>0) 
{
    $_SESSION['username'] = $user;
    // $query1="SELECT `name`, `password` FROM `signtb` WHERE name='$user' AND password='$pass' ";
    $q1="SELECT * FROM `signtb` WHERE name='$user' AND password='$pass' ";
    $res=mysqli_query($conn,$q1);
    $test=mysqli_num_rows($res);
    // while($row=mysqli_fetch_assoc($res))
    // {
    //     $check_username=$row['username'];
    //     $check_password=$row['password'];
    // }

    if( $test)
    {
        // echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        // <strong>Login !</strong> successfully.
        // <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        // </div>';
        header('location:personal_info.php');
    }
    else
    {
        echo ' <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>Alert !</strong> username or password is invalid.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
} 
else 
{
    $showError="username doesn't exits please signup";
}
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login-Page</title>
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
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Error !</strong>'. $showError.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    ?>
        <div class="contain">
            <h3 class="text-center">Login</h3>
            <form method = "POST" action ="<?php
                $url = isset($_SERVER['HTTPS']) &&
                $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
                $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
                ?>">
                
                <div class="col-md-12 mt-2">
                    <label for="exampleInputPassword1" class="form-label"><b>Username</b></label>
                    <input type="email" class="form-control" name="username" id="exampleInputPassword1" require>
                </div>
                <div class="col-md-12 mt-2">
                    <label for="exampleInputPassword1" class="form-label"><b>password</b></label>
                    <input type="password" class="form-control" name="password" id="exampleInputPassword1" require>
                </div>
                <div class="forgate-password">
                    <a href="forget.php">Forgate Password?</a>
                </div>
                <div class="sign">
                    <b>Not a Member?</b><a href="signup.php">Signup</a>
                </div>
                <div class="col-12 mt-2">
                    <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                </div>
            </form>
        </div>
        <?php include 'footer.php' ?>