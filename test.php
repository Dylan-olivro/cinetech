<?php
require_once("./include/bd.php");
ob_start('ob_gzhandler');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="films.css">
    <title>Cinetech</title>
</head>

<body>
    <?php
    ?>
    <main>
        <select name="categories" id="categories-select" value="categorie">
            <option value="">Catégorie</option>

        </select>
        <div id="films"></div>
    </main>
</body>

</html>
<script>
    fetch('https://api.themoviedb.org/3/genre/movie/list?api_key=7c8573e07bc29f162cd95a3850c8b3b1&language=en-US', {
        method: 'GET'
    }).then((res) =>
        res.json()
    ).then((data) => {
        data.genres.filter(function(resultats) {
            let select = document.getElementById("categories-select");
            let option = document.createElement('option');
            console.log(resultats.id);
            option.setAttribute('value', resultats.id);
            option.innerHTML = resultats.name;
            select.append(option);
        });

    })
    const elt = document.querySelector("select");
    elt.addEventListener("change", () => {
        let films = document.getElementById("films");
        films.innerHTML = ''; // pour qu'a chaque changement de catégories, il ne me mette pas tout à la suite: action + horror etc..
        const value = elt.value;
        fetch('https://api.themoviedb.org/3/discover/movie?api_key=7c8573e07bc29f162cd95a3850c8b3b1&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_watch_monetization_types=flatrate&with_genres=' + value, {
            method: 'GET'
        }).then((res) =>
            res.json()
        ).then((data) => {
            data.results.forEach(element => {
                //Traitement + affichage des données 
                // console.log(element);
                let p = document.createElement('p');
                let img = document.createElement('img');
                img.src = "https://image.tmdb.org/t/p/original" + element.poster_path;
                p.innerHTML = element.title;
                p.append(img);
                films.append(p);
            })
        })
    })
</script>