const API_URL = "https://api.themoviedb.org/3/";
const API_KEY = "3dba613b1899e55a6567cb728761bb94";
const API_IMAGE_URL = "https://image.tmdb.org/t/p/original/";

const detail = document.getElementById("detail");
const detailMedia = document.getElementById("detailMedia");
const title_overview = document.getElementById("title_overview");
const castMedia = document.getElementById("castMedia");
const similarList = document.getElementById("similarList");

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

function isEmpty(data) {
  // SI DES INFOS DU FILM SONT MANQUANT
  if (getType() == "movie") {
    if (!data.poster_path) {
      imgMedia.src = "./assets/nondispo.png";
      imgMedia.style.objectFit = "contain";
    }
    if (!data.title) {
      title.style.display = "none";
    }
    if (!data.runtime) {
      runtime_Status.style.display = "none";
    }
    if (!data.vote_average) {
      voteAverage_Birthday.style.display = "none";
    }
    if (!data.budget) {
      budget_Seasons_Job.style.display = "none";
    }
    if (!data.revenue) {
      revenue_Episodes_PlaceOfBirth.style.display = "none";
    }
    if (!data.genres) {
      genres.style.display = "none";
    }
    if (!data.overview) {
      overview_Biography.textContent = "Aucune description";
    }
  }
  // SI DES INFOS DE LA SERIE SONT MANQUANT
  else if (getType() == "tv") {
    if (!data.poster_path) {
      imgMedia.src = "./assets/nondispo.png";
      imgMedia.style.objectFit = "contain";
    }
    if (!data.name) {
      title.style.display = "none";
    }
    if (!data.status) {
      runtime_Status.style.display = "none";
    }
    if (!data.vote_average) {
      voteAverage_Birthday.style.display = "none";
    }
    if (!data.number_of_seasons) {
      budget_Seasons_Job.style.display = "none";
    }
    if (!data.number_of_episodes) {
      revenue_Episodes_PlaceOfBirth.style.display = "none";
    }
    if (!data.genres) {
      genres.style.display = "none";
    }
    if (!data.overview) {
      overview_Biography.textContent = "Aucune description";
    }
  }
  // SI DES INFOS DE LA PERSONNE SONT MANQUANT
  else {
    if (!data.profile_path) {
      imgMedia.src = "./assets/nondispo.png";
      imgMedia.style.objectFit = "contain";
    }
    if (!data.name) {
      title.style.display = "none";
    }
    if (!data.deathday) {
      runtime_Status.style.display = "none";
    }
    if (!data.birthday) {
      voteAverage_Birthday.style.display = "none";
    }
    if (!data.known_for_department) {
      budget_Seasons_Job.style.display = "none";
    }
    if (!data.place_of_birth) {
      revenue_Episodes_PlaceOfBirth.style.display = "none";
    }
    if (!data.gender) {
      genres.style.display = "none";
    }
    if (!data.biography) {
      overview_Biography.textContent = "Aucune biographie";
    }
  }
}

function format_string(current_id, max_id) {
  return current_id == max_id - 1 ? "" : ", " + " ";
}

