<?php
include 'config.php';
$fname = $_POST['first_name'];
$lname = $_POST['last_name'];

$sql = "INSERT INTO student (`fname`, `lname`) VALUES ('$fname', '$lname')";
if ($conn->query($sql) === true) {
    echo("1");
} else {
    echo("0");   
}

?>