const API = {
  key: "3dba613b1899e55a6567cb728761bb94",
  image: "https://image.tmdb.org/t/p/original",
  url: "https://api.themoviedb.org/3/",
};

const search = document.getElementById("search-bar");
const result = document.getElementById("result");

if (search) {
  search.addEventListener("keyup", () => {
    result.innerHTML = "";
    if (search.value != "") {
      fetch(
        `${API.url}search/multi?api_key=${API.key}&language=en-US&page=1&include_adult=false&query=${search.value}`
      )
        .then((response) => {
          return response.json();
        })
        .then((data) => {
          data.results.forEach((element) => {
            let e = document.createElement("p");
            let a = document.createElement("a");
            a.href = `./detail.php?id=${element.id}&type=${element.media_type}`;

            if (element.media_type == "movie") {
              a.innerText = element.title + "(film)";
            } else if (element.media_type == "tv") {
              a.innerText = element.name + "(Serie)";
            } else if (element.media_type == "person") {
              a.innerText = element.name + "(Personne)";
            }
            result.appendChild(e);
            e.appendChild(a);
          });
        });
    }
  });
}