function numberWithSpaces(number) {
  return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
}
// FETCH POUR LES INFOS
fetch(`${API_URL}${getType()}/${getId()}?api_key=${API_KEY}&language=fr-FR`)
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    console.log(data);
    const imgMedia = document.getElementById("imgMedia");
    const title = document.getElementById("title");
    const overview_Biography = document.getElementById("overview_Biography");
    const runtime_Status = document.getElementById("runtime_Status");
    const voteAverage_Birthday = document.getElementById(
      "voteAverage_Birthday"
    );
    const budget_Seasons_Job = document.getElementById("budget_Seasons_Job");
    const revenue_Episodes_PlaceOfBirth = document.getElementById(
      "revenue_Episodes_PlaceOfBirth"
    );
    const genres = document.getElementById("genres");

    // SI C'EST UN FILM OU UNE SERIE
    if (getType() === "movie" || getType() === "tv") {
      detail.style.backgroundImage = `url(${API_IMAGE_URL}${data.backdrop_path})`;
      // IMAGE
      imgMedia.src = API_IMAGE_URL + data.poster_path;
      // TITRE DE LA DIV OVERVIEW
      title_overview.textContent = "Description";

      if (getType() === "movie") {
        // TITRE
        title.textContent = data.title;
        // DUREE
        let minutes = parseInt(data.runtime % 60, 10);
        let hours = parseInt((data.runtime - minutes) / 60, 10);
        let m = minutes.toString().padStart(2, "0");
        let h = hours.toString().padStart(2, "0");
        runtime_Status.textContent = `Durée : ${h}h${m}`;
        // BUDGET
        budget_Seasons_Job.textContent = `Budget : ${numberWithSpaces(
          data.budget
        )}$`;
        // REVENUE

        revenue_Episodes_PlaceOfBirth.textContent = `Revenue : ${numberWithSpaces(
          data.revenue
        )}$`;
      } else {
        // TITRE
        title.textContent = data.name;
        // STATUS
        runtime_Status.textContent = data.status;
        // SEASONS
        budget_Seasons_Job.textContent = `Nb de Saisons : ${data.number_of_seasons}`;
        // EPISODES
        revenue_Episodes_PlaceOfBirth.textContent = `Nb d'épisodes : ${data.number_of_episodes}`;
      }
      // DESCRIPTION
      overview_Biography.textContent = data.overview;
      //VOTE
      let note = Math.round(data.vote_average * 10) / 10;
      voteAverage_Birthday.textContent = `Note : ${note}/10`;
      // GENRE
      for (let i = 0; i < data.genres.length; i++) {
        genres.innerHTML +=
          data.genres[i].name + format_string(i, data.genres.length);
      }
    }
    // SI C'EST UNE PERSONNE
    else {
      detail.style.backgroundColor = `#000`;
      // TITRE DE LA DIV OVERVIEW
      title_overview.textContent = "Biographie";
      // CAST
      castMedia.style.display = "none";
      // SIMILAIRE
      similarMedia.style.display = "none";
      // PHOTO
      imgMedia.src = API_IMAGE_URL + data.profile_path;
      // NAME
      title.textContent = data.name;
      // BIOGRAPHY
      overview_Biography.textContent = data.biography;
      // STATUS
      runtime_Status.textContent = `Mort le : ${data.deathday}`;
      // BIRTHDAY
      voteAverage_Birthday.textContent = `Née le : ${data.birthday}`;
      // JOB
      budget_Seasons_Job.textContent = data.known_for_department;
      // PLACE OF BIRTH
      revenue_Episodes_PlaceOfBirth.textContent = data.place_of_birth;
      // GENDER
      if (data.gender == 1) {
        genres.textContent = "Femme";
      } else if (data.gender == 2) {
        genres.textContent = "Homme";
      }
    }
    isEmpty(data);
  })
  .catch((error) => {
    console.log(error);
  });

// FETCH POUR LE CAST
if (getType() === "movie" || getType() === "tv") {
  fetch(
    `${API_URL}${getType()}/${getId()}/credits?api_key=${API_KEY}&language=fr-FR`
  )
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      const directorList = document.getElementById("directorList");
      data.crew.forEach((element) => {
        if (
          element.job == "Director" ||
          element.job == "Producer" ||
          element.job == "Executive Producer"
        ) {
          if (element.profile_path != null) {
            let director_producer = document.createElement("a");
            let img = document.createElement("img");
            let name = document.createElement("p");

            director_producer.href = `detail.php?id=${element.id}&type=person`;
            img.src = API_IMAGE_URL + element.profile_path;
            name.textContent = element.name;

            directorList.append(director_producer);
            director_producer.append(img, name);
          }
        }
      });

      const actorList = document.getElementById("actorList");
      data.cast.forEach((element) => {
        if (element.known_for_department == "Acting") {
          if (element.profile_path != null) {
            let actors = document.createElement("a");
            let img = document.createElement("img");
            let name = document.createElement("p");

            actors.href = `detail.php?id=${element.id}&type=person`;
            img.src = API_IMAGE_URL + element.profile_path;
            name.textContent = element.name;

            actorList.append(actors);
            actors.append(img, name);
          }
        }
      });
    })
    .catch((error) => {
      console.log(error);
    });
}
// FETCH POUR LES FILM OU SERIE SIMILAIRE
if (getType() === "movie" || getType() === "tv") {
  fetch(
    `${API_URL}${getType()}/${getId()}/similar?api_key=${API_KEY}&language=en-US`
  )
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.results.forEach((element) => {
        if (element.poster_path != null) {
          let similar = document.createElement("a");
          let img = document.createElement("img");
          let name = document.createElement("p");

          similar.href = `detail.php?id=${element.id}&type=${getType()}`;
          img.src = API_IMAGE_URL + element.poster_path;
          if (getType() === "movie") {
            name.textContent = element.title;
          } else if (getType() === "tv") {
            name.textContent = element.name;
          }

          similarList.append(similar);
          similar.append(img, name);
        }
      });
    });
}
