<?php
require_once("./include/bd.php");
ob_start('ob_gzhandler');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <!-- <link rel="stylesheet" href="./styles/style.css"> -->
    <link rel="icon" href="#">
    <link rel="stylesheet" href="./css/index.css">

    <script src="./js/script.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
</head>

<body>
    <?php require_once('./include/header.php') ?>

    <?php
    if (!isset($_SESSION['id'])) {
        echo '<h1 class="text-center titleIndex">Welcome Inconnu</h1>';
    } else {
        echo '<h1 class="text-center titleIndex">Welcome ' . $_SESSION['username'] . '</h1>';
    }
    ?>
    <!-- <h1>TEST</h1> -->
    <div id="containerMovie"></div>
    <div id="containerSerie"></div>
</body>

</html>