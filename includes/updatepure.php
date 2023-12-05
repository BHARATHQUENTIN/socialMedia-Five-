
<?php
include("config.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updateFields = array();

    if (!empty($_POST['name'])) {
        $updateFields[] = "name='" . $_POST['name'] . "'";
    }
    if (!empty($_POST['dob'])) {
        $updateFields[] = "dob='" . $_POST['dob'] . "'";
    }
    if (!empty($_POST['email'])) {
        $updateFields[] = "email='" . $_POST['email'] . "'";
    }
    if (!empty($_POST['upwd'])) {
        $updateFields[] = "upwd='" . $_POST['upwd'] . "'";
    }
    if (!empty($_POST['gender'])) {
        $updateFields[] = "gender='" . $_POST['gender'] . "'";
    }
    if (!empty($_POST['bio'])) {
        $updateFields[] = "bio='" . $_POST['bio'] . "'";
    }
    if (!empty($_POST['sec_question'])) {
        $updateFields[] = "sec_question='" . $_POST['sec_question'] . "'";
    }
    if (!empty($_POST['profilepic'])) {
        $updateFields[] = "profilepic='" . $_POST['profilepic'] . "'";
    }

    $usercnfrm = $_SESSION['username'];
    $updateFieldsStr = implode(', ', $updateFields);
    $query = "UPDATE users SET $updateFieldsStr WHERE username='$usercnfrm'";

    $result = mysqli_query($db, $query);
    if ($result) {
            echo "<script>alert('Changes made successfully'); window.location.href='../updateprofile.php';</script>";

        
    }else {
            echo 1;
        echo "<script>alert('Changes not made'); window.location.href='../updateprofile.php';</script>";
        }
}
 else {
    echo "<script>alert('Failed to make changes'); window.location.href='../updateprofile.php';</script>";
}



?>
