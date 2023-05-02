function showMedia(type) {
  fetch(`${API.url}${type}/top_rated?api_key=${API.key}&language=en-US&page=1`)
    .then((response) => {
      return response.json();
    })
    .then((data) => {
      data.results.forEach((element) => {
        // console.log(data);
        const containerMedia = document.getElementById(`container${type}`);
        const linkMedia = document.createElement("a");
        const divMedia = document.createElement("div");
        const imgMedia = document.createElement("img");
        const captionMedia = document.createElement("div");
        const titleMedia = document.createElement("h3");

        linkMedia.href = `detail.php?id=${element.id}&type=${type}`;

        divMedia.className = "carousel-item";
        imgMedia.className = "d-block w-100";
        captionMedia.className = "carousel-caption d-none d-md-block";

        imgMedia.src = API.image + element.backdrop_path;

        if (type == "movie") {
          titleMedia.textContent = element.title;
        } else {
          titleMedia.textContent = element.name;
        }

        containerMedia.append(linkMedia);
        linkMedia.append(divMedia);
        divMedia.append(imgMedia, captionMedia);
        captionMedia.append(titleMedia);
      });
    })
    .catch((error) => {
      console.log(error);
    });
}
showMedia("movie");
showMedia("tv");
