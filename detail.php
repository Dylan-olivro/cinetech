<?php
require_once("./include/bd.php");
ob_start('ob_gzhandler');

// FAVORIS
$recupFavoris = $bdd->prepare('SELECT * FROM favoris WHERE id_user = ? AND id_media = ?');
$recupFavoris->execute([$_SESSION['user']['id'], $_GET['id']]);
$resultFavoris = $recupFavoris->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['favoris'])) {

    if (empty($resultFavoris)) {
        $insertFavoris = $bdd->prepare('INSERT INTO favoris (id_media,id_user,type) VALUES (?,?,?)');
        $insertFavoris->execute([$_GET['id'], $_SESSION['user']['id'], $_GET['type']]);
        header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
    } else {
        $deleteFavoris = $bdd->prepare("DELETE FROM favoris WHERE id_user = ? AND id_media = ?");
        $deleteFavoris->execute([$_SESSION['user']['id'], $_GET['id']]);
        header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
    }
}

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
            if ($_SESSION['user']) {
                if (isset($_POST['submit'])) {
                    $insertComment = $bdd->prepare("INSERT INTO comment (commentaire,id_user,id_media)VALUES (?,?,?)");
                    $insertComment->execute([$_POST['commentaire'], $_SESSION['user']['id'], $_GET['id']]);
                }
            }

            $recupComment = $bdd->prepare("SELECT * FROM users INNER JOIN comment ON users.id = comment.id_user WHERE id_media = ?");
            $recupComment->execute([$_GET['id']]);
            $result = $recupComment->fetchAll(PDO::FETCH_ASSOC);

            if (isset($_POST['repondre'])) {
                $insertComment2 = $bdd->prepare("INSERT INTO responses (response,id_user)VALUES (?,?)");
                $insertComment2->execute([$_POST['response'], $_SESSION['user']['id']]);

                $insertResponse = $bdd->prepare("INSERT INTO liaison_comment (id_comment,id_parent)VALUES (?,?)");
                $insertResponse->execute([$bdd->lastInsertId(), $_POST['id_parent']]);
            }

            foreach ($result as $key) {
                $recupResponse = $bdd->prepare("SELECT liaison_comment.id_parent, liaison_comment.id_comment, responses.*, users.username FROM liaison_comment INNER JOIN responses ON liaison_comment.id_comment = responses.id INNER JOIN users ON users.id = responses.id_user WHERE liaison_comment.id_parent = ?");

                $recupResponse->execute([$key['id']]);
                $resul2 = $recupResponse->fetchAll(PDO::FETCH_ASSOC);
            ?>
                <div style="border: 1px solid black;">
                    <div>
                        <div>
                            <h5><?= $key['username']; ?></h5>
                            <p><?= $key['commentaire']; ?></p>
                            <form action="" method="POST">
                                <input type="text" name="response" placeholder="Comment...">
                                <input type="hidden" name="id_parent" value="<?= $key['id']; ?>">
                                <input type="submit" name="repondre" value="repondre">
                            </form>
                        </div>
                        <div>
                            <?php foreach ($resul2 as $key2) { ?>
                                <div>
                                    <p><?= $key2['username'] ?></p>
                                    <p><?= $key2['response'] ?></p>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
    </main>

</body>

</html>