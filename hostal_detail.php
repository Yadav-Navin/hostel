<?php

session_start();
$showAlert=false;
$next=false;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$snameErr = $mailErr = $addressErr = $mno = $cityErr = $pinErr ="";

$conn = mysqli_connect('localhost','root','','hostaldb');
if(!$conn){
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Connection!</strong> Error.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

$sname = $_POST['name'];
$dob=$_POST['dob'];
$address = $_POST['address'];
$mail = $_POST['username'];
$mno = $_POST['contact'];
$city = $_POST['city'];
$state = $_POST['state'];
$pin = $_POST['pin'];


if(!preg_match("/^[a-z A-z-' ]*$/",$sname)){
    $snameErr = "Only letters and white space allowed";
}

$q = "INSERT INTO `hostaltb`(`name`, `dob`, `address`, `username`, `contact`, `state`, `city`, `pin`) VALUES ('$sname','$dob','$address','$mail','$mno','$state','$city','$pin')";
$res = mysqli_query($conn, $q);
if($res){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Inserted !</strong> successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    $next=true;
}
else{
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Alert !</strong> Data not inserted.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
}
?>


<?php include 'header.php' ?>
<div class="contain">
    <form action="<?php
                $url = isset($_SERVER['HTTPS']) &&
                $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
                $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
                ?>" method="POST">
        <h2 class="text-center">Hostal Detail</h2>
        <div class="col-md-12 mt-2">
            <label for="validationDefault01" class="form-label"><b>Name</b></label>
            <input type="text" name="name" class="form-control" id="validationDefault01" value="" required>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault03" class="form-label"><b>DOB</b></label>
            <input type="date" name="dob" class="form-control" id="validationDefault02" value="" required>
        </div>
        <div class="form-group mt-2">
            <label for="exampleFormControlTextarea1"><b>Address</b></label>
            <textarea class="form-control rounded-0" name="address" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefaultUsername" class="form-label"><b>Username</b></label>
            <div class="input-group">
                <span class="input-group-text" id="inputGroupPrepend2">@</span>
                <input type="text" class="form-control" name="username" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
            </div>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault03" class="form-label"><b>Contact</b></label>
            <input type="text" class="form-control" name="contact" id="validationDefault04" value="" required>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault04" class="form-label"><b>City</b></label>
            <input type="text" class="form-control" name="city" id="validationDefault04" required>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault04" class="form-label"><b>State</b></label>
            <select class="form-select" name="state" id="validationDefault04" required>
                <option selected default value="">Delhi</option>
                <option selected activate value="">Gujarat</option>
                <option selected activate value="">Uttarpradesh</option>
                <option selected activate value="">Assam</option>
                <option selected activate value="">Madhyapradesh</option>
                <option selected activate value="">Rajashthan</option>
                <option selected activate value="">Maharastra</option>
                <option selected activate value="">Choose.....</option>
            </select>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault05" class="form-label"><b>Pincode</b></label>
            <input type="text" class="form-control" name="pin" id="validationDefault05" required>
        </div>
        <div class="col-12 mt-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" for="invalidCheck2">
                    Agree to terms and conditions
                </label>
            </div>
        </div>
        <div class="col-12 mt-2">
            <button class="btn btn-primary" type="submit">Submit</button>
            <?php
            if($next){
               echo '<span><button class="btn btn-primary" type="next" name="next"><a class="nav-link active" aria-current="page" href="room.php">Next</a></span>';
            }
            ?>
        </div>
    </form>
</div>

<?php include 'footer.php' ?>