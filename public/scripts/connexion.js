// Fichier JavaScript de la page connexion

const eyeOpened = document.getElementById("eye-opened");
const eyeClosed = document.getElementById("eye-closed");
const inputPassword = document.getElementById("input-password-connexion");

// Fonction permettant d'afficher ou de cacher le mot de passe dans le champ de connexion
function afficherCacherMdp(element1, type1, element2, type2) {
  element1.onclick = () => {
    if (element1.classList.contains("d-block")) {
      element1.classList.remove("d-block");
      element1.classList.add("d-none");
      inputPassword.setAttribute("type", type1);
      element2.classList.add("d-block");
      element2.classList.remove("d-none");
    } else {
      element1.classList.add("d-block");
      element1.classList.remove("d-none");
      inputPassword.setAttribute("type", type2);
      element2.classList.remove("d-block");
      element2.classList.add("d-none");
    }
  };
}
// Cacher le mot de passe
afficherCacherMdp(eyeClosed, "text", eyeOpened, "password");
// Afficher le mot de passe
afficherCacherMdp(eyeOpened, "password", eyeClosed, "text");
