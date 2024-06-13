
/////////////////////////////
// CHANGER L'ICONE DU MDP / MASQUER LE MDP
let toggleBtnIcon = document.querySelector(".icon-mdp"); // .icon-container>span>class="icon-mdp"
let inputMdp = document.querySelector("#mdp"); // .icon-container>input>id="mdp"
toggleBtnIcon.addEventListener("click", function (event) {
    event.preventDefault();
    if (inputMdp.type === "password") {
        inputMdp.type = "text";
        toggleBtnIcon.style.backgroundImage = "url('./img/icons/visibility_FILL0_wght400_GRAD0_opsz24.svg')";
    } else if (inputMdp.type === "text") {
        inputMdp.type = "password";
        toggleBtnIcon.style.backgroundImage = "url('./img/icons/visibility_off_FILL0_wght400_GRAD0_opsz24.svg')";
    }
});
//////////////////////////////////////////////////////////


/////////////////////////////
// CONTROLE DU FORMULAIRE DE CONNEXION
const boutonConnexion = document.querySelector('#bouton-connexion');
const inputEmail = document.querySelector('#email');
const errorMessage = document.querySelector('#index-error-message');
boutonConnexion.addEventListener('click', (event) => {


    fetch("../src/pages/controle_user.php?email=" + inputEmail.value)
        .then(function (response) {
            return response.json();
        })
        .then(function (response) {
            if (response[0].nb !== 1) {
                event.preventDefault();
                inputEmail.style.backgroundColor = "var(--MSX-medium-red)";
                inputEmail.placeholder = "ex: john.doe@email.fr";
                inputMdp.style.backgroundColor = "var(--MSX-medium-red)";
                console.log(response[0].nb);
                // Le mail existe déjà
                errorMessage.style.display = 'block';
                errorMessage.innerHTML = "Adresse ou mot de passe introuvable";
                this.value = "";
                if (inputEmail.addEventListener('focus', function () {
                    errorMessage.innerHTML = "";
                }));
            }
        });
});
//////////////////////////////////////////////////////////

console.log('HELLOWORLD');