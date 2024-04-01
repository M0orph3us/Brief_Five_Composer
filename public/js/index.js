"use strict";
import { userProfilMenu } from "./imports/profil.js";
import { adminMenu } from "./imports/admin.js";

// const currentPage = window.location.pathname;
// console.log(currentPage);
document.addEventListener("DOMContentLoaded", () => {
  const currentPage = window.location.pathname;
  if (currentPage === `/Brief_Five_Composer/profil`) {
    userProfilMenu();
  }
  if (currentPage === `/Brief_Five_Composer/admin`) {
    adminMenu();
  }
});
