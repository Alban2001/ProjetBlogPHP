// Vérification individuelle de chaque champ s'ils sont remplis
const inputContact = document.querySelectorAll(".inputContact");
const messageErreurP = document.querySelectorAll(".messageErreurP");
const messageErreurEmail = document.getElementById("messageErreurEmail");

for (let index in inputContact) {
  inputContact[index].oninput = () => {
    if (messageErreurEmail !== null) {
      messageErreurEmail.classList.add("d-none");
    }
    if (inputContact[index].value.length > 0) {
      inputContact[index].classList.remove("border-danger");
      inputContact[index].classList.add("border-success");
      messageErreurP[index].classList.replace("d-block", "d-none");
    } else {
      inputContact[index].classList.remove("border-success");
      inputContact[index].classList.add("border-danger");
      messageErreurP[index].classList.replace("d-none", "d-block");
    }
  };
}

// Vérification du format de l'adresse mail
inputContact[1].oninput = () => {
  if (messageErreurEmail !== null) {
    messageErreurEmail.classList.add("d-none");
  }
  if (inputContact[1].value.match(/\S+@\S+\.\S+/)) {
    inputContact[1].classList.remove("border-danger");
    inputContact[1].classList.add("border-success");
    messageErreurP[1].classList.replace("d-block", "d-none");
  } else {
    inputContact[1].classList.remove("border-success");
    inputContact[1].classList.add("border-danger");
    messageErreurP[1].classList.replace("d-none", "d-block");
  }
};

// Fermeture du message de succès
const messageSuccess = document.querySelector(".messageSuccess");
if (messageSuccess !== null) {
  setTimeout(function () {
    messageSuccess.classList.add("d-none");
  }, 5000);
}
