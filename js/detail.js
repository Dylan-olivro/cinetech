const detail = document.getElementById("detail");
const detailMovie = document.getElementById("detailMovie");
const imgURL = "https://image.tmdb.org/t/p/original/";

function getId() {
  let URL = window.location.href;
  let shortURL = URL.split("=")[1];
  let id = shortURL.split("&")[0];
  return id;
}

function getType() {
  let URL = window.location.href;
  let type = URL.split("=")[2];
  return type;
}

let containerDiv = document.createElement("div");
containerDiv.className = "containerDiv";

let divTest = document.createElement("div");
divTest.className = "divTest";

let divInfo = document.createElement("div");
divInfo.className = "divInfo";

detailMovie.append(containerDiv);
containerDiv.append(divTest, divInfo);

let divCast = document.createElement("div");
divCast.className = "divCast";
detailMovie.append(divCast);

let divSimilar = document.createElement("div");
divSimilar.className = "divSimilar";
detailMovie.append(divSimilar);

// FETCH POUR LES DETAILS DU FILM OU DE LA SERIE
fetch(`${API.url}${getType()}/${getId()}?api_key=${API.key}&language=fr-FR`)
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data);
    for (let key in data) {
      if (data.success != false) {
        let p = document.createElement("p");
        if ((typeof data[key] === "string") ^ (typeof data[key] === "number")) {
          if (key == "poster_path" || key == "profile_path") {
            let img = document.createElement("img");
            img.src = imgURL + data[key];
            // img.style = "width:100%";

            divTest.style = "padding: 0 1%";

            // img.style = "margin:1%";

            divTest.append(img);
            //   // detail.style.backgroundColor = "red";
            //   // let img = document.createElement("img");
            //   // img.src = imgURL + data[key];
            //   // // img.style = "width:200px";
            //   // divImage.append(img);
          } else {
            if (
              key != "id" &&
              key != "imdb_id" &&
              key != "backdrop_path" &&
              key != "homepage" &&
              key != "status" &&
              key != "popularity" &&
              key != "tagline" &&
              key != "vote_count" &&
              key != "original_title" &&
              key != "gender" &&
              key != "original_language" &&
              key != "original_name"
            ) {
              if (key == "runtime") {
                let minutes = parseInt(data.runtime % 60, 10);
                let hours = parseInt((data.runtime - minutes) / 60, 10);
                let m = minutes.toString().padStart(2, "0");
                let h = hours.toString().padStart(2, "0");
                p.innerHTML = "<b>" + key + "</b>" + ":" + h + "h" + m;
                divInfo.append(p);
              } else if (key == "vote_average") {
                let note = Math.round(data.vote_average * 10) / 10;
                p.innerHTML = "<b>" + key + "</b>" + ":" + note + "/10";
                divInfo.append(p);
              } else {
                p.innerHTML = "<b>" + key + "</b>" + ":" + data[key];
                divInfo.append(p);
              }
            }
          }
        }
      }
    }
    if (getType() === "movie" || getType() === "tv") {
      let form = document.createElement("form");
      let buttonFavori = document.createElement("button");

      form.setAttribute("method", "post");
      buttonFavori.setAttribute("type", "sumbit");
      buttonFavori.setAttribute("name", "favoris");
      buttonFavori.className = "btnFavoris";
      buttonFavori.textContent = "Ajouter aux Favoris";

      form.append(buttonFavori);
      divInfo.append(form);
    }
  })
  .catch((error) => {
    console.log(error);
  });

//   FETCH POUR LES PHOTO DES DU CASTING ET DU CREW
fetch(
  `${API.url}${getType()}/${getId()}/credits?api_key=${API.key}&language=fr-FR`
)
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data);

    let directorName = document.createElement("p");
    data.crew.forEach((element) => {
      // console.log(element);

      if (element.job == "Director") {
        let director = document.createElement("div");
        divCast.append(director);
        director.className = "director";
        // || element.job == "Executive Producer"
        if (element.profile_path != null) {
          // console.log(element);
          let img = document.createElement("img");
          img.src = imgURL + element.profile_path;
          img.style = "width:200px";
          director.append(img);
          directorName.innerHTML = element.job;
          director.append(directorName);
        }
      }
      // if (element.job == "Screenplay") {
      //     console.log(element);
      // }
    });

    let divActor = document.createElement("div");
    divCast.append(divActor);
    divActor.className = "divActor";

    data.cast.forEach((element) => {
      // console.log(element);
      if (element.known_for_department == "Acting") {
        let linkActor = document.createElement("a");
        let actor = document.createElement("div");

        linkActor.href = `detail.php?id=${element.id}&type=person`;

        divActor.append(linkActor);
        linkActor.append(actor);

        actor.className = "actor";
        // console.log(element);
        if (element.profile_path != null) {
          // console.log(element);
          let img = document.createElement("img");
          let actorName = document.createElement("p");

          img.src = imgURL + element.profile_path;
          img.style = "width:200px";
          actor.append(img);
          actorName.innerText = element.name;
          actor.append(actorName);
        }
      }
    });
  })
  .catch((error) => {
    console.log(error);
  });

// FETCH POUR LES FILM OU SERIE SIMILAIRE
if (getType() === "movie" || getType() === "tv") {
  fetch(
    `${API.url}${getType()}/${getId()}/similar?api_key=${
      API.key
    }&language=en-US`
  )
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      // console.log(data);
      data.results.forEach((element) => {
        // console.log(element);
        let linkSimilar = document.createElement("a");
        let similar = document.createElement("div");

        linkSimilar.href = `detail.php?id=${element.id}&type=${getType()}`;
        similar.className = "similar";

        divSimilar.append(linkSimilar);
        linkSimilar.append(similar);

        // console.log(element);
        let img = document.createElement("img");
        img.src = imgURL + element.poster_path;
        img.style = "width:200px";
        similar.append(img);

        let similarTitle = document.createElement("p");
        if (getType() === "movie") {
          similarTitle.innerHTML = element.title;
          similar.append(similarTitle);
        } else if (getType() === "tv") {
          similarTitle.innerHTML = element.name;
          similar.append(similarTitle);
        }
      });
    });
}
// FETCH POUR LES COMMENTAIRES
// FETCH FAVORIS
fetch("./traitement_favoris.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    data.forEach((element) => {
      if (element.id_media == getId()) {
        let btnFavoris = document.querySelector(".btnFavoris");
        btnFavoris.textContent = "Enlever des Favoris";
        btnFavoris.style = "background-color: yellow";
        // btnFavoris.style = "background-cgiolor: red";
      }
    });
  });
