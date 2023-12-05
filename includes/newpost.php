<?php
if (isset($_POST["content"])) {
    $errors = array();
    $filenamefetch = "SELECT MAX(id) FROM content";
    $fetchFileName = mysqli_query($db, $filenamefetch);
    $row = mysqli_fetch_assoc($fetchFileName);
    $nextId = $row['MAX(id)'] + 1;
    $s = $fetchFileName;
    $file_name = $_FILES['img']['name'];
    $file_tmp = $_FILES['img']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $file_name = $nextId . "." . $ext; //filename is the current id
    $filePath = "images/posts/" . $file_name;
    $caption = $_POST['caption'];
    $insertquery = "INSERT INTO content(caption,img) VALUES ('$caption','$filePath')";
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/posts/" . $file_name);
        mysqli_query($db, $insertquery);
        echo "alert('Some error encountered!!');<script>window.location.href='front.php';</script>";
    } else {
        echo "<script>alert('Some error encountered!!');window.location.href='front.php';</script>";
    }
}
else{
    echo "<script>alert('Some error encountered!!');window.location.href='front.php';</script>";
}
?>
