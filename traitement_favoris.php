<?php require_once("./include/bd.php");
$recupFavoris = $bdd->prepare('SELECT * FROM favoris WHERE id_user = ?');
$recupFavoris->execute([$_SESSION['user']['id']]);
$resultFavoris = $recupFavoris->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($resultFavoris);
echo $json;
