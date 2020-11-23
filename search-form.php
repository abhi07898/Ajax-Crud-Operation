<?php
include "config.php";
$key = $_POST['key'];
$sql = "SELECT * FROM student WHERE `fname` LIKE '%$key%'" ;
$result = $conn->query($sql);
$output = "";
if ($result->num_rows > 0) {
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
              <tr>
                <th width="60px">Id</th>
                <th>Name</th>
                <th width="90px">Edit</th>
                <th width="90px">Delete</th>
              </tr>';
    while ($row = $result->fetch_assoc()) {
        $output .= "<tr><td align='center'>{$row["ID"]}</td><td>{$row["fname"]} {$row["lname"]}</td><td align='center'><button class='edit-btn' data-eid='{$row["ID"]}' data-toggle='modal' data-target='#exampleModal'>Edit</button></td><td align='center'><button Class='delete-btn' data-id='{$row["ID"]}'>Delete</button></td></tr>" ;
    }
    $output .= "</table>";
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}
?>