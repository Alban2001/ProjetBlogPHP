/******************** SYSTEME DE PAGINATION ********************/

function pagination(elements, nbrElementsParPage, typeAffichage) {
  const pagination = document.getElementById("pagination");
  const nbrElements = elements;
  const elementsParPage = nbrElementsParPage;
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
      if (nbrElements[i] !== undefined) {
        nbrElements[i].classList.replace("d-none", typeAffichage);
      }
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
          nbrElements[i].classList.replace("d-none", typeAffichage);
        }
      }
    } else {
      for (
        let i = index * elementsParPage;
        i < index * elementsParPage * 2;
        i++
      ) {
        if (nbrElements[i] !== undefined) {
          nbrElements[i].classList.replace("d-none", typeAffichage);
        }
      }
    }
  }
}
