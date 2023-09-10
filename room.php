<?php

session_start();

$showAlert=false;
$exit=false;

if($_SERVER["REQUEST_METHOD"]=="POST")
{
$conn = mysqli_connect('localhost','root','','roomdb');

if(!$conn){
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Connection!</strong> Error.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}

$rid = $_POST['rid'];
$radio = $_POST['ac'];
$optn = $_POST['optn'];
$description = $_POST['description'];

$q = "INSERT INTO `roomtb`(`rid`, `radiobutton`, `opt`, `description`) VALUES ('$rid','$radio','$optn','$description')";
$res = mysqli_query($conn, $q);
if($res){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Inserted !</strong> successfully.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    $exit=true;
}else{

    $showAlert="Item not inserted";
}
}
?>

<?php include 'header.php' ?>
<?php 
    if($showAlert){
    echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Alert !</strong>'. $showAlert.'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
?>
<div class="contain">
    <form action="<?php
                $url = isset($_SERVER['HTTPS']) &&
                $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
                $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];	
                ?>" method="POST">
        <h2 class="text-center">Room Details</h2>
        <div class="col-md-12 mt-2">
            <label for="validationDefault01" class="form-label"><b>Room Id</b></label>
            <input type="text" class="form-control" name="rid" id="validationDefault01" value="" required>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault01" class="form-label"><b>Room Type</b></label>
            <select class="form-select" id="validationDefault03" name="optn" required>
                <option selected disabled value="">No-Choice</option>
                <option selected activate value="">None AC</option>
                <option selected activate value="">AC</option>
                <option selected default value="">Choose...</option>
            </select>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault03" class="form-label"><b>Room and Price</b></label>
            <select class="form-select" id="validationDefault03" name="optn" required>
                <option selected disabled value="">Availabel Room</option>
                <option selected activate value="">None AC-Rs.600 Per_Day</option>
                <option selected activate value="">AC-Rs.1000 Per_Day</option>
                <option selected default value="">Select Room Price</option>
            </select>
        </div>
        <div class="col-md-12 mt-2">
            <label for="validationDefault02" class="form-label"><b>Descreption</b></label>
            <input type="text" class="form-control" name="description" id="validationDefault02" value="" required>
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
            <button class="btn btn-primary" type="submit" name="submit">Submit</button>
            <?php
            if($exit){
               echo '<span><button class="btn btn-danger" type="close" name="close"><a class="nav-link active" aria-current="page" href="home.php">Close</a></span>';
            }
            ?>
        </div>
    </form>
</div>

<?php include 'footer.php' ?>