<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="#">
    <title>Détail</title>
    <!-- CSS -->
    <!-- JAVASCRIPT -->
    <!-- BOOTSTRAP -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</head>

<body>
    <?php require_once('./include/header.php') ?>

    <div id="detail"></div>

    <?php
    if (isset($_GET['id'])) {
    ?>
        <script>
            const detail = document.getElementById('detail')
            const imgURL = "https://image.tmdb.org/t/p/original/";

            function getId() {
                let URL = window.location.href;
                let shortURL = URL.split('=')[1]
                let id = shortURL.split('&')[0]
                return id
            }

            function getType() {
                let URL = window.location.href;
                let type = URL.split('=')[2]
                return type
            }


            fetch(`https://api.themoviedb.org/3/${getType()}/${getId()}?api_key=3dba613b1899e55a6567cb728761bb94&language=fr-FR`)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    // console.log(data);
                    for (let key in data) {
                        // console.log(key)
                        console.log(data[key]);
                        let value = data[key];
                        // console.log(value)
                        let p = document.createElement("p");
                        if (typeof value === "string" ^ typeof value === "number") {
                            if (key == 'backdrop_path' || key == 'poster_path' || key == "profile_path") {
                                let img = document.createElement("img");
                                img.src = imgURL + value;
                                img.style = 'width:200px';
                                detail.append(img);
                            } else {
                                if (key != "id" && key != 'imdb_id') {
                                    if (key == 'runtime') {
                                        let minutes = parseInt(data.runtime % 60, 10);
                                        let hours = parseInt((data.runtime - minutes) / 60, 10);
                                        let m = minutes.toString().padStart(2, "0")
                                        let h = hours.toString().padStart(2, "0")
                                        p.innerHTML = '<b>' + key + '</b>' + ':' + h + "h" + m;
                                        detail.append(p);
                                    } else if (key == "vote_average") {
                                        let note = Math.round(data.vote_average * 10) / 10;
                                        p.innerHTML = '<b>' + key + '</b>' + ':' + note;
                                        detail.append(p);
                                    } else {
                                        p.innerHTML = '<b>' + key + '</b>' + ':' + value;
                                        detail.append(p);

                                    }
                                }
                            }
                        }
                    }
                })
                .catch((error) => {
                    console.log(error);
                })


            fetch(`https://api.themoviedb.org/3/${getType()}/${getId()}/credits?api_key=3dba613b1899e55a6567cb728761bb94&language=fr-FR`)
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    console.log(data);

                    let p = document.createElement("p");
                    data.crew.forEach(element => {
                        // console.log(element);

                        if (element.job == "Director") {
                            // || element.job == "Executive Producer"
                            if (element.profile_path != null) {

                                console.log(element);
                                let img = document.createElement("img");
                                img.src = imgURL + element.profile_path;
                                img.style = 'width:200px';
                                detail.append(img);
                                p.innerHTML = element.job;
                                detail.append(p);
                            }
                        }
                        // if (element.job == "Screenplay") {
                        //     console.log(element);
                        // }

                    });

                    data.cast.forEach(element => {
                        // console.log(element);
                        if (element.known_for_department == 'Acting') {
                            // console.log(element);
                            if (element.profile_path != null) {

                                // console.log(element);
                                let img = document.createElement("img");
                                img.src = imgURL + element.profile_path;
                                img.style = 'width:200px';
                                detail.append(img);
                            }
                        }
                        if (element.job == "Screenplay") {
                            console.log(element);
                        }
                    });



                })
                .catch((error) => {
                    console.log(error);
                })
        </script>
    <?php
    }
    ?>
    <style>
        img {
            width: 200px;
        }
    </style>
</body>

</html>