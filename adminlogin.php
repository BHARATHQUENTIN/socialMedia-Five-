<?php
include ("/opt/lampp/htdocs/FIVE/includes/config.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
    $email=mysqli_real_escape_string($db,$_POST['email']);
    $pwd=mysqli_real_escape_string($db,$_POST['apwd']);
    $mailcheckquery="SELECT admin_id FROM admin WHERE admin_id='$email'";
    $mailcheck=mysqli_query($db,$mailcheckquery);
    if(mysqli_num_rows($mailcheck)>0)
    {
        $query="SELECT apwd FROM admin WHERE admin_id='$email' AND apwd='$pwd'";
        $pwcheck=mysqli_query($db,$query);
        if(mysqli_num_rows($pwcheck))
        {
            echo "<script>alert('Login Successful');window.location.href='https://www.google.com';</script>";
        }
        else{
            echo "<script>alert('Incorrect Password');window.location.href='adminlogin.php';</script>";
        }
    }
    else{
        echo "<script>alert('Admin ID wrong');window.location.href='adminlogin.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="img/favicon.png" type="image/x-icon">
  <title>Admin login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <style>
    body {
      background-image: url("img/background.jpg") !important;
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }

    @media (max-width: 1210px) {
      .right {
        display: none !important;

      }

      .left {
        width: auto !important;
      }

      .container {
        backdrop-filter: blur(3.5px) !important;
      
      }

    }

    .left {
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .container{
      
background: rgba(255, 255, 255, 0.1);
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(3.5px);
      border-radius: 10px;
      border: 1px solid rgba(255, 255, 255, 0.18);
    }
    .right {
      display: flex;
      flex-direction: column;
      justify-content: center;
      
    }
  </style>
  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</head>

<body>
  <div class="container d-flex justify-content-center align-items-center vh-100  text-center">
    <div class="left w-50 gy-sm-3 gy-md-2 py-5 d-flex flex-column align-items-center">
      <div class="logo">
        <img src="img/tplogo.png" alt="OUR LOGO" class="img-fluid mb-5" 
          style="mix-blend-mode: multiply;border: none; height: 100px; width: auto;" />
      </div>
      <form action="adminlogin.php" method="POST">

          <div class="form-content row mx-1">
            <div class="col-12 form-floating mb-5">
              <input type="email" class="form-control rounded-pill" name="email" id="floatingInput" placeholder="name@example.com" />
              <label for="floatingInput">&nbsp;&nbsp;&nbsp;&nbsp;Email address</label>
            </div>
            <div class="col-12 form-floating mb-5">
              <input type="password" class="form-control rounded-pill" name="apwd" id="floatingInput" placeholder="name@example.com" />
              <label for="floatingInput">&nbsp;&nbsp;&nbsp;&nbsp;Password</label>
            </div>
          </div>
          <div class="d-grid d-block col-md-6 col-sm-12 mx-auto mb-3">
            <button class="btn-lg btn-primary rounded-pill" type="submit">
              Signin
            </button>
          </div>
      </form>
    </div>
    <div class="right h-75 w-50 align-items-center justify-content-center">
      <img src="img/output-onlinegiftools.gif" alt="if" width="500" height="500">
    </div>  
  </div>
</body>

</html>