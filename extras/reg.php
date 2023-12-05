<?php
include_once "includes/config.php";
if (isset($_POST["submit"])) {//Check if image was uploaded and form method is post
    //img part
	$s=$_POST['username'];
    $file_name = $_FILES['profilepic']['name'];
	$file_tmp =$_FILES['profilepic']['tmp_name'];
	$ext = pathinfo($file_name, PATHINFO_EXTENSION);
	$file_name = $s.".".$ext;
	$filePath="images/profile/".$file_name;
    //img end
	$name = $_POST['name'];
	$username = $_POST['username'];
	$dob = $_POST['dob'];
	$email = $_POST['email'];
	$upwd = $_POST['upwd'];
	$gender = $_POST['gender'];
    $bio = $_POST['bio'];
    $sec_question = $_POST['sec_question'];
	$query = "INSERT INTO users (name,username,dob,email,upwd,gender,bio,sec_question,profilepic) VALUES ('$name', '$username', '$dob', '$email', '$upwd', '$gender', '$bio', '$sec_question', '$filePath')";
	$emquery = "SELECT username FROM users WHERE username='$username'";
	$check = mysqli_num_rows(mysqli_query($db, $emquery));
	if ($check == 0) {//check for existing user
        move_uploaded_file($file_tmp,"images/profile/".$file_name);
		mysqli_query($db, $query);
		echo "<script>alert('Registration Successful');window.location.href='front.php';</script>";
	} else {
		echo "<script>alert('Already Registered');window.location.href='userlogin.php';</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USER REGISTRATION</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">
        <form action="#" method="POST" name="users" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="John">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">User Name</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="john_aaron">
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">DOB</label>
                <input type="date" class="form-control" id="dob" name="dob" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="upwd" class="form-label">Password</label>
                <input type="password" class="form-control" id="upwd" name="upwd" placeholder="************">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Gender</label>
                <input type="text" class="form-control" name="gender" id="exampleFormControlInput1" placeholder="male">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Bio</label>
                <input type="text" class="form-control" name="bio" id="exampleFormControlInput1" placeholder="Enter your bio here">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Security Question</label>
                <input type="text" class="form-control" name="sec_question" id="exampleFormControlInput1" placeholder="dhoni">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Profilepic</label>
                <input type="file" name="profilepic" accept="image/*" required class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <input type="submit" name="submit" class="btn btn-success">
            </div>
        </form>
    </div>
</body>

</html>