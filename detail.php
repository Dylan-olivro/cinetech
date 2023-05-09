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
    <!-- FONT AWESOME -->
    <script src="https://kit.fontawesome.com/9a09d189de.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php require_once('./include/header.php') ?>

    <main id="detail">

        <!-- SECTION DES INFO DU FILM, SERIE, PERSONNE -->
        <section id="detailMedia">
            <div id="containerImage">
                <img src="" alt="Image du media" id="imgMedia">
            </div>

            <div id="info_favoris">
                <div id="infoMedia">
                    <!-- INFO -->
                    <p id="title"></p>
                    <p id="runtime_Status"></p>
                    <p id="voteAverage_Birthday"></p>
                    <p id="budget_Seasons_Job"></p>
                    <p id="revenue_Episodes_PlaceOfBirth"></p>
                    <p id="genres"></p>
                </div>
                <!-- BUTTON FAVORIS -->
                <?php if (isset($_SESSION['user'])) { ?>
                    <form action="" method="post" id="formFavoris">
                        <button type="submit" name="favoris" id="btnFavoris"><i id="iconFavoris" class="fa-solid fa-heart-circle-plus"></i><span id="word_favoris">Favoris</span></button>
                    </form>
                    <script>
                        function getType() {
                            let URL = window.location.href;
                            let type = URL.split("=")[2];
                            return type;
                        }
                        // ENLEVER LE BOUTON FAVORIS SUR LES PERSON
                        if (getType() === 'person') {
                            const formFavoris = document.getElementById("formFavoris");
                            formFavoris.style = "display: none";
                        }
                    </script>
                <?php } ?>
            </div>
        </section>
        <!-- DESCRIPTION OU BIOGRAPHY -->
        <div id="div_overview_Biography">
            <h5 id="title_overview"></h5>
            <p id="overview_Biography"></p>
        </div>

        <!-- SECTION DU CAST DU MEDIA -->
        <section id="castMedia">
            <div id="director">
                <h3>Directeur et Producteur:</h3>
                <div id="directorList"></div>
            </div>
            <div id="actor">
                <h3>Acteurs :</h3>
                <div id="actorList"></div>
            </div>
        </section>

        <!-- SECTION DES MEDIAS SIMILAIRES -->
        <section id="similarMedia">
            <h3>Similaire</h3>
            <div id="similarList"></div>
        </section>

        <!-- SECTION DES COMMENTAIRES -->
        <section id="commentaireMedia">
            <h3>Commentaire :</h3>
            <?php
            $date = date('Y-m-d H:i:s');
            // RECUPERATION DES COMMENTAIRES
            $retrieveComments = $bdd->prepare("SELECT * FROM users INNER JOIN comment ON users.id = comment.id_user WHERE id_media = ? ORDER BY  comment.date DESC");
            $retrieveComments->execute([$_GET['id']]);
            $resultForTheComments = $retrieveComments->fetchAll(PDO::FETCH_ASSOC);

            if (isset($_SESSION['user'])) { ?>
                <!-- FORM POUR LES COMMENTAIRES -->
                <form action="" method="POST">
                    <input type="text" name="commentaire" placeholder="Comment...">
                    <input type="submit" name="submit">
                </form>

            <?php
                if (isset($_POST['submit'])) {
                    // INSERTION DES NOUVEAU COMMENTAIRES
                    $insertComment = $bdd->prepare("INSERT INTO comment (commentaire,id_user,id_media,date)VALUES (?,?,?,?)");
                    $insertComment->execute([$_POST['commentaire'], $_SESSION['user']['id'], $_GET['id'], $date]);
                    header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
                }

                if (isset($_POST['repondre'])) {
                    // INSERTION DES REPONSES AU COMMENTAIRES
                    $insertResponse = $bdd->prepare("INSERT INTO responses (response,id_user,date)VALUES (?,?,?)");
                    $insertResponse->execute([$_POST['response'], $_SESSION['user']['id'], $date]);

                    $insertLiaison = $bdd->prepare("INSERT INTO liaison_comment (id_comment,id_parent)VALUES (?,?)");
                    $insertLiaison->execute([$bdd->lastInsertId(), $_POST['id_parent']]);
                    header('Location: ./detail.php?id=' . $_GET['id'] . '&type=' . $_GET['type'] . '');
                }
            }
            ?>
            <div>
                <?php
                foreach ($resultForTheComments as $comment) {
                    // RECUPERATION DES REPONSES
                    $retrieveResponses = $bdd->prepare("SELECT liaison_comment.id_parent, liaison_comment.id_comment, responses.*, users.username FROM liaison_comment INNER JOIN responses ON liaison_comment.id_comment = responses.id INNER JOIN users ON users.id = responses.id_user WHERE liaison_comment.id_parent = ? ORDER BY responses.date DESC");
                    $retrieveResponses->execute([$comment['id']]);
                    $resultForTheResponses = $retrieveResponses->fetchAll(PDO::FETCH_ASSOC);
                ?>
                    <div id="commentaire">
                        <!-- AFFICHAGE DES COMMENTAIRES -->
                        <h5><?= $comment['username']; ?> : <span><?= $comment['date'] ?></span></h5>
                        <p><?= $comment['commentaire']; ?></p>
                        <?php if (isset($_SESSION['user'])) { ?>
                            <!-- FORM POUR LES REPONSES -->
                            <form action="" method="POST">
                                <input type="text" name="response" placeholder="Response...">
                                <input type="hidden" name="id_parent" value="<?= $comment['id']; ?>">
                                <input type="submit" name="repondre" value="repondre">
                            </form>
                        <?php } ?>
                    </div>
                    <?php foreach ($resultForTheResponses as $response) { ?>
                        <div id="reponse">
                            <!-- AFFICHAGE DES REPONSES -->
                            <p><?= $response['username'] . ' : ' . $response['date'] ?></p>
                            <p><?= $response['response'] ?></p>
                        </div>
                <?php
                    }
                } ?>
            </div>
        </section>

    </main>
    <?php
    // FAVORIS
    if (isset($_SESSION['user'])) {

        $recupFavoris = $bdd->prepare('SELECT * FROM favoris WHERE id_user = ? AND id_media = ?');
        $recupFavoris->execute([$_SESSION['user']['id'], $_GET['id']]);
        $resultFavoris = $recupFavoris->fetch(PDO::FETCH_ASSOC);

        // INSERTION ET SUPPRESSION DES FAVORIS
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
        // CHANGEMENT DE L'ETAT DU BOUTON
        if (empty($resultFavoris)) { ?>
            <script>
                const iconFavoris = document.getElementById('iconFavoris');
                iconFavoris.className = 'fa-regular fa-star'
                iconFavoris.style.color = '#fff'
            </script>
        <?php
        } else { ?>
            <script>
                iconFavoris.className = 'fa-solid fa-star'
                iconFavoris.style.color = 'orange'
            </script>
    <?php
        }
    }
    ?>
</body>

</html>