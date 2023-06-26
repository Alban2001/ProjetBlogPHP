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

/******************** SYSTEME DE PAGINATION ********************/

const pagination = document.getElementById("pagination");
const nbrElements = document.querySelectorAll("tbody>tr");
const elementsParPage = 5;
const nbrBtn = Math.ceil(nbrElements.length / elementsParPage);
const btnRight = document.getElementById("btnPaginationRight");
const btnLeft = document.getElementById("btnPaginationLeft");

// Création des boutons
for (let i = 1; i <= nbrBtn; i++) {
  const btn = document.createElement("button");
  btn.classList.add("p-2", "m-2", "btnPagination", "btnPaginationGestion");
  const textBtn = document.createTextNode(i);
  btn.appendChild(textBtn);
  pagination.appendChild(btn);
}

const btnPagination = document.querySelectorAll(".btnPagination");
// Mise à jour de la liste
function updateList() {
  for (let el of nbrElements) {
    el.classList.add("d-none");
  }
  for (let btn of btnPagination) {
    btn.classList.remove("btnPaginationActive");
  }
}

// Affichage des 5 premières lignes (par défaut: premier bouton)
updateList();
if (btnPagination[0] !== undefined) {
  btnPagination[0].classList.add("btnPaginationActive");
  for (let i = 0; i < elementsParPage; i++) {
    nbrElements[i].classList.replace("d-none", "table-cell");
  }
}

// Permet d'afficher ou non le bouton de gauche
// Il ne s'affiche si le premier bouton contient la classe btnPaginationActive (s'il est actif)
function afficherBtnLeft() {
  if (btnPagination[0].classList.contains("btnPaginationActive")) {
    btnLeft.classList.add("d-none");
  } else {
    btnLeft.classList.replace("d-none", "d-block");
  }
}

// Permet d'afficher ou non le bouton de droit
// Il ne s'affiche si le dernier bouton contient la classe btnPaginationActive (s'il est actif)
function afficherBtnRight() {
  if (
    btnPagination[btnPagination.length - 1].classList.contains(
      "btnPaginationActive"
    )
  ) {
    btnRight.classList.add("d-none");
  } else {
    btnRight.classList.replace("d-none", "d-block");
  }
}

// Initialisation de l'affichage des boutons droit et gauche dès le départ
afficherBtnLeft();
afficherBtnRight();

// Affichage de l'ensemble des lignes (5 éléments par ligne)
for (let k = 0; k < btnPagination.length; k++) {
  btnPagination[k].onclick = () => {
    updateList();
    btnPagination[k].classList.add("btnPaginationActive");
    afficherListe(k);
    afficherBtnLeft();
    afficherBtnRight();
  };
}

// Bouton gauche (retour arrière)
btnLeft.onclick = () => {
  let index = 0;
  for (let i = 0; i < btnPagination.length; i++) {
    if (btnPagination[i].classList.contains("btnPaginationActive")) {
      updateList();
      index = i - 1;
      afficherListe(index);
      btnPagination[index].classList.add("btnPaginationActive");
      afficherBtnLeft();
      afficherBtnRight();
      break;
    }
  }
};

// Bouton droit (aller à l'avant)
btnRight.onclick = () => {
  let index = 0;
  for (let i = 0; i < btnPagination.length; i++) {
    if (btnPagination[i].classList.contains("btnPaginationActive")) {
      updateList();
      index = i + 1;
      afficherListe(index);
      afficherBtnLeft();
      btnPagination[index].classList.add("btnPaginationActive");
      afficherBtnRight();
      break;
    }
  }
};

// Affichage de la liste des lignes avec l'index concerné
function afficherListe(index) {
  if (index == 0) {
    for (let i = index * elementsParPage; i < elementsParPage; i++) {
      if (nbrElements[i] !== null) {
        nbrElements[i].classList.replace("d-none", "table-cell");
      }
    }
  } else {
    for (
      let i = index * elementsParPage;
      i < index * elementsParPage * 2;
      i++
    ) {
      if (nbrElements[i] !== undefined) {
        nbrElements[i].classList.replace("d-none", "table-cell");
      }
    }
  }
}

// Fermeture du message de succès en 3 secondes
const messageSuccess = document.querySelector(".messageSuccess");
if (messageSuccess !== null) {
  setTimeout(function () {
    messageSuccess.classList.add("d-none");
  }, 3000);
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
