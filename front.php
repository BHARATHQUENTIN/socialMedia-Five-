<!-- Home page -->

<?php

include "includes/head.php";

//selecting all the posts according to newwest 
$sql = "SELECT *
        FROM content
        ORDER BY postedat DESC;";

$results = mysqli_query($db, $sql);

if ($results === false) {
    echo mysqli_error($db);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);
}


?>
<main class="">
    <div class="container-fluid">
        <div class="row">

            <div class="waste d-block d-sm-none" style="height: 54px;">waste block</div>
            <div class="col justify-content-center">
                <!-- feed -->
                <div class="row bg-light justify-content-center">
                    <!-- Content for the first row -->


                    <div class="col-auto justify-content-center g-5">
                        <?php foreach ($articles as $article) : ?>
                            <div class="col-12 col-xl-9 mb-4 m-auto">
                                <div class="card col-9 col-lg-8 col-md-7 shadow mx-auto">
                                    <div class="col fs-5 pt-2 pb-2 ps-3 fw-bold bg-gradient bg-light rounded-top">
                                        <a href="article.php?id=<?= $article['id']; ?>" class="text-dark text-decoration-none">
                                            <?= htmlspecialchars($article['username']); ?>
                                        </a>
                                    </div>
                                    <div class="col ps-3 font-italic text-secondary" style="font-size: 13px;">
                                        <?php
                                        $dateTime = new DateTime($article['postedat']); // Use $article['postedat'] here

                                        // Format the date and time in the desired formats
                                        $dateFormatted = $dateTime->format('d-m-Y');
                                        $timeFormatted = $dateTime->format('H:i:s');
                                        ?>

                                        <em>Date:<?= $dateFormatted ?> Time:<?= $timeFormatted ?> </em>
                                    </div>
                                    <div class="col ps-3 pt-2 pb-2 fs-6">
                                        <?= htmlspecialchars($article['caption']); ?>
                                    </div>
                                    <div class="col">
                                        <div class="justify-content-center">
                                            <img class="img-fluid  rounded-bottom" src="<?= htmlspecialchars($article['img']); ?>" alt="" width="600" height="300" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>
            </div>

            <!-- right coloumn on large screen -->
            <div class="col-4 col-lg-3 bg-light sticky-top d-none d-lg-block shadow " style="top: 58px; height: 95vh">
                <div class="container mt-5 ">
                    <div class="row justify-content-center">
                        <div class="col text-center p-5">
                            <div class="rounded-circle overflow-hidden mx-auto shadow-lg mb-5" style="display: flex; justify-content: center;align-items: center;">
                                <img class="img-fluid" src="<?= $imagePath; ?>" alt="Circular Image" style="width: 100%; height: 100%; object-fit: cover" />
                            </div>
                            <h2 class="mt-3"><?= $name; ?></h2>
                            <h6 class="text-secondary mb-3">@<?= $username; ?></h6>
                            <p><?= $bio; ?></p>
                            <a name="" id="" class="btn btn-primary btn-outline-light border-0" href="profile.php">Profile</a>
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
</main>

<?php include "includes/foot.php" ?>