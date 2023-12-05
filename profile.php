<!DOCTYPE html>
<html lang="en">

<?php

include_once "includes/config.php";
session_start();
// $_SESSION['username'] = 'narutouzumaki';
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



  //selecting all the posts according to newwest 
  $sql2 = "SELECT *
        FROM content WHERE username='$usercnfrm'
        ORDER BY postedat DESC;";
  $results = mysqli_query($db, $sql2);

//Getting post count
  $sql3 = "SELECT count('$usercnfrm') 
          FROM content WHERE username='$usercnfrm'";
  $count = mysqli_query($db,$sql3);
  
  if ($results === false) {
    echo mysqli_error($db);
  } else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
  }



  //insert new post
  if (isset($_POST["contentx"])) {
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
    $insertquery = "INSERT INTO content (username, caption, img) VALUES ('$usercnfrm', '$caption', '$filePath')";
    if (empty($errors) == true) {
      move_uploaded_file($file_tmp, "images/posts/" . $file_name);
      mysqli_query($db, $insertquery);
      header("Location: profile.php");
    }
  }
}
?>

<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">



  <style>
    /* General Scrollbar Styling */
    ::-webkit-scrollbar {
      width: 10px;
      /* Width of the scrollbar */
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
      /* Color of the track (background) */
      border-radius: 10px;
      /* Rounded corners */
    }

    /* Handle (Thumb) */
    ::-webkit-scrollbar-thumb {
      background: #888;
      /* Color of the handle */
      border-radius: 10px;
      /* Rounded corners */
    }

    /* Handle (Thumb) on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555;
      /* Darken the handle on hover */
    }

    body {
      width: 100%;
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      min-height: 100vh;
      font-family: "Poppins", sans-serif;
      background-color: lightblue;
    }


    ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
      align-items: center;
    }

    a {
      text-decoration: none;
    }

    .header__wrapper header {
      width: 100%;
      background: url("images/posts/2.jpg") no-repeat 50% 20% / cover;
      min-height: calc(10px + 15vw);
    }

    .header__wrapper .cols__container .left__col {
      padding: 25px 20px;
      text-align: center;
      max-width: 350px;
      position: relative;
      margin: 0 auto;
    }

    .header__wrapper .cols__container .left__col .img__container {
      position: absolute;
      top: -60px;
      left: 50%;
      transform: translatex(-50%);
    }

    .header__wrapper .cols__container .left__col .img__container img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 50%;
      display: block;
      box-shadow: 1px 3px 12px rgba(0, 0, 0, 0.18);
    }

    .header__wrapper .cols__container .left__col .img__container span {
      position: absolute;
      background: #2afa6a;
      width: 16px;
      height: 16px;
      border-radius: 50%;
      bottom: 3px;
      right: 11px;
      border: 2px solid #fff;
    }

    .header__wrapper .cols__container .left__col h2 {
      margin-top: 60px;
      font-weight: 600;
      font-size: 22px;
      margin-bottom: 5px;
    }

    .header__wrapper .cols__container .left__col p {
      font-size: 0.9rem;
      color: #818181;
      margin: 0;
    }

    .header__wrapper .cols__container .left__col .about {
      justify-content: space-between;
      position: relative;
      margin: 35px 0;
    }

    .header__wrapper .cols__container .left__col .about li {
      display: flex;
      flex-direction: column;
      color: #818181;
      font-size: 0.9rem;
    }

    .header__wrapper .cols__container .left__col .about li span {
      color: #1d1d1d;
      font-weight: 600;
    }

    .header__wrapper .cols__container .left__col .about:after {
      position: absolute;
      content: "";
      bottom: -16px;
      display: block;
      background: #cccccc;
      height: 1px;
      width: 100%;
    }

    .header__wrapper .cols__container .content p {
      font-size: 1rem;
      color: #1d1d1d;
      line-height: 1.8em;
    }

    .header__wrapper .cols__container .content ul {
      gap: 30px;
      justify-content: center;
      align-items: center;
      margin-top: 25px;
    }

    .header__wrapper .cols__container .content ul li {
      display: flex;
    }

    .header__wrapper .cols__container .content ul i {
      font-size: 1.3rem;
    }

    .header__wrapper .cols__container .right__col nav {
      display: flex;
      align-items: center;
      padding: 30px 0;
      justify-content: space-between;
      flex-direction: column;
    }

    .header__wrapper .cols__container .right__col nav ul {
      display: flex;
      gap: 20px;
      flex-direction: column;
    }

    .header__wrapper .cols__container .right__col nav ul li a {
      text-transform: uppercase;
      color: #818181;
    }

    .header__wrapper .cols__container .right__col nav ul li:nth-child(1) a {
      color: #1d1d1d;
      font-weight: 600;
    }

    .header__wrapper .cols__container .right__col nav button {
      background: lightslategray;
      color: #fff;
      border: none;
      padding: 10px 25px;
      border-radius: 4px;
      cursor: pointer;
      margin-top: 20px;
    }

    .header__wrapper .cols__container .right__col nav button:hover {
      opacity: 0.8;
    }

    .header__wrapper .cols__container .right__col .photos {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
      gap: 20px;
      max-height: 60vh;
      overflow: auto;

    }

    .header__wrapper .cols__container .right__col .photos img {
      max-width: 100%;
      display: block;
      /* height: 100%; */
      object-fit: cover;
      max-height: 100%;
    }

    .header__wrapper .cols__container .right__col .photos .image-container {


      width: 190px;
      height: 190px;
      position: relative;
    }

    .header__wrapper .cols__container .right__col .photos .image-container img {
      width: 100%;
      height: 100%;
      display: block;
      object-fit: cover;
      border-radius: 3%;
    }

    .header__wrapper .cols__container .right__col .photos .image-caption {
      position: static;
      bottom: 0;
      left: 0;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      color: white;
      padding: 5px;
      font-size: 14px;
      opacity: 0;
      /* Initially hidden */
      transition: opacity 0.3s ease;
    }

    .header__wrapper .cols__container .right__col .photos .image-container:hover .image-caption {
      opacity: 1;
      /* Show caption on hover */
    }

    .bg-lightblue {
      background-color: #CCE2F0;
      /* This is a common light blue color */
    }

    @media (min-width: 868px) {
      .header__wrapper .cols__container {
        max-width: 1200px;
        margin: 0 auto;
        width: 90%;
        justify-content: space-between;
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 50px;
      }

      .header__wrapper .cols__container .left__col {
        padding: 25px 0px;
      }

      .header__wrapper .cols__container .right__col nav ul {
        flex-direction: row;
        gap: 30px;
      }

      @media (min-width: 1017px) {
        .header__wrapper .cols__container .left__col {
          margin: 0;
          margin-right: auto;
        }

        .header__wrapper .cols__container .right__col nav {
          flex-direction: row;
        }

        .header__wrapper .cols__container .right__col nav button {
          margin-top: 0;
        }
      }
    }
  </style>
