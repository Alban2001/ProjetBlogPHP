/***
 * Ce fichier concerne les fichiers PHP suivants :
 * - articles/add.php
 * - articles/affichage.php
 * - articles/edit.php
 * - articles/gestion.php
 * - articles/read.php
 */

// Permet de supprimer un article au choix dans la BDD
const btnSupprimerArticle = document.querySelectorAll(".btnSupprimerArticle");
const dataId = document.querySelectorAll("td[data-content=ID]");
const spanDelete = document.getElementById("spanDelete");
const btnConfirmerDelete = document.getElementById("btnConfirmerDelete");
const formDelete = document.getElementById("formDelete");

for (let index in btnSupprimerArticle) {
  // Permet de récupérer l'index du bouton cliqué
  btnSupprimerArticle[index].onclick = () => {
    spanDelete.innerHTML = dataId[index].innerHTML;
    btnConfirmerDelete.onclick = () => {
      const input = document.createElement("input");
      input.setAttribute("id", "inputIdArticle");
      input.setAttribute("name", "id");
      input.setAttribute("type", "hidden");
      formDelete.appendChild(input);
      document.getElementById("inputIdArticle").value =
        dataId[index].innerHTML.trim();
      formDelete.submit();
    };
  };
}

// SYSTEME DE PAGINATION
const section = document.querySelector("section");
if (section.id == "affichageArticles") {
  const elementsAffichageArticles = document.querySelectorAll(".card");
  pagination(elementsAffichageArticles, 6, "d-block");
} else if (section.id == "gestionArticles") {
  const elementsGestionArticles = document.querySelectorAll("tbody>tr");
  pagination(elementsGestionArticles, 5, "table-cell");
}

// Fermeture du message de succès en 3 secondes
const messageSuccess = document.querySelector(".messageSuccess");
if (messageSuccess !== null) {
  setTimeout(function () {
    messageSuccess.classList.add("d-none");
  }, 5000);
}

// Permet de fermer le modal pour continuer à écrire l'article
const btnConfirmerAnnuler = document.getElementById("btnConfirmerAnnuler");
if (btnConfirmerAnnuler !== null) {
  btnConfirmerAnnuler.onclick = () => {
    location.href = "index.php?action=gestionArticles";
  };
}

// Vérification individuelle de chaque champ s'ils sont remplis
const inputAjoutArticle = document.querySelectorAll(".inputAjoutArticle");
const messageErreurP = document.querySelectorAll(".messageErreurP");

for (let index in inputAjoutArticle) {
  inputAjoutArticle[index].oninput = () => {
    if (inputAjoutArticle[index].value.length > 0) {
      inputAjoutArticle[index].classList.remove("border-danger");
      inputAjoutArticle[index].classList.add("border-success");
      messageErreurP[index].classList.replace("d-block", "d-none");
    } else {
      inputAjoutArticle[index].classList.remove("border-success");
      inputAjoutArticle[index].classList.add("border-danger");
      messageErreurP[index].classList.replace("d-none", "d-block");
    }
  };
}

// Permet d'afficher et de mettre à jour l'image instantanément
const inputFileImage = document.getElementById("inputFileImage");
const imgEditArticle = document.getElementById("imgEditArticle");

if (inputFileImage !== null) {
  inputFileImage.onchange = () => {
    imgEditArticle.classList.replace("d-none", "d-block");
    imgEditArticle.src = window.URL.createObjectURL(inputFileImage.files[0]);
  };

  imgEditArticle.onclick = () => {
    imgEditArticle.click();
  };
}

// Affichage de l'article pour le commentaire
const textareaCommentaire = document.getElementById("textarea-commentaire");
const messageErreurCommentaire = document.querySelector(
  ".messageErreurCommentaire"
);
const btnEnvoyerCommentaire = document.getElementById("btnEnvoyerCommentaire");

if (textareaCommentaire !== null) {
  textareaCommentaire.oninput = () => {
    if (textareaCommentaire.value.length > 0) {
      textareaCommentaire.classList.remove("border-danger");
      textareaCommentaire.classList.add("border-success");
      messageErreurCommentaire.classList.replace("d-block", "d-none");
      btnEnvoyerCommentaire.disabled = false;
    } else {
      textareaCommentaire.classList.remove("border-success");
      textareaCommentaire.classList.add("border-danger");
      messageErreurCommentaire.classList.replace("d-none", "d-block");
      btnEnvoyerCommentaire.disabled = true;
    }
  };
}
