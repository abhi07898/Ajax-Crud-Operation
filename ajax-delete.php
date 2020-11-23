<?php
include 'config.php';
$id = $_POST['id'];
$sql = "DELETE FROM student WHERE `ID`='$id'";
if ($conn->query($sql) === true) {
    echo 1;
} else {
    echo 0;
}
?>