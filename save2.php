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
    <title>Détail</title>
    <!-- CSS -->
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/detail.css">
    <!-- JAVASCRIPT -->
    <script src="./js/search.js" defer></script>
    <script src="./js/detail.js" defer></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>

<body>
    <?php require_once('./include/header.php') ?>

    <main id="detail">

        <section id="detailMovie"></section>
        <section class="commentaire">

            <form action="" method="POST">
                <input type="text" name="commentaire" placeholder="Comment...">
                <input type="submit" name="submit">
            </form>



            <?php
            // var_dump($_SESSION);
            if ($_SESSION['user']) {
                if (isset($_POST['submit'])) {
                    $insertComment = $bdd->prepare("INSERT INTO testcomment (commentaire,id_user,id_film,id_parent)VALUES (?,?,?,?)");
                    $insertComment->execute([$_POST['commentaire'], $_SESSION['user']['id'], $_GET['id']]);
                }
            }

            $recupComment = $bdd->prepare("SELECT * FROM users INNER JOIN comment ON users.id = comment.id_user WHERE id_media = ?");
            $recupComment->execute([$_GET['id']]);
            $result = $recupComment->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($result);

            ?>

        </section>
    </main>

</body>

</html>