</head>

<body>
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
        <div><a name="logout" id="logout" class="btn btn-danger" href="includes/logout.php" role="button">Logout</a></div>
      </div>

    </nav>
  </header>


  <div class="header__wrapper">
    <header></header>
    <div class="cols__container">
      <div class="left__col">

        <div class="img__container">
          <img src="<?= $img ?>" alt="image" />
          <span></span>
        </div>


        <h2><?= $name ?></h2>
        <p>@<?= $uname ?></p>
        <p><?= $email ?></p>
        <p></p>

        <ul class="about">
          <li><span>8,073</span>Followers</li>
          <li><span>322</span>Following</li>
          <li><span>4</span>Post</li>
        </ul>

        <div class="content">
          <p>
            <?= $bio ?>
          </p>
          <br>
          <br>
          <a href="updateprofile.php" class="btn btn-primary">Edit</a>

          <button type="button" class="btn btn-primary btn-outline-light border-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            +
          </button>
          <!-- Modal -->
          <div class="modal fade modal-static" id="staticBackdrop" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">New Post</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="#" method="POST" enctype="multipart/form-data" name="contentx">
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
                    <div class="modal-footer">
                      <button type="submit" name="contentx" class="btn btn-primary">Post</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
          <ul>
            <li><i class="fab fa-twitter"></i></li>
            <i class="fab fa-pinterest"></i>
            <i class="fab fa-facebook"></i>
            <i class="fab fa-dribbble"></i>
          </ul>
        </div>
      </div>
      <div class="right__col">
        <nav>
          <ul class="flex-row">
            <li><a href="">photos</a></li>
            <li><a href="">galleries</a></li>
            <li><a href="">groups</a></li>
            <li><a href="">about</a></li>
          </ul>
          <button>Follow</button>
        </nav>

        <div class="photos bg-lightblue p-2">
        <?php if ($articles){
           foreach ($articles as $article) : 
            ?>
            
            <div class="image-container m-auto">
              <img class="img-fluid" src="<?= htmlspecialchars($article['img']); ?>" alt="Photo" />
              <div class="image-caption"><?= htmlspecialchars($article['caption']); ?></div>
            </div>
          <?php endforeach;}
          else{
            echo "<b>No posts to show</b> ";
          } ?>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>