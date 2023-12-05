<!DOCTYPE html>
<html lang="en">
<?php

session_start(); //comfiguration files
// include "includes/newpost.php";

include_once "includes/config.php";
//pass that username in session
if ($_SESSION['username']) {
    $username = $_SESSION['username']; // Replace with the actual username(dynamic variable ah podanum)
}
$selectQuery = " SELECT * FROM users WHERE username='$username' ";
$result = mysqli_query($db, $selectQuery);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['profilepic'];
    $bio = $row['bio'];
    $name = $row['name'];
} else {
    echo "USER NAME CHECK PANNU DA";
}


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
    $insertquery = "INSERT INTO content (username, caption, img, postedat) VALUES ('$username', '$caption', '$filePath', NOW())";
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "images/posts/" . $file_name);
        mysqli_query($db, $insertquery);
    }
}

?>



<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <style>
        .modal-backdrop {
            display: none !important
        }
    </style>

</head>

<body style="padding-top: 58px;font-family: 'Nunito', sans-serif;">
    <header class="row-auto">
        <!-- place navbar here -->
        <nav class="navbar navbar-dark bg-dark fixed-top justify-content-center">
            <div class="container-fluid justify-content-evenly">
                <div class="col d-flex">

                    <a href="front.php">
                        <img class="img-fluid" src="img/favicon.png" alt="" width="40">
                    </a>

                    <a class="navbar-brand col-auto d-none d-sm-block" href="front.php" style="font-weight: 900;">FIVE</a>
                    <form class="d-flex col-auto d-sm-flex d-none">
                        <input class="form-control me-2 col" type="search" placeholder="Search" aria-label="Search" />
                        <button class="btn btn-outline-success col-auto" type="submit">
                            Search
                        </button>
                    </form>
                </div>
                <div class="col-auto ">

                    <a name="logout" id="logout" class="btn btn-danger" href="includes/logout.php" role="button">Logout</a>
                    
                    <button class="navbar-toggler profile-button rounded-circle d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" style="padding: 0 0px;">
                        <img class="img-fluid  rounded-circle" src="<?= $imagePath; ?>" alt="Circular Image" width="40" />
                        <!-- <i class="bi bi-person-circle" style="font-size: 2rem;"></i> Profile Icon -->
                    </button>
                </div>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                            Profile </h5>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col text-center p-5">
                                    <div class="rounded-circle overflow-hidden mx-auto shadow-lg mb-5" style="display: flex; justify-content: center;align-items: center;">
                                        <img class="img-fluid" src="<?= $imagePath; ?>" alt="Circular Image" style="width: 100%; height: 100%; object-fit: cover" />
                                    </div>
                                    <h2 class="mt-3"><?= $name; ?></h2>
                                    <h6 class="text-secondary mb-3">@<?= $username; ?></h6>
                                    <p><?= $bio; ?></p>
                                    <a name="" id="" class="btn btn-primary btn-outline-light border-0" href="profile.php">Profile</a>
                                    <button type="button" class="btn btn-primary btn-outline-light border-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
                                        +
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">New Post</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="#" method="POST" enctype="multipart/form-data" name="content">
                                                        <div class="mb-3">
                                                            <label for="caption" class="form-label">Post Caption</label>
                                                            <input type="text" name="caption" class="form-control" placeholder="Write your caption here......">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">
                                                                Post Picture
                                                            </label>
                                                            <input type="file" name="img" accept="image/*" required class="form-control">
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" name="content" class="btn btn-primary">Post</button>

                                                    </form>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form class="d-flex col d-sm-none p-3 pb-0">
                <input class="form-control me-2 col" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success col-auto" type="submit">
                    Search
                </button>
            </form>
        </nav>
    </header>