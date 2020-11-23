<?php
include "config.php";
$id = $_POST['id'];
$sql = "SELECT * FROM student where `ID` ='$id'" ;
$result = $conn->query($sql);
$output = "";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
 echo '<form action="">
    <table>
        <tr>
            <td colspan="2">You can easly update the values after clicking the save changes</td>
        </tr>
        <tr>
        <input type="hidden" class="edit-id" value=' . $row["ID"] . '>
            <td>First-Name</td>
            <td><input type="text" class = "edit-fname" placeholder = "comes for update" value=' . $row["fname"] . '></td>
        </tr>
        <tr>
            <td>Last-Name</L-Name></td>
            <td><input type="text" class = "edit-lname" placeholder = "comes for update" value=' . $row["lname"] . '></td>
        </tr>
        <div class="modal-footer ">
        <tr>
        <td>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></td>
        <td><button type="button" class="btn btn-outline-success update" data-dismiss="modal">Save changes</button></td>
        </tr>
      </div>
    </table>
</form>';
    }
} else {
     echo 'some concern here';
}

?>