let containerMovie = document.getElementById("containerMovie");
let containerSerie = document.getElementById("containerSerie");
// 3dba613b1899e55a6567cb728761bb94
// for (let i = 1; i <= 551; i++) {
fetch(
  `https://api.themoviedb.org/3/movie/upcoming?api_key=3dba613b1899e55a6567cb728761bb94&language=en-US&page=1`
)
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data.results);
    // console.log(data);
    data.results.forEach((element) => {
      let divMovie = document.createElement("div");
      divMovie.className = "item";
      // let titleMovie = document.createElement("p");
      let imgMovie = document.createElement("img");
      imgMovie.src =
        "https://image.tmdb.org/t/p/original" + element.backdrop_path;
      imgMovie.className = "d-block w-100";
      // titleMovie = element.title;
      containerMovie.append(divMovie);
      divMovie.append(imgMovie);
    });
  })
  .catch((error) => {
    console.log(error);
  });

fetch(
  `https://api.themoviedb.org/3/tv/popular?api_key=3dba613b1899e55a6567cb728761bb94&language=en-US&page=1`
)
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data.results);
    console.log(data);
    data.results.forEach((element) => {
      let divSerie = document.createElement("div");
      divSerie.className = "item";
      // let nameSerie = document.createElement("p");
      let imgSerie = document.createElement("img");
      imgSerie.src =
        "https://image.tmdb.org/t/p/original" + element.backdrop_path;
      // nameSerie = element.name;
      containerSerie.append(divSerie);
      divSerie.append(imgSerie);
    });
  })
  .catch((error) => {
    console.log(error);
  });
// }
