export function adminMenu() {
  const teamsContainer = document.querySelector("#teams-container");
  const assignContainer = document.querySelector("#assign-container");
  const reservationsContainer = document.querySelector(
    "#reservations-container"
  );

  const btnStaff = document.querySelector("#btn-teams");
  btnStaff.addEventListener("click", () => {
    console.log("teams");
    teamsContainer.style.display = "flex";
    assignContainer.style.display = "none";
    reservationsContainer.style.display = "none";
  });

  const btnReservations = document.querySelector("#btn-reservations");
  btnReservations.addEventListener("click", () => {
    console.log("resa");
    reservationsContainer.style.display = "flex";
    teamsContainer.style.display = "none";
    assignContainer.style.display = "none";
  });

  const btnAssign = document.querySelector("#btn-assign");
  btnAssign.addEventListener("click", () => {
    console.log("assign");
    assignContainer.style.display = "flex";
    reservationsContainer.style.display = "none";
    teamsContainer.style.display = "none";
  });
}
