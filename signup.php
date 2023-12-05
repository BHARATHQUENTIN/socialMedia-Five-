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
		echo "<script>alert('Registration Successful');window.location.href='userlogin.php';</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Document</title>
</head>
<body>
        <!----------------------- Main Container -------------------------->
     <div class="container d-flex justify-content-center align-items-center min-vh-100">

         <!----------------------- Login Container -------------------------->

         <div class="row border rounded-30 p-3 bg-white shadow box-area">

             <!--------------------------- Left Box ----------------------------->
        <div class="col">
          <form action="signup.php" class="mt-0" method="POST" name="submit" enctype="multipart/form-data">
           <div class="card">
                <div class="card-body">
                  <h3 class="fw-bolder">REGISTER HERE !</h3>
                  <p class="fw-lighter fs-6">Have an account, <a href="userlogin.php" class="link-underline-primary">Sign in</a></p>
                  <!-- form register section -->
                    <div class="col-auto mb-2">
                        <label class="visually-hidden" for="autoSizingInput">Name</label>
                        <input type="text" class="form-control" id="autoSizingInput" name="name" placeholder="Name">
                      </div>


                      <div class="col-auto mb-2">
                        <label class="visually-hidden" for="autoSizingInputGroup">Username</label>
                        <div class="input-group">
                          <div class="input-group-text">@</div>
                          <input type="text" class="form-control" name="username" id="autoSizingInputGroup" placeholder="Username">
                        </div>
                      </div>

                      
                    <div class="col-auto mb-2">
                        <label class="visually-hidden" for="autoSizingInput">DOB</label>
                        <input type="date" class="form-control" id="autoSizingInput" name="dob"  placeholder="DOB">
                      </div>



                      <div class="mb-2">
                        <input type="email" class="form-control" id="formGroupExampleInput" name="email" placeholder="example@gmail.com">
                      </div>

                      <div class="mb-2">
                        <input type="password" class="form-control" id="formGroupExampleInput" name="upwd" placeholder="password">
                        <span class="password__icon text-primary fs-4 fw-bold bi bi-eye-slash"></span>
                      </div>

                      <div class="d-md-flex justify-content-start align-items-left mb-2  py-2">

                        <h6 class="mb-0 me-4">Gender: </h6>
      
                        <div class="form-check form-check-inline mb-0 me-4">
                          <input class="form-check-input" name="gender"  type="radio"  id="femaleGender"
                            value="option1" />
                          <label class="form-check-label" for="femaleGender">Male</label>
                        </div>
      
                        <div class="form-check form-check-inline mb-0 me-4">
                          <input class="form-check-input"  name="gender"  type="radio" id="maleGender"
                            value="option2" />
                          <label class="form-check-label" for="maleGender">Female</label>
                        </div>

                      </div>

                      <div class="form-floating mb-2">
                        <textarea class="form-control" name="bio" placeholder="Leave a comment here" id="floatingTextarea"></textarea>
                        <label for="floatingTextarea">Bio</label>
                      </div>     
    
         
                      <div class="input-group mb-3">
                        <input type="text" class="form-control" name="sec_question" placeholder="What is your favourite pet name?" aria-label="" aria-describedby="button-addon2">
                      </div>

                      <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Profilepic</label>
                <input type="file" name="profilepic" accept="image/*" required class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
                        
                      <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit" name="submit">Create account</button>
                      </div>
            </div> 
      </div>
    </form>




        </div>

         <!--------------------------- right Box ----------------------------->

         
        </div>
    </div>
    
</body>
</html>
