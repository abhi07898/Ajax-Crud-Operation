<?php
include "config.php";
$id = $_POST['id'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$sql = "UPDATE student SET `fname`='$fname' , `lname` = '$lname' WHERE `ID`='$id'";

if ($conn->query($sql) === true) {
    echo 1;
} else {
    echo "Error updating record: " . $conn->error;
}
?>