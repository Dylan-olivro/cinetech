<?php require_once("./include/bd.php");

// if (isset($_GET['favoris'])) {
$recupFavoris = $bdd->prepare('SELECT * FROM favoris WHERE id_user = ?');
$recupFavoris->execute([$_SESSION['user']['id']]);
$resultFavoris = $recupFavoris->fetchAll(PDO::FETCH_ASSOC);
$json = json_encode($resultFavoris);
echo $json;
// }

// if (isset($_GET['id'])) {
//     $req = $bdd->prepare("SELECT * FROM `animaux` WHERE `id` = ? ");
//     $req->execute([$_GET['id']]);
//     $result = $req->fetchAll(PDO::FETCH_ASSOC);
//     $json = json_encode($result);
//     echo $json;
// }
