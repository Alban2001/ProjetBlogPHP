// Permet de fermer le modal pour continuer à écrire l'article
document.getElementById("btnConfirmerAnnuler").onclick = () => {
  location.href = "index.php?action=gestionArticles";
};

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
