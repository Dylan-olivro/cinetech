const API_URL = "https://api.themoviedb.org/3/";
const API_KEY = "3dba613b1899e55a6567cb728761bb94";
const API_IMAGE_URL = "https://image.tmdb.org/t/p/w500/";

const list_favoris = document.getElementById("list_favoris");
const movies_list = document.getElementById("movies_list");
const series_list = document.getElementById("series_list");
// FETCH POUR MA BASE DE DONNEE
fetch("./traitement_favoris.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    data.forEach((element) => {
      // FETCH POUR LES DETAILS DES FILM FAVORIS
      fetch(
        `${API_URL}${element.type}/${element.id_media}?api_key=${API_KEY}&language=fr-FR`
      )
        .then((response) => {
          return response.json();
        })
        .then((favoris) => {
          let a = document.createElement("a");
          let img = document.createElement("img");
          let titre = document.createElement("p");

          a.href = `detail.php?id=${favoris.id}&type=${element.type}`;
          img.src = API_IMAGE_URL + favoris.poster_path;

          a.append(img, titre);
          if (element.type == "movie") {
            titre.textContent = favoris.title;
            movies_list.append(a);
          } else {
            series_list.append(a);
            titre.textContent = favoris.name;
          }
          // if (movies.childElementCount > 3) {
          //   movies.style.backgroundColor = "red";
          // }
          // console.log(movies.childElementCount);
        });
    });
  });
// console.log(movies);
