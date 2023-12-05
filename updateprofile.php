<!DOCTYPE html>
<html lang="en">
<?php

include_once "includes/config.php";
session_start();
if ($_SESSION['username']) {
    $usercnfrm = $_SESSION['username'];
    $sql = "SELECT * from users where username='$usercnfrm';";
    $query = mysqli_query($db, $sql);
    if ($query) {
        $row = mysqli_fetch_assoc($query);
        $img = $row['profilepic'];
        $name = $row['name'];
        $uname = $row['username'];
        $email = $row['email'];
        $bio = $row['bio'];
    } else {
        echo "<script>alert('error in username');</script>";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Title</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            background-image: url('assests/sample.png');

        }

        .row1 {
            width: 32vw;
            height: 25vw;
            margin-top: 3px;
            margin-bottom: 3px;
            margin-right: 3px;
            border-radius: 15px;
            border: 2px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.35);
            -webkit-backdrop-filter: blur(2px);
            backdrop-filter: blur(2px);
            border: 1px solid rgba(255, 255, 255, 0.175);
        }

        .row2 {
            height: 20vw;
            width: 32vw;
            border-radius: 15px;
            border: 2px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255, 255, 255, 0.35);
            -webkit-backdrop-filter: blur(2px);
            backdrop-filter: blur(2px);
            border: 1px solid rgba(255, 255, 255, 0.175)
        }

        .row3 {
            width: 60vw;
            height: 45vw;
            margin-top: 3px;
            margin-bottom: 3px;
            margin-left: 0px;
            border-radius: 15px;
            border: 2px solid black;
            background: rgba(255, 255, 255, 0.3);
            -webkit-backdrop-filter: blur(16px);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            overflow-y: auto;
        }

        .image-upload-container {
            display: flex;
            flex-direction: column;
            align-items: start;
            justify-content: start;
        }

        .image-upload-input {
            display: none;
        }

        .custom-square-image {
            width: 100px;
            height: 100px;
            background-color: white;
            border: 2px solid black;
            display: flex;
            justify-content: start;
            align-items: start;
            cursor: pointer;
            transition: border-color 0.3s ease;

        }

        .custom-square-image:hover {
            border-color: black;
            border-radius: 50%;
            /* Slightly reduce border radius */
            transform: scale(1.5);
            /* Enlarge the image on hover */
        }

        /* Updated style for the image within the container on hover */
        .custom-square-image:hover img {
            border-color: black;
            transform: scale(0.5);
            /* Enlarge the image more on hover */
            transition: transform 0.3s ease;
            /* Apply a smooth transition */
        }

        .button {

            display: flex;
            justify-content: center;
        }

        .bbb {
            display: flex;
            justify-content: space-between;
        }

        .col {
            display: flex;
            justify-content: center;
        }

        .row3 {

            padding: 20px;
        }

        @media (max-width: 768px) {
            .row1 {
                order: 1;
                width: 100%;
                /* height: 40vw; */
            }

            .row2 {
                order: 2;
                display: none;
                /* Corrected property value to hide row2 */
            }

            .row3 {
                order: 3;
                width: 100%;
                height: 100vw;
            }

            .col-4 {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark" style="background-color:black;">
            <a class="navbar-brand" href="front.php">FIVE</a>
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="row1">
                        <div class="image-upload-container">
                            <label for="image-upload" class="image-upload-label">
                                <input type="file" id="image-upload" class="image-upload-input" name="profilepic">
                                <div class="custom-square-image">
                                    <img src="<?= $img; ?>" alt="Upload Image" style="max-width: 100%; max-height: 100%;">
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="row2">

                        <div class="btn  bbb">
                            <a class="btn btn-success" href="front.php">Home</a>
                        </div>
                        <form action="includes/deleteuser.php" method="POST" name="delete">
                            <div class="btn  bbb">
                                <button type="submit" name="delete" class="btn btn-danger">Delete account</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col">
                    <div class="row3">
                        <form action="includes/updatepure.php" method="POST" name="submit">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="name" placeholder="<?= $name; ?>">
                                <label for="floatingInput"><?= $name; ?></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="date" class="form-control" id="floatingDate" name="dob" placeholder="DOB">
                                <label for="floatingDate">DATE/MONTH/YEAR</label>
                            </div>
                            <b>CHOOSE your gender!</b><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="male">
                                <label class="form-check-label" for="inlineRadio1">BOY</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="female">
                                <label class="form-check-label" for="inlineRadio2">GIRL</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="others">
                                <label class="form-check-label" for="inlineRadio3">OTHERS</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingBio" name="bio" placeholder="BIO">
                                <label for="floatingBio">BIO</label>
                            </div>
                            <b>CHANGE EMAIL</b><br>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="changePassword" name="email" placeholder="New email">
                                <label for="New email">New email</label>
                            </div>
                            <b>CHANGE PASSWORD</b><br>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="changePassword" name="upwd" placeholder="New Password">
                                <label for="changePassword">New Password</label>
                            </div>

                            <b>Security question!</b>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="securityQuestion" name="sec_question" placeholder="security">
                                <label for="securityQuestion">What is your pet name?</label>
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="button" class="btn btn-outline-primary mx-2">cancel</button>
                                <button type="submit" class="btn btn-outline-secondary mx-2" name="submit">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- Your footer content remains unchanged -->
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>

</html>