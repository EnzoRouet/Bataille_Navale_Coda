const cases_libres = document.querySelectorAll(".clickable");
cases_libres.classList;

cases_libres.forEach((case_libre) => {
  case_libre.addEventListener("click", (e) => {
    const x = e.target.dataset.x;
    const y = e.target.dataset.y;

    console.log("Tir demandé aux coordonnées suivantes : " + x + y);

    window.location.href = "?x=" + x + "&y=" + y;
  });
});
