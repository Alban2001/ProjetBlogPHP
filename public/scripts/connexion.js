/*Ce fichier concerne les fichiers PHP suivants :
 *- connexion.php
 *- creationComptes.php*/

// Fichier JavaScript de la page connexion
const eyeOpened = document.getElementById("eye-opened");
const eyeClosed = document.getElementById("eye-closed");
const inputPassword = document.getElementById("input-password-connexion");

// Fonction permettant d'afficher ou de cacher le mot de passe dans le champ de connexion
function afficherCacherMdp(element1, type1, element2, type2) {
  element1.onclick = () => {
    if (element1.classList.contains("d-block")) {
      element1.classList.replace("d-block", "d-none");
      inputPassword.setAttribute("type", type1);
      element2.classList.replace("d-none", "d-block");
    } else {
      element1.classList.replace("d-none", "d-block");
      inputPassword.setAttribute("type", type2);
      element2.classList.replace("d-block", "d-none");
    }
  };
}
// Cacher le mot de passe
afficherCacherMdp(eyeClosed, "text", eyeOpened, "password");
// Afficher le mot de passe
afficherCacherMdp(eyeOpened, "password", eyeClosed, "text");

// Fichier "creationCompte.php"
const inputCompte = document.querySelectorAll(".inputCompte");
const msgErreurC = document.querySelectorAll(".msgErreurC");
const msgErreurMdp = document.getElementById("msgErreurMdp");
const msgErreurMdp2 = document.getElementById("msgErreurMdp2");
const msgErreurMdpConfirmed = document.getElementById("msgErreurMdpConfirmed");
const msgErreurMdpConfirmed2 = document.getElementById(
  "msgErreurMdpConfirmed2"
);
const msgErreurEmail = document.getElementById("msgErreurEmail");
const msgErreurEmail2 = document.getElementById("msgErreurEmail2");
const msgErreurEmail3 = document.getElementById("msgErreurEmail3");

// Fonction qui permet d'afficher ou non les messages d'erreurs avec les bordures sur les champs
function conditionCreationCompte(condition, input, messageErreur) {
  if (condition) {
    input.classList.remove("border-danger");
    input.classList.add("border-success");
    messageErreur.classList.replace("d-block", "d-none");
  } else {
    input.classList.remove("border-success");
    input.classList.add("border-danger");
    messageErreur.classList.replace("d-none", "d-block");
  }
}

msgErreurMdp.classList.add("d-none");

for (let index in inputCompte) {
  // Vérification si les champs sont remplis
  inputCompte[index].oninput = () => {
    conditionCreationCompte(
      inputCompte[index].value.length > 0,
      inputCompte[index],
      msgErreurC[index]
    );
  };
  // L'adresse mail doit respecter le format : exemple@mail.fr
  inputCompte[2].oninput = () => {
    conditionCreationCompte(
      inputCompte[2].value.match(/\S+@\S+\.\S+/),
      inputCompte[2],
      msgErreurEmail
    );
    if (msgErreurEmail2 !== null) {
      msgErreurEmail2.classList.add("d-none");
    }
    if (msgErreurEmail3 !== null) {
      msgErreurEmail3.classList.add("d-none");
    }
  };
  // Le mot de passe doit contenir au moins 8 caractères, un chiffre, une lettre minuscule, une majuscule et un caractères spéciaux
  inputCompte[3].oninput = () => {
    conditionCreationCompte(
      inputCompte[3].value.length >= 12 &&
        inputCompte[3].value.match(/[a-z]/, "g") &&
        inputCompte[3].value.match(/[A-Z]/, "g") &&
        inputCompte[3].value.match(/[0-9]/, "g") &&
        inputCompte[3].value.match(/[?!@#$%^&*)(+=~.;:_-]/, "g"),
      inputCompte[3],
      msgErreurMdp
    );
    if (msgErreurMdp2 !== null) {
      msgErreurMdp2.classList.add("d-none");
    }
    conditionCreationCompte(
      inputCompte[4].value == inputCompte[3].value,
      inputCompte[4],
      msgErreurMdpConfirmed
    );
    if (msgErreurMdpConfirmed2 !== null) {
      msgErreurMdpConfirmed2.classList.add("d-none");
    }
  };

  // Le mot de passe de confirmation doit correspondre à celui du dessus
  inputCompte[4].oninput = () => {
    conditionCreationCompte(
      inputCompte[4].value == inputCompte[3].value,
      inputCompte[4],
      msgErreurMdpConfirmed
    );
    if (msgErreurMdpConfirmed2 !== null) {
      msgErreurMdpConfirmed2.classList.add("d-none");
    }
  };
}

// Fermeture du message de succès en 3 secondes
const messageSuccess = document.querySelector(".messageSuccess");
if (messageSuccess !== null) {
  setTimeout(function () {
    messageSuccess.classList.add("d-none");
  }, 5000);
}
