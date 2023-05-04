<?php
require_once("./include/bd.php");
ob_start('ob_gzhandler');
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="#">
    <title>Index</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/header.css">
    <!-- <link rel="stylesheet" href="./css/profil.css"> -->
    <!-- JAVASCRIPT -->
    <script src="./js/search.js" defer></script>
    <script src="./js/profil.js" defer></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous" defer></script>
</head>

<body>
    <?php require_once('./include/header.php') ?>
    <main>
        <div>

        </div>
    </main>
    <?php
    $recupFavoris = $bdd->prepare('SELECT * FROM favoris WHERE id_user = ?');
    $recupFavoris->execute([$_SESSION['user']['id']]);
    $resultFavoris = $recupFavoris->fetchAll(PDO::FETCH_ASSOC);
    // var_dump($resultFavoris);

    foreach ($resultFavoris as $key) {
        # code...
    }
    ?>
</body>

</html>