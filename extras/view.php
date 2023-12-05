<?php
include "includes/config.php";
	$username = "narutouzumaki"; // Replace with the actual username(dynamic variable ah podanum)

$selectQuery = "SELECT profilepic FROM users WHERE username='$username'";
$result = mysqli_query($db, $selectQuery);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $imagePath = $row['profilepic'];
} else {
    echo "USER NAME CHECK PANNU DA";
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
        
        <img src="<?php echo $imagePath; ?>" alt="">//displaying image here
    </div>
</body>

</html>