const API_URL = "https://api.themoviedb.org/3/";
const API_KEY = "3dba613b1899e55a6567cb728761bb94";
const API_IMAGE_URL = "https://image.tmdb.org/t/p/w500/";

function fetchMovies(endpoint, container, filtre, titleText, titleDiv) {
  fetch(`${API_URL}${endpoint}?api_key=${API_KEY}&language=en-US${filtre}`)
    .then((response) => response.json())
    .then((data) => {
      // INSERTION DU TITRE DE LA DIV
      titleDiv.textContent = titleText;

      data.results.forEach((movie) => {
        // INSERTION DES IMAGES AVEC LIEN
        const img = document.createElement("img");
        const a = document.createElement("a");
        // const p = document.createElement("p");
        // p.textContent = movie.title;
        a.href = `detail.php?id=${movie.id}&type=movie`;
        img.src = API_IMAGE_URL + movie.poster_path;
        a.append(img);
        // a.append(img, p);
        container.append(a);
      });
    })
    .catch((error) => console.error(error));
}

function fetchGenres() {
  fetch(`${API_URL}genre/movie/list?api_key=${API_KEY}&language=en-US`)
    .then((response) => response.json())
    .then((data) => {
      data.genres.forEach((genre) => {
        const button = document.createElement("button");
        const a = document.createElement("a");
        button.setAttribute("value", genre.id);
        button.innerText = genre.name;
        a.href = `movie.php?id=${genre.id}`;
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
  fetchMovies(
    "discover/movie",
    document.getElementById("filmGenres"),
    `&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_watch_monetization_types=flatrate&with_genres=${genreId}`,
    "Film par genres",
    document.getElementById("titleGenres")
  );
}

fetchMovies(
  "movie/popular",
  document.getElementById("filmPopularList"),
  "",
  "Film Populaire",
  document.getElementById("titlePopular")
);
fetchMovies(
  "movie/top_rated",
  document.getElementById("topRatedFilmList"),
  "",
  "Film Les Mieux Notés",
  document.getElementById("titleUpcoming")
);
fetchMovies(
  "movie/upcoming",
  document.getElementById("filmUpcomingList"),
  "",
  "Film A Venir",
  document.getElementById("titleToprated")
);

fetchGenres();
