/***
 * Ce fichier concerne les fichiers PHP suivants :
 * - gestionUsers.php
 * - gestionComments.php
 */

// Permet de valider un utilisateur/commentaire au choix dans la BDD
const btnValider = document.querySelectorAll(".btnValider");
const dataId = document.querySelectorAll("td[data-content=ID]");
const spanID = document.getElementById("spanID");
const btnConfirmerValider = document.getElementById("btnConfirmerValider");
const formValider = document.getElementById("formValider");

for (let index in btnValider) {
  // Permet de récupérer l'index du bouton cliqué
  btnValider[index].onclick = () => {
    spanID.innerHTML = dataId[index].innerHTML;
    btnConfirmerValider.onclick = () => {
      const input = document.createElement("input");
      input.setAttribute("id", "inputId");
      input.setAttribute("name", "id");
      input.setAttribute("type", "hidden");
      formValider.appendChild(input);
      document.getElementById("inputId").value = dataId[index].innerHTML.trim();
      formValider.submit();
    };
  };
}

// Fermeture du message de succès en 3 secondes
const messageSuccess = document.querySelector(".messageSuccess");
if (messageSuccess !== null) {
  setTimeout(function () {
    messageSuccess.classList.add("d-none");
  }, 3000);
}

// Pagination
const elementsGestionUsers = document.querySelectorAll("tbody>tr");
pagination(elementsGestionUsers, 5, "table-cell");
