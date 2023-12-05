<?php
session_start();
include("includes/config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // username and password sent from form 
    $myemail = mysqli_real_escape_string($db, $_POST['email']);
    $mypassword = mysqli_real_escape_string($db, $_POST['upwd']);
    $query = "SELECT * FROM users where email='$myemail' AND upwd='$mypassword'";
    $get1 = mysqli_query($db, $query);
    if (mysqli_num_rows($get1) > 0) {
        $arr = mysqli_fetch_assoc($get1);
        $_SESSION['log'] = $arr['username'];
        $_SESSION['username']  = $arr['username'];
        echo "<script>alert('Login Successful');window.location.href='front.php';</script>"; //ALBIN HOMEPAGE MATHIKO
    } else {
        echo "<script>alert('Your Login Name or Password is invalid');window.location.href='userlogin.php';</script>";
        exit();
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
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:wght@200&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;

        }

        body {
            background-image: radial-gradient(circle farthest-corner at 10% 20%, rgba(234, 249, 249, 0.67) 0.1%, rgba(239, 249, 251, 0.63) 90.1%);
            font-family: 'Rubik', sans-serif;

        }

        .container {
            mix-blend-mode: multiply;
        }

        .card {
            width: 400px;
            mix-blend-mode: multiply;
        }

        .forgot {
            justify-content: center;
            text-align: center;
        }

        img {
            width: 400px;
            mix-blend-mode: multiply;
            justify-content: center;
        }

        form {
            border-radius: 20px;
            margin-top: 150px !important;
            width: 24% !important;
            background-color: white !important;
            padding: 50px;
        }

        .btn-primary {
            width: 100%;
            border: none;
            border-radius: 50px;
            background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(75, 14, 154, 1) 35%, rgba(0, 212, 255, 1) 100%);

        }

        h3 {
            font-size: 2rem !important;
            font-weight: 700;
            text-align: center;
        }

        h1 {
            font-size: 2rem !important;
            font-weight: 700;
            text-align: center;
        }

        @media only screen and (max-width: 600px) {
            form {
                width: 100% !important;
            }
        }
    </style>
    <title>Document</title>
</head>

<body>


    <!----------------------- Main Container -------------------------->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">

            <!--------------------------- Left Box ----------------------------->

            <div class="col">

                <h3 style="color: dodgerblue; text-align: center;">Connect and share</h3>
                <img src="img/login.gif" alt="" class="img-fluid">

            </div>

            <!--------------------------- right Box ----------------------------->

            <div class="col">
                <form action="userlogin.php" class="mt-0" method="POST" name="submit">
                    <div class="card">
                        <svg class="mx-auto my-1" xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                        <div class="card-body">

                            <h3 class="floatingPassword">WELCOME BACK !</h3>

                            <div class="form-floating mb-2">
                                <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name@example.com">
                                <label for="floatingInput">Email address</label>
                            </div>

                            <div class="form-floating mb-2">
                                <input type="password" class="form-control" name="upwd" id="floatingPassword" placeholder="Password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-primary btn-lg" type="submit" name="submit">Login</button>
                            </div>

                            <div class="forgot mt-3">
                                <p><a href="forgotpw.ph" class="link-offset-2 link-underline link-underline-opacity-0" href="">Forgotten password?
                            </div>

                            <div class="d-grid gap-2 col-6 mx-auto">
                                <a href="signup.php" class="btn btn-success btn-lg" tabindex="-1" role="button" aria-disabled="true">Create account</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

</body>

</html>