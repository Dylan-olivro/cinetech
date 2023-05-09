const API_URL = "https://api.themoviedb.org/3/";
const API_KEY = "3dba613b1899e55a6567cb728761bb94";
const API_IMAGE_URL = "https://image.tmdb.org/t/p/w500/";

const container = document.getElementById("container");
const button = document.getElementById("button");

// GENERATION DES SERIE AVEC LA CATEGORIE QUE L'ON VEUX
function fetchSeries(endpoint, container, filtre) {
  fetch(`${API_URL}${endpoint}?api_key=${API_KEY}&language=en-US${filtre}`)
    .then((response) => response.json())
    .then((data) => {
      data.results.forEach((serie) => {
        const img = document.createElement("img");
        const a = document.createElement("a");
        a.href = `detail.php?id=${serie.id}&type=tv`;
        img.src = API_IMAGE_URL + serie.poster_path;
        img.style.width = "100px";
        a.append(img);
        container.append(a);
      });
    })
    .catch((error) => console.error(error));
}

// GENERATION DES BOUTON AVEC LES GENRES DE SERIE
function fetchGenres() {
  fetch(`${API_URL}genre/tv/list?api_key=${API_KEY}&language=en-US`)
    .then((response) => response.json())
    .then((data) => {
      data.genres.forEach((genre) => {
        const button = document.createElement("button");
        const a = document.createElement("a");
        button.setAttribute("value", genre.id);
        button.innerText = genre.name;
        a.href = `serie.php?id=${genre.id}`;
        a.append(button);
        document.getElementById("button").append(a);
      });
    })
    .catch((error) => console.error(error));
}

function getId() {
  const URL = window.location.href;
  return URL.split("=")[1];
}

const genreId = getId();

if (genreId) {
  fetchSeries(
    "discover/tv",
    document.getElementById("serie"),
    `&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_watch_monetization_types=flatrate&with_genres=${genreId}`
  );
}

fetchSeries("tv/popular", document.getElementById("seriePopular"), "");
fetchSeries("tv/top_rated", document.getElementById("serietop_rated"), "");

fetchGenres();
