<?php

session_start();
$showAlert=false;
$next=false;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$conn = mysqli_connect('localhost','root','','feesdb');

if($conn){
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Connection!</strong> Error.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

$sid = $_POST['sid'];
$sname = $_POST['sname'];
$pid = $_POST['pid'];
$bid = $_POST['bid'];
$mno = $_POST['mno'];
$cno = $_POST['cno'];
$edate = $_POST['edate'];

$q = "INSERT INTO `feestb`(`sid`, `sname`, `pid`, `bid`, `mno`, `cno`, `edate`) VALUES ('$sid','$sname','$pid','$bid','$mno','$cno','$edate')";

$result = mysqli_query($conn, $q);
if($result){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Data !</strong> successfully inserted.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    $next=true;
}
else
{
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
        <h2 class="text-center">Fees</h2>
        <div class="col-md-12 mt-2">
            <label for="validationDefault01" class="form-label"><b>Student ID</b></label>
            <input type="text" class="form-control" name="sid" id="validationDefault01" value="" required>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault01" class="form-label"><b>StudentName</b></label>
            <input type="text" class="form-control" name="sname" id="validationDefault01" value="" required>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault01" class="form-label"><b>Pyment ID</b></label>
            <input type="text" class="form-control" name="pid" id="validationDefault01" value="" required>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault01" class="form-label"><b>Booking ID</b></label>
            <input type="text" class="form-control" name="bid" id="validationDefault01" value="" required>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault05" class="form-label"><b>MobileNo</b></label>
            <input type="text" class="form-control" name="mno" id="validationDefault05" required>
        </div>
        <div class="col-md-12 mt-3">
            <label for="validationDefault01" class="form-label"><b>Credit Card No</b></label>
            <input type="text" class="form-control" name="cno" id="validationDefault01" value="" required>
        </div>
        <div class="col-md-12 mt-3">
            <label for="validationDefault01" class="form-label"><b>Expire Date</b></label>
            <input type="date" class="form-control" name="edate" id="validationDefault01" value="" required>
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
            <button class="btn btn-primary" name="submit" type="submit">Submit</button>
            <?php
            if($next){
               echo '<span><button class="btn btn-primary" type="next" name="next"><a class="nav-link active" aria-current="page" href="hostal_detail.php">Next</a></span>';
            }
            ?>
        </div>
    </form>
</div>
<?php include 'footer.php' ?>