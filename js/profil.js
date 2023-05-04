fetch("./traitement_favoris.php")
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    // console.log(data);
    let r = [];
    data.forEach((element) => {
      //   console.log(element.id_media);
      r.push(element.id_media);
      return r;
    });
    return r;
  });
// console.log();
