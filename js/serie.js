let container = document.getElementById("container");
let button = document.getElementById("button");

let film = document.getElementById("film");
let popularFilm = document.getElementById("filmPopular");
let upcomingFilm = document.getElementById("filmUpcoming");

function getId() {
  let URL = window.location.href;
  let id = URL.split("=")[1];
  return id;
}

fetch(`${API.url}genre/tv/list?api_key=${API.key}&language=en-US`)
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data);
    data.genres.forEach((element) => {
      //   console.log(element);
      let categorie = document.createElement("button");
      let a = document.createElement("a");

      categorie.setAttribute("value", element.id);
      categorie.innerText = element.name;
      a.href = `serie.php?id=${element.id}`;

      button.append(a);
      a.append(categorie);
    });
  });

if (typeof getId() !== "undefined") {
  fetch(
    `https://api.themoviedb.org/3/discover/tv?api_key=${
      API.key
    }&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_watch_monetization_types=flatrate&with_genres=${getId()}`
  )
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.results.forEach((element) => {
        let img = document.createElement("img");
        img.src = API.image + element.poster_path;
        img.style = "width:100px";

        film.append(img);
      });
    });
}

function fetchMovie(cat) {
  fetch(`${API.url}tv/${cat}?api_key=${API.key}&language=en-US&page=1`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.results.forEach((element) => {
        let img = document.createElement("img");
        img.src = API.image + element.poster_path;
        img.style = "width:100px";

        if (cat == "popular") {
          popularFilm.append(img);
        } else if (cat == "top_rated") {
          upcomingFilm.append(img);
        }
      });
    });
}

fetchMovie("popular");
fetchMovie("top_rated");
// fetchMovie("latest");
// fetch(`${API.url}movie/upcoming?api_key=${API.key}&language=en-US&page=1`)
//   .then((response) => {
//     return response.json();
//   })
//   .then((data) => {
//     console.log(data);
//     data.results.forEach((element) => {
//       let img = document.createElement("img");
//       img.src = API.image + element.poster_path;
//       img.style = "width:100px";
//     });
//   });
