// 3dba613b1899e55a6567cb728761bb94
// for (const i = 1; i <= 551; i++) {

// FETCH POUR LES FILMS QUI VIENNENT DE SORTIR
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
      const containerMovie = document.getElementById("containerMovie");
      const divMovie = document.createElement("div");
      const imgMovie = document.createElement("img");
      const captionMovie = document.createElement("div");
      const titleMovie = document.createElement("h3");
      titleMovie.textContent = element.title;

      divMovie.className = "item";
      imgMovie.className = "d-block w-100";
      captionMovie.className = "carousel-caption";

      imgMovie.src =
        "https://image.tmdb.org/t/p/original" + element.backdrop_path;

      containerMovie.append(divMovie);
      divMovie.append(imgMovie, captionMovie);
      captionMovie.append(titleMovie);
    });
  })
  .catch((error) => {
    console.log(error);
  });

// FETCH POUR LES SERIES LES PLUS POPULAIRES
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
      const containerSerie = document.getElementById("containerSerie");
      const divSerie = document.createElement("div");
      const imgSerie = document.createElement("img");
      const captionSerie = document.createElement("div");
      const nameSerie = document.createElement("h3");
      nameSerie.textContent = element.name;

      divSerie.className = "item";
      imgSerie.className = "d-block w-100";
      captionSerie.className = "carousel-caption";

      imgSerie.src =
        "https://image.tmdb.org/t/p/original" + element.backdrop_path;

      containerSerie.append(divSerie);
      divSerie.append(imgSerie, captionSerie);
      captionSerie.append(nameSerie);
    });
  })
  .catch((error) => {
    console.log(error);
  });
// }
