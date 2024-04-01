export function userProfilMenu() {
  const myReservationContainer = document.querySelector(
    "#my-reservation-container"
  );
  const myProfilContainer = document.querySelector("#my-profil-container");

  const btnMyReservations = document.querySelector("#btn-my-reservations");
  btnMyReservations.addEventListener("click", () => {
    myReservationContainer.style.display = "flex";
    myProfilContainer.style.display = "none";
  });

  const btnEditProfil = document.querySelector("#btn-edit-profil");
  btnEditProfil.addEventListener("click", () => {
    myProfilContainer.style.display = "flex";
    myReservationContainer.style.display = "none";
  });
}
