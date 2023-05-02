//api.themoviedb.org/3/genre/movie/list?api_key=<<api_key>>&language=en-US

let container = document.getElementById("container");
let genre = "";

fetch(`${API.url}genre/movie/list?api_key=${API.key}&language=en-US`)
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data);
    data.genres.forEach((element) => {
      //   console.log(element);
      let categorie = document.createElement("button");
      categorie.setAttribute("value", element.id);
      categorie.innerText = element.name;
      container.append(categorie);
      //   console.log(categorie);
      genre = categorie.value;
    });
  });
console.log(genre);
//api.themoviedb.org/3/movie/top_rated?api_key=<<api_key>>&language=en-US&page=1&genre_id=[action]

fetch(
  `https://api.themoviedb.org/3/discover/movie?api_key=${API.key}&language=en-US&sort_by=popularity.desc&include_adult=false&include_video=false&page=1&with_watch_monetization_types=flatrate&with_genres=80`
)
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data);

    data.results.forEach((element) => {
      //   console.log(element);
      let div = document.querySelector(".container");
      let img = document.createElement("img");
      img.src = API.image + element.poster_path;
      img.style = "width:100px";

      container.append(img);
    });
  });
