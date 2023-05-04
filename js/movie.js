const container = document.getElementById("container");
const button = document.getElementById("button");
const film = document.getElementById("film");
const popularFilm = document.getElementById("filmPopular");
const upcomingFilm = document.getElementById("filmUpcoming");
const topRatedFilm = document.getElementById("topRatedFilm");

// Utiliser const à la place de let pour les variables qui ne seront pas modifiées

function getId() {
  const URL = window.location.href;
  const id = URL.split("=")[1];
  return id;
}

fetch(`${API.url}genre/movie/list?api_key=${API.key}&language=en-US`)
  .then((response) => response.json())
  .then((data) => {
    data.genres.forEach((element) => {
      const categorie = document.createElement("button");
      const a = document.createElement("a");

      categorie.setAttribute("value", element.id);
      categorie.innerText = element.name;
      a.href = `movie.php?id=${element.id}`;

      button.append(a);
      a.append(categorie);
    });
  })
  .catch((error) => console.error(error)); // Ajouter une gestion d'erreur pour la requête fetch

const genreId = getId();

if (genreId) {
  // Vérifier si genreId n'est pas null ou undefined
  fetch(
    `${API.url}discover/movie?api_key=${API.key}&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_watch_monetization_types=flatrate&with_genres=${genreId}`
  )
    .then((response) => response.json())
    .then((data) => {
      data.results.forEach((element) => {
        const img = document.createElement("img");
        const a = document.createElement("a");
        a.href = `detail.php?id=${element.id}&type=movie`;
        img.src = API.image + element.poster_path;
        img.style.width = "100px"; // Utiliser une propriété CSS à la place de l'attribut style

        film.append(a);
        a.append(img);
      });
    })
    .catch((error) => console.error(error)); // Ajouter une gestion d'erreur pour la requête fetch
}

function fetchMovie(cat) {
  fetch(`${API.url}movie/${cat}?api_key=${API.key}&language=en-US&page=1`)
    .then((response) => response.json())
    .then((data) => {
      data.results.forEach((element) => {
        const img = document.createElement("img");
        const a = document.createElement("a");
        a.href = `detail.php?id=${element.id}&type=movie`;

        img.src = API.image + element.poster_path;
        img.style.width = "100px"; // Utiliser une propriété CSS à la place de l'attribut style

        switch (
          cat // Utiliser un switch à la place d'une série de if else if
        ) {
          case "popular":
            a.append(img);
            popularFilm.append(a);
            break;
          case "upcoming":
            a.append(img);
            upcomingFilm.append(a);
            break;
          case "top_rated":
            a.append(img);
            topRatedFilm.append(a);
            break;
          default:
            break;
        }
      });
    })
    .catch((error) => console.error(error)); // Ajouter une gestion d'erreur pour la requête fetch
}

fetchMovie("popular");
fetchMovie("top_rated");
fetchMovie("upcoming");
