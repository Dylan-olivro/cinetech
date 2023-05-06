<?php
require_once("./include/bd.php");
ob_start('ob_gzhandler');

// FAVORIS
if (isset($_SESSION['user'])) {

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
    <link rel="stylesheet" href="./css/detail_old.css">
    <!-- JAVASCRIPT -->
    <script src="./js/search.js" defer></script>
    <script src="./js/detail_old.js" defer></script>
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>

<body>
    <?php require_once('./include/header.php') ?>

    <main id="detail">

        <section id="detailMovie"></section>
        <section class="commentaire">
            <h3>Commentaire :</h3>

            <?php
            // $date = new DateTime();
            $date = date('Y-m-d H:i:s');
            // var_dump($date);

            $recupComment = $bdd->prepare("SELECT * FROM users INNER JOIN comment ON users.id = comment.id_user WHERE id_media = ? ORDER BY  comment.date DESC");
            $recupComment->execute([$_GET['id']]);
            $result = $recupComment->fetchAll(PDO::FETCH_ASSOC);

            if (isset($_SESSION['user'])) { ?>
                <form action="" method="POST">
                    <input type="text" name="commentaire" placeholder="Comment...">
                    <input type="submit" name="submit">
                </form>

                <?php
                if (isset($_POST['submit'])) {
                    $insertComment = $bdd->prepare("INSERT INTO comment (commentaire,id_user,id_media,date)VALUES (?,?,?,?)");
                    $insertComment->execute([$_POST['commentaire'], $_SESSION['user']['id'], $_GET['id'], $date]);
                    header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
                }

                if (isset($_POST['repondre'])) {
                    $insertComment2 = $bdd->prepare("INSERT INTO responses (response,id_user,date)VALUES (?,?,?)");
                    $insertComment2->execute([$_POST['response'], $_SESSION['user']['id'], $date]);

                    $insertResponse = $bdd->prepare("INSERT INTO liaison_comment (id_comment,id_parent)VALUES (?,?)");
                    $insertResponse->execute([$bdd->lastInsertId(), $_POST['id_parent']]);
                    header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
                }
            }

            foreach ($result as $key) {
                $recupResponse = $bdd->prepare("SELECT liaison_comment.id_parent, liaison_comment.id_comment, responses.*, users.username FROM liaison_comment INNER JOIN responses ON liaison_comment.id_comment = responses.id INNER JOIN users ON users.id = responses.id_user WHERE liaison_comment.id_parent = ? ORDER BY responses.date DESC");
                $recupResponse->execute([$key['id']]);
                $resul2 = $recupResponse->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div style="border: 1px solid black;">
                    <div>
                        <div>
                            <h5><?= $key['username']; ?> : <span><?= $key['date'] ?></span></h5>
                            <p><?= $key['commentaire']; ?></p>
                            <?php if (isset($_SESSION['user'])) { ?>
                                <form action="" method="POST">
                                    <input type="text" name="response" placeholder="Response...">
                                    <input type="hidden" name="id_parent" value="<?= $key['id']; ?>">
                                    <input type="submit" name="repondre" value="repondre">
                                </form>
                            <?php } ?>
                        </div>
                        <div>
                            <?php foreach ($resul2 as $key2) {
                                // var_dump($key2);
                            ?>
                                <div>
                                    <p><?= $key2['username'] . ' : ' . $key2['date'] ?></p>
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